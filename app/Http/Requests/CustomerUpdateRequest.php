<?php

namespace App\Http\Requests;

use App\Models\Customer;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CustomerUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->can('customers.update') ?? false;
    }

    public function rules(): array
    {
        /** @var Customer $customer */
        $customer = $this->route('customer');

        return [
            'customer_group_id' => ['nullable', 'exists:customer_groups,id'],
            'code' => [
                'required',
                'string',
                'max:50',
                Rule::unique('customers', 'code')->ignore($customer->id),
            ],
            'name' => ['required', 'string', 'max:150'],
            'mobile' => ['nullable', 'string', 'max:30'],
            'address' => ['nullable', 'string'],
            'credit_limit' => ['nullable', 'numeric', 'min:0', 'max:999999999999.99'],
            'sales' => ['nullable', 'numeric', 'min:0', 'max:999999999999.99'],
            'sales_return' => ['nullable', 'numeric', 'min:0', 'max:999999999999.99'],
            'is_blocked' => ['nullable', 'boolean'],
            'remark' => ['nullable', 'string'],
            'is_active' => ['nullable', 'boolean'],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'code' => strtoupper(trim((string) $this->code)),
            'credit_limit' => $this->credit_limit === null || $this->credit_limit === '' ? 0 : $this->credit_limit,
            'sales' => $this->sales === null || $this->sales === '' ? 0 : $this->sales,
            'sales_return' => $this->sales_return === null || $this->sales_return === '' ? 0 : $this->sales_return,
            'is_blocked' => $this->boolean('is_blocked'),
            'is_active' => $this->boolean('is_active'),
        ]);
    }
}
