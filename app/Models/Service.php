<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

#[Fillable([
    'name',
    'slug',
    'description',
    'image',
    'is_active',
    'sort_order',
])]
class Service extends Model
{
    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    protected static function booted(): void
    {
        static::updating(function ($service) {
            if ($service->isDirty('image') && $service->getOriginal('image')) {
                Storage::disk('public')->delete($service->getOriginal('image'));
            }
        });

        static::deleting(function ($service) {
            if ($service->image) {
                Storage::disk('public')->delete($service->image);
            }
        });
    }
}