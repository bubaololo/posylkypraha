<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TrackResource\Pages;
use App\Filament\Resources\TrackResource\RelationManagers;
use App\Models\Track;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;

use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TrackResource extends Resource
{
    protected static ?string $model = Track::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    
    protected static ?string $label = 'Трек номер';
    protected static ?string $pluralLabel = 'Трек номера';
    
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('number')->label('трек номер')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('number')->label('трек номер'),
                TextColumn::make('parcel.order_num')->label('заказ'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageTracks::route('/'),
        ];
    }
}
