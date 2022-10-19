<?php

namespace Modules\Localization\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LanguageRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $code_unique = '';
        if ($this->method() == 'PUT') {
            $code_unique = ',' . $this->route('id') . ',id';
        }
        $validations = [
            'name'              => 'required|string|max:50',
            'code'              => 'required|string|alpha_dash|max:6|unique:languages,code' . $code_unique,
            'dir'               => 'nullable|string|in:ltr,rtl',
            'script'            => 'nullable',
            'native'            => 'nullable',
            'regional'          => 'nullable',
        ];
        return $validations;
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
