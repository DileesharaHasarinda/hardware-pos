<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SupplierUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->can('suppliers.update') ?? false;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:150'],
            'mobile' => ['required', 'string', 'max:30'],
            'address' => ['nullable', 'string'],
            'contact_person' => ['nullable', 'string', 'max:150'],
            'contact_person_designation' => ['nullable', 'string', 'max:150'],
            'credit_limit' => ['nullable', 'numeric', 'min:0', 'max:999999999999.99'],
            'credit' => ['nullable', 'numeric', 'min:0', 'max:999999999999.99'],
            'remark' => ['nullable', 'string'],
            'is_active' => ['nullable', 'boolean'],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'credit_limit' => $this->credit_limit === null || $this->credit_limit === '' ? 0 : $this->credit_limit,
            'credit' => $this->credit === null || $this->credit === '' ? 0 : $this->credit,
            'is_active' => $this->boolean('is_active'),
        ]);
    }
}