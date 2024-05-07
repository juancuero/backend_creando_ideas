<?php

namespace App\Http\Requests\V1\User;

use  App\Http\Requests\BaseFormRequest;

class UserCreateRequest extends BaseFormRequest
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
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'email' => 'required|string|email|max:255|unique:users',
            'username' => 'required|max:15|unique:users,username|alpha_num',
            'role_id' => 'required|exists:roles,id',
        ];
    }
}
