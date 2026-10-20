<?php

namespace App\Filament\Resources\Brands\Schemas;

use Illuminate\Http\UploadedFile;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class BrandForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nombre de la Marca')
                    ->placeholder('Ejemplo: Sony, Samsung...')
                    ->required()
                    ->maxLength(255),

                TextInput::make('slug')
                    ->label('URL Amigable (Slug)')
                    ->placeholder('se-genera-automaticamente')
                    ->required()
                    ->maxLength(255)
                    ->unique(ignoreRecord: true)
                    ->validationMessages([
                        'unique' => 'Esta URL amigable ya está registrada en otra marca. Por favor, ingresa una diferente.',
                    ]),

                Textarea::make('description')
                    ->label('Descripción')
                    ->placeholder('Breve descripción de la marca...')
                    ->rows(3)
                    ->columnSpanFull(),

                FileUpload::make('logo')
                    ->label('Logotipo de la Marca')
                    ->image()
                    ->disk('public')         // <-- Obligatorio para leer desde storage/app/public/
                    ->visibility('public')   // <-- Otorga permisos de lectura
                    ->directory('brands')
                    ->openable()
                    ->downloadable()
                    ->getUploadedFileNameForStorageUsing(
                        fn (UploadedFile $file): string => 'BRAND-' . time() . '-' . str()->random(5) . '.' . $file->getClientOriginalExtension()
                    )
                    ->columnSpanFull(),

                Toggle::make('is_active')
                    ->label('¿Marca Activa?')
                    ->default(true),
            ]);
    }
}
