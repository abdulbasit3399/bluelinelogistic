<?php

namespace Modules\Pages\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PageRequest extends FormRequest
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
            'title'             => 'required|array|max:100',
            'title.'.$lang      => 'required|string|max:100',
            'slug'              => 'required|string|alpha_dash|max:100',
            'content'           => 'nullable|array|max:150000',
            'categories'        => 'nullable|array',
            'tags'              => 'nullable|array',
            'visibility'        => 'nullable|string|in:public,auth_user,private',
            'publish_on'        => 'nullable|date:Y-m-d H:i',
            'seo_title'         => 'nullable|array|max:100',
            'seo_description'   => 'nullable|array|max:150',
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
