<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactFormRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'full_name' => ['required', 'string', 'max:100'],
            'company_name' => ['nullable', 'string', 'max:100'],
            'phone' => ['required', 'string', 'max:20'],
            'email' => ['required', 'email', 'max:100'],
            'state' => ['required', 'string', 'max:50'],
            'products_interest' => ['nullable', 'string', 'max:255'],
            'message' => ['required', 'string', 'min:10', 'max:2000'],
        ];
    }

    public function messages(): array
    {
        return [
            'full_name.required' => 'Please enter your full name.',
            'phone.required' => 'Please provide a phone number.',
            'email.required' => 'Please provide your email address.',
            'email.email' => 'Please enter a valid email address.',
            'state.required' => 'Please select your state.',
            'message.required' => 'Please enter your message.',
            'message.min' => 'Your message should be at least 10 characters.',
        ];
    }
}
