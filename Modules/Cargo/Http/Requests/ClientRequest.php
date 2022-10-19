<?php

namespace Modules\Cargo\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Cargo\Entities\Client;

class ClientRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $email_validation = 'required|max:50|email|unique:users,email';
        $password_validation = 'string|min:6';
        if ($this->method() == 'PUT') {
            $user_id = Client::where('id',$this->route('client'))->pluck('user_id')->first();
            $email_validation .= (',' . $user_id . 'id');
            $password_validation = 'nullable|' . $password_validation;
        } else {
            $password_validation = 'required|' . $password_validation;
        }
        return [
            'name' => 'required|string|min:3|max:50',
            'email' => $email_validation,
            'password' => $password_validation,
            // 'responsible_mobile' => 'required|digits_between:8,20',
            // 'responsible_name' => 'required|string|min:3|max:50',
            // 'national_id'   => 'required',
            // 'branch_id' => 'required',
            // 'address' => 'required',
            'follow_up_name' => 'nullable',
            'follow_up_mobile' => 'nullable|digits_between:8,20',
            'how_know_us' => 'nullable',
            'pickup_cost' => 'nullable',
            'supply_cost' => 'nullable',
            'def_shipping_cost' => 'nullable',
            'def_tax' => 'nullable',
            'def_insurance' => 'nullable',
            'def_return_cost' => 'nullable',
            'def_shipping_cost_gram' => 'nullable',
            'def_tax_gram' => 'nullable',
            'def_insurance_gram' => 'nullable',
            'def_return_cost_gram' => 'nullable',
            'def_mile_cost' => 'nullable',
            'def_return_mile_cost' => 'nullable',
            'def_mile_cost_gram' => 'nullable',
            'def_return_mile_cost_gram' => 'nullable',
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