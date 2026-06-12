<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Supplier extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'mobile',
        'address',
        'contact_person',
        'contact_person_designation',
        'credit_limit',
        'credit',
        'remark',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'credit_limit' => 'decimal:2',
            'credit' => 'decimal:2',
            'is_active' => 'boolean',
        ];
    }

    public function scopeSearch(Builder $query, ?string $term): Builder
    {
        $term = trim((string) $term);

        if ($term === '') {
            return $query;
        }

        return $query->where(function (Builder $builder) use ($term) {
            $builder
                ->where('name', 'ilike', "%{$term}%")
                ->orWhere('mobile', 'ilike', "%{$term}%")
                ->orWhere('contact_person', 'ilike', "%{$term}%")
                ->orWhere('contact_person_designation', 'ilike', "%{$term}%");
        });
    }
}