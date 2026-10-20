<?php

namespace App\Filament\Resources\Services\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Illuminate\Http\UploadedFile;

class ServiceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nombre del Servicio')
                    ->placeholder('Ejemplo: Mantenimiento de Servidores')
                    ->required()
                    ->maxLength(255),

                TextInput::make('slug')
                    ->label('URL Amigable (Slug)')
                    ->placeholder('se-genera-automaticamente')
                    ->required()
                    ->maxLength(255)
                    ->unique(ignoreRecord: true)
                    ->validationMessages([
                        'unique' => 'Esta URL amigable ya pertenece a otro servicio.',
                    ]),

                Textarea::make('description')
                    ->label('Descripción del Servicio')
                    ->placeholder('Detalles de lo que incluye este servicio...')
                    ->rows(4)
                    ->columnSpanFull(),

                FileUpload::make('image')
                    ->label('Imagen Representativa')
                    ->image()
                    ->disk('public')
                    ->directory('services')
                    ->getUploadedFileNameForStorageUsing(
                        fn (UploadedFile $file): string => 'SERV-' . time() . '-' . str()->random(5) . '.' . $file->getClientOriginalExtension()
                    )
                    ->columnSpanFull(),

                TextInput::make('sort_order')
                    ->label('Orden de Presentación')
                    ->numeric()
                    ->default(0),

                Toggle::make('is_active')
                    ->label('¿Servicio Activo?')
                    ->default(true),
            ]);
    }
}
