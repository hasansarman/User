<?php

namespace Modules\User\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    public function rules()
    {
        $userId = $this->route()->parameter('users');

        /*return [
            'EMAIL' => "required",
            'FIRST_NAME' => 'required',
            'LAST_NAME' => 'required',
            'PASSWORD' => 'confirmed',
        ];*/
        return [];
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
