<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRegisterRequest extends FormRequest
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
                'firstname' => 'required',
                'lastname' =>'required',
                'email' =>'required|email|unique:users',
                'gender' => 'required',
                'phone'=>'required|unique:users',
                'password' => 'min:6|required|confirmed',
        ];
    }

    //Custom Messaages for the Validation Errors
    public function messages(){

        return [
            'firstname.required' => 'Please type-in your first name, it is mandatory',
            'lastname.required' =>'Please type-in your last name, it is mandatory',
            'email.required'=>'Please type-in your email, it is mandatory',
            'email.unique'=>'This email has been registred by another user',
            'gender.required'=>'Please supply your gender, it is mandatory',
            'phone.required'=> 'Please type in your phone number, it is mandatory',
            'phone.unique'=>'This phone number has been registered by another user',
            'password.required'=> 'Please type-in your password, it is mandatory',
            'password.min'=>'Your password must not be less than 6 letters'
        ];
    }
}
