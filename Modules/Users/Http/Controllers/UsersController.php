<?php

namespace Modules\Users\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Users\Http\DataTables\UsersDataTable;

use Modules\Users\Events\UserCreatedEvent;
use Modules\Users\Events\UserUpdatedEvent;
use Modules\Users\Events\UserAssignedPermissionEvent;
use Modules\Acl\Repositories\AclRepository;

use Modules\Users\Http\Requests\UserRequest;
use Modules\Users\Http\Requests\AssignPermissionToUserRequest;
use App\Models\User;
use Auth;
class UsersController extends Controller
{

    private $aclRepo;


    public function __construct(AclRepository $aclRepository)
    {
        $this->aclRepo = $aclRepository;
        // check on permissions
        $this->middleware('can:manage-users');
        $this->middleware('can:view-users')->only('index');
        $this->middleware('can:view-profile-users')->only('show');
        $this->middleware('can:create-users')->only('create', 'store');
        $this->middleware('can:edit-users')->only('edit', 'update');
        $this->middleware('can:delete-users')->only('delete', 'multiDestroy');
        $this->middleware('isAdmin')->only('assignPermissionToUserView', 'assignPermissionToUser');
    }

    /**
     * Display a listing of the resource.
     * @return UsersDataTable
     */
    public function index(UsersDataTable $dataTable)
    {
        // breadcrumb([
        //     [
        //         'name' => __('users::view.users'),
        //     ],
        // ]);

        $share_data = User::where('type', '!=' , null)
        ->get();
        $adminTheme = env('ADMIN_THEME', 'adminLte');
        return view('users::'.$adminTheme.'.pages.users.UserIndex', compact('share_data'));

        // $data_with = [];
        // $share_data = array_merge(get_class_vars(UsersDataTable::class), $data_with);
        // $adminTheme = env('ADMIN_THEME', 'adminLte');
        // return $dataTable->render('users::'.$adminTheme.'.pages.users.index', $share_data);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        // breadcrumb([
        //     [
        //         'name' => __('users::view.users'),
        //         'path' => fr_route('users.index')
        //     ],
        //     [
        //         'name' => __('users::view.create_new_user'),
        //     ],
        // ]);
        $adminTheme = env('ADMIN_THEME', 'adminLte');return view('users::'.$adminTheme.'.pages.users.addUser');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(UserRequest $request)
    {
        // dd($request->all());
        $data = $request->all();
        $data['password'] = bcrypt($data['password']);
        if($request->password == $request->confirm_password)
        {
            $user = User::create($data);
            $data['user_id']  =   $user->id;
            // dd($user);

            $user->addFromMediaLibraryRequest($request->image)->toMediaCollection('avatar');
            // event(new UserCreatedEvent($data));
            // return redirect()->route('users.index')->with(['message_alert' => __('users::messages.users.created')]);

            return redirect()->route('users.index')->with(['message_alert' => __('users::messages.users.created')]);

        }
        else
        {
            return redirect()->back()->with('error', 'Password is not confirmed!');
        }


    }
    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        // dd($id);
        // breadcrumb([
        //     [
        //         'name' => __('users::view.users'),
        //         'path' => fr_route('users.index')
        //     ],
        //     [
        //         'name' => __('view.profile_details')
        //     ],
        // ]);
        $user = User::findOrFail($id);
        $adminTheme = env('ADMIN_THEME', 'adminLte');
        return view('users::adminLte.pages.users.show')->with(['model' => $user]);



    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        // breadcrumb([
        //     [
        //         'name' => __('users::view.users'),
        //         'path' => fr_route('users.index')
        //     ],
        //     [
        //         'name' => __('users::view.edit_user')
        //     ],
        // ]);
        $user = User::findOrFail($id);
        $adminTheme = env('ADMIN_THEME', 'adminLte');
        return view('users::'.$adminTheme.'.pages.users.editUser')->with(['model' => $user]);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(UserRequest $request, $id)
    {
        if (env('DEMO_MODE') == 'On') {
            return redirect()->back()->with(['error_message_alert' => __('view.demo_mode')]);
        }
        // dd($request->all());
        $user = User::findOrFail($id);
        if (empty($request->password)) {
            $data = $request->only(['name', 'username', 'type', 'email', 'role']);
        }else{
            $data = $request->only(['name', 'username', 'type', 'email', 'role' ,'password', 'confirm_password']);
            if($request->password == $request->confirm_password)
            {
            $data['password'] = bcrypt($data['password']);
            }
            else{
                return redirect()->back()->with('error', 'Password is not confirmed!');
            }
        }

        $user->update($data);
        $user->syncFromMediaLibraryRequest($request->image)->toMediaCollection('avatar');
        event(new UserUpdatedEvent($user));
        return redirect()->route('users.index')->with(['message_alert' => __('users::messages.users.saved')]);
    }



    /**
     * Remove one user from database.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        if (env('DEMO_MODE') == 'On') {
            return redirect()->back()->with(['error_message_alert' => __('view.demo_mode')]);
        }

        if ($id == 1) return response()->json(['message' => __('users::messages.users.deleted_failed_admin')], 403);
        $thisuser = User::find($id);
        $thisuser->delete();
        dd('deleted');

        User::destroy($id);
        return response()->json(['message' => __('users::messages.users.deleted')]);
    }
    public function delete($id)
    {
        User::destroy($id);
        return redirect()->back()->with(['message' => __('users::messages.users.deleted')]);
        // response()->json(['message' => __('users::messages.users.deleted')]);
    }



    /**
     * Remove multi user from database.
     * @param Request $request
     * @return Renderable
     */
    public function multiDestroy(Request $request)
    {
        if (env('DEMO_MODE') == 'On') {
            return redirect()->back()->with(['error_message_alert' => __('view.demo_mode')]);
        }

        $ids = $request->ids;
        if (in_array(1, $ids)) return response()->json(['message' => __('users::messages.users.multi_deleted_failed_admin')], 403);
        User::destroy($ids);
        return response()->json(['message' => __('users::messages.users.multi_deleted')]);
    }



    /**
     * Remove multi user from database.
     * @param int $id
     * @return Renderable
     */
    public function assignPermissionToUserView($id)
    {
        $user = User::findOrFail($id);
        $permissions_by_group = $this->aclRepo->getPermissionsByGroup();
        $roles = $this->aclRepo->getRoleList()->toArray();
        $user_permissions = $user->getPermissionNames()->toArray();
        $user_roles = $user->getRoleNames()->toArray();

        $adminTheme = env('ADMIN_THEME', 'adminLte');return view('users::'.$adminTheme.'.pages.users.assign_permissions')->with([
            'model' => $user,
            'roles' => $roles,
            'permissions_by_group' => $permissions_by_group,
            'user_permissions' => $user_permissions,
            'user_roles' => $user_roles,
        ]);
    }



    /**
     * Remove multi user from database.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function assignPermissionToUser(AssignPermissionToUserRequest $request, $id)
    {
        $user = User::findOrFail($id);
        $data = $request->only(['roles', 'permissions']);
        $data['roles'] = isset($data['roles']) && is_array($data['roles']) ? $data['roles'] : [];
        $data['permissions'] = isset($data['permissions']) && is_array($data['permissions']) ? $data['permissions'] : [];
        $user->syncRoles($data['roles']);
        $user->syncPermissions($data['permissions']);
        event(new UserAssignedPermissionEvent($user));
        return redirect()->route('users.index')->with(['message_alert' => __('users::messages.users.permissions_assigned')]);
    }
}
