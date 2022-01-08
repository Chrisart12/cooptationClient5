<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CooptationRequest extends FormRequest
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
            'title' => 'string',
            'location' => 'string',
            'reference' => 'string',
            'jobId' => 'string',
            'jobUrl' => 'string',
            'firstname' => 'string',
            'lastname' => 'string',
            'email' => 'string',
            'id' => 'integer',
            'categorie_id' => 'integer',
        ];

    }
}
