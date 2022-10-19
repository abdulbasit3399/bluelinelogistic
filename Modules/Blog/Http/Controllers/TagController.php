<?php

namespace Modules\Blog\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Modules\Blog\Events\TagCreatedEvent;
use Modules\Blog\Events\TagUpdatedEvent;
use Illuminate\Support\Facades\DB;
use Modules\Blog\Http\Requests\TagRequest;
use Modules\Blog\Entities\Tag;
use Modules\Blog\Http\DataTables\TagsDataTable;
use Modules\Blog\Transformers\TagSelectResource;

class TagController extends Controller
{


    public function __construct()
    {
        // check on permissions
        $this->middleware('can:manage-blog');
        $this->middleware('can:view-tags')->only('index');
        $this->middleware('can:create-tags')->only('store');
        $this->middleware('can:edit-tags')->only('edit', 'update');
        $this->middleware('can:delete-tags')->only('delete', 'multiDestroy');
    }


    /**
     * Display a listing of the resource.
     * @return TagsDataTable
     */
    public function index(TagsDataTable $dataTable)
    {
        breadcrumb([
            [
                'name' => __('blog::view.blog'),
            ],
            [
                'name' => __('blog::view.tags'),
            ],
        ]);
        $data_with = [];
        $share_data = array_merge(get_class_vars(TagsDataTable::class), $data_with);
        $adminTheme = env('ADMIN_THEME', 'adminLte');
        return $dataTable->render('blog::'.$adminTheme.'.pages.tags.index', $share_data);
    }


    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(TagRequest $request)
    {
        if (env('DEMO_MODE') == 'On') {
            return redirect()->back()->with(['error_message_alert' => __('view.demo_mode')]);
        }
        $data = $request->only(['name', 'slug', 'description']);
        $tag = Tag::create($data);
        event(new TagCreatedEvent($tag));
        return redirect()->route('tags.index')->with(['message_alert' => __('blog::messages.tags.created')]);
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
                'name' => __('blog::view.tags'),
                'path' => fr_route('tags.index')
            ],
            [
                'name' => __('blog::view.edit_tag')
            ]
        ]);
        $tag = Tag::findOrFail($id);
        $adminTheme = env('ADMIN_THEME', 'adminLte');return view('blog::'.$adminTheme.'.pages.tags.edit')->with(['model' => $tag]);
    }


    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Tag
     */
    public function update(TagRequest $request, $id)
    {
        if (env('DEMO_MODE') == 'On') {
            return redirect()->back()->with(['error_message_alert' => __('view.demo_mode')]);
        }

        $tag = Tag::findOrFail($id);
        $data = $request->only(['name', 'slug', 'description']);
        $tag->update($data);
        event(new TagUpdatedEvent($tag));
        return redirect()->route('tags.index')->with(['message_alert' => __('blog::messages.tags.saved')]);
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

        $related_tag = DB::table('taggables')->where('tag_id', $id)->count();
        if ($related_tag) {
            return response()->json(['message' => __('blog::messages.tags.deleted_failed_related')], 403);
        }
        Tag::destroy($id);
        return response()->json(['message' => __('blog::messages.tags.deleted')]);
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
        $related_tags = DB::table('taggables')->whereIn('tag_id', $ids)->count();
        if ($related_tags) {
            return response()->json(['message' => __('blog::messages.tags.multi_deleted_failed_related')], 403);
        }
        Tag::destroy($ids);
        return response()->json(['message' => __('blog::messages.tags.multi_deleted')]);
    }


    /**
     * Search on tags
     * @param Request $request
     * @return array
     */

    public function searchTags(Request $request)
    {
        $search = $request->search;
        $tags = Tag::select('id', 'name')->orderByDesc('id')->where('name', 'LIKE', "%$search%")->limit(30)->get();
        $tagsCollection = TagSelectResource::collection($tags);
        return response()->json(['tags' => $tagsCollection]);
    }


}
