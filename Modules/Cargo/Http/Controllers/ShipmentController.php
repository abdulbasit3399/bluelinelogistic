<?php

namespace Modules\Cargo\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Cargo\Http\DataTables\ShipmentsDataTable;
use Modules\Cargo\Http\DataTables\VaultDataTable;

use Modules\Cargo\Http\Requests\ShipmentRequest;
use Modules\Cargo\Entities\Shipment;
use Modules\Cargo\Entities\ShipmentSetting;
use Modules\Cargo\Entities\ClientPackage;
use Modules\Cargo\Entities\Client;
use Modules\Cargo\Entities\Package;
use Modules\Cargo\Entities\Cost;
use Modules\Cargo\Http\Helpers\ShipmentPRNG;
use Modules\Cargo\Http\Helpers\MissionPRNG;
use Modules\Cargo\Entities\PackageShipment;
use Modules\Cargo\Http\Helpers\ShipmentActionHelper;
use Modules\Cargo\Http\Helpers\VaultActionHelper;

use Modules\Cargo\Http\Helpers\StatusManagerHelper;
use Modules\Cargo\Http\Helpers\TransactionHelper;
use Modules\Cargo\Entities\Mission;
use Modules\Cargo\Entities\ShipmentMission;
use Modules\Cargo\Entities\ShipmentReason;
use Modules\Cargo\Entities\Country;
use Modules\Cargo\Entities\State;
use Modules\Cargo\Entities\Area;
use Modules\Cargo\Entities\ClientAddress;
use Modules\Cargo\Entities\DeliveryTime;
use Modules\Cargo\Entities\Branch;
use Modules\Cargo\Entities\BusinessSetting;
use Modules\Cargo\Utility\CSVUtility;
use DB;
use Modules\Cargo\Http\Helpers\UserRegistrationHelper;
use app\Http\Helpers\ApiHelper;
use App\Models\User;
use Modules\Cargo\Events\AddShipment;
use Modules\Cargo\Events\CreateMission;
use Modules\Cargo\Events\ShipmentAction;
use Modules\Cargo\Events\UpdateMission;
use Modules\Cargo\Events\UpdateShipment;
use Modules\Acl\Repositories\AclRepository;
use Modules\Cargo\Http\Controllers\ClientController;
use Modules\Cargo\Http\Requests\RegisterRequest;
use Modules\Cargo\Entities\ShipmentStatus;

use Auth;

class ShipmentController extends Controller
{
    private $aclRepo;

