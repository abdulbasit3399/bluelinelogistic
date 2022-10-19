<?php

namespace Modules\Cargo\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AreaRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $lang = \LaravelLocalization::getCurrentLocale();
        return [
            'country_id' => 'required',
            'state_id' => 'required',
            'name'         => 'required|array|max:100',
            'name.'.$lang  => 'required|string|max:100',
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
