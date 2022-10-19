<?php

namespace Modules\Cargo\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Cargo\Entities\Client;
use Modules\Cargo\Entities\Branch;
use Modules\Cargo\Entities\Staff;
use Modules\Cargo\Entities\Driver;

class Transaction extends Model
{
    use HasFactory;

    protected $table = 'transactions';
    protected $guarded = [];
    protected $fillable = [];

    CONST MESSION_TYPE = 1;
    CONST SHIPMENT_TYPE = 2;
    CONST MANUAL_TYPE = 3;

    CONST CAPTAIN = 1;
    CONST CLIENT = 2;
    CONST BRANCH = 3;

    CONST DEBIT = 1;   // -
    CONST CREDIT = 2;  // +
    
    protected static function newFactory()
    {
        return \Modules\Cargo\Database\factories\TransactionFactory::new();
    }

    public function client(){
        return $this->belongsTo('Modules\Cargo\Entities\Client', 'client_id');
    }
    public function branch(){
        return $this->belongsTo('Modules\Cargo\Entities\Branch', 'branch_id');
    }
    public function captain(){
        return $this->belongsTo('Modules\Cargo\Entities\Driver', 'captain_id');
    }
    public function mission(){
        return $this->belongsTo('Modules\Cargo\Entities\Mission', 'mission_id');
    }
    public function shipment(){
        return $this->belongsTo('Modules\Cargo\Entities\Shipment', 'shipment_id');
    }

    static public function getTransactions($query , $request = null){

        $transactions = $query;
        $user_role = auth()->user()->role;
        if(isset($user_role))
        {
            if($user_role == 3){
                $user = Branch::where('user_id',auth()->user()->id)->pluck('id')->first();
                $transactions = $transactions->where('branch_id', $user)->orWhere('branch_owner_id', $user);
            }elseif($user_role == 4){
                $user = Client::where('user_id',auth()->user()->id)->pluck('id')->first();
                $transactions = $transactions->where('client_id', $user);
            }elseif($user_role == 5){
                $user = Driver::where('user_id',auth()->user()->id)->pluck('id')->first();
                $transactions = $transactions->where('captain_id', $user);
            }elseif($user_role == 2){
                $user = Staff::where('user_id',auth()->user()->id)->first();
                $transactions = $transactions->where('branch_id', $user);

                $transactions = $transactions->where('branch_owner_id',$user->branch_id)
                ->where(function($query) use($staff_permission) {
                    if(auth()->user()->can('manage-drivers')){
                        $query->Where('captain_id','!=' , null);
                    }
                    if(auth()->user()->can('manage-branches')){
                        $query->orWhere('branch_id','!=' , null);
                    }
                    if(auth()->user()->can('manage-customers')){
                        $query->orWhere('client_id','!=' , null);
                    }
                });
            }

        }

        if (isset($request) && !empty($request)) {

        }
        

        return $transactions;

    }
}