<?php

namespace Modules\Cargo\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Cargo\Http\DataTables\StaffsDataTable;
use Modules\Cargo\Http\Requests\StaffRequest;
use Modules\Cargo\Entities\Staff;
use Modules\Cargo\Entities\Branch;
use App\Models\User;
use Modules\Cargo\Http\Helpers\UserRegistrationHelper;
use Modules\Users\Events\UserCreatedEvent;
use Modules\Users\Events\UserUpdatedEvent;
use Modules\Acl\Repositories\AclRepository;

class StaffController extends Controller
{
    private $aclRepo;

    public function __construct(AclRepository $aclRepository)
    {
        $this->aclRepo = $aclRepository;
        // check on permissions
        $this->middleware('user_role:1|0');
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(StaffsDataTable $dataTable)
    {
        breadcrumb([
            [
                'name' => __('cargo::view.staffs'),
            ],
        ]);
        $data_with = [];
        $share_data = array_merge(get_class_vars(StaffsDataTable::class), $data_with);
        $adminTheme = env('ADMIN_THEME', 'adminLte');
        return $dataTable->render('cargo::'.$adminTheme.'.pages.staffs.index', $share_data);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        breadcrumb([
            [
                'name' => __('cargo::view.staffs'),
                'path' => fr_route('staffs.index')
            ],
            [
                'name' => __('cargo::view.staffs'),
            ],
        ]);
        $branches = Branch::where('is_archived',0)->get();
        $roles    = $this->aclRepo->getRoleList()->toArray();
        $permissions_by_group = $this->aclRepo->getPermissionsByGroup();
        $adminTheme = env('ADMIN_THEME', 'adminLte');return view('cargo::'.$adminTheme.'.pages.staffs.create')->with(['branches' => $branches, 'roles'=>$roles, 'permissions_by_group' => $permissions_by_group]);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(StaffRequest $request)
    {
        

        $data = $request->only(['name', 'email', 'password', 'responsible_mobile','national_id','branch_id','roles','permissions']);
        $Userdata['name']     = $data['name'];
        $Userdata['email']    = $data['email'];
        $Userdata['password'] = $data['password'];
        $Userdata['role']     = 2;

        $roles = isset($data['roles']) && is_array($data['roles']) ? $data['roles'] : [];
        $permissions = isset($data['permissions']) && is_array($data['permissions']) ? $data['permissions'] : [];

        $userRegistrationHelper  = new UserRegistrationHelper();
		$response = $userRegistrationHelper->NewUser($Userdata, $roles, $permissions);

        if(!$response['success']){
            throw new \Exception($response['error_msg']);
        }
        
        $data['code']    = 0;
        $data['user_id'] = $response['user']['id'];
        $data['created_by'] = auth()->check() ? auth()->id() : null;
        unset($data['password']);
        unset($data['roles']);
        unset($data['permissions']);
        $model = new Staff();
        $model->fill($data);
        if (!$model->save()){
            throw new \Exception();
        }
        $model->code = $model->id;
        if (!$model->save()){
            throw new \Exception();
        }
        event(new UserCreatedEvent($response['user']));
        return redirect()->route('staffs.index')->with(['message_alert' => __('cargo::messages.created')]);
                
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {                    

                breadcrumb([
            [
                'name' => __('cargo::view.dashboard'),
                'path' => fr_route('admin.dashboard')
            ],
            [
                'name' => __('cargo::view.edit_staff')
            ],
        ]);
        $model = Staff::findOrFail($id);
        $branches = Branch::where('is_archived',0)->get();

        $permissions_by_group = $this->aclRepo->getPermissionsByGroup();
        $roles = $this->aclRepo->getRoleList()->toArray();
        $user_permissions = $model->user->getPermissionNames()->toArray();
        $user_roles = $model->user->getRoleNames()->toArray();
        
        $adminTheme = env('ADMIN_THEME', 'adminLte');return view('cargo::'.$adminTheme.'.pages.staffs.show')->with([
            'model' => $model,
            'branches' => $branches,
            'roles' => $roles,
            'permissions_by_group' => $permissions_by_group,
            'user_permissions' => $user_permissions,
            'user_roles' => $user_roles,
        ]);
        
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
                'name' => __('cargo::view.staffs'),
                'path' => fr_route('staffs.index')
            ],
            [
                'name' => __('cargo::view.edit_staff')
            ],
        ]);
        $model = Staff::findOrFail($id);
        $branches = Branch::where('is_archived',0)->get();

        $permissions_by_group = $this->aclRepo->getPermissionsByGroup();
        $roles = $this->aclRepo->getRoleList()->toArray();
        $user_permissions = $model->user->getPermissionNames()->toArray();
        $user_roles = $model->user->getRoleNames()->toArray();
        
        $adminTheme = env('ADMIN_THEME', 'adminLte');return view('cargo::'.$adminTheme.'.pages.staffs.edit')->with([
            'model' => $model,
            'branches' => $branches,
            'roles' => $roles,
            'permissions_by_group' => $permissions_by_group,
            'user_permissions' => $user_permissions,
            'user_roles' => $user_roles,
        ]);
    }




        /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function profile($id)
    {
        breadcrumb([
            [
                'name' => __('cargo::view.dashboard'),
                'path' => fr_route('admin.dashboard')
            ],
            [
                'name' => __('cargo::view.edit_staff')
            ],
        ]);
        $model = Staff::findOrFail($id);
        $branches = Branch::where('is_archived',0)->get();

        $permissions_by_group = $this->aclRepo->getPermissionsByGroup();
        $roles = $this->aclRepo->getRoleList()->toArray();
        $user_permissions = $model->user->getPermissionNames()->toArray();
        $user_roles = $model->user->getRoleNames()->toArray();
        
        $adminTheme = env('ADMIN_THEME', 'adminLte');return view('cargo::'.$adminTheme.'.pages.staffs.edit-profile')->with([
            'model' => $model,
            'branches' => $branches,
            'roles' => $roles,
            'permissions_by_group' => $permissions_by_group,
            'user_permissions' => $user_permissions,
            'user_roles' => $user_roles,
        ]);
    }


    
    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(StaffRequest $request, $id)
    {
        if (env('DEMO_MODE') == 'On') {
            return redirect()->back()->with(['error_message_alert' => __('view.demo_mode')]);
        }

        $model = Staff::findOrFail($id);
        
        $data = $request->only(['responsible_mobile','national_id','branch_id']);
        $Userdata = $request->only(['name', 'email', 'password' , 'image']);
        
        
        $Userdata['role']     = 0;

        $roles = isset($data['roles']) && is_array($data['roles']) ? $data['roles'] : [];
        $permissions = isset($data['permissions']) && is_array($data['permissions']) ? $data['permissions'] : [];

        $userRegistrationHelper  = new UserRegistrationHelper($model->user_id);
		$response = $userRegistrationHelper->NewUser($Userdata, $roles, $permissions);

        if(!$response['success']){
            throw new \Exception($response['error_msg']);
        }

        $data['updated_by'] = auth()->check() ? auth()->id() : null;

        $model->fill($data);
        if (!$model->save()){
            throw new \Exception();
        }
        event(new UserUpdatedEvent($response['user']));
        return redirect()->back()->with(['message_alert' => __('cargo::messages.saved')]);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        if (env('DEMO_MODE') == 'On') {
            return redirect()->back()->with(['error_message_alert' => __('view.demo_mode')]);
        }

        Staff::destroy($id);
        return response()->json(['message' => __('cargo::messages.staffs.deleted')]);
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
        Staff::destroy($ids);
        return response()->json(['message' => __('cargo::messages.staffs.multi_deleted')]);
    }
}