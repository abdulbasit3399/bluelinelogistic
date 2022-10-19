<?php

namespace Modules\Cargo\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Cargo\Entities\ClientAddress;

class ClientAddressRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'address.*.country_id' => 'required',
            'address.*.state_id' => 'required',
            'address.*.area_id' => 'required',
        ];
    }


}
