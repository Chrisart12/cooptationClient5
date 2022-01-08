<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShowImageRequest extends FormRequest
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
            "userId" => "integer",
            // "image" => "mimes:JPG,JPEG,jpg,jpeg,bmp,png,PNG",
            "image" => "required|mimes:JPG,JPEG,jpg,jpeg,bmp,png,PNG|max:8000",
        ];
    }
}
