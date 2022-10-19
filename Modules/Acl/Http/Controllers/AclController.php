<?php

namespace Modules\Acl\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Acl\Repositories\AclRepository;
use Spatie\Permission\Models\Role;
use Modules\Acl\Http\Requests\RoleRequest;
use Modules\Acl\Http\DataTables\RolesDataTable;

use Modules\Acl\Events\RoleCreatedEvent;
use Modules\Acl\Events\RoleUpdatedEvent;
use Modules\Acl\Events\RoleDeletedEvent;

class AclController extends Controller
{
    
    /**
     * The AclRepository instance.
     *
     * @var AclRepository
     */
    private $aclRepo;

    public function __construct(AclRepository $aclRepository)
    {
        $this->aclRepo = $aclRepository;
        $this->middleware('isAdmin');
    }


    /**
     * Display a listing of the roles.
     * @return Renderable
     */
    public function index(RolesDataTable $dataTable)
    {
        breadcrumb([
            [
                'name' => __('acl::view.acl'),
            ],
            [
                'name' => __('acl::view.role_list'),
            ],
        ]);
        // show list roles
        $data_with = [];
        $share_data = array_merge(get_class_vars(RolesDataTable::class), $data_with);
        $adminTheme = env('ADMIN_THEME', 'adminLte');
        return $dataTable->render('acl::'.$adminTheme.'.pages.roles.index', $share_data);
    }


    /**
     * Show the form for creating a new role.
     * @return Renderable
     */
    public function create()
    {
        breadcrumb([
            [
                'name' => __('acl::view.acl'),
            ],
            [
                'name' => __('acl::view.roles'),
                'path' => route('roles.index')
            ],
            [
                'name' => __('acl::view.create_new_role')
            ],
        ]);
        $permissions_by_group = $this->aclRepo->getPermissionsByGroup();

        $adminTheme = env('ADMIN_THEME', 'adminLte');
        return view('acl::'.$adminTheme.'.pages.roles.create', ['permissions_by_group' => $permissions_by_group]);
    }




    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(RoleRequest $request)
    {
        $data = $request->only(['name', 'permissions']);
        $role = $this->aclRepo->createRole($data);
        event(new RoleCreatedEvent($role));
        return redirect()->route('roles.index')->with(['message_alert' => __('acl::messages.roles.created')]);
    }



     /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        if (env('DEMO_MODE') == 'On') {
            return redirect()->back()->with(['error_message_alert' => __('view.demo_mode')]);
        }

        breadcrumb([
            [
                'name' => __('acl::view.acl'),
            ],
            [
                'name' => __('acl::view.roles'),
                'path' => route('roles.index')
            ],
            [
                'name' => __('acl::view.edit_role')
            ],
        ]);
        $role = Role::findOrFail($id);
        $role_permissions = $role->getPermissionNames()->toArray();
        $permissions_by_group = $this->aclRepo->getPermissionsByGroup();

        $adminTheme = env('ADMIN_THEME', 'adminLte');
        return view('acl::'.$adminTheme.'.pages.roles.edit')->with([
            'model' => $role,
            'permissions_by_group' => $permissions_by_group,
            'role_permissions' => $role_permissions
        ]);
    }



    public function update($id, RoleRequest $request)
    {

        if (env('DEMO_MODE') == 'On') {
            return redirect()->back()->with(['error_message_alert' => __('view.demo_mode')]);
        }

        $role = Role::find($id);
        $data = $request->only(['name', 'permissions']);
        $role = $this->aclRepo->updateRole($role, $data);
        event(new RoleUpdatedEvent($role));
        return redirect()->route('roles.index')->with(['message_alert' => __('acl::messages.roles.saved')]);
    }


    /**
     * Remove the role from database.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        if (env('DEMO_MODE') == 'On') {
            return redirect()->back()->with(['error_message_alert' => __('view.demo_mode')]);
        }

        $role = Role::findOrFail($id);
        event(new RoleDeletedEvent($role));
        return response()->json(['message' => __('acl::messages.roles.deleted')]);
    }




    /**
     * Remove multi roles from database.
     * @param Request $request
     * @return Renderable
     */
    public function multiRoleDestroy(Request $request)
    {
        if (env('DEMO_MODE') == 'On') {
            return redirect()->back()->with(['error_message_alert' => __('view.demo_mode')]);
        }

        $ids = $request->ids;
        Role::destroy($ids);
        // if need run event after delete role -> make for each and run event in callback
        // event(new RoleDeletedEvent($role));
        return response()->json(['message' => __('acl::messages.roles.multi_deleted')]);
    }
}
