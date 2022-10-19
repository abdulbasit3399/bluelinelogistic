<?php

namespace Modules\Blog\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


use Modules\Blog\Events\CommentUpdatedEvent;
use Illuminate\Support\Facades\DB;
use Modules\Blog\Http\Requests\CommentRequest;
use Modules\Blog\Entities\Comment;
use Modules\Blog\Http\DataTables\CommentsDataTable;
use Modules\Blog\Http\Requests\CommentCreateRequest;

class CommentController extends Controller
{


    public function __construct()
    {
        // check on permissions
        $this->middleware('can:manage-blog');
        $this->middleware('can:view-comments')->only('index');
        $this->middleware('can:edit-comments')->only('edit', 'update');
        $this->middleware('can:delete-comments')->only('delete', 'multiDestroy');
        $this->middleware('can:approval-comments')->only('approval');
    }


    /**
     * Display a listing of the resource.
     * @return CommentsDataTable
     */
    public function index(CommentsDataTable $dataTable)
    {
        breadcrumb([
            [
                'name' => __('blog::view.blog'),
            ],
            [
                'name' => __('blog::view.comments'),
            ],
        ]);
        $data_with = [];
        $share_data = array_merge(get_class_vars(CommentsDataTable::class), $data_with);
        $adminTheme = env('ADMIN_THEME', 'adminLte');
        return $dataTable->render('blog::'.$adminTheme.'.pages.comments.index', $share_data);
    }



    /**
     * Add new comment to post in storage.
     * @param Request $request
     * @return Comment
     */
    public function store(CommentCreateRequest $request)
    {
        if (env('DEMO_MODE') == 'On') {
            return redirect()->back()->with(['error_message_alert' => __('view.demo_mode')]);
        }
        
        $data = $request->only(['content', 'author_name', 'author_email', 'author_website', 'parent_id']);
        $post_id = $request->post_id;
        return redirect()->route('comments.index')->with(['message_alert' => __('blog::messages.comments.saved')]);
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
                'name' => __('blog::view.comments'),
                'path' => fr_route('comments.index')
            ],
            [
                'name' => __('blog::view.edit_comment')
            ]
        ]);
        $comment = Comment::findOrFail($id);
        $adminTheme = env('ADMIN_THEME', 'adminLte');return view('blog::'.$adminTheme.'.pages.comments.edit')->with(['model' => $comment]);
    }


    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Comment
     */
    public function update(CommentRequest $request, $id)
    {
        if (env('DEMO_MODE') == 'On') {
            return redirect()->back()->with(['error_message_alert' => __('view.demo_mode')]);
        }

        $comment = Comment::findOrFail($id);
        $data = $request->only(['content']);
        $comment->update($data);
        return redirect()->route('comments.index')->with(['message_alert' => __('blog::messages.comments.saved')]);
    }

    /**
     * Remove one user from database.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        Comment::destroy($id);
        return response()->json(['message' => __('blog::messages.comments.deleted')]);
    }




    /**
     * Remove multi user from database.
     * @param Request $request
     * @return Response
     */
    public function multiDestroy(Request $request)
    {
        $ids = $request->ids;
        Comment::destroy($ids);
        return response()->json(['message' => __('blog::messages.comments.multi_deleted')]);
    }


    /**
     * Comments approval.
     * @param Request $request
     * @return Response
     */
    public function approval(Request $request)
    {
        $ids = $request->ids;
        $multi = $request->multi;
        $action = $request->action;
        $approvalValue = $action == 'approve' ? 1 : 2;
        $pathTrans = 'blog::messages.comments.';
        if ($multi) {
            $success_msg = $action == 'approve' ? __($pathTrans . 'multi_approved') : __($pathTrans . 'multi_rejected');
            $failed_msg = $action == 'approve' ? __($pathTrans . 'multi_approved_failed') : __($pathTrans . 'multi_rejected_failed');
        } else {
            $success_msg = $action == 'approve' ? __($pathTrans . 'approved') : __($pathTrans . 'rejected');
            $failed_msg = $action == 'approve' ? __($pathTrans . 'approved_failed') : __($pathTrans . 'rejected_failed');
        }
        $updated = Comment::whereIn('id', $ids)->update(['approved' => $approvalValue]);
        if ($updated) {
            return response()->json(['message' => $success_msg]);
        }
        return response()->json(['message' => $failed_msg]);
    }


}
