<?php

namespace App\Filament\Resources\Settings\Schemas;

use Filament\Forms\Components\FileUpload;
use Illuminate\Http\UploadedFile;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class SettingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('site_name')
                    ->label('Nombre del Sitio Web')
                    ->default('DigiGrow')
                    ->required()
                    ->maxLength(255),

                TextInput::make('phone')
                    ->label('Teléfono Principal')
                    ->placeholder('+51 999 999 999')
                    ->tel()
                    ->maxLength(255),

                TextInput::make('whatsapp')
                    ->label('Número de WhatsApp')
                    ->placeholder('+51 999 999 999')
                    ->tel()
                    ->maxLength(255),

                TextInput::make('email')
                    ->label('Correo Electrónico de Contacto')
                    ->placeholder('contacto@digigrow.com')
                    ->email()
                    ->maxLength(255),

                Textarea::make('address')
                    ->label('Dirección Física')
                    ->placeholder('Av. Principal 123, Lima, Perú')
                    ->rows(3)
                    ->columnSpanFull(),

                FileUpload::make('logo')
                    ->label('Logotipo Institucional')
                    ->image()
                    ->disk('public')
                    ->directory('settings')
                    ->getUploadedFileNameForStorageUsing(
                        fn (UploadedFile $file): string => 'LOGO-' . time() . '-' . str()->random(5) . '.' . $file->getClientOriginalExtension()
                    )
                    ->columnSpanFull(),
                
                // Banners de cada página
                FileUpload::make('home_banner')
                    ->label('Banner - Home')
                    ->image()
                    ->disk('public')
                    ->directory('settings')
                    ->visibility('public')
                    ->getUploadedFileNameForStorageUsing(
                        fn (UploadedFile $file): string => 'BANNER-HOME-' . time() . '-' . str()->random(5) . '.' . $file->getClientOriginalExtension()
                    ),

                FileUpload::make('about_banner')
                    ->label('Banner - Nosotros')
                    ->image()
                    ->disk('public')
                    ->directory('settings')
                    ->visibility('public')
                    ->getUploadedFileNameForStorageUsing(
                        fn (UploadedFile $file): string => 'BANNER-ABOUT-' . time() . '-' . str()->random(5) . '.' . $file->getClientOriginalExtension()
                    ),

                FileUpload::make('contact_banner')
                    ->label('Banner - Contacto')
                    ->image()
                    ->disk('public')
                    ->directory('settings')
                    ->visibility('public')
                    ->getUploadedFileNameForStorageUsing(
                        fn (UploadedFile $file): string => 'BANNER-CONTACT-' . time() . '-' . str()->random(5) . '.' . $file->getClientOriginalExtension()
                    ),

                FileUpload::make('catalogo_banner')
                    ->label('Banner - Catálogo de Productos')
                    ->image()
                    ->disk('public')
                    ->directory('settings')
                    ->visibility('public')
                    ->getUploadedFileNameForStorageUsing(
                        fn (UploadedFile $file): string => 'BANNER-CATALOGO-' . time() . '-' . str()->random(5) . '.' . $file->getClientOriginalExtension()
                    ),

                FileUpload::make('services_banner')
                    ->label('Banner - Servicios')
                    ->image()
                    ->disk('public')
                    ->directory('settings')
                    ->visibility('public')
                    ->getUploadedFileNameForStorageUsing(
                        fn (UploadedFile $file): string => 'BANNER-SERVICES-' . time() . '-' . str()->random(5) . '.' . $file->getClientOriginalExtension()
                    ),

                FileUpload::make('brands_banner')
                    ->label('Banner - Marcas')
                    ->image()
                    ->disk('public')
                    ->directory('settings')
                    ->visibility('public')
                    ->getUploadedFileNameForStorageUsing(
                        fn (UploadedFile $file): string => 'BANNER-BRANDS-' . time() . '-' . str()->random(5) . '.' . $file->getClientOriginalExtension()
                    ),


                TextInput::make('facebook_url')
                    ->label('Enlace de Facebook')
                    ->url()
                    ->placeholder('https://facebook.com/digigrow')
                    ->maxLength(255),

                TextInput::make('instagram_url')
                    ->label('Enlace de Instagram')
                    ->url()
                    ->placeholder('https://instagram.com/digigrow')
                    ->maxLength(255),

                TextInput::make('linkedin_url')
                    ->label('Enlace de LinkedIn')
                    ->url()
                    ->placeholder('https://linkedin.com/company/digigrow')
                    ->maxLength(255)
                    ->columnSpanFull(),
        ]);

    }
}
