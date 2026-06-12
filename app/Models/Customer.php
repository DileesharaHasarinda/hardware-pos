<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'customer_group_id',
        'code',
        'name',
        'mobile',
        'address',
        'credit_limit',
        'sales',
        'sales_return',
        'is_blocked',
        'remark',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'credit_limit' => 'decimal:2',
            'sales' => 'decimal:2',
            'sales_return' => 'decimal:2',
            'is_blocked' => 'boolean',
            'is_active' => 'boolean',
        ];
    }

    public function customerGroup(): BelongsTo
    {
        return $this->belongsTo(CustomerGroup::class);
    }

    public function scopeSearch(Builder $query, ?string $term): Builder
    {
        $term = trim((string) $term);

        if ($term === '') {
            return $query;
        }

        return $query->where(function (Builder $builder) use ($term) {
            $builder
                ->where('code', 'ilike', "%{$term}%")
                ->orWhere('name', 'ilike', "%{$term}%")
                ->orWhere('mobile', 'ilike', "%{$term}%")
                ->orWhereHas('customerGroup', function (Builder $groupQuery) use ($term) {
                    $groupQuery->where('name', 'ilike', "%{$term}%")
                        ->orWhere('code', 'ilike', "%{$term}%");
                });
        });
    }
}
