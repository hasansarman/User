<?php

namespace Modules\User\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\User\Contracts\Authentication;

class UpdateProfileRequest extends FormRequest
{
    public function rules()
    {
        $userId = app(Authentication::class)->id();

        return [
            'EMAIL' => "required",
            'FIRST_NAME' => 'required',
            'LAST_NAME' => 'required',
            'PASSWORD' => 'confirmed',
            'PASSWORD_CONFIRMATION' => 'same:PASSWORD',
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
