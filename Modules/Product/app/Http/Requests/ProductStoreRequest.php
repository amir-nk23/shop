<?php

namespace Modules\Product\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Modules\Core\App\Helpers\Helpers;

class ProductStoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {

        return [
            'image'=>'mimes:jpeg,jpg,png,gif|required|max:10000',
            'title'=>'required|max:191|string|unique',
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

        if ($this->input('discount_type')=='percent' && $this->input('percent')>100){

            throw Helpers::makeValidationException('هنگامی که نوع تخفیف درصد است مقدار تخفیف نباید بیشتر از صد باشد');

        }

    }
}
