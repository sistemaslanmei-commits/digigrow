<?php

namespace App\Filament\Resources\Categories\Schemas;

use Illuminate\Http\UploadedFile;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class CategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nombre de la Categoría')
                    ->placeholder('Ejemplo: Servidores, Redes, Laptops...')
                    ->required()
                    ->maxLength(255),

                TextInput::make('slug')
                    ->label('URL Amigable (Slug)')
                    ->placeholder('se-genera-automaticamente')
                    ->required()
                    ->maxLength(255)
                    ->unique(ignoreRecord: true)
                    ->validationMessages([
                        'unique' => 'Esta URL amigable ya pertenece a otra categoría.',
                    ]),

                Select::make('parent_id')
                    ->label('Categoría Padre (Opcional)')
                    ->relationship('parent', 'name')
                    ->placeholder('Seleccione si es una subcategoría')
                    ->nullable()
                    ->searchable(),

                Textarea::make('description')
                    ->label('Descripción')
                    ->placeholder('Breve descripción de la categoría...')
                    ->rows(3)
                    ->columnSpanFull(),

                FileUpload::make('image')
                    ->label('Imagen Representativa')
                    ->image()
                    ->disk('public')
                    ->directory('categories')
                    ->getUploadedFileNameForStorageUsing(
                        fn (UploadedFile $file): string => 'CAT-' . time() . '-' . str()->random(5) . '.' . $file->getClientOriginalExtension()
                    )
                ->columnSpanFull(),

                TextInput::make('sort_order')
                    ->label('Orden de Presentación')
                    ->numeric()
                    ->default(0),

                Toggle::make('is_active')
                    ->label('¿Categoría Activa?')
                    ->default(true),
            ]);
    }
}
