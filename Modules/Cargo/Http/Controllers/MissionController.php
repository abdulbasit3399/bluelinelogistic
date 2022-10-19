<?php

namespace Modules\Cargo\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Cargo\Http\Helpers\MissionPRNG;
use Modules\Cargo\Http\Helpers\MissionStatusManagerHelper;
use Modules\Cargo\Entities\Mission;
use Modules\Cargo\Entities\Shipment;
use Modules\Cargo\Entities\Driver;
use Modules\Cargo\Entities\BusinessSetting;
use Modules\Cargo\Http\Helpers\MissionActionHelper;
use Modules\Cargo\Http\Helpers\TransactionHelper;
use Modules\Cargo\Http\DataTables\MissionsDataTable;
use Modules\Cargo\Http\Requests\ShipmentRequest;
use Modules\Cargo\Entities\Reason;
use Modules\Cargo\Entities\MissionReason;
use Modules\Cargo\Entities\Payment;
use Carbon\Carbon;
use Modules\Cargo\Entities\ShipmentSetting;
use DB;
use Modules\Cargo\Events\AssignMission;
use Modules\Cargo\Events\ApproveMission;
use Modules\Cargo\Events\MissionAction;
use Modules\Cargo\Events\ShipmentAction;
use Modules\Acl\Repositories\AclRepository;

class MissionController extends Controller
{
    private $aclRepo;
    
