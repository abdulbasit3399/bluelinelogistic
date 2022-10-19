<?php

namespace Modules\Pages\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Modules\Pages\Events\PageCreatedEvent;
use Modules\Pages\Events\PageUpdatedEvent;

use Modules\Pages\Entities\Page;
use Modules\Pages\Http\Requests\PageRequest;
use Modules\Pages\Http\DataTables\PagesDataTable;

use Modules\Pages\Transformers\PageSelectResource;

class PageController extends Controller
{

    public function __construct()
    {
        // check on permissions
        $this->middleware('can:manage-blog');
        $this->middleware('can:view-pages')->only('index');
        $this->middleware('can:create-pages')->only('create', 'store');
        $this->middleware('can:edit-pages')->only('edit', 'update');
        $this->middleware('can:delete-pages')->only('delete', 'multiDestroy');
    }


    /**
     * Display a listing of the resource.
     * @return PagesDataTable
     */
    public function index(PagesDataTable $dataTable)
    {
        breadcrumb([
            [
                'name' => __('cargo::view.dashboard'),
                'path' => fr_route('admin.dashboard')
            ],
            [
                'name' => __('pages::view.pages'),
            ],
        ]);
        $data_with = [];
        $share_data = array_merge(get_class_vars(PagesDataTable::class), $data_with);
        $adminTheme = env('ADMIN_THEME', 'adminLte');
        return $dataTable->render('pages::'.$adminTheme.'.pages.pages.index', $share_data);
    }


     /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function create()
    {
        breadcrumb([
            [
                'name' => __('cargo::view.dashboard'),
                'path' => fr_route('admin.dashboard')
            ],
            [
                'name' => __('pages::view.pages'),
                'path' => fr_route('pages.index')
            ],
            [
                'name' => __('pages::view.create_new_page')
            ]
        ]);
        $adminTheme = env('ADMIN_THEME', 'adminLte');return view('pages::'.$adminTheme.'.pages.pages.create')->with([]);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(PageRequest $request)
    {
        if (env('DEMO_MODE') == 'On') {
            return redirect()->back()->with(['error_message_alert' => __('view.demo_mode')]);
        }

        // return $request ;
        $data = $request->only(['title', 'slug', 'content', 'visibility', 'publish_on', 'seo_title', 'seo_description']);
        $data['published'] = $request->publish ? true : false;

        $page = Page::create($data);
        $page->addFromMediaLibraryRequest($request->image)->toMediaCollection('featured_image');
        event(new PageCreatedEvent($page));
        return redirect()->route('pages.index')->with(['message_alert' => __('pages::messages.pages.created')]);
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
                'name' => __('cargo::view.dashboard'),
                'path' => fr_route('admin.dashboard')
            ],
            [
                'name' => __('pages::view.pages'),
                'path' => fr_route('pages.index')
            ],
            [
                'name' => __('pages::view.edit_page')
            ]
        ]);
        $page = Page::findOrFail($id);
        $adminTheme = env('ADMIN_THEME', 'adminLte');return view('pages::'.$adminTheme.'.pages.pages.edit')->with(['model' => $page]);
    }


    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Page
     */
    public function update(PageRequest $request, $id)
    {
        if (env('DEMO_MODE') == 'On') {
            return redirect()->back()->with(['error_message_alert' => __('view.demo_mode')]);
        }

        $page = Page::findOrFail($id);
        $data = $request->only(['title', 'slug', 'content', 'visibility', 'published', 'publish_on', 'seo_title', 'seo_description']);
        
        $data['published'] = $request->publish ? true : ($request->published ? true : false);
        $data['active'] = $request->active ? true : false;
        $data['image'] = uploader()->path(Page::DIRECTORY_IMAGE)->model($page)->singleUpload();
        $page->update($data);
        $page->syncFromMediaLibraryRequest($request->image)->toMediaCollection('featured_image');
        event(new PageUpdatedEvent($page));
        return redirect()->route('pages.index')->with(['message_alert' => __('pages::messages.pages.saved')]);
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
        
        Page::destroy($id);
        return response()->json(['message' => __('pages::messages.pages.deleted')]);
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
        Page::destroy($ids);
        return response()->json(['message' => __('pages::messages.pages.multi_deleted')]);
    }


    /**
     * Search on pages
     * @param Request $request
     * @return array
     */
    public function searchPages(Request $request)
    {
        $search = $request->search;
        $query = Page::select('id', 'title')->orderByDesc('id');
        if ($search && $search != '') {
            $query->where('title->' . app()->getLocale(), 'LIKE', "%$search%");
        }
        $pages = $query->limit(30)->get();
        $pagesResource = PageSelectResource::collection($pages);
        return response()->json(['pages' => $pagesResource]);
    }

    public function searchStaticPages(Request $request)
    {
        $pages = new Page;
        return response()->json(['pages' => $pages->staticPages()]);
    }
    
}
