<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VestiRequest extends FormRequest
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
            'naslov' => 'required',
            'tekst' => 'required|min:10',
            'slika' => 'file|mimes:jpg,jpeg,gif,png|max:2000',
            'alt' => 'required'
        ];
    }
}
