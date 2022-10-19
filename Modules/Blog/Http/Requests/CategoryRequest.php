<?php

namespace Modules\Blog\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class CategoryRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $name_validation = 'string|max:100';
        $description_validation = 'nullable|string|max:150';
        $translate_fields_validations = [
            'name.en'           => $name_validation,
            'name.ar'           => $name_validation,
            'description.en'    => $description_validation,
            'description.ar'    => $description_validation,
        ];

        if (request('translate-active') != 'true') {
            $translate_fields_validations = collect($translate_fields_validations)->filter(function ($item, $key) {
                return Str::endsWith($key, '.' . app()->getLocale());
            })->toArray();
        }

        $validations = [
            'slug'          => 'required|string|alpha_dash|max:100',
            'parent_id'     => 'nullable|integer|exists:categories,id',
            'active'        => 'nullable|in:0,1',
        ];

        $validations = array_merge($validations, $translate_fields_validations);
        $validations = collect($validations)->map(function ($item, $key) {
            $new_item = $item;
            if ($key == 'name.' . app()->getLocale()) {
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
            'name.en'           => __('blog::view.categories_table.en_name'),
            'name.ar'           => __('blog::view.categories_table.ar_name'),
            'description.en'    => __('blog::view.categories_table.en_description'),
            'description.ar'    => __('blog::view.categories_table.ar_description'),
        ];
    }


}
