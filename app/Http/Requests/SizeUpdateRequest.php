<?php

namespace App\Http\Requests;

use App\Models\Size;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SizeUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->can('master-details.manage') ?? false;
    }

    public function rules(): array
    {
        /** @var Size $size */
        $size = $this->route('size');

        return [
            'name' => [
                'required',
                'string',
                'max:100',
                Rule::unique('sizes', 'name')->ignore($size->id),
            ],
            'is_default' => ['nullable', 'boolean'],
            'is_active' => ['nullable', 'boolean'],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'is_default' => $this->boolean('is_default'),
            'is_active' => $this->boolean('is_active'),
        ]);
    }
}