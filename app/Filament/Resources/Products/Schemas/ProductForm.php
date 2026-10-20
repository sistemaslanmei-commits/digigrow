<?php

namespace App\Filament\Resources\Products\Schemas;

use Illuminate\Http\UploadedFile;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
       return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nombre del Producto')
                    ->placeholder('Ejemplo: Servidor Dell PowerEdge R750')
                    ->required()
                    ->maxLength(255),

                TextInput::make('slug')
                    ->label('URL Amigable (Slug)')
                    ->placeholder('se-genera-automaticamente')
                    ->required()
                    ->maxLength(255)
                    ->unique(ignoreRecord: true)
                    ->validationMessages([
                        'unique' => 'Esta URL amigable ya pertenece a otro producto.',
                    ]),

                Select::make('category_id')
                    ->label('Categoría')
                    ->relationship('category', 'name')
                    ->required()
                    ->searchable()
                    ->preload(),

                Select::make('brand_id')
                    ->label('Marca (Opcional)')
                    ->relationship('brand', 'name')
                    ->nullable()
                    ->searchable()
                    ->preload(),

                TextInput::make('sku')
                    ->label('Código de Referencia (SKU)')
                    ->placeholder('Ejemplo: PROD-10293')
                    ->maxLength(255)
                    ->unique(ignoreRecord: true)
                    ->validationMessages([
                        'unique' => 'Este código SKU ya está registrado en otro producto.',
                    ]),

                Textarea::make('short_description')
                    ->label('Descripción Corta')
                    ->placeholder('Resumen del producto...')
                    ->rows(2)
                    ->columnSpanFull(),

                Textarea::make('description')
                    ->label('Descripción Extensa')
                    ->placeholder('Detalles completos del producto...')
                    ->rows(4)
                    ->columnSpanFull(),

                KeyValue::make('technical_specifications')
                    ->label('Especificaciones Técnicas')
                    ->keyLabel('Propiedad (Ej: Procesador, RAM)')
                    ->valueLabel('Valor (Ej: Intel Xeon 16 Cores, 64GB)')
                    ->columnSpanFull(),

                // TAREA 1: Imagen Principal y Galería Múltiple
                FileUpload::make('image')
                    ->label('Imagen Principal')
                    ->image()
                    ->disk('public')
                    ->directory('products/images')
                    ->getUploadedFileNameForStorageUsing(
                        fn (UploadedFile $file): string => 'PROD-' . time() . '-' . str()->random(5) . '.' . $file->getClientOriginalExtension()
                    )
                    ->columnSpanFull(),

                FileUpload::make('images')
                    ->label('Galería de Imágenes Adicionales')
                    ->image()
                    ->disk('public')
                    ->multiple()
                    ->reorderable()
                    ->directory('products/gallery')
                    ->getUploadedFileNameForStorageUsing(
                        fn (UploadedFile $file): string => 'GAL-PROD-' . time() . '-' . str()->random(5) . '.' . $file->getClientOriginalExtension()
                    )
                    ->columnSpanFull(),

                // TAREA 2: Gestión Avanzada de Ficha Técnica PDF
                FileUpload::make('datasheet')
                    ->label('Ficha Técnica (Documento PDF)')
                    ->acceptedFileTypes(['application/pdf'])
                    ->directory('products/datasheets')
                    ->openable()
                    ->downloadable()
                    ->maxSize(10240) // Límite de 10 MB
                    ->getUploadedFileNameForStorageUsing(
                        fn (UploadedFile $file): string => 'DOC-PROD-' . time() . '-' . str()->random(5) . '.' . $file->getClientOriginalExtension()
                    )
                    ->columnSpanFull(),

                TextInput::make('sort_order')
                    ->label('Orden de Presentación')
                    ->numeric()
                    ->default(0),

                Toggle::make('is_featured')
                    ->label('¿Producto Destacado?')
                    ->default(false),

                Toggle::make('is_active')
                    ->label('¿Producto Activo?')
                    ->default(true),
            ]);


    }
}
