<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

#[Fillable([
    'parent_id', 
    'name', 
    'slug', 
    'description', 
    'image', 
    'is_active', 
    'sort_order'])]
class Category extends Model
{
    
    protected function casts(): array
        {
            return [
                'is_active' => 'boolean',
            ];
        }

    protected static function booted(): void
    {
        // Al actualizar: borrar imagen anterior si cambió
        static::updating(function ($category) {
            if ($category->isDirty('image') && $category->getOriginal('image')) {
                Storage::disk('public')->delete($category->getOriginal('image'));
            }
        });

        // Al eliminar: borrar imagen del disco
        static::deleting(function ($category) {
            if ($category->image) {
                Storage::disk('public')->delete($category->image);
            }
        });
    }



/**
     * @return BelongsTo<Category, $this>
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    /**
     * @return HasMany<Category, $this>
     */
    public function children(): HasMany
    {
        return $this->hasMany(self::class, 'parent_id');
    }

    /**
     * @return HasMany<Product, $this>
     */
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
