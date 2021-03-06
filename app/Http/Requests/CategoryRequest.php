<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
        $rules = [
            'code' => 'required|min:3|max:25|unique:categories,code',
            'name' => 'required|min:3|max:25',
            'description' => 'required|min:5',
//            'category_id' => 'required',
        ];

        if ($this->route()->named('categories.update')){
            $rules['code'] .= ',' .$this->route()->parameter('category')->id        ;
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'required' => 'Pole :attribute obizatelno dlya vvoda',
            'min' => 'Pole :attribute doljno imet minimum :min simvolov',
        ];
    }
}
