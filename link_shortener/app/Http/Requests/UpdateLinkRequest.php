<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLinkRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'url' => ['bail', 'required', 'url', 'string', 'max:250'],
            'slug' => ['bail', 'nullable', 'string', 'min:6', 'max:8', 'unique:links,slug,'.$this->link->id],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'url.url' => 'A Full URL with http:// or https:// is required',
        ];
    }
}
