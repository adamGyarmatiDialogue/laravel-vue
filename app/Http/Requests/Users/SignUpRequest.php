<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;

class SignUpRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "firstName" => ["required", "min:2", "max:255"],
            "lastName" => ["required", "min:2", "max:255"],
            "email" => ["required", "max:512", "email"],
            "username" => ["required", "min:2", "max:255"],
            "password" => ["required", "min:8", "max:100"],
            "reTypedPassword" => ["required", "min:8", "max:100"],
        ];
    }
}
