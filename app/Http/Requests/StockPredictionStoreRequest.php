<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StockPredictionStoreRequest extends FormRequest
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
            'ticker_symbol' => 'required|string|unique:stock_predictions|max:5',
            'company_name' => 'required|string|max:255',
            'confidence' => 'required|numeric',
            'predictions' => 'required|array'
        ];
    }
}
