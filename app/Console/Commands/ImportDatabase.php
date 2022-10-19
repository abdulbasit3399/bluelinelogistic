<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;
use App\Models\User;
use Modules\Cargo\Entities\Branch;
use Modules\Cargo\Entities\Staff;
use Modules\Cargo\Entities\Client;
use Modules\Cargo\Entities\Driver;
use Modules\Cargo\Entities\ClientPackage;
use Modules\Cargo\Entities\ClientAddress;
use Modules\Cargo\Entities\ClientShipmentLog;
use Modules\Cargo\Entities\Cost;
use Modules\Cargo\Entities\Package;
use Modules\Cargo\Entities\Country;
use Modules\Cargo\Entities\State;
use Modules\Cargo\Entities\Area;
use Modules\Currency\Entities\Currency;
use Modules\Cargo\Entities\DeliveryTime;
use Modules\Cargo\Entities\Shipment;
use Modules\Cargo\Entities\ShipmentLog;
use Modules\Cargo\Entities\ShipmentMission;
use Modules\Cargo\Entities\ShipmentReason;
use Modules\Cargo\Entities\Mission;
use Modules\Cargo\Entities\MissionReason;
use Modules\Cargo\Entities\Transaction;
use Modules\Cargo\Entities\Reason;
use Modules\Cargo\Entities\Payment;
use Modules\Localization\Entities\Language;

class ImportDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'database:import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        ini_set('memory_limit', '-1');
        if (check_module('cargo')) {
            $this->importUsers();
            $this->importBranches();
            $this->importStaff();
            $this->importDrivers();
            $this->importClients();
            $this->importClientAddresses();
            $this->importClientPackages();
            $this->importTabel(new ClientShipmentLog, 'client_shipment_logs');
            $this->importTabel(new Cost, 'costs');
            $this->importTabelMultiLangName(new Package, 'packages');
            $this->importTabel(new Country, 'countries');
            $this->importTabel(new State, 'states');
            $this->importTabelMultiLangName(new Area, 'areas');
            $this->importTabelMultiLangName(new DeliveryTime, 'delivery_time');
            $this->importShipments();
            $this->importTabel(new ShipmentLog, 'shipment_log');
            $this->importTabel(new ShipmentMission ,'shipment_mission');
            $this->importTabel(new ShipmentReason ,'shipment_reasons');
            $this->importTabel(new Mission ,'missions');
            $this->importTabel(new MissionReason,'mission_reasons');
            $this->importTabel(new Transaction,'transactions');
            $this->importTabel(new Reason,'reasons');
            $this->importTabel(new Payment,'payments');
            $this->importNotifications();
        }

        if (check_module('currency')) {
            $this->importTabel(new Currency, 'currencies');
        }
        
    }

    public function importTabel($model, $tabelname)
    {
        $items = $model->get();
        $items->each->delete();

        $items = DB::connection('mysql2')->table($tabelname)->get();  

        $items = json_decode(json_encode($items), true);
        $items = $model->insert($items);
    }

    public function importTabelMultiLangName($model, $tabelname)
    {
        $items = $model->get();
        $items->each->delete();

        $items = DB::connection('mysql2')->table($tabelname)->get(); 
        foreach ($items as $item) {
            if($item){
                $item->name = '{"en":"'.$item->name.'","ar":"'.$item->name.'"}';
            }
        }   

        $items = json_decode(json_encode($items), true);
        $items = $model->insert($items);
    }

    public function importUsers()
    {
        $items = User::where('id','!=','1')->get();
        $items->each->delete();

        $item = User::find(1);
        $item->id = 2000;
        $item->save();

        $items = DB::connection('mysql2')->table('users')
        ->select('id','name','email','email_verified_at','password','user_type as role','api_token as remember_token')->get();

        foreach ($items as $key => $item) {
            if($item->role == 'admin'){
                $item->role = 1;
            }elseif($item->role == 'staff'){
                $item->role = 0;
            }elseif($item->role == 'branch'){
                $item->role = 3;
            }elseif($item->role == 'customer'){
                $item->role = 4;
            }elseif($item->role == 'captain'){
                $item->role = 5;
            }
        }

        $items = json_decode(json_encode($items), true);
        $items = User::insert($items);

        $item = User::find(2000);
        $item->delete();
    }

    public function importBranches()
    {
        $items = Branch::get();
        $items->each->delete();

        $items = DB::connection('mysql2')->table('branchs')
        ->select('id','code','name','email','responsible_name','responsible_mobile','national_id','address','is_archived','created_by')->get();    
        
        foreach (User::all() as $user) {
            foreach ($items as $item) {
                if($item){
                    if($item->email == $user->email){
                        $item->user_id = $user->id;
                    }
                }
            }
        }

        $items = json_decode(json_encode($items), true);
        $items = Branch::insert($items);
    }

    public function importStaff()
    {
        $items = Staff::get();
        $items->each->delete();

        $items = DB::connection('mysql2')->table('staff')
        ->select('id','user_id','branch_id')->get();    
        foreach ($items as $item) {
            if($item){
                $item->code = $item->id;
                $item->responsible_mobile = 0;
            }
        }

        $items = json_decode(json_encode($items), true);
        $items = Staff::insert($items);
    }

    public function importDrivers()
    {
        $items = Driver::get();
        $items->each->delete();

        $items = DB::connection('mysql2')->table('captains')
        ->select('id','code','name','email','responsible_name','responsible_mobile','national_id','is_archived','created_by','branch_id')->get();    
        
        foreach (User::all() as $user) {
            foreach ($items as $item) {
                if($item){
                    if($item->email == $user->email){
                        $item->user_id = $user->id;
                        $itemsArray[] =  (array) $item;
                    }
                }
            }
        }
        
        $items = Driver::insert($itemsArray);
    }

    public function importClients()
    {
        $items = Client::get();
        $items->each->delete();

        $items = DB::connection('mysql2')->table('clients')
        ->select('id','code','name','email','responsible_name','responsible_mobile','follow_up_name','follow_up_mobile','how_know_us','national_id','address','is_archived','created_by','pickup_cost','supply_cost','def_return_mile_cost','def_mile_cost','def_shipping_cost','def_tax','def_insurance','def_return_cost','def_shipping_cost_gram','def_mile_cost_gram','def_tax_gram','def_insurance_gram','def_return_cost_gram','def_return_mile_cost_gram','branch_id')->get();    
        
        foreach (User::all() as $user) {
            foreach ($items as $item) {
                if($item){
                    if($item->email == $user->email){
                        $item->user_id = $user->id;
                    }
                }
            }
        }

        $items = json_decode(json_encode($items), true);
        $items = Client::insert($items);
    }

    public function importClientAddresses()
    {
        $items = ClientAddress::get();
        $items->each->delete();

        $items = DB::connection('mysql2')->table('address_client')->get();   
        foreach ($items as $item) {
            if($item){
                $item->is_default = 0;
            }
        } 

        $items = json_decode(json_encode($items), true);
        $items = ClientAddress::insert($items);
    }

    public function importClientPackages()
    {
        $items = ClientPackage::get();
        $items->each->delete();

        $items = DB::connection('mysql2')->table('client_package')
        ->select('id','client_id','package_id','package_name as name','package_cost as cost','created_at','updated_at')->get();   

        $items = json_decode(json_encode($items), true);
        $items = ClientPackage::insert($items);
    }

    public function importShipments()
    {
        $items = Shipment::get();
        $items->each->delete();

        $items = DB::connection('mysql2')->table('shipments')->get();   
        foreach ($items as $item) {
            if($item){
                if($item->payment_method_id == 11){
                    $item->payment_method_id = 'cash_payment';
                }elseif($item->payment_method_id == 118){
                    $item->payment_method_id = 'invoice_payment';
                }elseif($item->payment_method_id == 9){
                    $item->payment_method_id = 'paypal_payment';
                }elseif($item->payment_method_id == 44){
                    $item->payment_method_id = 'paystack';
                }

                if($item->client_phone == null){
                    $item->client_phone = '000000000';
                }
            }
            
        } 

        $items = json_decode(json_encode($items), true);
        $items = Shipment::insert($items);
    }

    public function importNotifications()
    {
        $items = DB::connection('mysql')->table('notifications')->delete();

        $items = DB::connection('mysql2')->table('notifications')->get();
        
        $items = json_decode(json_encode($items), true);
        $items = DB::connection('mysql')->table('notifications')->insert($items);
    }

}