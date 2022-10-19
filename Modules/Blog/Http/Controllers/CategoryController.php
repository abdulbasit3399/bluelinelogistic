<?php

namespace Modules\Blog\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Modules\Blog\Events\CategoryCreatedEvent;
use Modules\Blog\Events\CategoryUpdatedEvent;
use Modules\Blog\Repositories\CategoryRepository;
use Modules\Blog\Http\Requests\CategoryRequest;
use Modules\Blog\Http\DataTables\CategoriesDataTable;
use Modules\Blog\Entities\Category;
use Modules\Blog\Transformers\CategorySelectResource;

class CategoryController extends Controller
{


    private $categoryRepo;

    public function __construct(CategoryRepository $categoryRepo)
    {
        $this->categoryRepo = $categoryRepo;
        // check on permissions
        $this->middleware('can:manage-blog');
        $this->middleware('can:view-categories')->only('index');
        $this->middleware('can:create-categories')->only('store');
        $this->middleware('can:edit-categories')->only('edit', 'update');
        $this->middleware('can:delete-categories')->only('delete', 'multiDestroy');
    }


    /**
     * Display a listing of the resource.
     * @return CategoriesDataTable
     */
    public function index(CategoriesDataTable $dataTable)
    {
        breadcrumb([
            [
                'name' => __('blog::view.blog'),
            ],
            [
                'name' => __('blog::view.categories'),
            ],
        ]);
        $data_with = [
            'category_list' => $this->categoryRepo->category_list_for_select()
        ];
        $share_data = array_merge(get_class_vars(CategoriesDataTable::class), $data_with);
        $adminTheme = env('ADMIN_THEME', 'adminLte');     
          
        return $dataTable->render('blog::'.$adminTheme.'.pages.categories.index', $share_data);


    }


    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(CategoryRequest $request)
    {
        if (env('DEMO_MODE') == 'On') {
            return redirect()->back()->with(['error_message_alert' => __('view.demo_mode')]);
        }
        
        $data = $request->only(['name', 'slug', 'description', 'parent_id']);
        $category = Category::create($data);
        $category->addFromMediaLibraryRequest($request->image)->toMediaCollection('featured_image');
        event(new CategoryCreatedEvent($category));
        return redirect()->route('categories.index')->with(['message_alert' => __('blog::messages.categories.created')]);
    }


    /**
     * Store a simple newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function simpleStore(Request $request)
    {
        $request->validate(['name' => 'required|string|max:100']);
        $data = $request->only(['name', 'parent_id']);
        $data['slug'] = \Str::slug($data['name']);
        $category = Category::create($data);
        event(new CategoryCreatedEvent($category));
        return response()->json(['category' => new CategorySelectResource($category), 'message' => __('blog::messages.categories.created')]);
    }


    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        breadcrumb([
            [
                'name' => __('blog::view.blog'),
            ],
            [
                'name' => __('blog::view.categories'),
                'path' => fr_route('categories.index')
            ],
            [
                'name' => __('blog::view.edit_category')
            ]
        ]);
        $category = Category::findOrFail($id);

        $adminTheme = env('ADMIN_THEME', 'adminLte');
        return view('blog::'.$adminTheme.'.pages.categories.edit')->with([
            'model' => $category,
            'category_list' => $this->categoryRepo->parents_list_for_select($id)
        ]);
    }


    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Category
     */
    public function update(CategoryRequest $request, $id)
    {
        if (env('DEMO_MODE') == 'On') {
            return redirect()->back()->with(['error_message_alert' => __('view.demo_mode')]);
        }

        $category = Category::findOrFail($id);
        $data = $request->only(['name', 'slug', 'description', 'parent_id']);
        $data['active'] = $request->active ? true : false;
        $category->update($data);
        $category->syncFromMediaLibraryRequest($request->image)->toMediaCollection('featured_image');
        event(new CategoryUpdatedEvent($category));
        return redirect()->route('categories.index')->with(['message_alert' => __('blog::messages.categories.saved')]);
    }

    /**
     * Remove one user from database.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        if (env('DEMO_MODE') == 'On') {
            return redirect()->back()->with(['error_message_alert' => __('view.demo_mode')]);
        }

        $category = Category::withCount('posts as posts_count')->findOrFail($id);
        if ($category) {
            if ($category->posts_count) {
                return response()->json(['message' => __('blog::messages.categories.deleted_failed_related')], 403);
            }
            Category::destroy($id);
            return response()->json(['message' => __('blog::messages.categories.deleted')]);
        }
    }




    /**
     * Remove multi user from database.
     * @param Request $request
     * @return Response
     */
    public function multiDestroy(Request $request)
    {
        if (env('DEMO_MODE') == 'On') {
            return redirect()->back()->with(['error_message_alert' => __('view.demo_mode')]);
        }

        $ids = $request->ids;
        $related_categories = Category::whereIn('id', $ids)->whereHas('posts')->count();
        if ($related_categories) {
            return response()->json(['message' => __('blog::messages.categories.multi_deleted_failed_related')], 403);
        }
        Category::destroy($ids);
        return response()->json(['message' => __('blog::messages.categories.multi_deleted')]);
    }



    /**
     * Search on categories
     * @param Request $request
     * @return array
     */
    public function searchCategories(Request $request)
    {
        $categories = CategorySelectResource::collection($this->categoryRepo->category_list_for_select($request->search, 30));
        return response()->json(['categories' => $categories]);
    }


}