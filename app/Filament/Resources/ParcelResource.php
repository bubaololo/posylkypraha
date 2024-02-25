<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ParcelResource\Pages;
use App\Filament\Resources\ParcelResource\RelationManagers;
use App\Models\Parcel;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists\Components\Fieldset;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Infolists;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components;

class ParcelResource extends Resource
{
    protected static ?string $model = Parcel::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('order_num'),
                TextColumn::make('sender_credential.name')
                    ->formatStateUsing(function ($state, Parcel $parcel) {
                        return $parcel->sender_credential->name . ' ' . $parcel->sender_credential->surname;
                    })
                    ->label('Отправитель'),
                TextColumn::make('recipient_credential.name')
                    ->formatStateUsing(function ($state, Parcel $parcel) {
                        return $parcel->recipient_credential->name . ' ' . $parcel->recipient_credential->surname;
                    })
                    ->label('Получатель'),
                IconColumn::make('paid')
                    ->boolean()->label('оплачена'),
                ToggleColumn::make('sent')->label('Отправлена'),
                TextColumn::make('created_at')
                    ->date()->label('создан')
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListParcels::route('/'),
            'create' => Pages\CreateParcel::route('/create'),
            'view' => Pages\ViewParcel::route('/{record}'),
            'edit' => Pages\EditParcel::route('/{record}/edit'),
        ];
    }
    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Components\Section::make()
                    ->schema([
                        Components\Split::make([
                            Components\Grid::make(2)
                                ->schema([
                                    Fieldset::make('sender')
                                        ->schema([
                                            Components\TextEntry::make('name'),
                                            Components\TextEntry::make('surname'),
                                        ]),

                                ]),

                        ])->from('lg'),
                    ]),

                Components\Section::make()
                    ->schema([
                        Components\RepeatableEntry::make('enclosures')
                            ->schema([
                                Components\TextEntry::make('description'),
                                Components\TextEntry::make('weight_kg'),
                                Components\TextEntry::make('weight_g'),
                                Components\TextEntry::make('quantity')
                                
                            ])
                            
                    ]),
            ]);
    }
}
