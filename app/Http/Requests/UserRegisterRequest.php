<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Enums\Roles;
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
                'first_name' => 'required',
                'last_name' =>'required',
                'email' =>'required|email|unique:users',
                'phone'=>'required|unique:users',
                'password' => 'min:6|required|confirmed',
                'country_id'=>'nullable',
                'state_id'=>'nullable',
                'community_id'=>'nullable',
                "role" => "required|in:".implode(",",Roles::getKeys()),
        ];
    }

    //Custom Messaages for the Validation Errors
    public function messages(){

        return [
            'first_name.required' => 'Please type-in your first name, it is mandatory',
            'last_name.required' =>'Please type-in your last name, it is mandatory',
            'email.required'=>'Please type-in your email, it is mandatory',
            'email.unique'=>'This email has been registred by another user',
            'phone.required'=> 'Please type in your phone number, it is mandatory',
            'phone.unique'=>'This phone number has been registered by another user',
            'password.required'=> 'Please type-in your password, it is mandatory',
            'password.min'=>'Your password must not be less than 6 letters',
            'role'=>'User role is required',
            'role.in'=>'User Role does not exist'
        ];
    }
}
