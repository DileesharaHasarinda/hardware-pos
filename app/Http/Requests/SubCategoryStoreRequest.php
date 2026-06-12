<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SubCategoryStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->can('master-details.manage') ?? false;
    }

    public function rules(): array
    {
        return [
            'master_category_id' => ['required', 'exists:master_categories,id'],
            'name' => [
                'required',
                'string',
                'max:150',
                Rule::unique('sub_categories', 'name')->where(
                    fn ($query) => $query->where('master_category_id', $this->master_category_id)
                ),
            ],
            'code' => [
                'required',
                'string',
                'max:50',
                Rule::unique('sub_categories', 'code')->where(
                    fn ($query) => $query->where('master_category_id', $this->master_category_id)
                ),
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