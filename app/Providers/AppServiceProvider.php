<?php

namespace App\Providers;

use Filament\Forms\Components\FileUpload;
use Filament\Tables\Columns\ImageColumn;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Forzar a todos los campos de subida de imágenes de Filament a usar el disco 'public'
        FileUpload::configureUsing(function (FileUpload $fileUpload) {
            $fileUpload->disk('public')->visibility('public');
        });

        // Forzar a todas las columnas de imagen en tablas a leer del disco 'public'
        ImageColumn::configureUsing(function (ImageColumn $imageColumn) {
            $imageColumn->disk('public');
        });
    }
}
