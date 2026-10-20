<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

#[Fillable([
    'category_id',
    'brand_id',
    'name',
    'slug',
    'sku',
    'short_description',
    'description',
    'technical_specifications',
    'image',
    'images',
    'datasheet',
    'is_featured',
    'is_active',
    'sort_order',
])]
class Product extends Model
{
    /**
     * Define la conversión automática de tipos de datos.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'technical_specifications' => 'array',
            'images' => 'array',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
        ];
    }

    /**
     * Eventos del ciclo de vida de Eloquent para gestión de archivos físicos.
     */
    protected static function booted(): void
    {
        // 1. EVENTO UPDATING: Borra los archivos anteriores del servidor cuando se actualizan o reemplazan
        static::updating(function ($product) {
            // Limpieza de la Ficha Técnica PDF
            if ($product->isDirty('datasheet') && $product->getOriginal('datasheet')) {
                Storage::disk('public')->delete($product->getOriginal('datasheet'));
            }

            // Limpieza de la Imagen Principal
            if ($product->isDirty('image') && $product->getOriginal('image')) {
                Storage::disk('public')->delete($product->getOriginal('image'));
            }

            // Limpieza de fotos descartadas en la Galería Múltiple
            if ($product->isDirty('images')) {
                $oldImages = $product->getOriginal('images') ?? [];
                $newImages = $product->images ?? [];

                $removedImages = array_diff($oldImages, $newImages);
                foreach ($removedImages as $removedImage) {
                    Storage::disk('public')->delete($removedImage);
                }
            }
        });

        // 2. EVENTO DELETING: Borra todos los archivos asociados cuando el registro se elimina completamente de MySQL
        static::deleting(function ($product) {
            // Borrar Ficha Técnica PDF
            if ($product->datasheet) {
                Storage::disk('public')->delete($product->datasheet);
            }

            // Borrar Imagen Principal
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }

            // Borrar imágenes de la Galería
            if (!empty($product->images) && is_array($product->images)) {
                foreach ($product->images as $galleryImage) {
                    Storage::disk('public')->delete($galleryImage);
                }
            }
        });
    }

    /**
     * Relación: Un producto pertenece a una Categoría.
     *
     * @return BelongsTo<Category, $this>
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Relación: Un producto pertenece opcionalmente a una Marca.
     *
     * @return BelongsTo<Brand, $this>
     */
    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }
}