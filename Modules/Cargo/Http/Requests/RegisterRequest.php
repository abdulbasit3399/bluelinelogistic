<?php

namespace Modules\Cargo\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Cargo\Entities\Client;

class RegisterRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|min:3|max:50',
            'email' => 'required|max:50|email|unique:users,email',
            'password' => 'required|string|min:6',
            'responsible_mobile' => 'required|digits_between:8,20',
            'responsible_name' => 'required|string|min:3|max:50',
            'national_id'   => 'required',
            'branch_id' => 'required',
            'terms_conditions' => 'required',
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