<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IgraciInsertRequest extends FormRequest
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
            'ime' => 'required|min:3|max:12',
            'prezime' => 'required|min:3|max:15',
            'broj' => 'required|numeric|max:99',
            'pozicija' => 'required|min:3|max:30',
            'slika' => 'required|file|mimes:jpg,jpeg,gif,png|max:2000',
            'drzava' => 'required|min:3'
        ];
    }
}
