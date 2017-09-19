<?php namespace Modules\User\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RolesRequest extends FormRequest
{
    public function rules()
    {
        return [
            'NAME' => 'required',
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
