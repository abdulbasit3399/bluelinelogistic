<?php

namespace Modules\Cargo\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShipmentRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'Shipment.type'            => 'required',
            'Shipment.branch_id'       => 'required', 
            'Shipment.shipping_date'   => 'nullable',
            'Shipment.collection_time' => 'nullable', 
            'Shipment.client_id'       => 'required',
            'Shipment.client_phone'    => 'required|digits_between:8,20', 
            'Shipment.client_address'  => 'required',
            'Shipment.reciver_name'    => 'required|string|min:3|max:50', 
            'Shipment.reciver_phone'   => 'required|digits_between:8,20',
            'Shipment.reciver_address' => 'required|string|min:5', 
            'Shipment.from_country_id' => 'required',
            'Shipment.to_country_id'   => 'required', 
            'Shipment.from_state_id'   => 'required',
            'Shipment.to_state_id'     => 'required', 
            'Shipment.from_area_id'    => 'required',
            'Shipment.to_area_id'      => 'required', 
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
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
