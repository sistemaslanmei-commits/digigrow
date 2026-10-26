<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Store extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'tag',
        'address',
        'icon',
        'map_url',
        'button_text',
        'image',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    protected static function booted(): void
    {
        // Limpia la imagen física anterior en el disco si se sube una nueva
        static::updating(function ($store) {
            if ($store->isDirty('image') && $store->getOriginal('image')) {
                Storage::disk('public')->delete($store->getOriginal('image'));
            }
        });

        // Limpia la imagen física del disco si la tienda se elimina de la base de datos
        static::deleting(function ($store) {
            if ($store->image) {
                Storage::disk('public')->delete($store->image);
            }
        });
    }
}