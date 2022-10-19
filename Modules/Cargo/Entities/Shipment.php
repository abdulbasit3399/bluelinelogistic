<?php

namespace Modules\Cargo\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Cargo\Entities\Client;
use Modules\Cargo\Entities\Branch;
use Modules\Cargo\Entities\Staff;
use Modules\Cargo\Entities\Mission;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Shipment extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $fillable = [];
    protected $guarded = [];
    protected $table = 'shipments';

    //Shipment Types
    const PICKUP = 1;
    const DROPOFF = 2;
    const VAULT = 3;

    //Payment Methods
    const CASH_METHOD = 1;
    const PAYPAL_METHOD = 2;

    //Payment Types
    const POSTPAID = 1;
    const PREPAID = 2;

    //Sort Types
    const LATEST = 1;
    const OLDEST = 2;

    //Shipments Status Manager
    const SAVED_STATUS = 1;
    const REQUESTED_STATUS = 2;
    const APPROVED_STATUS = 3;
    const CLOSED_STATUS = 4;
    const CAPTAIN_ASSIGNED_STATUS = 5;
    const RECIVED_STATUS = 6;
    const DELIVERED_STATUS = 7;
    const PENDING_STATUS = 8;
    const IN_STOCK_STATUS = 9;
    const SUPPLIED_STATUS = 10;
    const RETURNED_STATUS = 11;
    const RETURNED_ON_SENDER = 12;
    const RETURNED_ON_RECEIVER = 13;
    const RETURNED_STOCK = 14;
    const RETURNED_CLIENT_GIVEN = 15;

    const CLIENT_STATUS_CREATED = 1;
    const CLIENT_STATUS_READY = 2;
    const CLIENT_STATUS_IN_PROCESSING = 3;
    const CLIENT_STATUS_TRANSFERED = 4;
    const CLIENT_STATUS_RECEIVED_BRANCH = 5;
    const CLIENT_STATUS_OUT_FOR_DELIVERY = 6;
    const CLIENT_STATUS_DELIVERED = 7;
    const CLIENT_STATUS_SUPPLIED = 10;
    const CLIENT_STATUS_RETURNED = 11;
    const CLIENT_STATUS_RETURNED_STOCK = 14;
    const CLIENT_STATUS_RETURNED_CLIENT_GIVEN = 15;

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('attachments');
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('preview')->fit(Manipulations::FIT_CROP, 300, 300)->nonQueued();
    }

    protected static function newFactory()
    {
        return \Modules\Cargo\Database\factories\ShipmentFactory::new();
    }
    static public function status_info()
    {
        $array = [
            [
                'status' => Self::SAVED_STATUS,
                'text' => __('cargo::view.saved'),
                'route_name' => 'admin.shipments.saved.index',
                'permissions' => 'saved-shipments',
                'route_url' => 'saved',
                'optional_params' => '/{type?}'
            ],

            [
                'status' => Self::REQUESTED_STATUS,
                'text' => __('cargo::view.requested'),
                'route_name' => 'admin.shipments.requested.index',
                'permissions' => 'requested-shipments',
                'route_url' => 'requested',
                'optional_params' => '/{type?}'
            ],

            [
                'status' => Self::APPROVED_STATUS,
                'text' => __('cargo::view.approved'),
                'route_name' => 'admin.shipments.approved.index',
                'permissions' => 'approved-shipments',
                'route_url' => 'approved'
            ],

            [
                'status' => Self::CLOSED_STATUS,
                'text' => __('cargo::view.closed'),
                'route_name' => 'admin.shipments.closed.index',
                'permissions' => 'closed-shipments',
                'route_url' => 'closed'
            ],

            [
                'status' => Self::CAPTAIN_ASSIGNED_STATUS,
                'text' =>  __('cargo::view.assigned'),
                'route_name' => 'admin.shipments.assigned.index',
                'permissions' => 'assigned-shipments',
                'route_url' => 'assigned'
            ],

            [
                'status' => Self::RECIVED_STATUS,
                'text' => __('cargo::view.received'),
                'route_name' => 'admin.shipments.captain.given.index',
                'permissions' => 'received-shipments',
                'route_url' => 'deliverd-to-driver'
            ],
            [
                'status' => Self::DELIVERED_STATUS,
                'text' => __('cargo::view.deliverd'),
                'route_name' => 'admin.shipments.delivred.index',
                'permissions' => 'deliverd-shipments',
                'route_url' => 'delivred'
            ],
            [
                'status' => Self::SUPPLIED_STATUS,
                'text' => __('cargo::view.supplied'),
                'route_name' => 'admin.shipments.supplied.index',
                'permissions' => 'supplied-shipments',
                'route_url' => 'supplied'
            ],

            [
                'status' => Self::RETURNED_STATUS,
                'text' => __('cargo::view.returned'),
                'route_name' => 'admin.shipments.returned.sender.index',
                'permissions' => 'returned-shipments',
                'route_url' => 'returned-on-sender'
            ],

            [
                'status' => Self::RETURNED_STOCK,
                'text' => __('cargo::view.returned_stock'),
                'route_name' => 'admin.shipments.returned.stock.index',
                'permissions' => 'returned-stock-shipments',
                'route_url' => 'returned-stock'
            ],

            [
                'status' => Self::RETURNED_CLIENT_GIVEN,
                'text' => __('cargo::view.returned_deliverd'),
                'route_name' => 'admin.shipments.returned.deliverd.index',
                'permissions' => 'returned-deliverd-shipments',
                'route_url' => 'returned-deliverd'
            ],



        ];
        return $array;
    }

    static public function getShipments($query , $request = null){
        $shipments = $query;
        $user_role = auth()->user()->role;
        if(isset($user_role))
        {
            if($user_role == 3){ // User Branch
                $user = Branch::where('user_id',auth()->user()->id)->pluck('id')->first();
                $shipments = $shipments->where('branch_id', $user);
            }elseif($user_role == 4){ // User Client
                $user = Client::where('user_id',auth()->user()->id)->pluck('id')->first();
                $shipments = $shipments->where('client_id', $user);
            }elseif(auth()->user()->can('manage-shipments') && $user_role == 0){ // User Staff
                $user = Staff::where('user_id',auth()->user()->id)->pluck('branch_id')->first();
                $shipments = $shipments->where('branch_id', $user);
            }
        }

        if (isset($request) && !empty($request)) {

            if (isset($request->type) && !empty($request->type)) {
                $shipments = $shipments->where('type', $request->type);
            }

            if (isset($request->branch_id) && !empty($request->branch_id)) {
                $shipments = $shipments->where('branch_id', $request->branch_id);
            }

            if (isset($request->client_id) && !empty($request->client_id)) {
                $shipments = $shipments->where('client_id', $request->client_id);
            }

            if (isset($request->status) && !empty($request->status)) {
                if($request->status == 'all')
                {
                    $shipments = $shipments->where('id','!=', null );
                }else {
                    if(is_array($request->status)){
                        $shipments = $shipments->whereIn('status_id', $request->status);
                    }else{
                        $shipments = $shipments->where('status_id', $request->status);
                    }
                }
            }
        }
        $shipments = $shipments->where('type','!=',3);

        return $shipments;

    }
    public function getStatus(){
        return $this->status;
        $result = null;
        foreach (Self::status_info() as $status) {
            $status_id = $this->status_id;
            $result = (isset($status['status']) && $status['status'] == $status_id) ? $status['text'] : null;
            if ($result != null) {
                return $result;
            }
        }

        return $result;
    }
    static public function getStatusByStatusId($status_id_attr){
        $result = null;
        foreach (Self::status_info() as $status) {
            $status_id = $status_id_attr;
            $result = (isset($status['status']) && $status['status'] == $status_id) ? $status['text'] : null;
            if ($result != null) {
                return $result;
            }
        }

        return $result;
    }
    static public function getType($value){

        if ($value == Self::DROPOFF) {
            return __('cargo::view.dropoff');
        } elseif ($value == Self::PICKUP) {
            return __('cargo::view.pickup');
        } else {
            return null;
        }
    }

    public function getTypeAttribute($value)
    {
        if ($value == Self::DROPOFF) {
            return __('cargo::view.dropoff');
        } elseif ($value == Self::PICKUP) {
            return __('cargo::view.pickup');
        } else  {
            return $value;
        }
    }

    public function shipmentReasons(){
		return $this->hasMany('Modules\Cargo\Entities\ShipmentReason', 'shipment_id' , 'id');
	}
    public function logs(){
        return $this->hasMany('Modules\Cargo\Entities\ClientShipmentLog', 'shipment_id', 'id');
    }
    public function from_country(){
		return $this->hasOne('Modules\Cargo\Entities\Country', 'id' , 'from_country_id');
	}
    public function to_country(){
		return $this->hasOne('Modules\Cargo\Entities\Country', 'id' , 'to_country_id');
	}
    public function from_state(){
		return $this->hasOne('Modules\Cargo\Entities\State', 'id' , 'from_state_id');
	}
    public function to_state(){
		return $this->hasOne('Modules\Cargo\Entities\State', 'id' , 'to_state_id');
	}
    public function from_area(){
		return $this->hasOne('Modules\Cargo\Entities\Area', 'id' , 'from_area_id');
	}
    public function to_area(){
		return $this->hasOne('Modules\Cargo\Entities\Area', 'id' , 'to_area_id');
	}
    public function from_address(){
		return $this->hasOne('Modules\Cargo\Entities\ClientAddress', 'id' , 'client_address');
	}
    public function client(){
        return $this->hasOne('Modules\Cargo\Entities\Client', 'id', 'client_id');
    }
    public function reciever(){
        return $this->hasOne('Modules\Cargo\Entities\Client', 'id', 'reciver_id');
    }
    public function captain(){
        return $this->hasOne('Modules\Cargo\Entities\Driver', 'id', 'captain_id');
    }
    public function branch(){
        return $this->hasOne('Modules\Cargo\Entities\Branch', 'id', 'branch_id');
    }
    public function current_mission(){
        return $this->hasOne('Modules\Cargo\Entities\Mission', 'id', 'mission_id');
    }
    public function getPaymentType(){
        if ($this->payment_type == Self::POSTPAID) {
            return __('cargo::view.postpaid');
        } elseif ($this->payment_type == Self::PREPAID) {
            return __('cargo::view.prepaid');
        }
    }
    public function pay(){
        return $this->belongsTo('Modules\Cargo\Entities\BusinessSetting', 'payment_method_id');
    }
    public function payment(){
        return $this->hasOne('Modules\Cargo\Entities\Payment', 'shipment_id' , 'id');
    }
    public function getTableColumns(){
        return $this->getConnection()->getSchemaBuilder()->getColumnListing($this->getTable());
    }
    public function deliveryTime(){
        return $this->hasOne('Modules\Cargo\Entities\DeliveryTime', 'id' , 'delivery_time');
    }
    static public function client_status_info()
    {
        $array = [
            [
                'status' => Self::CLIENT_STATUS_CREATED,
                'text' => __('cargo::view.created'),
            ],
            [
                'status' => Self::CLIENT_STATUS_READY,
                'text' => __('cargo::view.ready_for_shipping'),
            ],
            [
                'status' => Self::CLIENT_STATUS_IN_PROCESSING,
                'text' => __('cargo::view.in_Processing'),
            ],
            [
                'status' => Self::CLIENT_STATUS_TRANSFERED,
                'text' => __('cargo::view.moving_to_branch'),
            ],
            [
                'status' => Self::CLIENT_STATUS_RECEIVED_BRANCH,
                'text' => __('cargo::view.received_in_branch'),
            ],
            [
                'status' => Self::CLIENT_STATUS_OUT_FOR_DELIVERY,
                'text' => __('cargo::view.out_for_delivery'),
            ],
            [
                'status' => Self::CLIENT_STATUS_DELIVERED,
                'text' => __('cargo::view.delivered'),
            ],
            [
                'status' => Self::CLIENT_STATUS_SUPPLIED,
                'text' => __('cargo::view.supplied'),
            ],
            [
                'status' => Self::CLIENT_STATUS_RETURNED,
                'text' => __('cargo::view.returned'),
            ],
            [
                'status' => Self::CLIENT_STATUS_RETURNED_STOCK,
                'text' => __('cargo::view.returned_stock'),
            ],
            [
                'status' => Self::CLIENT_STATUS_RETURNED_CLIENT_GIVEN,
                'text' => __('cargo::view.returned_to_merchant'),
            ]

        ];
        return $array;
    }
    static public function getClientStatusByStatusId($status_id_attr)
    {
        $result = null;
        foreach (Self::client_status_info() as $status) {
            $status_id = $status_id_attr;
            $result = (isset($status['status']) && $status['status'] == $status_id) ? $status['text'] : null;
            if ($result != null) {
                return $result;
            }
        }

        return $result;
    }
    public function getClientStatus()
    {
        $result = null;
        foreach (Self::client_status_info() as $status) {
            $status_id = $this->status_id;
            $result = (isset($status['status']) && $status['status'] == $status_id) ? $status['text'] : null;
            if ($result != null) {
                return $result;
            }
        }

        return $result;
    }

}