    public function __construct(AclRepository $aclRepository)
    {
        $this->aclRepo = $aclRepository;
        // check on permissions
        $this->middleware('user_role:1|0|3|4')->only('index', 'shipmentsReport' ,'create');
        $this->middleware('user_role:4')->only('import', 'parseImport','ShipmentApis');
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(ShipmentsDataTable $dataTable , $status = 'all' , $type = null)
    {

        breadcrumb([
            [
                'name' => __('cargo::view.dashboard'),
                'path' => fr_route('admin.dashboard')
            ],
            [
                'name' => __('cargo::view.shipments')
            ]
        ]);
        $actions = new ShipmentActionHelper();
        // dd($status);
        if($status == 'all'){
            $actions = $actions->get('all');
        }else{
            $actions = $actions->get($status, $type);
        }

        $data_with = ['actions'=> $actions , 'status' => $status];
        $share_data = array_merge(get_class_vars(ShipmentsDataTable::class), $data_with);

        $adminTheme = env('ADMIN_THEME', 'adminLte');
        return $dataTable->render('cargo::'.$adminTheme.'.pages.shipments.index', $share_data);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        // dd('ali');

        breadcrumb([
            [
                'name' => __('cargo::view.dashboard'),
                'path' => fr_route('admin.dashboard')
            ],
            [
                'name' => __('cargo::view.shipments'),
                'path' => fr_route('shipments.index')
            ],
            [
                'name' => __('cargo::view.add_shipment'),
            ],
        ]);

        $adminTheme = env('ADMIN_THEME', 'adminLte');return view('cargo::'.$adminTheme.'.pages.shipments.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function vault_create()
    {
        breadcrumb([
            [
                'name' => __('cargo::view.dashboard'),
                'path' => fr_route('admin.dashboard')
            ],
            [
                'name' => __('cargo::view.shipments'),
                'path' => fr_route('shipments.index')
            ],
            [
                'name' => "Add Vault",
            ],
        ]);

        $adminTheme = env('ADMIN_THEME', 'adminLte');
        return view('cargo::'.$adminTheme.'.pages.shipments.vault_create');
    }
    public function vault_store(Request $request)
    {
        // dd($request->all());
        
        $request->validate([
            'vault_username' => 'required',
            'vault_password' => 'required',
            'next_kin' => 'required',
            'despositor' => 'required',

            'arrears' => 'required',
            'd_o_deposit' => 'required',

        ]);
        if($request->vault_password == $request->confirm_password)
        {
        $model = new Shipment;

        $model->type = 3;
        $model->code = '';
        $model->status_id = 1;
        // $model->client_id = $request->Shipment['client_id'];
        //$model->client_phone = $request->Shipment['client_phone'];

        // $model->client_address = $request->client_address;
        $model->user_fullname = $request->user_fullname;
        $model->user_email = $request->user_email;

        $model->vault_username = $request->vault_username;
        $model->vault_password = $request->vault_password;
        // $model->vault_number = 'VA'.time();
        $model->vault_number = $request->vault_number;
        $model->next_kin = $request->next_kin;
        $model->despositor = $request->despositor;

        // $model->vault_icon = $request->vault_icon;
        $model->quantity = $request->quantity;

        $model->item_des = $request->item_des;
        $model->status = $request->ship_status;
        $model->arrears = $request->arrears;
        $model->d_o_deposit = $request->d_o_deposit;
        // dd($request->all());

        // dd($model->all());
        $model->save();
        return redirect()->route('shipments.vault.index')->with(['message_alert' => "Vault created successfully."]);
        }
        else
        {
            return redirect()->back()->with('error', 'Password is not confirmed!');
        }
    }

    // Vault Update
    public function vault_edit($id)
    {
        // dd('edit');

        breadcrumb([
            [
                'name' => __('cargo::view.dashboard'),
                'path' => fr_route('admin.dashboard')
            ],
            [
                'name' => __('cargo::view.shipments'),
                'path' => fr_route('shipments.index')
            ],
            [
                'name' => __('Edit Vault'),
            ],
        ]);
        $item = Shipment::findOrFail($id);
        $adminTheme = env('ADMIN_THEME', 'adminLte');
        return view('cargo::'.$adminTheme.'.pages.shipments.vault_edit')->with(['model' => $item]);
    }

    public function vault_update(Request $request)
    {
        $request->validate([
            'vault_username' => 'required',
            'vault_password' => 'required',
            'next_kin' => 'required',
            // 'item_des' => 'required',
            'arrears' => 'required',
            'd_o_deposit' => 'required',
        ]);

        try {
            if($request->vault_password == $request->confirm_password)
            {
            DB::beginTransaction();
            $model = Shipment::where('id', $request->ship_id)->first();
            // dd($model);
            $model->fill($request->Shipment);
            $model->type = 3;
            $model->code = '';
            $model->status_id = 1;
            // $model->client_id = $request->Shipment['client_id'];
            // $model->client_phone = $request->Shipment['client_phone'];
            // $model->client_address = $request->client_address;
            $model->user_fullname = $request->user_fullname;
            $model->user_email = $request->user_email;

            $model->vault_username = $request->vault_username;
            $model->vault_password = $request->vault_password;

            $model->vault_number = $request->vault_number;

            $model->next_kin = $request->next_kin;
            $model->despositor = $request->despositor;

            $model->quantity = $request->quantity;

            // $model->vault_icon = $request->vault_icon;
            $model->item_des = $request->item_des;
            $model->status = $request->ship_status;
            $model->arrears = $request->arrears;
            $model->d_o_deposit = $request->d_o_deposit;
            // dd('update');

            if (!$model->save()) {
                throw new \Exception();
            }

            $counter = 0;
            event(new UpdateShipment($model));
            DB::commit();

            $model->syncFromMediaLibraryRequest($request->image)->toMediaCollection('attachments');
            return redirect()->route('shipments.vault.index', $model->id)->with(['message_alert' => __('cargo::messages.saved')]);;

            }else{
                return redirect()->back()->with('error', 'Password is not confirmed!');
            }
        } catch (\Exception $e) {
            DB::rollback();
            print_r($e->getMessage());
            exit;
            return back();
        }
    }

    public function vault_delete($id)
    {
        Shipment::find($id)->delete();
        return redirect()->route('shipments.vault.index')->with(['message_alert' => "Vault deleted successfully."]);

    }
    public function store(Request $request)
    {
        $request->validate([
            'Shipment.type'            => 'required',
            'Shipment.branch_id'       => 'required',
            'Shipment.shipping_date'   => 'nullable',
            'Shipment.collection_time' => 'nullable',
            
            'Shipment.reciver_id'       => 'required',
            // 'Shipment.vault_username'    => 'required',
            // 'Shipment.vault_password'    => 'required',

            // 'Shipment.client_phone'    => 'required|digits_between:8,20',
            // 'Shipment.client_address'  => 'required',
            // 'Shipment.reciver_name'    => 'required|string|min:3|max:50',
            // 'Shipment.reciver_phone'   => 'required|digits_between:8,20',

            // 'Shipment.reciver_address' => 'required|string|min:8',
            // 'Shipment.from_country_id' => 'required',
            // 'Shipment.to_country_id'   => 'required',
            // 'Shipment.from_state_id'   => 'required',
            // 'Shipment.to_state_id'     => 'required',
            // 'Shipment.from_area_id'    => 'required',
            // 'Shipment.to_area_id'      => 'required',
            'Shipment.payment_type'    => 'required',
            'Shipment.payment_method_id' => 'required',
            'Shipment.order_id'          => 'nullable',
            'Shipment.attachments_before_shipping' => 'nullable',
            'Shipment.amount_to_be_collected'      => 'required',
            'Shipment.delivery_time'    => 'nullable',
            // 'Shipment.total_weight'     => 'required',

        ]);

        try {
            DB::beginTransaction();
                $model = $this->storeShipment($request);
                $model->addFromMediaLibraryRequest($request->image)->toMediaCollection('attachments');
                event(new AddShipment($model));
            DB::commit();

            if($request->Shipment['type'] != 3)
            {
                return redirect()->route('shipments.show', $model->id)->with(['message_alert' => __('cargo::messages.created')]);
            } else {
                return redirect()->route('shipments.vault.view.tracking');
            }

        } catch (\Exception $e) {
            DB::rollback();
            print_r($e->getMessage());
            exit;

            flash(translate("Error"))->error();
            return back();
        }
        // dd($request->all());
    }

    private function storeShipment($request , $token = null)
    {
        $model = new Shipment();
        $model->fill($request->Shipment);
        $model->client_address = $request->clnt_address;
        $model->reciver_address = $request->receiver_address;
        $model->status = $request->ship_status;

        $model->code = -1;
        $model->status_id = Shipment::SAVED_STATUS;
        $date = date_create();
        $today = date("Y-m-d");
        // dd($model);

        $model->save();


        if(isset($token)){
            $user = User::where('remember_token', $token)->first();
            $userClient = Client::where('user_id',$user->id)->first();

            if(isset($user))
            {
                $model->client_id = $userClient->id;

                // Validation
                if(!isset($request->Shipment['type']) || !isset($request->Shipment['branch_id']) || !isset($request->Shipment['shipping_date']) || !isset($request->Shipment['client_address']) || !isset($request->Shipment['reciver_name']) || !isset($request->Shipment['reciver_phone']) || !isset($request->Shipment['reciver_address']) || !isset($request->Shipment['from_country_id']) || !isset($request->Shipment['to_country_id']) || !isset($request->Shipment['from_state_id']) || !isset($request->Shipment['to_state_id']) || !isset($request->Shipment['from_area_id']) || !isset($request->Shipment['to_area_id']) || !isset($request->Shipment['payment_method_id']) || !isset($request->Shipment['payment_type']) || !isset($request->Package))
                {
                    $message = 'Please make sure to add all required fields';
                    return $message;
                }else {
                    if($request->Shipment['type'] != Shipment::POSTPAID && $request->Shipment['type'] != Shipment::PREPAID ){
                        return 'Invalid Type';
                    }

                    if(!Branch::find($request->Shipment['branch_id'])){
                        return 'Invalid Branch';
                    }

                    if(!ClientAddress::where('client_id',$userClient->id)->where('id',$request->Shipment['client_address'])->first() ){
                        return 'Invalid Client Address';
                    }

                    if(!Country::where('covered',1)->where('id',$request->Shipment['from_country_id'])->first() || !Country::where('covered',1)->where('id',$request->Shipment['to_country_id'])->first() ){
                        return 'Invalid Country';
                    }

                    if(!State::where('covered',1)->where('id',$request->Shipment['from_state_id'])->first() || !State::where('covered',1)->where('id',$request->Shipment['to_state_id'])->first() ){
                        return 'Invalid State';
                    }

                    if(!Area::where('state_id', $request->Shipment['from_state_id'])->where('id',$request->Shipment['from_area_id'])->first() || !Area::where('state_id', $request->Shipment['to_state_id'])->where('id',$request->Shipment['to_area_id'])->first() ){
                        return 'Invalid Area';
                    }

                    if(isset($request->Shipment['payment_method_id'])){
                        $paymentSettings = resolve(\Modules\Payments\Entities\PaymentSetting::class)->toArray();
                      	if(!isset($paymentSettings[$request->Shipment['payment_method_id']])){
                          return 'Invalid Payment Method Id';
                        }
                    }

                    if($request->Shipment['payment_type'] != Shipment::POSTPAID && $request->Shipment['payment_type'] != Shipment::PREPAID){
                        return 'Invalid Payment Type';
                    }

                    if(isset($request->Shipment['delivery_time'])){
                        $delivery_time = DeliveryTime::where('id', $request->Shipment['delivery_time'] )->first();
                        if(!$delivery_time){
                            return 'Invalid Delivery Time';
                        }
                    }

                }

                if(!isset($request->Shipment['client_phone'])){
                    $model->client_phone = $userClient->responsible_mobile;
                }

                if(!isset($request->Shipment['amount_to_be_collected'])){
                    $model->amount_to_be_collected = 0;
                }

            }else{
                return response()->json(['message' => 'invalid or Expired Api Key' ] );
            }
        }

        if (!$model->save()) {
            return response()->json(['message' => new \Exception()] );
        }

        if(ShipmentSetting::getVal('def_shipment_code_type')=='random'){
            $barcode = ShipmentPRNG::get();
                }else{
            $code = '';
            for($n = 0; $n < ShipmentSetting::getVal('shipment_code_count'); $n++){
                $code .= '0';
            }
            $code       =   substr($code, 0, -strlen($model->id));
            $barcode    =   $code.$model->id;
        }
        $model->barcode = $barcode;
        $model->code = ShipmentSetting::getVal('shipment_prefix').$barcode;

        if( auth()->user() && auth()->user()->role == 4 ){ // IF IN AUTH USER == CLIENT
            $client = Client::where('user_id',auth()->user()->id)->first();
            $model->client_id = $client->id;
        // dd($model);
        }

        if (!$model->save()) {
            return response()->json(['message' => new \Exception()] );
        }
        $costs = $this->applyShipmentCost($model,$request->Package);

        $model->fill($costs);
        if (!$model->save()) {
            return response()->json(['message' => new \Exception()] );
        }

        $counter = 0;
        if (isset($request->Package)) {
            if (!empty($request->Package)) {

                if (isset($request->Package[$counter]['package_id'])) {

                    if(isset($token))
                    {
                        $total_weight = 0;
                    }

                    foreach ($request->Package as $package) {
                        if(isset($token))
                        {
                            if(!Package::find($package['package_id'])){
                                return 'Package invalid';
                            }

                            if(!isset($package['qty'])){
                                $package['qty'] = 1;
                            }

                            if(!isset($package['weight'])){
                                $package['weight'] = 1;
                            }
                            if(!isset($package['length'])){
                                $package['length'] = 1;
                            }
                            if(!isset($package->width)){
                                $package['width'] = 1;
                            }
                            if(!isset($package['height'])){
                                $package['height'] = 1;
                            }

                            $total_weight = $total_weight + $package['weight'];
                        }
                        $package_shipment = new PackageShipment();
                        $package_shipment->fill($package);
                        $package_shipment->package_id = 0;
                        $package_shipment->shipment_id = $model->id;
                        if (!$package_shipment->save()) {
                            throw new \Exception();
                        }
                    }

                    if(isset($token))
                    {

                        $model->total_weight = $total_weight;
                        if (!$model->save()) {
                            return response()->json(['message' => new \Exception()] );
                        }
                    }
                }
            }
        }

        if(isset($token))
        {
            $message = 'Shipment added successfully';
            return $message;
        }else {
            return $model;
        }
    }

    public function storeAPI(Request $request)
    {
        // dd($request->all());
        try {
            $apihelper = new ApiHelper();
            $user = $apihelper->checkUser($request);

            if($user){
                DB::beginTransaction();
                    $message = $this->storeShipment($request , $request->header('token'));
                DB::commit();
                return response()->json(['message' => $message ] );
            }else{
                return response()->json(['message' => 'Not Authorized'] );
            }
        } catch (\Exception $e) {
            DB::rollback();
            return $e->getMessage();
        }
    }
    public function getShipmentsAPI(Request $request)
    {
        // dd($request->all());
        try {
            $apihelper = new ApiHelper();
            $user = $apihelper->checkUser($request);

            if($user){
                $userClient = Client::where('user_id',$user->id)->first();
                $shipments = new Shipment();

                $shipments = $shipments->where('client_id',$userClient->id);
                if (isset($request->code) && !empty($request->code)) {
                    $shipments = $shipments->where('code', $request->code);
                }
                if (isset($request->type) && !empty($request->type)) {
                    $shipments = $shipments->where('type', $request->type);
                }
                $shipments = $shipments->with(['pay','from_address'])->orderBy('client_id')->orderBy('id','DESC')->paginate(20);
                return response()->json($shipments);
            }else{
                return response()->json(['message' => 'Not Authorized'] );
            }
        } catch (\Exception $e) {
            DB::rollback();
            return $e->getMessage();
        }
    }

    public function show($id)
    {
        $shipment = Shipment::find($id);
        breadcrumb([
            [
                'name' => __('cargo::view.dashboard'),
                'path' => fr_route('admin.dashboard')
            ],
            [
                'name' => __('cargo::view.shipments'),
                'path' => fr_route('shipments.index')
            ],
            [
                'name' => __('cargo::view.shipment') .' | '.$shipment->code,
            ],
        ]);
        if($shipment->type == 3){
            $adminTheme = env('ADMIN_THEME', 'adminLte');
            return view('cargo::'.$adminTheme.'.pages.shipments.show_valut', compact('shipment'));
        }
        else{
            $adminTheme = env('ADMIN_THEME', 'adminLte');return view('cargo::'.$adminTheme.'.pages.shipments.show', compact('shipment'));

        }
    }

    public function edit($id)
    {
        // dd('ali');

        breadcrumb([
            [
                'name' => __('cargo::view.dashboard'),
                'path' => fr_route('admin.dashboard')
            ],
            [
                'name' => __('cargo::view.shipments'),
                'path' => fr_route('shipments.index')
            ],
            [
                'name' => __('cargo::view.edit_shipment'),
            ],
        ]);
        $item = Shipment::findOrFail($id);
        $adminTheme = env('ADMIN_THEME', 'adminLte');return view('cargo::'.$adminTheme.'.pages.shipments.edit')->with(['model' => $item]);
    }

    public function update(Request $request, $id)
    {
        // dd($request->all());
        $request->validate([
            'Shipment.type'            => 'required',
            'Shipment.branch_id'       => 'required',
            'Shipment.shipping_date'   => 'nullable',
            'Shipment.collection_time' => 'nullable',
            // 'Shipment.client_id'       => 'required',

            // 'Shipment.vault_username'    => 'required',
            // 'Shipment.vault_password'    => 'required',

            // 'Shipment.client_phone'    => 'required|digits_between:8,20',
            // 'Shipment.client_address'  => 'required',
            // 'Shipment.reciver_name'    => 'required|string|min:3|max:50',
            // 'Shipment.reciver_phone'   => 'required|digits_between:8,20',
            // 'Shipment.reciver_address' => 'required|string|min:8',
            // 'Shipment.from_country_id' => 'required',
            // 'Shipment.to_country_id'   => 'required',
            // 'Shipment.from_state_id'   => 'required',
            // 'Shipment.to_state_id'     => 'required',
            // 'Shipment.from_area_id'    => 'required',
            // 'Shipment.to_area_id'      => 'required',
            'Shipment.payment_type'    => 'required',
            'Shipment.payment_method_id' => 'required',
            'Shipment.order_id'          => 'nullable',
            'Shipment.attachments_before_shipping' => 'nullable',
            'Shipment.amount_to_be_collected'      => 'required',
            'Shipment.delivery_time'    => 'nullable',
            'Shipment.total_weight'     => 'required',
            'Shipment.tax'           => 'nullable',
            'Shipment.insurance'     => 'nullable',
            'Shipment.shipping_cost' => 'nullable',
            'Shipment.return_cost'   => 'nullable',
        ]);

        try {

            DB::beginTransaction();
            $model = Shipment::find($id);
            // dd($model);
            $model->fill($request->Shipment);
            $model->client_address = $request->clnt_address;
            $model->reciver_address = $request->receiver_address;

            if (!$model->save()) {
                throw new \Exception();
            }

            foreach (PackageShipment::where('shipment_id', $model->id)->get() as $pack) {

                //$pack->delete();
                $pack->update([
                    // 'shipment_id' => $model->id,
                    'description' => $request->description,
                    'qty' => $request->qty,
                    'weight' => $request->weight,
                    'length' => $request->length,
                    'width' => $request->width,
                    'height' => $request->height,

                ]);
            // dd($pack->all());

            }
            $counter = 0;

            // dd($request->all());
            // $edit_package = PackageShipment::where('package_id', 0)
            // ->update([
            //     // 'shipment_id' => $model->id,
            //     'description' => $request->description,
            //     'qty' => $request->qty,
            //     'weight' => $request->weight,
            //     'length' => $request->length,
            //     'width' => $request->width,
            //     'height' => $request->height,

            // ]);
            // dd($edit_package);

            // if (isset($_POST['Package'])) {
            //     if (!empty($_POST['Package'])) {
            //         if (isset($_POST['Package'][$counter]['package_id'])) {

            //             foreach ($_POST['Package'] as $package) {
            //                 $package_shipment = new PackageShipment();
            //                 $package_shipment->fill($package);

            //                 $package_shipment->shipment_id = $model->id;
            //                 if (!$package_shipment->save()) {
            //                     throw new \Exception();
            //                 }
            //             }
            //         }
            //     }
            // }

            event(new UpdateShipment($model));
            DB::commit();

            $model->syncFromMediaLibraryRequest($request->image)->toMediaCollection('attachments');
            return redirect()->route('shipments.show', $model->id)->with(['message_alert' => __('cargo::messages.saved')]);;
        } catch (\Exception $e) {
            DB::rollback();
            print_r($e->getMessage());
            exit;
            return back();
        }

    }

    public function import(Request $request)
    {
        breadcrumb([
            [
                'name' => __('cargo::view.dashboard'),
                'path' => fr_route('admin.dashboard')
            ],
            [
                'name' => __('cargo::view.shipments'),
                'path' => fr_route('shipments.index')
            ],
            [
                'name' => __('cargo::view.import_shipments'),
            ],
        ]);
        $shipment = new Shipment;
        $columns = $shipment->getTableColumns();
        $client = Client::where('user_id',auth()->user()->id)->first();

        $countries = Country::where('covered',1)->get();
        $states    = State::where('covered',1)->get();
        $areas     = Area::get();
        $packages  = Package::all();
        $branches   = Branch::where('is_archived', 0)->get();
        $paymentsGateway = BusinessSetting::where("key","payment_gateway")->where("value","1")->get();
        $addresses       = ClientAddress::where('client_id', $client->id )->get();
        $deliveryTimes   = DeliveryTime::all();
        $adminTheme = env('ADMIN_THEME', 'adminLte');return view('cargo::'.$adminTheme.'.pages.shipments.import')
        ->with(['columns' => $columns, 'countries' => $countries, 'states' => $states, 'areas' => $areas, 'packages' => $packages, 'branches' => $branches, 'paymentsGateway' => $paymentsGateway, 'deliveryTimes' => $deliveryTimes, 'client' => $client, 'addresses' => $addresses ]);
    }

    public function parseImport(Request $request)
    {

        $request->validate([
            'shipments_file' => 'required|mimes:csv,txt',
            "columns"        => "required|array|min:16",
        ]);

        $path = $request->file('shipments_file')->getRealPath();
        $data = [];
        $csv = new CSVUtility("testfile");
        $csv->readCSV($path);
        $totalRows = $csv->totalRows();

        for($row=0; $row<$totalRows; $row++) {

            $value = $csv->getRow($row);
            array_push($data,$value);

        }



        if(count($data[0]) != count($request->columns)){
            return back()->with(['error_message_alert' => __('cargo::view.this_file_you_are_trying_to_import_is_not_the_file_that_you_should_upload')]);
        }

        if(!in_array('type',$request->columns) || !in_array('client_phone',$request->columns) || !in_array('client_address',$request->columns) || !in_array('branch_id',$request->columns) || !in_array('shipping_date',$request->columns) || !in_array('reciver_name',$request->columns) || !in_array('reciver_phone',$request->columns) || !in_array('reciver_address',$request->columns) || !in_array('from_country_id',$request->columns) || !in_array('to_country_id',$request->columns) || !in_array('from_state_id',$request->columns) || !in_array('to_state_id',$request->columns) || !in_array('to_area_id',$request->columns) || !in_array('from_area_id',$request->columns) || !in_array('payment_type',$request->columns) || !in_array('payment_method_id',$request->columns) || !in_array('package_id',$request->columns) ){
            return back()->with(['error_message_alert' => __('cargo::view.make_sure_all_required_parameters_in_CSV')]);
        }

        try {
            unset($data[0]);
            $client = Client::where('user_id',auth()->user()->id)->first();

            foreach ($data as $row) {
                for ($i=0; $i < count($row); $i++) {

                    // Validation
                    if($request->columns[$i] == 'type'){
                        if(intval($row[$i]) != Shipment::POSTPAID && intval($row[$i]) != Shipment::PREPAID ){
                            return back()->with(['error_message_alert' => __('cargo::view.invalid_type')]);
                        }
                    }

                    if($request->columns[$i] == 'branch_id'){
                        if(!Branch::find($row[$i])){
                            return back()->with(['error_message_alert' => __('cargo::view.invalid_branch')]);
                        }
                    }

                    if($request->columns[$i] == 'client_address'){
                        if(!ClientAddress::find($row[$i])){
                            return back()->with(['error_message_alert' => __('cargo::view.invalid_client_address')]);
                        }
                    }

                    if($request->columns[$i] == 'from_country_id' || $request->columns[$i] == 'to_country_id'){
                        if(!Country::find($row[$i])){
                            return back()->with(['error_message_alert' => __('cargo::view.invalid_country')]);
                        }
                    }

                    if($request->columns[$i] == 'from_state_id' || $request->columns[$i] == 'to_state_id' ){
                        if(!State::find($row[$i])){
                            return back()->with(['error_message_alert' => __('cargo::view.invalid_state')]);
                        }
                    }

                    if($request->columns[$i] == 'from_area_id' || $request->columns[$i] == 'to_area_id'){
                        if(!Area::find($row[$i])){
                            return back()->with(['error_message_alert' => __('cargo::view.invalid_area')]);
                        }
                    }

                    if($request->columns[$i] == 'payment_method_id'){
                        $paymentSettings = resolve(\Modules\Payments\Entities\PaymentSetting::class)->toArray();
                      	if(!isset($paymentSettings[$row[$i]])){
                            return back()->with(['error_message_alert' => __('cargo::view.invalid_payment_method')]);
                        }
                    }

                    if($request->columns[$i] == 'payment_type'){
                        if($row[$i] != Shipment::POSTPAID && $row[$i] != Shipment::PREPAID){
                            return back()->with(['error_message_alert' => __('cargo::view.invalid_payment_type')]);
                        }
                    }

                    if($request->columns[$i] == 'package_id'){
                        if(!Package::find($row[$i])){
                            return back()->with(['error_message_alert' => __('cargo::view.invalid_package')]);
                        }
                    }
                    // End Validation

                    if($request->columns[$i] != 'package_id' && $request->columns[$i] != 'description' && $request->columns[$i] != 'height' && $request->columns[$i] != 'width' && $request->columns[$i] != 'length' && $request->columns[$i] != 'weight' && $request->columns[$i] != 'qty' )
                    {

                        if($request->columns[$i] == 'amount_to_be_collected'){

                            if($row[$i] == "" || $row[$i] == " " || !is_numeric($row[$i]))
                            {
                                $new_shipment[$request->columns[$i]] = 0;
                            }else{
                                $new_shipment[$request->columns[$i]] = $row[$i];
                            }
                        }elseif($request->columns[$i] == 'client_phone'){
                            if($row[$i] == "" || $row[$i] == " ")
                            {
                                $new_shipment[$request->columns[$i]] = $client->responsible_mobile ?? $auth_user->phone;
                            }else{
                                $new_shipment[$request->columns[$i]] = $row[$i];
                            }
                        }
                        else {
                            $new_shipment[$request->columns[$i]] = $row[$i];
                        }

                    }else{
                        if($request->columns[$i] == 'package_id')
                        {
                            $new_package[$request->columns[$i]] = intval($row[$i]);
                        }else{
                            if($request->columns[$i] != 'description')
                            {
                                if($row[$i] == "" || $row[$i] == " " || !is_numeric($row[$i]))
                                {
                                    $new_package[$request->columns[$i]] = 1;

                                    if($request->columns[$i] == 'weight'){
                                        $new_shipment['total_weight'] = 1;
                                    }
                                }else{
                                    $new_package[$request->columns[$i]] = $row[$i];
                                    if($request->columns[$i] == 'weight'){
                                        $new_shipment['total_weight'] = $row[$i];
                                    }
                                }
                            }else {
                                $new_package[$request->columns[$i]] = $row[$i];
                            }
                        }

                    }

                    if($request->columns[$i] == 'delivery_time'){
                        if(isset($row[$i]) && !empty($row[$i])){
                            if(!DeliveryTime::find($row[$i])){
                                return back()->with(['error_message_alert' => __('cargo::view.invalid_delivery_time')]);
                            }
                        }
                    }

                }
                $request['Shipment'] = $new_shipment;

                $packages[0] = $new_package;
                $request['Package'] = $packages;

                $this->storeShipment($request);
            }

            return back()->with(['message_alert' => __('cargo::messages.imported')]);
        } catch (\Throwable $th) {

            return dd($th);
        }
    }

    public function change(Request $request, $to)
    {
        // dd($request->all());
        if (isset($request->ids)) {
            $action = new StatusManagerHelper();
            $response = $action->change_shipment_status($request->ids, $to);
            if ($response['success']) {
                event(new ShipmentAction($to,$request->ids));
                return back()->with(['message_alert' => __('cargo::messages.saved')]);
            }
        } else {
            return back()->with(['message_alert' => __('cargo::messages.select_error')]);
        }
    }

    public function createPickupMission(Request $request, $type)
    {
        try {

            if(!is_array($request->checked_ids)){
                $request->checked_ids = json_decode($request->checked_ids, true);
            }

            DB::beginTransaction();
            $model = new Mission();
            $model->fill($request['Mission']);
            $model->status_id = Mission::REQUESTED_STATUS;
            $model->type = Mission::PICKUP_TYPE;
            if (!$model->save()) {
                throw new \Exception();
            }

            $code = '';
            for($n = 0; $n < ShipmentSetting::getVal('mission_code_count'); $n++){
                $code .= '0';
            }
            $code   =   substr($code, 0, -strlen($model->id));
            $model->code = $code.$model->id;
            $model->code = ShipmentSetting::getVal('mission_prefix').$code.$model->id;

            if (!$model->save()) {
                throw new \Exception();
            }

            //change shipment status to requested
            $action = new StatusManagerHelper();

            $response = $action->change_shipment_status($request->checked_ids, Shipment::REQUESTED_STATUS, $model->id);

            //Calaculate Amount
            $helper = new TransactionHelper();
            $helper->calculate_mission_amount($model->id);

            foreach ($request->checked_ids as $shipment_id) {
                if ($model->id != null && ShipmentMission::check_if_shipment_is_assigned_to_mission($shipment_id, Mission::PICKUP_TYPE) == 0)
                {
                    $shipment = Shipment::find($shipment_id);
                    $shipment_mission = new ShipmentMission();
                    $shipment_mission->shipment_id = $shipment->id;
                    $shipment_mission->mission_id = $model->id;
                    if ($shipment_mission->save()) {
                        $shipment->mission_id = $model->id;
                        $shipment->save();
                    }
                }
            }

            event(new ShipmentAction( Shipment::REQUESTED_STATUS,$request->checked_ids));

            event(new CreateMission($model));

            DB::commit();
            if($request->is('api/*')){
                 return $model;
            }else{
                return back()->with(['message_alert' => __('cargo::messages.created')]);
            }

        } catch (\Exception $e) {
            DB::rollback();
            print_r($e->getMessage());
            exit;

            flash(translate("Error"))->error();
            return back();
        }
    }

    public function createDeliveryMission(Request $request, $type)
    {
        try {
            $request->checked_ids = json_decode($request->checked_ids, true);
            DB::beginTransaction();
            $model = new Mission();
            // $model->fill($request['Mission']);
            $model->code = -1;
            $model->status_id = Mission::REQUESTED_STATUS;
            $model->type = Mission::DELIVERY_TYPE;
            $model->otp  = MissionPRNG::get();
            // if(ShipmentSetting::getVal('def_shipment_conf_type')=='otp'){
            //     $model->otp = MissionPRNG::get();
            // }
            if (!$model->save()) {
                throw new \Exception();
            }
            $code = '';
            for($n = 0; $n < ShipmentSetting::getVal('mission_code_count'); $n++){
                $code .= '0';
            }
            $code   =   substr($code, 0, -strlen($model->id));
            $model->code = ShipmentSetting::getVal('mission_prefix').$code.$model->id;
            if (!$model->save()) {
                throw new \Exception();
            }
            foreach ($request->checked_ids as $shipment_id) {


                if ($model->id != null && ShipmentMission::check_if_shipment_is_assigned_to_mission($shipment_id, Mission::DELIVERY_TYPE) == 0) {
                    $shipment = Shipment::find($shipment_id);
                    $shipment_mission = new ShipmentMission();
                    $shipment_mission->shipment_id = $shipment->id;
                    $shipment_mission->mission_id = $model->id;
                    if ($shipment_mission->save()) {
                        $shipment->mission_id = $model->id;
                        $shipment->save();
                    }
                }
            }
            //Calaculate Amount
            $helper = new TransactionHelper();
            $helper->calculate_mission_amount($model->id);

            event(new CreateMission($model));
            DB::commit();

            if($request->is('api/*')){
                 return $model;
            }else{
                return back()->with(['message_alert' => __('cargo::messages.created')]);
            }
        } catch (\Exception $e) {
            DB::rollback();
            print_r($e->getMessage());
            exit;

            flash(translate("Error"))->error();
            return back();
        }
    }

    public function createTransferMission(Request $request, $type)
    {
        try {
            $request->checked_ids = json_decode($request->checked_ids, true);
            DB::beginTransaction();
            $model = new Mission();
            $model->fill($request['Mission']);
            $model->code = -1;
            $model->status_id = Mission::REQUESTED_STATUS;
            $model->type = Mission::TRANSFER_TYPE;
            if (!$model->save()) {
                throw new \Exception();
            }
            $code = '';
            for($n = 0; $n < ShipmentSetting::getVal('mission_code_count'); $n++){
                $code .= '0';
            }
            $code   =   substr($code, 0, -strlen($model->id));
            $model->code = ShipmentSetting::getVal('mission_prefix').$code.$model->id;
            if (!$model->save()) {
                throw new \Exception();
            }
            foreach ($request->checked_ids as $shipment_id) {
                // if ($model->id != null && ShipmentMission::check_if_shipment_is_assigned_to_mission($shipment_id, Mission::TRANSFER_TYPE) == 0) {
                    $shipment = Shipment::find($shipment_id);
                    $shipment_mission = new ShipmentMission();
                    $shipment_mission->shipment_id = $shipment->id;
                    $shipment_mission->mission_id = $model->id;
                    if ($shipment_mission->save()) {
                        $shipment->mission_id = $model->id;
                        $shipment->save();
                    }
                // }
            }

            //Calaculate Amount
            $helper = new TransactionHelper();
            $helper->calculate_mission_amount($model->id);


            event(new CreateMission($model));
            DB::commit();

            if($request->is('api/*')){
                 return $model;
            }else{
                return back()->with(['message_alert' => __('cargo::messages.created')]);
            }
        } catch (\Exception $e) {
            DB::rollback();
            print_r($e->getMessage());
            exit;

            flash(translate("Error"))->error();
            return back();
        }
    }

    public function createSupplyMission(Request $request, $type)
    {
        try {
            if(!is_array($request->checked_ids)){
                $request->checked_ids = json_decode($request->checked_ids, true);
            }

            DB::beginTransaction();
            $model = new Mission();
            $model->fill($request['Mission']);
            $model->code = -1;
            $model->status_id = Mission::REQUESTED_STATUS;
            $model->type = Mission::SUPPLY_TYPE;
            if (!$model->save()) {
                throw new \Exception();
            }
            $code = '';
            for($n = 0; $n < ShipmentSetting::getVal('mission_code_count'); $n++){
                $code .= '0';
            }
            $code   =   substr($code, 0, -strlen($model->id));
            $model->code = ShipmentSetting::getVal('mission_prefix').$code.$model->id;
            if (!$model->save()) {
                throw new \Exception();
            }
            foreach ($request->checked_ids as $shipment_id) {
                if ($model->id != null && ShipmentMission::check_if_shipment_is_assigned_to_mission($shipment_id, Mission::SUPPLY_TYPE) == 0) {
                    $shipment = Shipment::find($shipment_id);
                    $shipment_mission = new ShipmentMission();
                    $shipment_mission->shipment_id = $shipment->id;
                    $shipment_mission->mission_id = $model->id;
                    if ($shipment_mission->save()) {
                        $shipment->mission_id = $model->id;
                        $shipment->save();
                    }
                }
            }

            //Calaculate Amount
            $helper = new TransactionHelper();
            $helper->calculate_mission_amount($model->id);


            event(new CreateMission($model));
            DB::commit();

            if($request->is('api/*')){
                 return $model;
            }else{
                return back()->with(['message_alert' => __('cargo::messages.created')]);
            }
        } catch (\Exception $e) {
            DB::rollback();
            print_r($e->getMessage());
            exit;

            flash(translate("Error"))->error();
            return back();
        }
    }

    public function createReturnMission(Request $request, $type)
    {
        try {
            $request->checked_ids = json_decode($request->checked_ids, true);
            DB::beginTransaction();
            $model = new Mission();
            $model->fill($request['Mission']);
            $model->code = -1;
            $model->status_id = Mission::REQUESTED_STATUS;
            $model->otp  = MissionPRNG::get();
            $model->type = Mission::RETURN_TYPE;
            if (!$model->save()) {
                throw new \Exception();
            }
            $code = '';
            for($n = 0; $n < ShipmentSetting::getVal('mission_code_count'); $n++){
                $code .= '0';
            }
            $code   =   substr($code, 0, -strlen($model->id));
            $model->code = ShipmentSetting::getVal('mission_prefix').$code.$model->id;
            if (!$model->save()) {
                throw new \Exception();
            }

            foreach ($request->checked_ids as $shipment_id) {
                if ($model->id != null && ShipmentMission::check_if_shipment_is_assigned_to_mission($shipment_id, Mission::RETURN_TYPE) == 0) {
                    $shipment = Shipment::find($shipment_id);
                    $shipment_mission = new ShipmentMission();
                    $shipment_mission->shipment_id = $shipment->id;
                    $shipment_mission->mission_id = $model->id;
                    if ($shipment_mission->save()) {
                        $shipment->mission_id = $model->id;
                        $shipment->save();
                    }
                }
            }

            //Calaculate Amount
            $helper = new TransactionHelper();
            $helper->calculate_mission_amount($model->id);

            event(new CreateMission($model));
            DB::commit();

            if($request->is('api/*')){
                 return $model;
            }else{
                            return back()->with(['message_alert' => __('cargo::messages.created')]);
            }
        } catch (\Exception $e) {
            DB::rollback();
            print_r($e->getMessage());
            exit;

            flash(translate("Error"))->error();
            return back();
        }
    }

    public function removeShipmentFromMission(Request $request , $fromApi = false)
    {
        $shipment_id = $request->shipment_id;
        $mission_id = $request->mission_id;
        try {
            DB::beginTransaction();

            $mission = Mission::find($mission_id);
            $shipment = Shipment::find($shipment_id);
            if($mission && $shipment && in_array($mission->status_id , [Mission::APPROVED_STATUS,Mission::REQUESTED_STATUS,Mission::RECIVED_STATUS])){

                $action = new StatusManagerHelper();
                if($mission->type == Mission::getType(Mission::PICKUP_TYPE)){
                    $response = $action->change_shipment_status([$shipment_id], Shipment::SAVED_STATUS, $mission_id);
                }elseif(in_array($mission->type , [Mission::getType(Mission::DELIVERY_TYPE) ,Mission::getType(Mission::RETURN_TYPE) , Mission::getType(Mission::TRANSFER_TYPE) ]) && $mission->status_id == Mission::RECIVED_STATUS){
                    $response = $action->change_shipment_status([$shipment_id], Shipment::RETURNED_STATUS, $mission_id);
                }elseif(in_array($mission->type , [Mission::getType(Mission::DELIVERY_TYPE) ,Mission::getType(Mission::RETURN_TYPE) , Mission::getType(Mission::TRANSFER_TYPE) ]) && in_array($mission->status_id , [Mission::APPROVED_STATUS,Mission::REQUESTED_STATUS]) ){
                    $response = $action->change_shipment_status([$shipment_id], Shipment::RETURNED_STOCK, $mission_id);
                }

                if($shipment_mission = $mission->shipment_mission_by_shipment_id($shipment_id)){
                    $shipment_mission->delete();
                }
                $shipment_reason = new ShipmentReason();
                $shipment_reason->reason_id = $request->reason;
                $shipment_reason->shipment_id = $request->shipment_id;
                $shipment_reason->type = "Delete From Mission";
                $shipment_reason->save();
                //Calaculate Amount
                $helper = new TransactionHelper();
                $helper->calculate_mission_amount($mission_id);

                $mission_shipments = ShipmentMission::where('mission_id',$mission->id)->get();
                if(count($mission_shipments) == 0){
                    $mission->status_id = Mission::DONE_STATUS;
                    $mission->save();
                }
                event(new UpdateMission( $mission_id));
                // event(new ShipmentAction( Shipment::SAVED_STATUS,[$shipment]));
                DB::commit();
                if($fromApi)
                {
                    return true;
                }
                return back()->with(['message_alert' => __('cargo::messages.deleted')]);
            }else{
                return back()->with(['error_message_alert' => __('cargo::messages.invalid')]);
            }
        } catch (\Exception $e) {
            DB::rollback();
            print_r($e->getMessage());
            exit;

            flash(translate("Error"))->error();
            return back();
        }
    }

    public function pay($shipment_id)
    {
        $shipment = Shipment::find($shipment_id);
        if(!$shipment || $shipment->paid == 1){
            flash("Invalid Link")->error();
            return back();
        }

        // return $shipment;
        $adminTheme = env('ADMIN_THEME', 'adminLte');
        return view('cargo::'.$adminTheme.'.pages.shipments.pay', compact('shipment'));
    }

    public function ajaxGetEstimationCost(Request $request)
    {
        // dd($request);
        $request->validate([
            'total_weight' => 'required|numeric|min:0',
        ]);
        $costs = $this->applyShipmentCost($request,$request->package_ids);
        $formated_cost["tax"] = format_price($costs["tax"]);
        $formated_cost["insurance"] = format_price($costs["insurance"]);

        $formated_cost["return_cost"] = format_price($costs["return_cost"]);
        $formated_cost["shipping_cost"] = format_price($costs["shipping_cost"]);
        $formated_cost["total_cost"] = format_price($costs["shipping_cost"] + $costs["tax"] + $costs["insurance"]);

        return $formated_cost;
    }

    public function applyShipmentCost($request,$packages)
    {
        $client_costs    = Client::where('id', $request['client_id'] )->first();
        $idPackages      = array_column($packages, 'package_id');
        $client_packages = ClientPackage::where('client_id', $request['client_id'])->whereIn('package_id',$idPackages)->get();

        $from_country_id = $request['from_country_id'];
        $to_country_id = $request['to_country_id'];

        if (isset($request['from_state_id']) && isset($request['to_state_id'])) {
            $from_state_id = $request['from_state_id'];
            $to_state_id = $request['to_state_id'];
        }
        if (isset($request['from_area_id']) && isset($request['to_area_id'])) {
            $from_area_id = $request['from_area_id'];
            $to_area_id = $request['to_area_id'];
        }

        $total_weight = 0 ;
        $package_extras = 0;

        if($client_packages){
            foreach ($client_packages as $pack) {
                $total_weight += isset($pack['weight']) ? $pack['weight'] : 1;
                $extra = $pack->package_cost;
                $package_extras += $extra;
            }
        }else{
            foreach ($packages as $pack) {
                $total_weight += isset($pack['weight']) ? $pack['weight'] : 1;
                $extra = Package::find($pack['package_id'])->cost;
                $package_extras += $extra;
            }
        }

        //$weight =  $request['total_weight'];
        $weight = isset($request['total_weight']) ? $request['total_weight'] : $total_weight;

        $array = ['return_cost' => 0, 'shipping_cost' => 0, 'tax' => 0, 'insurance' => 0];

        // Shipping Cost = Default + kg + Covered Custom  + Package extra
        $covered_cost = Cost::where('from_country_id', $from_country_id)->where('to_country_id', $to_country_id);

        if (isset($request['from_state_id']) && isset($request['to_state_id'])) {
            $covered_cost = $covered_cost->where('from_state_id', $from_state_id)->where('to_state_id', $to_state_id);
        } else {
            $covered_cost = $covered_cost->where('from_state_id', 0)->where('to_state_id', 0);
        }

        $covered_cost = $covered_cost->first();

        $def_return_cost_gram = $client_costs && $client_costs->def_return_cost_gram   ? $client_costs->def_return_cost_gram   : ShipmentSetting::getCost('def_return_cost_gram');
        $def_return_cost = $client_costs && $client_costs->def_return_cost ? $client_costs->def_return_cost : ShipmentSetting::getCost('def_return_cost');

        $def_shipping_cost_gram = $client_costs && $client_costs->def_shipping_cost_gram ? $client_costs->def_shipping_cost_gram : ShipmentSetting::getCost('def_shipping_cost_gram');
        $def_shipping_cost = $client_costs && $client_costs->def_shipping_cost ? $client_costs->def_shipping_cost : ShipmentSetting::getCost('def_shipping_cost');

        $def_return_mile_cost_gram = $client_costs && $client_costs->def_return_mile_cost_gram ? $client_costs->def_return_mile_cost_gram : ShipmentSetting::getCost('def_return_mile_cost_gram');
        $def_return_mile_cost  = $client_costs && $client_costs->def_return_mile_cost ? $client_costs->def_return_mile_cost : ShipmentSetting::getCost('def_return_mile_cost');

        $def_mile_cost_gram = $client_costs && $client_costs->def_mile_cost_gram ? $client_costs->def_mile_cost_gram : ShipmentSetting::getCost('def_mile_cost_gram');
        $def_mile_cost = $client_costs && $client_costs->def_mile_cost ? $client_costs->def_mile_cost : ShipmentSetting::getCost('def_mile_cost');

        $def_insurance_gram = $client_costs && $client_costs->def_insurance_gram ? $client_costs->def_insurance_gram : ShipmentSetting::getCost('def_insurance_gram');
        $def_insurance = $client_costs && $client_costs->def_insurance ? $client_costs->def_insurance : ShipmentSetting::getCost('def_insurance');


        $def_tax_gram = $client_costs && $client_costs->def_tax_gram ? $client_costs->def_tax_gram : ShipmentSetting::getCost('def_tax_gram');
        $def_tax = $client_costs && $client_costs->def_tax ? $client_costs->def_tax : ShipmentSetting::getCost('def_tax');




        if ($covered_cost != null) {

            if($weight > 1){
                if(ShipmentSetting::getVal('is_def_mile_or_fees')=='2')
                {
                    $return_cost = (float) $covered_cost->return_cost + (float) ( $def_return_cost_gram * ($weight -1));
                    $shipping_cost_first_one = (float) $covered_cost->shipping_cost + $package_extras;
                    $shipping_cost_for_extra = (float) ( $def_shipping_cost_gram * ($weight -1));
                } else if(ShipmentSetting::getVal('is_def_mile_or_fees')=='1')
                {
                    $return_cost = (float) $covered_cost->return_mile_cost + (float) ( $def_return_mile_cost_gram * ($weight -1));
                    $shipping_cost_first_one = (float) $covered_cost->mile_cost + $package_extras;
                    $shipping_cost_for_extra = (float) ( $def_mile_cost_gram * ($weight -1));
                }
                $insurance = (float) $covered_cost->insurance + (float) ( $def_insurance_gram * ($weight -1));

                $tax_for_first_one = (($covered_cost->tax * $shipping_cost_first_one) / 100 );

                $tax_for_exrea = (( $def_tax_gram * $shipping_cost_for_extra) / 100 );

                $shipping_cost = $shipping_cost_first_one + $shipping_cost_for_extra;
                $tax = $tax_for_first_one + $tax_for_exrea;

            }else{
                if(ShipmentSetting::getVal('is_def_mile_or_fees')=='2')
                {
                    $return_cost = (float) $covered_cost->return_cost;
                    $shipping_cost = (float) $covered_cost->shipping_cost + $package_extras;
                } else if(ShipmentSetting::getVal('is_def_mile_or_fees')=='1')
                {
                    $return_cost = (float) $covered_cost->return_mile_cost;
                    $shipping_cost = (float) $covered_cost->mile_cost + $package_extras;
                }
                $insurance = (float) $covered_cost->insurance;
                $tax = (($covered_cost->tax * $shipping_cost) / 100 );
            }

            $array['tax'] = $tax;
            $array['insurance'] = $insurance;
            $array['return_cost'] = $return_cost;
            $array['shipping_cost'] = $shipping_cost;
        } else {

            if($weight > 1){
                if(ShipmentSetting::getVal('is_def_mile_or_fees')=='2')
                {
                    $return_cost = $def_return_cost + (float) ( $def_return_cost_gram * ($weight -1));
                    $shipping_cost_first_one = $def_shipping_cost + $package_extras;
                    $shipping_cost_for_extra = (float) ( $def_shipping_cost_gram * ($weight -1));

                } else if(ShipmentSetting::getVal('is_def_mile_or_fees')=='1')
                {
                    $return_cost = $def_return_mile_cost + (float) ( $def_return_mile_cost_gram * ($weight -1));
                    $shipping_cost_first_one = $def_mile_cost + $package_extras;
                    $shipping_cost_for_extra = (float) ( $def_mile_cost_gram * ($weight -1));
                }

                $insurance = $def_insurance + (float) ( $def_insurance_gram * ($weight -1));
                $tax_for_first_one = (( $def_tax * $shipping_cost_first_one) / 100 );
                $tax_for_exrea = ((ShipmentSetting::getCost('def_tax_gram') * $shipping_cost_for_extra) / 100 );

                $shipping_cost = $shipping_cost_first_one + $shipping_cost_for_extra;
                $tax = $tax_for_first_one + $tax_for_exrea;

            }else{
                if(ShipmentSetting::getVal('is_def_mile_or_fees')=='2')
                {
                    $return_cost = $def_return_cost;
                    $shipping_cost = $def_shipping_cost + $package_extras;
                } else if(ShipmentSetting::getVal('is_def_mile_or_fees')=='1')
                {
                    $return_cost = $def_return_mile_cost;
                    $shipping_cost = $def_mile_cost + $package_extras;
                }
                $insurance = $def_insurance;
                $tax = (( $def_tax * $shipping_cost) / 100 );
            }

            $array['tax'] = $tax;
            $array['insurance'] = $insurance;
            $array['return_cost'] = $return_cost;
            $array['shipping_cost'] = $shipping_cost;

        }
        return $array;
    }

    public function print($shipment, $type = 'invoice')
    {
        $shipment = Shipment::find($shipment);
        if($type == 'label'){
            $adminTheme = env('ADMIN_THEME', 'adminLte');return view('cargo::'.$adminTheme.'.pages.shipments.print-label', compact('shipment'));
        }else{
            breadcrumb([
                [
                    'name' => __('cargo::view.dashboard'),
                    'path' => fr_route('admin.dashboard')
                ],
                [
                    'name' => __('cargo::view.shipments'),
                    'path' => fr_route('shipments.index')
                ],
                [
                    'name' => __('cargo::view.shipment').' '.$shipment->code,
                    'path' => fr_route('shipments.show', $shipment->id)
                ],
                [
                    'name' => __('cargo::view.print_invoice'),
                ],
            ]);
            $adminTheme = env('ADMIN_THEME', 'adminLte');return view('cargo::'.$adminTheme.'.pages.shipments.print-invoice', compact('shipment'));
        }
    }

    public function printStickers(Request $request)
    {
        $request->checked_ids = json_decode($request->checked_ids, true);
        $shipments = Shipment::whereIn('id', $request->checked_ids)->get();
        $adminTheme = env('ADMIN_THEME', 'adminLte');return view('cargo::'.$adminTheme.'.pages.shipments.print-stickers', compact('shipments'));
    }

    public function ShipmentApis()
    {
        breadcrumb([
            [
                'name' => __('cargo::view.dashboard'),
                'path' => fr_route('admin.dashboard')
            ],
            [
                'name' => __('cargo::view.shipment_apis'),
            ],
        ]);
        $client = Client::where('user_id',auth()->user()->id)->first();

        $countries = Country::where('covered',1)->get();
        $states    = State::where('covered',1)->get();
        $areas     = Area::get();
        $packages  = Package::all();
        $branches   = Branch::where('is_archived', 0)->get();
        $paymentsGateway = BusinessSetting::where("key","payment_gateway")->where("value","1")->get();
        $addresses       = ClientAddress::where('client_id', $client->id )->get();
        $deliveryTimes   = DeliveryTime::all();

        $adminTheme = env('ADMIN_THEME', 'adminLte');return view('cargo::'.$adminTheme.'.pages.shipments.apis')
        ->with(['countries' => $countries, 'states' => $states, 'areas' => $areas, 'packages' => $packages, 'branches' => $branches, 'paymentsGateway' => $paymentsGateway, 'deliveryTimes' => $deliveryTimes, 'client' => $client, 'addresses' => $addresses ]);
    }

    public function ajaxGgenerateToken()
    {
        $userRegistrationHelper = new UserRegistrationHelper(auth()->user()->id);
        $token = $userRegistrationHelper->setApiTokenGenerator();

        return response()->json($token);
    }

    public function createMissionAPI(Request $request)
    {

        $apihelper = new ApiHelper();
        $user = $apihelper->checkUser($request);

        if($user){
            $request->validate([
                'checked_ids'       => 'required',
                'type'              => 'required',
                'Mission.client_id' => 'required',
                'Mission.address'   => 'required',
            ]);

            $count = 0;
            foreach($request->checked_ids as $id){
                if(Shipment::whereIn('id', $request->checked_ids)->pluck('mission_id')->first()){
                    $count++;
                }
            }
            if($count >= 1){
                return response()->json(['message' => 'this shipment already in mission'] );
            }else{
                switch($request->type){
                    case Mission::PICKUP_TYPE:
                        $mission = $this->createPickupMission($request,$request->type);
                        break;
                    case Mission::DELIVERY_TYPE:
                        $mission = $this->createDeliveryMission($request,$request->type);
                        break;
                    case Mission::TRANSFER_TYPE:
                        $mission = $this->createTransferMission($request,$request->type);
                        break;
                    case Mission::SUPPLY_TYPE:
                        $mission = $this->createSupplyMission($request,$request->type);
                        break;
                    case Mission::RETURN_TYPE:
                        $mission = $this->createReturnMission($request,$request->type);
                        break;
                }
                return response()->json($mission);
            }
        }else{
            return response()->json(['message' => 'Not Authorized'] );
        }

    }

    public function BarcodeScanner()
    {
        breadcrumb([
            [
                'name' => __('cargo::view.dashboard'),
                'path' => fr_route('admin.dashboard')
            ],
            [
                'name' => __('cargo::view.barcode_scanner'),
            ],
        ]);
        $adminTheme = env('ADMIN_THEME', 'adminLte');
        return view('cargo::'.$adminTheme.'.pages.shipments.barcode-scanner');
    }
    public function ChangeStatusByBarcode(Request $request)
    {
        if($request->checked_ids){
            $request->checked_ids = json_decode($request->checked_ids, true);
        }else{
            return back()->with(['message_alert' => __('cargo::view.no_shipments_added') ]);
        }
        $user_role = auth()->user()->role;
        $action    = new StatusManagerHelper();
        $shipments = Shipment::whereIn('code',$request->checked_ids)->get();

        if(count($shipments) > 0){
            foreach($shipments as $shipment){
                if($shipment)
                {
                    $request->request->add(['ids' => [$shipment->id] ]);
                    if($user_role == 5){ // ROLE 5 == DRIVER

                        if( $shipment->status_id == Shipment::APPROVED_STATUS)
                        {
                            $to = Shipment::RECIVED_STATUS;
                            $response = $action->change_shipment_status($request->ids, $to);
                            if ($response['success']) {
                                event(new ShipmentAction($to,$request->ids));
                            }else{
                                return back()->with(['message_alert' => __('cargo::messages.somthing_wrong') ]);
                            }

                        }else{
                            $message = __('cargo::view.cant_change_this_shipment').$shipment->code;
                            return back()->with(['message_alert' => $message ]);
                        }

                    }elseif(auth()->user()->can('manage-shipments') || $user_role == 1 ){ // ROLE 1 == ADMIN

                        if( $shipment->status_id == Shipment::RECIVED_STATUS)
                        {
                            $to = Shipment::APPROVED_STATUS;
                            $response = $action->change_shipment_status($request->ids, $to);
                            if ($response['success']) {
                                event(new ShipmentAction($to,$request->ids));
                            }else{
                                return back()->with(['message_alert' => __('cargo::messages.somthing_wrong') ]);
                            }
                        }elseif($shipment->status_id == Shipment::RETURNED_STATUS)
                        {
                            $to = Shipment::RETURNED_STOCK;
                            $response = $action->change_shipment_status($request->ids, $to);
                            if ($response['success']) {
                                event(new ShipmentAction($to,$request->ids));
                            }else{
                                return back()->with(['message_alert' => __('cargo::messages.somthing_wrong') ]);
                            }

                        }else
                        {
                            $message = __('cargo::view.cant_change_this_shipment').$shipment->code;
                            return back()->with(['message_alert' => $message ]);
                        }
                    }
                }else{
                    $message = __('cargo::view.no_shipment_with_this_barcode').$shipment->code;
                    return back()->with(['message_alert' => $message ]);
                }
            }
            return back()->with(['message_alert' => __('cargo::messages.saved') ]);
        }else{
            return back()->with(['message_alert' => __('cargo::view.no_shipment_with_this_barcode') ]);
        }

    }

    public function goodtrack(Request $request){
        $share_data = Shipment::where('type', 0)->get();
        // dd($share_data);

        $adminTheme = env('ADMIN_THEME', 'adminLte');
        return view('cargo::'.$adminTheme.'.pages.shipments.goodtrack', compact('share_data'));

    }
    public function addgoodtrack(Request $request){


        $country_data = DB::table('countries')->select('id','name')->get();


        $adminTheme = env('ADMIN_THEME', 'adminLte');
        // dd($request->all());

        return view('cargo::'.$adminTheme.'.pages.shipments.add_goodtrack', compact('country_data'));

    }
    public function addgoodtrack_store(Request $request){
        // dd($request->all());
        $request->validate([

            'user_fullname'      => 'required',
            'user_email'         => 'required',
            'receipt_number'     => 'required',
            'code'     => 'unique:shipments|required',

        ],[
            'code.unique' => 'Tracking no already exists.',
        ]
    );

        $model = new Shipment();
        // $model->fill($request->Shipment);
        $model->vault_username = $request->vault_username;
        $model->vault_password = $request->vault_password;
        $model->user_fullname = $request->user_fullname;
        $model->user_email = $request->user_email;
        $model->receipt_number = $request->receipt_number;
        $model->code = $request->code;
        // $model->code = 'TR'.rand(1000, 9999);
        $model->status = $request->status;
        $model->depart_time = $request->depart_time;
        $model->reciver_name = $request->reciver_name;
        $model->items = $request->items;
        $model->total_weight = $request->total_weight;
        $model->service = $request->service;
        $model->client_address = $request->client_address;
        $model->reciver_address = $request->reciver_address;
        $model->goods_country = $request->goods_country;
        $model->payment_status = $request->payment_status;
        $model->estimated_delivery_date = $request->estimated_delivery_date;
        $model->d_o_deposit = $request->d_o_deposit;

        $model->status_id = Shipment::SAVED_STATUS;
        $model->type = 0;
        // $date = date_create();
        // $today = date("Y-m-d");
        // dd($model);
        $model->save();
        return redirect()->route('shipments.goodtrack');

    }

    public function editgoodtrack($id){
        $item = Shipment::findOrFail($id);
        $country_data = DB::table('countries')->select('id','name')->get();
        $adminTheme = env('ADMIN_THEME', 'adminLte');
        return view('cargo::'.$adminTheme.'.pages.shipments.edit_goodtrack', compact('country_data'))->with(['model' => $item]);
    }

    public function updategoodtrack(Request $request){
        $request->validate([

            'user_fullname'      => 'required',
            'user_email'         => 'required',
            'receipt_number'     => 'required',
            'code'     => 'unique:shipments|required',

        ],[
            'code.unique' => 'Tracking no already exists.',

        ]);

        $model = Shipment::where('code', $request->code)->first();
            // dd($model);


            // $request->id = $model->id;
            // $model->fill($request->Shipment);

        $model->vault_username = $request->vault_username;
        $model->vault_password = $request->vault_password;
        $model->user_fullname = $request->user_fullname;
        $model->user_email = $request->user_email;
        $model->receipt_number = $request->receipt_number;
        $model->code = $request->code;
        // $model->code = 'TR'.rand(1000, 9999);
        $model->status = $request->status;
        $model->depart_time = $request->depart_time;
        $model->reciver_name = $request->reciver_name;
        $model->items = $request->items;
        $model->total_weight = $request->total_weight;
        $model->service = $request->service;
        $model->client_address = $request->client_address;
        $model->reciver_address = $request->reciver_address;
        $model->goods_country = $request->goods_country;
        $model->payment_status = $request->payment_status;

        $model->estimated_delivery_date = $request->estimated_delivery_date;
        $model->d_o_deposit = $request->d_o_deposit;

        $model->status_id = Shipment::SAVED_STATUS;
        $model->type = 0;

        // $date = date_create();
        // $today = date("Y-m-d");
        // dd($model);

        $model->save();
        return redirect()->route('shipments.goodtrack');

    }

    public function deletegoodtrack($id)
    {
        Shipment::find($id)->delete();
        return redirect()->route('shipments.goodtrack')->with(['message_alert' => "Tracking deleted successfully."]);
    }

    public function trackingView(Request $request)
    {
        $adminTheme = env('ADMIN_THEME', 'adminLte');
        return view('cargo::'.$adminTheme.'.pages.shipments.tracking-view');
    }
    // public function shipment_status(Request $request){
    //     $shipment_status = ShipmentStatus::where('shipment_id',$ship_id)->get();

    //     $adminTheme = env('ADMIN_THEME', 'adminLte');
    //     if(count($shipment_status) > 0){
    //         // dd($shipment);
    //         return view('cargo::'.$adminTheme.'.pages.shipments.tracking', compact('shipment_status','shipment'));
    //     }else{
    //         $shipment_status = array();
    //         $error = __('cargo::messages.invalid_code');
    //         return view('cargo::'.$adminTheme.'.pages.shipments.tracking', compact('shipment_status','shipment'))->with(['error' => $error]);
    //     }
    // }

    public function tracking(Request $request)
    {
        $shipment = Shipment::where('code', $request->code)->first();
        if($shipment)
            $ship_id = $shipment->id;
        else
            $ship_id = 0;

        $shipment_status = ShipmentStatus::where('shipment_id',$ship_id)->get();
        // dd($shipment_status);

        $adminTheme = env('ADMIN_THEME', 'adminLte');
        if(count($shipment_status) > 0){
            // dd($shipment);
            return view('cargo::'.$adminTheme.'.pages.shipments.tracking', compact('shipment_status','shipment'));
        }else{
            $shipment_status = array();
            $error = __('cargo::messages.invalid_code');
            return view('cargo::'.$adminTheme.'.pages.shipments.tracking', compact('shipment_status','shipment'))->with(['error' => $error]);
        }



        // $shipment = Shipment::where('code', $request->code)->first();
        // // dd($request->code);

        // dd($shipment->id);

        // $adminTheme = env('ADMIN_THEME', 'adminLte');
        // if($shipment){

        //     return view('cargo::'.$adminTheme.'.pages.shipments.tracking')->with(['model' => $shipment]);
        // }else{
        //     $error = __('cargo::messages.invalid_code');
        //     return view('cargo::'.$adminTheme.'.pages.shipments.tracking')->with(['error' => $error]);
        // }
    }
    public function VaultTrackingView(Request $request)
    {
        // dd($request->all());
        $adminTheme = env('ADMIN_THEME', 'adminLte');

        return view('cargo::'.$adminTheme.'.pages.shipments.vault-tracking-view')->with('error','Invalid Vault Credentials.');
    }
    public function VaultTracking(Request $request)
    {

        $request->validate([
            'vault_number'         => 'required',
            // 'vault_username'       => 'required',
            // 'vault_password'       => 'required',
        ]);

        // $shipment = Shipment::where([['vault_number', $request->vault_number],['vault_username', $request->vault_username],['vault_password', $request->vault_password]])->first();
        // dd($shipment);
        $shipment = Shipment::where([['vault_number', $request->vault_number]])->first();

        $adminTheme = env('ADMIN_THEME', 'adminLte');

        if($shipment){

            return view('cargo::'.$adminTheme.'.pages.shipments.vault_tracking')->with(['model' => $shipment]);
        }else{
            $error = __('Vault not found.');
            \Session::flash('error', $error);
            return view('cargo::'.$adminTheme.'.pages.shipments.vault-tracking-view');
        }
    }

    public function VaultIndex()
    {
        $adminTheme = env('ADMIN_THEME', 'adminLte');

        $shipment = Shipment::where('type', '3')->get();

        // dd($shipment);

        return view('cargo::adminLte.pages.shipments.vault_index', compact('shipment'));
        // dd($shipment);

        // breadcrumb([
        //     [
        //         'name' => __('cargo::view.dashboard'),
        //         'path' => fr_route('admin.dashboard')
        //     ],
        //     [
        //         'name' => __('Vaults')
        //     ]
        // ]);
        // $actions = new VaultActionHelper();
        // // dd($status);
        // if($status == 'all'){
        //     $actions = $actions->get('all');
        // }else{
        //     $actions = $actions->get($status, $type);
        // }

        // $data_with = ['actions'=> $actions , 'status' => $status];
        // $share_data = array_merge(get_class_vars(VaultDataTable::class), $data_with);

        // $adminTheme = env('ADMIN_THEME', 'adminLte');
        // return $dataTable->render('cargo::'.$adminTheme.'.pages.shipments.vault_index', $share_data);

        // $adminTheme = env('ADMIN_THEME', 'adminLte');
        // return view('cargo::adminLte.pages.shipments.vault_index');
    }

    public function calculator(Request $request)
    {
        $adminTheme = env('ADMIN_THEME', 'adminLte');
        return view('cargo::'.$adminTheme.'.pages.shipments.shipment-calculator');
    }

    public function calculatorStore(Request $request)
    {
        $request->validate([
            'Shipment.type'            => 'required',
            'Shipment.branch_id'       => 'required',
            'Shipment.client_phone'    => 'required_if:if_have_account,==,0',
            'Shipment.reciver_name'    => 'required|string|min:3|max:50',
            'Shipment.reciver_phone'   => 'required',
            'Shipment.reciver_address' => 'required|string|min:8',
            'Shipment.from_country_id' => 'required',
            'Shipment.to_country_id'   => 'required',
            'Shipment.from_state_id'   => 'required',
            'Shipment.to_state_id'     => 'required',
            'Shipment.from_area_id'    => 'required',
            'Shipment.to_area_id'      => 'required',
            'Shipment.payment_type'    => 'required',
            'Shipment.payment_method_id' => 'required',
        ]);
        $ClientController = new ClientController(new AclRepository);

        $shipment = $request->Shipment;

        if($request->if_have_account == '1')
        {
            $client = Client::where('email', $request->client_email)->first();
            Auth::loginUsingId($client->user_id);
        }elseif($request->if_have_account == '0'){
            // Add New Client

            $request->request->add(['name' => $request->client_name ]);
            $request->request->add(['email' => $request->client_email ]);
            $request->request->add(['password' => $request->client_password ]);
            $request->request->add(['responsible_mobile' => $request->Shipment['client_phone'] ]);
            $request->request->add(['responsible_name' => $request->client_name ]);
            $request->request->add(['national_id' => $request->national_id ?? '' ]);
            $request->request->add(['branch_id' => $request->Shipment['branch_id'] ]);
            $request->request->add(['terms_conditions' => '1' ]);
            $client = $ClientController->registerStore($request ,true);
        }

        if($client)
        {
            $shipment['client_id']    = $client->id;
            $shipment['client_phone'] = $client->responsible_mobile;

            // Add New Client Address
            $request->request->add(['client_id' => $client->id ]);
            $request->request->add(['address' => $request->client_address ]);
            $request->request->add(['country' => $request->Shipment['from_country_id'] ]);
            $request->request->add(['state'   => $request->Shipment['from_state_id'] ]);
            if(isset($request->area))
            {
                $request->request->add(['area' => $request->Shipment['from_area_id'] ]);
            }
            $new_address        = $ClientController->addNewAddress($request , $calc = true);
            if($new_address)
            {
                $shipment['client_address'] = $new_address->id;
            }

        }
        $request->Shipment = $shipment;
        $model = $this->storeShipment($request);
        return redirect()->route('shipments.show', $model->id)->with(['message_alert' => __('cargo::messages.created')]);
    }

    public function ajaxGetShipmentByBarcode(Request $request)
    {

        $apihelper = new ApiHelper();
        $user = $apihelper->checkUser($request);

        if($user){
            $userClient = Client::where('user_id',$user->id)->first();
            $barcode    = $request->barcode;
            $shipment   = Shipment::where('client_id', $userClient->id)->where('barcode' , $barcode)->first();
            return response()->json($shipment);
        }else{
            return response()->json(['message' => 'Not Authorized'] );
        }
    }

    public function shipmentsReport(ShipmentsDataTable $dataTable , $status = 'all' , $type = null)
    {
        // dd($request->all());

        breadcrumb([
            [
                'name' => __('cargo::view.dashboard'),
                'path' => fr_route('admin.dashboard')
            ],
            [
                'name' => __('cargo::view.shipments_report')
            ]
        ]);

        $data_with = [];
        $share_data = array_merge(get_class_vars(ShipmentsDataTable::class), $data_with);

        $adminTheme = env('ADMIN_THEME', 'adminLte');
        return $dataTable->render('cargo::'.$adminTheme.'.pages.shipments.report', $share_data);
    }

}
