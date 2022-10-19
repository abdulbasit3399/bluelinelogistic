<?php

namespace Modules\Blog\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentCreateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $req_auth = auth()->check() ? 'nullable' : 'required';
        $validations = [
            'post_id'           => 'required|integer|exists:posts,id',
            'parent_id'         => 'nullable|integer|exists:comments,id',
            'content'           => 'required|string|max:65000',
            'author_name'       => $req_auth . '|string|max:100',
            'author_email'      => $req_auth . '|email|max:100',
            'author_website'    => 'nullable|url|max:200',
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
