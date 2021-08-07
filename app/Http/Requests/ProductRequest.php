<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        return [
            'title'=>'required| max:190',
            'category_id'=>'required',
            'description'=>'required| max:4000',
            'short_description'=> 'required| max:8000',
            'variants'=>'required',

            'variants.*.price' => 'required',
            'variants.*.quantity' =>'required',

        ];
    }
}
