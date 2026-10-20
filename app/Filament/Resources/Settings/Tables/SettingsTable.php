<?php

namespace App\Filament\Resources\Settings\Tables;


use Filament\Tables\Columns\ImageColumn;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SettingsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('logo')
                    ->label('Logotipo')
                    ->disk('public'),

                TextColumn::make('site_name')
                    ->label('Nombre del Sitio')
                    ->searchable(),

                TextColumn::make('phone')
                    ->label('Teléfono'),

                TextColumn::make('email')
                    ->label('Correo Electrónico'),

                TextColumn::make('updated_at')
                    ->label('Última Actualización')
                    ->dateTime('d/m/Y H:i'),
            ])
            ->actions([
                EditAction::make(),
            ]);
    }
}
