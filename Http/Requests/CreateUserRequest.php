<?php

namespace Modules\User\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
{
    public function rules()
    {
        return [
            'FIRST_NAME' => 'required',
            'LAST_NAME' => 'required',
            'EMAIL' => 'required|unique:users|email',
            'PASSWORD' => 'required|min:3',
            'PASSWORD_CONFIRMATION' => 'min:3|same:PASSWORD',
        ];
    }

    public function authorize()
    {
        return true;
    }

    public function messages()
    {
        return [];
    }
}
