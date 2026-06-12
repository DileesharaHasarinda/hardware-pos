<?php

namespace App\Http\Requests;

use App\Models\MasterCategory;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MasterCategoryUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->can('master-details.manage') ?? false;
    }

    public function rules(): array
    {
        /** @var MasterCategory $masterCategory */
        $masterCategory = $this->route('master_category');

        return [
            'name' => [
                'required',
                'string',
                'max:150',
                Rule::unique('master_categories', 'name')->ignore($masterCategory->id),
            ],
            'code' => [
                'required',
                'string',
                'max:50',
                Rule::unique('master_categories', 'code')->ignore($masterCategory->id),
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