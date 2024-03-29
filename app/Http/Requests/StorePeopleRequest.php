<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StorePeopleRequest extends FormRequest
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
            'name' => 'required|min:3|max:30',
            'age' => 'required|numeric|max:99',
            'city' => 'required|min:3|max:30',
        ];
    }

    /**
     * Failed validation response
     * 
     * @return json 
     */
    protected function failedValidation(Validator $validator)
    {
        $data = array(
            'status' => false,
            'message' => 'Invalid Request',
            'errors' => $validator->errors()
        );

        throw new HttpResponseException(response()->json($data, 422));
    }
}
