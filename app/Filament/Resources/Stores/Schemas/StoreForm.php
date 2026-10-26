<?php

namespace App\Filament\Resources\Stores\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Illuminate\Http\UploadedFile;

class StoreForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nombre de la Tienda / Sede')
                    ->placeholder('Ej: Ate, San Borja, Tienda Virtual')
                    ->required()
                    ->maxLength(255),

                TextInput::make('tag')
                    ->label('Etiqueta Superior')
                    ->placeholder('Ej: Nuestra tienda, Atención online, Sede Principal')
                    ->default('Nuestra tienda')
                    ->maxLength(255),

                TextInput::make('address')
                    ->label('Dirección o Descripción Corta')
                    ->placeholder('Ej: Diego Fernández 279, C.C. Salamanca, Stand #27')
                    ->maxLength(255),

                TextInput::make('icon')
                    ->label('Clase de Icono (Bootstrap Icons)')
                    ->placeholder('Ej: bi-geo-alt-fill o bi-whatsapp')
                    ->default('bi-geo-alt-fill')
                    ->maxLength(255),

                TextInput::make('map_url')
                    ->label('Enlace de Google Maps o WhatsApp')
                    ->placeholder('Ej: https://maps.app.goo.gl/... o https://wa.me/...')
                    ->url()
                    ->maxLength(500),

                TextInput::make('button_text')
                    ->label('Texto del Botón')
                    ->placeholder('Ej: Cómo llegar o Escríbenos')
                    ->default('Cómo llegar')
                    ->maxLength(255),

                FileUpload::make('image')
                    ->label('Fotografía de la Tienda')
                    ->image()
                    ->disk('public')
                    ->visibility('public')
                    ->directory('stores')
                    ->getUploadedFileNameForStorageUsing(
                        fn (UploadedFile $file): string => 'STORE-' . time() . '-' . str()->random(5) . '.' . $file->getClientOriginalExtension()
                    )
                    ->columnSpanFull(),

                TextInput::make('sort_order')
                    ->label('Orden de Presentación')
                    ->numeric()
                    ->default(0),

                Toggle::make('is_active')
                    ->label('¿Tienda Activa?')
                    ->default(true),
            ]);
    }
}