    public function __construct(AclRepository $aclRepository)
    {
        $this->aclRepo = $aclRepository;
        // check on permissions
        $this->middleware('user_role:1|0|3|5');
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(MissionsDataTable $dataTable , $status = 'all' , $type = null)
    {
        breadcrumb([
            [
                'name' => __('cargo::view.dashboard'),
                'path' => fr_route('admin.dashboard')
            ],
            [
                'name' => __('cargo::view.missions')
            ]
        ]);
        $actions = new MissionActionHelper();
        if($status == 'all'){
            $actions = $actions->get('all');
        }else{
            $actions = $actions->get($status, $type);
        }

        $data_with = ['actions'=> $actions , 'status' => $status];
        $share_data = array_merge(get_class_vars(MissionsDataTable::class), $data_with);

        $adminTheme = env('ADMIN_THEME', 'adminLte');
        return $dataTable->render('cargo::'.$adminTheme.'.pages.missions.index', $share_data);
    }

    public function approveAndAssign(Request $request,$to)
    {
        $request->validate([
            'Mission.captain_id' => 'required',
            'Mission.due_date'   => 'required', 
        ]);
        // return $request;
        try{
            $request->checked_ids = json_decode($request->checked_ids, true);
			DB::beginTransaction();
            $params = array();
            $params['due_data'] = $_POST['Mission']['due_date'];
            $action = new MissionStatusManagerHelper();
            $response = $action->change_mission_status($request->checked_ids,$to,$request['Mission']['captain_id'],$params);

            event(new AssignMission($request['Mission']['captain_id'],$request->checked_ids));
            // event(new ApproveMission($request->checked_ids));
            DB::commit();
            return back()->with(['message_alert' => __('cargo::messages.assigned')]);
		}catch(\Exception $e){
			DB::rollback();
			print_r($e->getMessage());
			exit;

			flash(translate("Error"))->error();
            return back();
		}
    }

    public function change(Request $request,$to,$fromApi = false)
    {
        if(isset($request->ids))
        {
            $mission = Mission::where('id',$request->ids[0])->first();
            $params = array();

            if($to == Mission::DONE_STATUS)
            {

                if(isset($request->shipment_id))
                {
                    $params['shipment_id'] = Shipment::find($request->shipment_id);
                }

                if($mission->type == Mission::getType(Mission::DELIVERY_TYPE) || $mission->type == Mission::getType(Mission::SUPPLY_TYPE) )
                {
                    if(ShipmentSetting::getVal('def_shipment_conf_type') == 'seg')
                    {
                        if(isset($request->signaturePadImg))
                        {
                            $params['seg_img'] = $request->signaturePadImg;
                        }else{
                            if($request->signaturePadImg == null || $request->signaturePadImg == " ")
                            {
                                if($fromApi)
                                {
                                    return response()->json(['message' => "Please Confirm The Signature" , 'status' => false ]);
                                }
                                return back()->with(['message_alert' => __('cargo::view.please_confirm_the_signature')]);
                            }
                        }
                    }elseif(ShipmentSetting::getVal('def_shipment_conf_type') == 'otp')
                    {
                        if(isset($request->otp_confirm))
                        {
                            if($mission->type == Mission::getType(Mission::DELIVERY_TYPE) )
                            {
                                if($params['shipment_id']['otp'] != $request->otp_confirm )
                                {
                                    if($fromApi)
                                    {
                                        return response()->json(['message' => "Please enter correct OTP" , 'status' => false ]);
                                    }
                                    return back()->with(['message_alert' => __('cargo::view.please_enter_correct_OTP')]);
                                }

                            }else{

                                if($mission->otp != $request->otp_confirm )
                                {
                                    if($fromApi)
                                    {
                                        return response()->json(['message' => "Please enter correct OTP" , 'status' => false ]);
                                    }
                                    return back()->with(['message_alert' => __('cargo::view.please_enter_correct_OTP')]);
                                }
                            }
                            $params['otp'] = $request->otp;
                        }else{
                            if($request->otp_confirm == null || $request->otp_confirm == " ")
                            {
                                if($fromApi)
                                {
                                    return response()->json(['message' => "Please enter OTP of mission" , 'status' => false ]);
                                }
                                return back()->with(['message_alert' => __('cargo::view.please_enter_OTP_of')]);
                            }
                        }
                    }
                }

                if(in_array($mission->type,[Mission::getType(Mission::PICKUP_TYPE),Mission::getType(Mission::DELIVERY_TYPE)])){

                    $cash = BusinessSetting::where("type","cash_payment")->get()->first();
                    $payment_method_id = $cash->id;
                    if($mission->type == Mission::getType(Mission::PICKUP_TYPE)){
                        $payment_type = Shipment::PREPAID;
                        $mission = Mission::where('id',$request->ids[0])->where('type',Mission::PICKUP_TYPE)
                                    ->with('shipment_mission')->get()->first();
                        $shipment_ids = $mission->shipment_mission->pluck('shipment_id');

                    }elseif($mission->type == Mission::getType(Mission::DELIVERY_TYPE)){
                        $payment_type = Shipment::POSTPAID;
                        $mission = Mission::where('id',$request->ids[0])->where('type',Mission::DELIVERY_TYPE)
                                    ->with('shipment_mission')->get()->first();
                        // $shipment_ids = $mission->shipment_mission->pluck('shipment_id');
                        $shipment_ids = [$request->shipment_id];
                    }

                    $shipments = Shipment::whereIn("id",$shipment_ids)->where('payment_method_id',$payment_method_id)->where('payment_type',$payment_type)->get();
                    foreach ($shipments as $shipment) {
                        $payment = new Payment();
                        $payment->shipment_id = $shipment->id;
                        $payment->seller_id = $shipment->client_id;
                        $payment->amount = $shipment->tax + $shipment->shipping_cost + $shipment->insurance;
                        $payment->payment_method = $shipment->payment_method_id;
                        $payment->payment_date = Carbon::now()->toDateTimeString();;
                        $payment->save();

                        $shipment->paid = 1;
                        $shipment->save();
                    }
                }
            }
            if(isset($request->amount))
            {
                $params['amount'] = $request->amount;
            }

            $action = new MissionStatusManagerHelper();
            $response = $action->change_mission_status($request->ids,$to,null,$params);

            if($response['success'])
            {
                if(isset($request->shipment_id))
                {
                    $ids[] = $request->shipment_id;
                    event(new ShipmentAction(Shipment::DELIVERED_STATUS,$ids));
                }else{
                    event(new MissionAction($to,$request->ids));
                }
		        if($fromApi)
                {
                    return true;
                }
                return back()->with(['message_alert' => __('cargo::messages.saved')]);
            }
            if($response['error_msg'])
            {
		        if($fromApi)
                {
                    return response()->json(['message' => "Somthing Wrong!" , 'status' => false ]);
                }
                return back()->with(['message_alert' => __('cargo::messages.somthing_wrong')]);
            }

        }else
        {
	        if($fromApi)
            {
                return response()->json(['message' => "Please select missions" , 'status' => false ]);
            }
            return back()->with(['message_alert' => __('cargo::messages.select_error')]);
        }

    }

    public function getAmountModel(Request $request , $mission_id)
    {
        $mission  = Mission::find($mission_id);
        $shipment = Shipment::find($request->shipment_id);
        $adminTheme = env('ADMIN_THEME', 'adminLte');return view('cargo::'.$adminTheme.'.pages.missions.ajaxed-confirm-amount',compact(['mission','shipment']));
    }

    public function reschedule(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:missions,id',
            'due_date' => 'required|date',
            'reason' => 'required|exists:reasons,id',
        ]);
        $mission = Mission::find($request->id);
        if($mission->status_id == Mission::APPROVED_STATUS){
            $mission->due_date = $request->due_date;
            $mission->save();

            $mission_reason = new MissionReason();
            $mission_reason->mission_id = $mission->id;
            $mission_reason->reason_id = $request->reason;
            $mission_reason->type = "reschedule";
            $mission_reason->save();
            return back()->with(['message_alert' => __('cargo::messages.saved')]);
        }else{
            return back()->with(['message_alert' => __('cargo::messages.invalid_link')]);
        }
    }

    public function getManifests()
    {
        breadcrumb([
            [
                'name' => __('cargo::view.dashboard'),
                'path' => fr_route('admin.dashboard')
            ],
            [
                'name' => __('cargo::view.manifest')
            ]
        ]);
        if(auth()->user()->role == 5){
            $driver = Driver::where('user_id',auth()->user()->id)->first();
            $missions = Mission::where('captain_id',$driver->id)->whereNotIn('status_id', [Mission::DONE_STATUS, Mission::CLOSED_STATUS])->where('due_date',Carbon::today()->format('Y-m-d'))->orderBy('order')->get();
            $adminTheme = env('ADMIN_THEME', 'adminLte');return view('cargo::'.$adminTheme.'.pages.missions.manifest-profile',compact('missions','driver'));
        }
        $adminTheme = env('ADMIN_THEME', 'adminLte');return view('cargo::'.$adminTheme.'.pages.missions.manifests');
    }

    public function getManifestProfile(Request $request)
    {
        $request->validate([
            'captain_id'    => 'required',
            'manifest_date' => 'required', 
        ]);

        breadcrumb([
            [
                'name' => __('cargo::view.dashboard'),
                'path' => fr_route('admin.dashboard')
            ],
            [
                'path' => fr_route('missions.manifests'),
                'name' => __('cargo::view.manifest')
            ],
            [
                'name' => __('cargo::view.manifest_missions')
            ]
        ]);

        $driver   = Driver::find($request->captain_id);
        $due_date = $request->manifest_date;
        $missions = Mission::where('captain_id',$request->captain_id)->whereNotIn('status_id', [Mission::DONE_STATUS, Mission::CLOSED_STATUS])->where('due_date',$due_date)->orderBy('order')->get();
        $adminTheme = env('ADMIN_THEME', 'adminLte');return view('cargo::'.$adminTheme.'.pages.missions.manifest-profile',compact('missions','driver', 'due_date'));
    }

    public function ajax_change_order(Request $request)
    {
        $ids = $request['missions_ids'];
        $missions = Mission::whereIn('id', $ids)
        ->orderByRaw("field(id,".implode(',',$ids).")")
        ->get();

        foreach ($missions as $key => $mission) {
            $mission->order = $key;
            $mission->save();
        }
        return "Done";
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
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
                'name' => __('cargo::view.missions'),
                'path' => fr_route('missions.index')
            ],
            [
                'name' => __('cargo::view.mission'),
            ],
        ]);

        $mission = Mission::find($id);
        $reasons = Reason::where("type","remove_shipment_from_mission")->get();
        $due_date = ($mission->status_id != Mission::REQUESTED_STATUS) ? $mission->due_date : null;
        $helper = new TransactionHelper();
        $shipment_cost = $helper->calcMissionShipmentsAmount($mission->getRawOriginal('type'),$mission->id);
        $cod = $helper->calcMissionShipmentsCOD($mission->id);

        if($mission->status_id == Mission::APPROVED_STATUS){
            $reschedule = true;
            $adminTheme = env('ADMIN_THEME', 'adminLte');return view('cargo::'.$adminTheme.'.pages.missions.show',compact('mission','reasons','due_date','reschedule', 'shipment_cost','cod'));
        }else{
            $adminTheme = env('ADMIN_THEME', 'adminLte');return view('cargo::'.$adminTheme.'.pages.missions.show',compact('mission','reasons','due_date', 'shipment_cost','cod'));
        }
    }

    public function missionsReport(MissionsDataTable $dataTable , $status = 'all' , $type = null)
    {
        breadcrumb([
            [
                'name' => __('cargo::view.dashboard'),
                'path' => fr_route('admin.dashboard')
            ],
            [
                'name' => __('cargo::view.missions_report')
            ]
        ]);

        $data_with = [];
        $share_data = array_merge(get_class_vars(MissionsDataTable::class), $data_with);

        $adminTheme = env('ADMIN_THEME', 'adminLte');
        return $dataTable->render('cargo::'.$adminTheme.'.pages.missions.report', $share_data);
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $adminTheme = env('ADMIN_THEME', 'adminLte');return view('cargo::'.$adminTheme.'.edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
