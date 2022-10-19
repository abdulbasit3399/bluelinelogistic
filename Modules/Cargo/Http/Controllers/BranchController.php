<?php

namespace Modules\Cargo\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Cargo\Http\DataTables\BranchesDataTable;
use Modules\Cargo\Http\Requests\BranchRequest;
use Modules\Cargo\Entities\Branch;
use Modules\Cargo\Entities\Shipment;
use App\Models\User;
use Modules\Cargo\Http\Helpers\UserRegistrationHelper;
use Modules\Users\Events\UserCreatedEvent;
use Modules\Users\Events\UserUpdatedEvent;
use Modules\Acl\Repositories\AclRepository;

class BranchController extends Controller
{ 

    private $aclRepo;


    public function __construct(AclRepository $aclRepository)
    {
        $this->aclRepo = $aclRepository;
        // check on permissions
        $this->middleware('user_role:1|0')->only('index','branchesReport');
        $this->middleware('user_role:1|0|3')->only('show');
        $this->middleware('user_role:1|0')->only('create', 'store');
        $this->middleware('user_role:1|0')->only('edit');
        $this->middleware('user_role:1|0|3')->only('update');
        $this->middleware('user_role:1|0')->only('delete', 'multiDestroy');
        $this->middleware('user_role:3')->only('profile');
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(BranchesDataTable $dataTable)
    {
        breadcrumb([
            [
                'name' => __('cargo::view.dashboard'),
                'path' => fr_route('admin.dashboard')
            ],
            [
                'name' => __('cargo::view.branches')            ]
        ]);
        $data_with = [];
        $share_data = array_merge(get_class_vars(BranchesDataTable::class), $data_with);

        $adminTheme = env('ADMIN_THEME', 'adminLte');
        return $dataTable->render('cargo::'.$adminTheme.'.pages.branches.index', $share_data);
    }

    /**
     * Show the form for creating a new resource.
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
                'name' => __('cargo::view.branches'),
                'path' => fr_route('branches.index')
            ],
            [
                'name' => __('cargo::view.add_branch'),
            ],
        ]);
        $adminTheme = env('ADMIN_THEME', 'adminLte');return view('cargo::'.$adminTheme.'.pages.branches.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(BranchRequest $request)
    {
        $data = $request->only(['name', 'email', 'password', 'responsible_mobile','responsible_name','national_id','address']);

        $Userdata['name']     = $data['name'];
        $Userdata['email']    = $data['email'];
        $Userdata['password'] = $data['password'];
        $Userdata['role']     = 3;
        $userRegistrationHelper = new UserRegistrationHelper();
		$response = $userRegistrationHelper->NewUser($Userdata);
        if(!$response['success']){
            throw new \Exception($response['error_msg']);
        }

        $data['code']    = 0;
        $data['user_id'] = $response['user']['id'];
        $data['created_by'] = auth()->check() ? auth()->id() : null;
        unset($data['password']);
        $branch = new Branch();
        $branch->fill($data);
        if (!$branch->save()){
            throw new \Exception();
        }
        $branch->code = $branch->id;
        if (!$branch->save()){
            throw new \Exception();
        }
        $branch->addFromMediaLibraryRequest($request->image)->toMediaCollection('avatar');
        return redirect()->route('branches.index')->with(['message_alert' => __('cargo::messages.created')]);

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
                'name' => __('view.profile_details')
            ],
        ]);
        $user = Branch::findOrFail($id);
        $shipments = Shipment::where('branch_id', $id)->count();
        $adminTheme = env('ADMIN_THEME', 'adminLte');return view('cargo::'.$adminTheme.'.pages.branches.show')->with(['model' => $user, 'shipments' => $shipments]);
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
                'name' => __('cargo::view.branches'),
                'path' => fr_route('branches.index')
            ],
            [
                'name' => __('cargo::view.edit_branch'),
            ],
        ]);
        $branch = Branch::findOrFail($id);
        $adminTheme = env('ADMIN_THEME', 'adminLte');return view('cargo::'.$adminTheme.'.pages.branches.edit')->with(['model' => $branch]);
    }


    /**
    * Show the form for editing the specified resource.
    * @param int $id
    * @return Renderable
    */

    public function profile($id){
        breadcrumb([
            [
                'name' => __('cargo::view.dashboard'),
                'path' => fr_route('admin.dashboard')
            ],
            [
                'name' => __('cargo::view.edit_profile'),
            ],
        ]);

        $branch = Branch::findOrFail($id);
        $adminTheme = env('ADMIN_THEME', 'adminLte');
        return view('cargo::'.$adminTheme.'.pages.branches.edit-profile')->with(['model' => $branch]);
    }


    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(BranchRequest $request, $id)
    {
        if (env('DEMO_MODE') == 'On') {
            return redirect()->back()->with(['error_message_alert' => __('view.demo_mode')]);
        }

        $branch = Branch::findOrFail($id);

        $data = $request->only(['name', 'email', 'password', 'responsible_mobile','responsible_name','national_id','address']);

        $Userdata['name']     = $data['name'];
        $Userdata['email']    = $data['email'];
        $Userdata['password'] = $data['password'];
        $userRegistrationHelper = new UserRegistrationHelper($branch->user_id);
		$response = $userRegistrationHelper->NewUser($Userdata);
        if(!$response['success']){
            throw new \Exception($response['error_msg']);
        }

        $data['updated_by'] = auth()->check() ? auth()->id() : null;
        unset($data['password']);

        $branch->fill($data);
        if (!$branch->save()){
            throw new \Exception();
        }
        $branch->syncFromMediaLibraryRequest($request->image)->toMediaCollection('avatar');
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

        $branch = Branch::findOrFail($id);
        User::destroy($branch->user_id);
        Branch::destroy($id);
        return response()->json(['message' => __('cargo::messages.deleted')]);
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
        $branchs_user_ids = Branch::whereIn('id',$ids)->pluck('user_id');
        User::destroy($branchs_user_ids);
        Branch::destroy($ids);
        return response()->json(['message' => __('cargo::messages.multi_deleted')]);
    }

    public function branchesReport(BranchesDataTable $dataTable)
    {
        breadcrumb([
            [
                'name' => __('cargo::view.dashboard'),
                'path' => fr_route('admin.dashboard')
            ],
            [
                'name' => __('cargo::view.branches_report')            ]
        ]);
        $data_with = [];
        $share_data = array_merge(get_class_vars(BranchesDataTable::class), $data_with);

        $adminTheme = env('ADMIN_THEME', 'adminLte');
        return $dataTable->render('cargo::'.$adminTheme.'.pages.branches.report', $share_data);
    }
}