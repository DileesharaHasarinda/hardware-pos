<?php

namespace App\Http\Requests;

use App\Models\CustomerGroup;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CustomerGroupUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->can('master-details.manage') ?? false;
    }

    public function rules(): array
    {
        /** @var CustomerGroup $customerGroup */
        $customerGroup = $this->route('customer_group');

        return [
            'name' => [
                'required',
                'string',
                'max:150',
                Rule::unique('customer_groups', 'name')->ignore($customerGroup->id),
            ],
            'code' => [
                'required',
                'string',
                'max:50',
                Rule::unique('customer_groups', 'code')->ignore($customerGroup->id),
            ],
            'is_active' => ['nullable', 'boolean'],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'code' => strtoupper(trim((string) $this->code)),
            'is_active' => $this->boolean('is_active'),
        ]);
    }
}
