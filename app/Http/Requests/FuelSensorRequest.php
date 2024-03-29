<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class FuelSensorRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'fuel_amount' => 'required|integer|min:0|max:100',
            'vehicle_id' => 'required|exists:vehicles,id'
        ];
    }

    public function messages(): array
    {
        return [
            'vehicle_id.exists' => __('messages.vehicle_not_found'),
        ];
    }
}
