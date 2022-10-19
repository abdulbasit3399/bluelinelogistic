<?php

namespace Modules\Users\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $email_validation = 'required|max:50|email|unique:users,email';
        $password_validation = 'string|min:6|max:16';
        if ($this->method() == 'PUT') {
            $email_validation .= (',' . $this->route('id') . ',id');
            $password_validation = 'nullable|' . $password_validation;
        } else {
            $password_validation = 'required|' . $password_validation;
        }
        return [
            'name' => 'required|string|min:3|max:50',
            'email' => $email_validation,
            'password' => $password_validation,
            'role'  => 'nullable|in:' . implode(',', array_keys(config('cms.user_roles'))),
            'avatar' => 'nullable|image|max:10000'
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
