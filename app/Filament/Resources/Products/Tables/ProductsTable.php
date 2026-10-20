<?php

namespace App\Filament\Resources\Products\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ProductsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')
                    ->label('Imagen')
                    ->disk('public'),

                TextColumn::make('name')
                    ->label('Nombre del Producto')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('category.name')
                    ->label('Categoría')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('brand.name')
                    ->label('Marca')
                    ->placeholder('Sin Marca')
                    ->searchable(),

                TextColumn::make('sku')
                    ->label('SKU')
                    ->searchable(),

                IconColumn::make('is_featured')
                    ->label('Destacado')
                    ->boolean(),

                IconColumn::make('is_active')
                    ->label('Estado')
                    ->boolean(),

                TextColumn::make('sort_order')
                    ->label('Orden')
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label('Fecha de Creación')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ]);
    }
}
