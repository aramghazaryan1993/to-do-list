<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ToDoListRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {

        return [
            'title'        => 'required|min:2|max:50',
            'text' => 'required|string|min:5|max:1000',
            'image'       => 'required|mimes:jpeg,jpg,png,gif|max:10000',
            'tag_id.*'    => 'required|integer',
        ];
    }
}
