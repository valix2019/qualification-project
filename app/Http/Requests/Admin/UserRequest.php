<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'is_active' => 'nullable|boolean',
            'name' => 'required|string|max:255',
            'email' => 'required|email:filter|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ];

        if ($user = $this->route('user')) {
            $rules['email'] = $rules['email'] . ',email,' . $user->getKey();
            $rules['password'] = 'nullable|min:6|confirmed';
        }

        return $rules;
    }
}
