<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Admin;

class AdminLoginRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function messages()
    {
        return [
            'email.exists'=>'Email does not exist',
        ];
    }
    public function rules()
    {
        return [
            'email' => 'email|required|exists:admins',
        ];
    }
}
