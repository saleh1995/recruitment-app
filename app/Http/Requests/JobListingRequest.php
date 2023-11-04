<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class JobListingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Gate::allows('employer');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required' ,'string', 'max:255'],
            'description' => ['required', 'string'],
            'location' => ['required', 'string', 'max:255'],
            'salary_from' => ['required', 'numeric', 'max:999999.99'],
            'salary_to' => ['required', 'numeric', 'max:999999.99'],
            'employemnt_type' => ['required', 'integer', 'min:1', 'max:2'],
            'status' => ['required', 'boolean'],
            'expires_at' => ['required', 'date', 'date_format:Y-m-d H:i:s', 'after:today'],
        ];
    }
}
