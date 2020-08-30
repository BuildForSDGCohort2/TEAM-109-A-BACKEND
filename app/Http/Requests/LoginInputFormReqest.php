<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Exceptions\RequestValidationException;

class LoginInputFormReqest extends FormRequest
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
            "email"=>"required|email|exists:users",
            "password"=>"required|min:6",
        ];
    }

    public function messages()
    {
        return [
            "email.exists"=>"Invalid account credentials provided",
            "email.email"=>"Invalid email provided",
            "email.required"=>"Email must be provided",
            "password.required"=>"Password must be provided",
            "password.min"=>"Password length must be atleast 6 character"
        ];
    }
    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        // throw new RequestValidationException($validator->errors()->first());
    }
}
