<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

#[Fillable(['name', 'slug', 'description', 'logo', 'is_active'])]
class Brand extends Model
{

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    protected static function booted(): void
    {
        static::updating(function ($brand) {
            if ($brand->isDirty('logo') && $brand->getOriginal('logo')) {
                Storage::disk('public')->delete($brand->getOriginal('logo'));
            }
        });

        static::deleting(function ($brand) {
            if ($brand->logo) {
                Storage::disk('public')->delete($brand->logo);
            }
        });
    }

    /**
     * @return HasMany<Product, $this>
     */
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
