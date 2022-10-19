<?php

namespace Modules\Cargo\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Cargo\Http\DataTables\DriversDataTable;
use Modules\Cargo\Http\Requests\DriverRequest;
use Modules\Cargo\Entities\Driver;
use Modules\Cargo\Entities\Branch;
use Modules\Cargo\Entities\Mission;
use App\Models\User;
use Modules\Cargo\Http\Helpers\UserRegistrationHelper;
use Modules\Users\Events\UserCreatedEvent;
use Modules\Users\Events\UserUpdatedEvent;
use Modules\Cargo\Events\AddDriver;
use Modules\Acl\Repositories\AclRepository;

class DriverController extends Controller
{
    private $aclRepo;
    
    public function __construct(AclRepository $aclRepository)
    {
        $this->aclRepo = $aclRepository;
        // check on permissions
        $this->middleware('user_role:1|0|3')->only('index','driversReport');
        $this->middleware('user_role:1|0|3|5')->only('show');
        $this->middleware('user_role:1|0|3')->only('create', 'store');
        $this->middleware('user_role:1|0|3')->only('edit');
        $this->middleware('user_role:1|0|3|5')->only('update');
        $this->middleware('user_role:1|0|3')->only('delete', 'multiDestroy');
        $this->middleware('user_role:5')->only('profile');
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(DriversDataTable $dataTable)
    {
        breadcrumb([
            [
                'name' => __('cargo::view.dashboard'),
                'path' => fr_route('admin.dashboard')
            ],
            [
                'name' => __('cargo::view.drivers')
            ]
        ]);
        $data_with = [];
        $share_data = array_merge(get_class_vars(DriversDataTable::class), $data_with);
        $adminTheme = env('ADMIN_THEME', 'adminLte');
        return $dataTable->render('cargo::'.$adminTheme.'.pages.drivers.index', $share_data);
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
                'name' => __('cargo::view.drivers'),
                'path' => fr_route('drivers.index')
            ],
            [
                'name' => __('cargo::view.add_driver'),
            ],
        ]);
        if(auth()->user()->role == 3){
            $branches = Branch::where('is_archived',0)->where('user_id',auth()->user()->id)->get();
        }else{
            $branches = Branch::where('is_archived',0)->get();
        }
        $adminTheme = env('ADMIN_THEME', 'adminLte');return view('cargo::'.$adminTheme.'.pages.drivers.create')->with(['branches' => $branches]);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(DriverRequest $request)
    {
        $data = $request->only(['name', 'email', 'password', 'responsible_mobile','responsible_name','national_id','branch_id']);
        
        $Userdata['name']     = $data['name'];
        $Userdata['email']    = $data['email'];
        $Userdata['password'] = $data['password'];
        $Userdata['role']     = 5;
        $userRegistrationHelper = new UserRegistrationHelper();
		$response = $userRegistrationHelper->NewUser($Userdata);
        if(!$response['success']){
            throw new \Exception($response['error_msg']);
        }

        $data['code']    = 0;
        $data['user_id'] = $response['user']['id'];
        $data['created_by'] = auth()->check() ? auth()->id() : null;
        unset($data['password']);

        $model = new Driver();
        $model->fill($data);
        if (!$model->save()){
            throw new \Exception();
        }
        $model->code = $model->id;
        if (!$model->save()){
            throw new \Exception();
        }
        $model->addFromMediaLibraryRequest($request->image)->toMediaCollection('avatar');
        event(new AddDriver($model));
        return redirect()->route('drivers.index')->with(['message_alert' => __('cargo::messages.created')]);
                
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
        $user = Driver::findOrFail($id);
        $items = Mission::where('captain_id', $id)->count();
        $adminTheme = env('ADMIN_THEME', 'adminLte');return view('cargo::'.$adminTheme.'.pages.drivers.show')->with(['model' => $user, 'items' => $items]);
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
                'name' => __('cargo::view.drivers'),
                'path' => fr_route('drivers.index')
            ],
            [
                'name' => __('cargo::view.edit_driver'),
            ],
        ]);
        $driver = Driver::findOrFail($id);
        if(auth()->user()->role == 3){
            $branches = Branch::where('is_archived',0)->where('user_id',auth()->user()->id)->get();
        }else{
            $branches = Branch::where('is_archived',0)->get();
        }
        $adminTheme = env('ADMIN_THEME', 'adminLte');return view('cargo::'.$adminTheme.'.pages.drivers.edit')->with(['model' => $driver, 'branches' => $branches]);
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
                'name' => __('cargo::view.edit_profile'),
            ],
        ]);
        
        $driver = Driver::findOrFail($id);
        if(auth()->user()->role == 3){
            $branches = Branch::where('is_archived',0)->where('user_id',auth()->user()->id)->get();
        }else{
            $branches = Branch::where('is_archived',0)->get();
        }
        $adminTheme = env('ADMIN_THEME', 'adminLte');return view('cargo::'.$adminTheme.'.pages.drivers.edit-profile')->with(['model' => $driver, 'branches' => $branches]);
    }


    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(DriverRequest $request, $id)
    {
        if (env('DEMO_MODE') == 'On') {
            return redirect()->back()->with(['error_message_alert' => __('view.demo_mode')]);
        }

        $driver = Driver::findOrFail($id);

        $data = $request->only(['name', 'email', 'password', 'responsible_mobile','responsible_name','national_id','branch_id']);
        
        $Userdata['name']     = $data['name'];
        $Userdata['email']    = $data['email'];
        $Userdata['password'] = $data['password'];
        $userRegistrationHelper = new UserRegistrationHelper($driver->user_id);
		$response = $userRegistrationHelper->NewUser($Userdata);
        if(!$response['success']){
            throw new \Exception($response['error_msg']);
        }

        $data['updated_by'] = auth()->check() ? auth()->id() : null;
        unset($data['password']);

        $driver->fill($data);
        if (!$driver->save()){
            throw new \Exception();
        }
        $driver->syncFromMediaLibraryRequest($request->image)->toMediaCollection('avatar');
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

        $driver = Driver::findOrFail($id);
        User::destroy($driver->user_id);
        Driver::destroy($id);
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
        $drivers_user_ids = Driver::whereIn('id',$ids)->pluck('user_id');
        User::destroy($drivers_user_ids);
        Driver::destroy($ids);
        return response()->json(['message' => __('cargo::messages.multi_deleted')]);
    }

    public function ajaxGetDrivers(Request $request){
        if(isset($request->branch_id)){
            $drivers = Driver::where('is_archived',0)->where('branch_id', $request->branch_id)->get();
            return response()->json($drivers);
        }
    }

    public function driversReport(DriversDataTable $dataTable)
    {
        breadcrumb([
            [
                'name' => __('cargo::view.dashboard'),
                'path' => fr_route('admin.dashboard')
            ],
            [
                'name' => __('cargo::view.drivers_report')
            ]
        ]);
        $data_with = [];
        $share_data = array_merge(get_class_vars(DriversDataTable::class), $data_with);
        $adminTheme = env('ADMIN_THEME', 'adminLte');
        return $dataTable->render('cargo::'.$adminTheme.'.pages.drivers.report', $share_data);
    }
}
