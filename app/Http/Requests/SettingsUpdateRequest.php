<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingsUpdateRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            "color" => "sometimes|regex:/^#[a-f0-9]+$/i",
            "focus_time" => "sometimes|integer|digits_between:1,100",
            "long_break_time"=> "sometimes|integer|digits_between:1,100",
            "break_time" => "sometimes|integer|digits_between:1,100",
            "pomodoro_count" => "sometimes|integer|digits   _between:1,10",
        ];
    }
}
