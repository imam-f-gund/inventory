<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'first_name' => 'required',
            'last_name' => 'required',
            'username' => request()->method() == 'POST' ? 'required|unique:users' : 'required',
            'email' => request()->method() == 'POST' ? 'required|unique:users' : 'required',
            'role_id' => 'required',
            'password' => request()->method() == 'POST' ? 'required' : 'nullable',
        ];
    }
}
