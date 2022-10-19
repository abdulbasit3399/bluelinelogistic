<?php

namespace Modules\Cargo\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Cargo\Entities\Package;
use Modules\Cargo\Entities\Branch;

class ShipmentSetting extends Model
{
    use HasFactory;

    protected $fillable = [];
    protected $guarded = [];
    protected $table = 'shipment_settings';

    protected static function newFactory()
    {
        return \Modules\Cargo\Database\factories\ShipmentSettingFactory::new();
    }

    static public function getVal($key)
    {
        $value = null;
        $setting = Self::where('key',$key)->first();
        // dd($setting);
        if($setting != null)
        {
            $value = $setting->value;
        }
        // dd($value);
        return $value;
    }
    static public function getCost($key)
    {
        $value = 0;
        $setting = Self::where('key',$key)->first();
        if($setting != null)
        {
            $value = $setting->value;
        }
        return $value;
    }

    public static function fields(): array
    {
        $settings = app(ShipmentSetting::class);

        $otp_activation = false;
        $notificationsSettings = app(\App\Models\NotificationsSettings::class);
        if($notificationsSettings->sms){
            $otp_activation = true;
        }

        $packages_array = array();
        foreach(Package::all() as $item){
            $packages_array[$item->id] = json_decode($item->name, true)[app()->getLocale()];
        }
        $branches_array = array();
        foreach(Branch::where('is_archived',0)->get() as $item){
            $branches_array[$item->id] = $item->name;
        }

        $payments_array  = array();
        $paymentSettings = resolve(\Modules\Payments\Entities\PaymentSetting::class)->toArray();
        foreach($paymentSettings as $key => $item){
            if($item){
                $payments_array[$key] = $key;
            }
        }

        $fields = [

            // shipment setting
            'mission_done_with_fees_received' =>   [
                'label'         => 'cargo::view.pickup_mission_done_with_shipment_fees_received',
                'label_radio_1' => 'cargo::view.yes',
                'label_radio_2' => 'cargo::view.no_mission_only_has_been_done',
                'translatable'  =>  false,
                'type'          =>  'radio',
                'value_radio_1' =>  '1',
                'value_radio_2' =>  '0',
                'checked_radio_1' => Self::getVal('mission_done_with_fees_received')=='1' ? 'checked' : ' ',
                'checked_radio_2' => Self::getVal('mission_done_with_fees_received')=='0' ? 'checked' : ' ',
                'required'      =>  true,
            ],
            'show_register_in_driver_app'     =>   [
                'label'         => 'cargo::view.show_register_in_driver_app',
                'label_radio_1' => 'cargo::view.yes',
                'label_radio_2' => 'cargo::view.no',
                'translatable'  =>  false,
                'type'          =>  'radio',
                'value_radio_1' =>  '1',
                'value_radio_2' =>  '0',
                'checked_radio_1' => Self::getVal('show_register_in_driver_app')=='1' ? 'checked' : ' ',
                'checked_radio_2' => Self::getVal('show_register_in_driver_app')=='0' ? 'checked' : ' ',
                'required'      =>  true,
            ],
            'is_shipping_calc_required'     =>   [
                'label'         => 'cargo::view.enable_shippment_calc_in_website',
                'label_radio_1' => 'cargo::view.yes',
                'label_radio_2' => 'cargo::view.no',
                'translatable'  =>  false,
                'type'          =>  'radio',
                'value_radio_1' =>  '1',
                'value_radio_2' =>  '0',
                'checked_radio_1' => Self::getVal('is_shipping_calc_required')=='1' ? 'checked' : ' ',
                'checked_radio_2' => Self::getVal('is_shipping_calc_required')=='0' ? 'checked' : ' ',
                'required'      =>  true,
            ],
            'latest_shipment_count'     =>   [
                'label'         =>  'cargo::view.default_count_for_dashboard_latest_shipment_widget',
                'translatable'  =>  false,
                'type'          =>  'select',
                'options'       =>  array(
                                        '5' =>  "5",
                                        '10' =>  "10",
                                        '15' =>  "15",
                                        '20' =>  "20",
                                        '30' =>  "30",
                                        '50' =>  "50",
                                        '100' =>  "100",
                                    ),
                'value'         =>  Self::getVal('latest_shipment_count') ? Self::getVal('latest_shipment_count') : '10',
                'required'      =>  true
            ],
            'is_date_required'     =>   [
                'label'         => 'cargo::view.enable_shipping_date',
                'label_radio_1' => 'cargo::view.yes',
                'label_radio_2' => 'cargo::view.no',
                'translatable'  =>  false,
                'type'          =>  'radio',
                'value_radio_1' =>  '1',
                'value_radio_2' =>  '0',
                'checked_radio_1' => Self::getVal('is_date_required')=='1' ? 'checked' : ' ',
                'checked_radio_2' => Self::getVal('is_date_required')=='0' ? 'checked' : ' ',
                'required'      =>  true,
            ],
            'def_shipping_date'     =>   [
                'label'         =>  'cargo::view.defult_shipping_date',
                'translatable'  =>  false,
                'type'          =>  'select',
                'options'       =>  array(
                                        '0' =>  __('cargo::view.same_day'),
                                        '1' =>  __('cargo::view.next_day'),
                                        '2' =>  __('cargo::view.after').' 2 '.__('cargo::view.days'),
                                        '3' =>  __('cargo::view.after').' 3 '.__('cargo::view.days'),
                                        '4' =>  __('cargo::view.after').' 4 '.__('cargo::view.days'),
                                        '5' =>  __('cargo::view.after').' 5 '.__('cargo::view.days'),
                                        '6' =>  __('cargo::view.after').' 6 '.__('cargo::view.days'),
                                        '7' =>  __('cargo::view.after').' 7 '.__('cargo::view.days'),
                                        '8' =>  __('cargo::view.after').' 8 '.__('cargo::view.days'),
                                        '9' =>  __('cargo::view.after').' 9 '.__('cargo::view.days'),
                                        '10' =>  __('cargo::view.after').' 10 '.__('cargo::view.days'),
                                        '11' =>  __('cargo::view.after').' 11 '.__('cargo::view.days'),
                                        '12' =>  __('cargo::view.after').' 12 '.__('cargo::view.days'),
                                        '13' =>  __('cargo::view.after').' 13 '.__('cargo::view.days'),
                                        '14' =>  __('cargo::view.after').' 14 '.__('cargo::view.days'),
                                        '15' =>  __('cargo::view.after').' 15'.__('cargo::view.days'),
                                        '16' =>  __('cargo::view.after').' 16 '.__('cargo::view.days'),
                                        '17' =>  __('cargo::view.after').' 17 '.__('cargo::view.days'),
                                        '18' =>  __('cargo::view.after').' 18 '.__('cargo::view.days'),
                                        '19' =>  __('cargo::view.after').' 19 '.__('cargo::view.days'),
                                        '20' =>  __('cargo::view.after').' 20 '.__('cargo::view.days'),
                                        '21' =>  __('cargo::view.after').' 21 '.__('cargo::view.days'),
                                        '22' =>  __('cargo::view.after').' 22 '.__('cargo::view.days'),
                                        '23' =>  __('cargo::view.after').' 23 '.__('cargo::view.days'),
                                        '24' =>  __('cargo::view.after').' 24 '.__('cargo::view.days'),
                                        '25' =>  __('cargo::view.after').' 25 '.__('cargo::view.days'),
                                        '26' =>  __('cargo::view.after').' 26 '.__('cargo::view.days'),
                                        '27' =>  __('cargo::view.after').' 27 '.__('cargo::view.days'),
                                        '28' =>  __('cargo::view.after').' 28 '.__('cargo::view.days'),
                                        '29' =>  __('cargo::view.after').' 29 '.__('cargo::view.days'),
                                        '30' =>  __('cargo::view.after').' 30 '.__('cargo::view.days')
                                    ),
                'value'         =>  Self::getVal('def_shipping_date') ? Self::getVal('def_shipping_date') : ' ',
                'required'      =>  true
            ],
            'shipment_prefix'     =>   [
                'label'         =>  'cargo::view.shipment_prefix',
                'translatable'  =>  false,
                'type'          =>  'string',
                'value'         =>  Self::getVal('shipment_prefix') ? Self::getVal('shipment_prefix') : 'SH',
                'required'      =>  true
            ],
            'shipment_code_count'     =>   [
                'label'         =>  'cargo::view.shipment_number_of_digits_in_the_tracking',
                'translatable'  =>  false,
                'type'          =>  'number',
                'value'         =>  Self::getVal('shipment_code_count') ? Self::getVal('shipment_code_count') : '5',
                'required'      =>  true,
                'validation'    =>  'required|numeric|min:1'
            ],
            'mission_prefix'     =>   [
                'label'         =>  'cargo::view.mission_prefix',
                'translatable'  =>  false,
                'type'          =>  'string',
                'value'         =>  Self::getVal('mission_prefix') ? Self::getVal('mission_prefix') : 'MI',
                'required'      =>  true
            ],
            'mission_code_count'     =>   [
                'label'         =>  'cargo::view.mission_number_of_digits_in_the_tracking',
                'translatable'  =>  false,
                'type'          =>  'number',
                'value'         =>  Self::getVal('mission_code_count') ? Self::getVal('mission_code_count') : '7',
                'required'      =>  true,
                'validation'    =>  'required|numeric|min:1'
            ],
            'def_shipment_type'     =>   [
                'label'         => 'cargo::view.default_shipment_type',
                'label_radio_1' => 'cargo::view.Pickup_For_door_to_door_delivery',
                'label_radio_2' => 'cargo::view.drop_off_For_delivery_package_from_branch_directly',
                'translatable'  =>  false,
                'type'          =>  'radio',
                'value_radio_1' =>  '1',
                'value_radio_2' =>  '2',
                'value_radio_3' =>  '3',

                'checked_radio_1' => Self::getVal('def_shipment_type')=='1' ? 'checked' : ' ',
                'checked_radio_2' => Self::getVal('def_shipment_type')=='2' ? 'checked' : ' ',
                'checked_radio_3' => Self::getVal('def_shipment_type')=='3' ? 'checked' : ' ',

                'required'      =>  true,
            ],
            'def_shipment_code_type'     =>   [
                'label'         => 'cargo::view.default_shipment_code_number_type',
                'label_radio_1' => 'cargo::view.sequential',
                'label_radio_2' => 'cargo::view.random_recommended_for_security',
                'translatable'  =>  false,
                'type'          =>  'radio',
                'value_radio_1' =>  'sequential',
                'value_radio_2' =>  'random',
                'checked_radio_1' => Self::getVal('def_shipment_code_type')=='sequential' ? 'checked' : ' ',
                'checked_radio_2' => Self::getVal('def_shipment_code_type')=='random' ? 'checked' : ' ',
                'required'      =>  true,
            ],
            'def_shipment_conf_type'     =>   [
                'label'         => 'cargo::view.receiving_mission_confirmation_type',
                'label_radio_1' => 'cargo::view.customer_signature',
                'label_radio_2' => 'cargo::view.without_confirmation',
                'translatable'  =>  false,
                'type'          =>  'radio',
                'value_radio_1' =>  'seg',
                'value_radio_2' =>  'none',
                'checked_radio_1' => Self::getVal('def_shipment_conf_type')=='seg' ? 'checked' : ' ',
                'checked_radio_2' => Self::getVal('def_shipment_conf_type')=='none' ? 'checked' : ' ',
                'required'      =>  true,
                'active_radio_3' => $otp_activation,
                'label_radio_3' => 'cargo::view.otp',
                'value_radio_3' =>  'otp',
                'checked_radio_3' => Self::getVal('def_shipment_conf_type')=='otp' ? 'checked' : ' ',
            ],
            'def_package_type'     =>   [
                'label'         =>  'cargo::view.default_package_type',
                'translatable'  =>  false,
                'type'          =>  'select',
                'options'       =>  $packages_array,
                'value'         =>  Self::getVal('def_package_type') ? Self::getVal('def_package_type') : '',
                'required'      =>  true
            ],
            'def_branch'     =>   [
                'label'         =>  'cargo::view.default_branch',
                'translatable'  =>  false,
                'type'          =>  'select',
                'options'       =>  $branches_array,
                'value'         =>  Self::getVal('def_branch') ? Self::getVal('def_branch') : '',
                'required'      =>  true
            ],
            'def_payment_type'     =>   [
                'label'         =>  'cargo::view.default_payment_type',
                'translatable'  =>  false,
                'type'          =>  'select',
                'options'       =>  array(
                                        '1' =>  __('cargo::view.postpaid'),
                                        '2' =>  __('cargo::view.prepaid'),
                                    ),
                'value'         =>  Self::getVal('def_payment_type'),
                'required'      =>  true
            ],
            'def_payment_method'     =>   [
                'label'         =>  'cargo::view.default_payment_method',
                'translatable'  =>  false,
                'type'          =>  'select',
                'options'       =>  $payments_array,
                'value'         =>  Self::getVal('def_payment_method') ? Self::getVal('def_payment_method') : '',
                'required'      =>  true
            ],
        ];

        return $fields;
    }
}
