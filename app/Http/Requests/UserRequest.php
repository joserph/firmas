<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $user = $this->route()->parameters('user');
        //dd($user['user']);
        if($user)
        {
            return [
                'name'      => 'required',
                'email'     => 'required|email|unique:users,email,' . $user['user'],
                'password'  => 'same:password_confirmation',
                'roles'     => 'required'
            ];
        }else{
            return [
                'name'      => 'required',
                'email'     => 'required|email|unique:users,email',
                'password'  => 'required|same:password_confirmation',
                'roles'     => 'required'
            ];
        }
        
    }
}
