<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class storeUser extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'email' => 'required|email|unique:users',
            'username' => 'required|string|max:50',
            'password' => 'required|confirmed|min:8',
        ];
    }

    public function messages() : array
    {
        return [
            'email.required' => 'email is required!',
            'username.required' => 'name is required!',
            'password.required' => 'password is required!',
        ];
    }
}
