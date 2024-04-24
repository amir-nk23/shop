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
            'title'=>'required|max:191|string',
            'category_id'=>'required|exists:categories,id',
            'description'=>'required|string',
            'status'=>'required|in:available,unavailable,draft',
            'discount_type'=> 'in:percent,flat',
            'discount'=>'integer|nullable'
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    protected function passedValidation()
    {

    }
}
