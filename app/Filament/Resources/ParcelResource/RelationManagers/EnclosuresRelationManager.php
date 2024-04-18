<?php

namespace App\Filament\Resources\ParcelResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EnclosuresRelationManager extends RelationManager
{
    protected static string $relationship = 'enclosures';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('description')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('description')
            ->columns([
                Tables\Columns\TextColumn::make('index')->state(
                    static function (Tables\Contracts\HasTable $livewire, \stdClass $rowLoop): string {
                        return (string) (
                            $rowLoop->iteration +
                            ($livewire->getTableRecordsPerPage() * (
                                    $livewire->getTablePage() - 1
                                ))
                        );
                    }
                ),
                Tables\Columns\TextColumn::make('description')->label('описание'),
                Tables\Columns\TextColumn::make('quantity')->label('кол-во'),
                Tables\Columns\TextColumn::make('weight_kg')->label('вес кг'),
                Tables\Columns\TextColumn::make('weight_g')->label('вес г'),
                Tables\Columns\TextColumn::make('value')->label('ценность'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
//                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
//                Tables\Actions\EditAction::make(),
//                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
//                Tables\Actions\BulkActionGroup::make([
//                    Tables\Actions\DeleteBulkAction::make(),
//                ]),
            ])
            ->defaultSort('description')
            ->paginated(false);
        
    }


}
