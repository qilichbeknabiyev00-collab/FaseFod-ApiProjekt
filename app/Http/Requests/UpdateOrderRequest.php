<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOrderRequest extends FormRequest
{
 
    public function authorize(): bool
    {
        return false;
    }

    public function rules(): array
    {
        return [
           
            'user_id' => 'required|exists:dishes,id',
            'dish_id' => 'required|integer|min:1',  //bunga kiritamiz
            'quantity' => 'required|numeric',           //bunga kiritamiz
            'total_price' => 'required|numeric',            //bunga kiritamiz
            'estimated_time' => 'required',
            'status' =>'required'
        ];
    }
}
