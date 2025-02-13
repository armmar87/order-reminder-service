<?php

namespace App\Http\Requests;

use App\Enums\OrderType;
use App\Enums\ReminderIntervalType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class UpdateIntervalsRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'intervals' => 'required|array',
            'intervals.*.type' => 'required|in:'.ReminderIntervalType::PRE->value.','.ReminderIntervalType::POST->value,
            'intervals.*.days' => 'required|integer'
        ];
    }
}
