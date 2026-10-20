<?php

namespace App\Filament\Resources\Categories\Tables;

use App\Models\Category;
use Filament\Notifications\Notification;
use Filament\Actions\DeleteAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class CategoriesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')
                    ->label('Imagen')
                    ->disk('public'),

                TextColumn::make('name')
                    ->label('Nombre')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('parent.name')
                    ->label('Categoría Padre')
                    ->default('Principal')
                    ->searchable(),

                TextColumn::make('slug')
                    ->label('URL (Slug)')
                    ->searchable(),

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
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make()
                    ->before(function (DeleteAction $action, Category $record) {
                        // Comprobar si la categoría tiene productos o subcategorías asociadas
                        if ($record->products()->exists() || $record->children()->exists()) {
                            Notification::make()
                                ->danger()
                                ->title('No se puede eliminar la categoría')
                                ->body('Esta categoría tiene productos o subcategorías asociadas. Reasigna o elimina sus registros dependientes antes de borrarla.')
                                ->persistent()
                                ->send();

                            // Cancela la eliminación limpia sin ejecutar la consulta SQL
                            $action->cancel();
                        }
                    }),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
