<?php

namespace Modules\Product\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductStoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'image'=>'mimes:jpeg,jpg,png,gif|required|max:10000',
            'title'=>'required|max:20',
            'category_id'=>'required|exists:categories,id',
            'description'=>'required|text',
            'status'=>'required|boolean',
            'discount_type'=> 'in:percent,flat',
            'discount'=>'numeric'

        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
}
