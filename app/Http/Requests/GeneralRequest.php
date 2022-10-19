<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class GeneralRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        $validations = [
            'site_active'   => 'nullable|in:0,1',
        ];

        $validations = collect($validations)->map(function ($item, $key) {
            $new_item = $item;
            if ($key == 'site_name.' . app()->getLocale()) {
                $new_item = 'required|' . $new_item;
            }
            return $new_item;
        })->toArray();

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

    public function attributes()
    {
        return [
            'site_name.en'           => __('blog::view.categories_table.en_name'),
            'site_name.ar'           => __('blog::view.categories_table.ar_name'),
        ];
    }


}
