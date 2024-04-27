<?php

namespace Modules\Store\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [

            'store_id'=>'required|integer|exists:stores,id',
            'quantity'=>'required|integer',
            'type'=>'required|in:increment,decrement',
            'description'=>'string',

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
