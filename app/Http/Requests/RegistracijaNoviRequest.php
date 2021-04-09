<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegistracijaNoviRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'username' => 'required|min:3|max:15|unique:korisnik,username',
            'password' => 'required|min:3|max:20',
            'email' => 'required|email'
            //'email' => 'required|regex:/[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}/'
        ];
    }
}
