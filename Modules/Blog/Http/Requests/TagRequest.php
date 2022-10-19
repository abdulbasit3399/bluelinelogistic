<?php

namespace Modules\Blog\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TagRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $validations = [
            'name'              => 'required|string|max:25',
            'slug'              => 'required|string|alpha_dash|max:25',
            'description'       => 'nullable|string|max:150',
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
