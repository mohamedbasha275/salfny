<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OfferRequest extends FormRequest
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
            'name' =>'required|min:3|max:20',
            'category_id' =>'required',
            'description' => 'required|min:10',
            'image' => 'image',
            'place' => 'required|min:3',
        ];
    }
    // attributes
    public function attributes()
    {
        return [
            'name' =>' الإسم ',
            'category_id' =>' القسم',
            'description' => ' الوصف',
            'image' => ' الصورة',
            'place' => ' المكان',
        ];
    }
}
