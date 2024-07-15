<?php

namespace App\Filament\Resources;

use App\Actions\GenerateCsv;
use App\Actions\GenerateInvoice;
use App\Filament\Resources\ParcelResource\Pages;
use App\Filament\Resources\ParcelResource\RelationManagers;
use App\Models\Parcel;
use Filament\Forms\Form;
use Filament\Infolists\Components;
use Filament\Infolists\Components\Fieldset;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Collection;

class ParcelResource extends Resource
{
    protected static ?string $model = Parcel::class;
    
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    
    protected static ?string $label = 'Посылки';
    protected static ?string $pluralLabel = 'Посылки';
    
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
                TextColumn::make('order_num')->label('номер заказа')->searchable(),
                TextColumn::make('track.number')->label('трек номер')->searchable(),
                TextColumn::make('delivery_type')->label('тип доставки'),
                TextColumn::make('sender.name')
                    ->label('Отправитель')
                    ->formatStateUsing(function ($state, Parcel $parcel) {
                        return $parcel->sender->name . ' ' . $parcel->sender->surname;
                    }),
//                TextColumn::make('recipient.name')
//                    ->label('Получатель')
//                    ->formatStateUsing(function ($state, Parcel $parcel) {
//                        return $parcel->recipient->name . ' ' . $parcel->recipient->surname;
//                    }),
                
                IconColumn::make('paid')
                    ->boolean()->label('оплачена'),
                TextColumn::make('enclosures')->label('Вложения')
                    ->formatStateUsing(function ($state, Parcel $parcel) {
                        return $parcel->enclosures()->count();
                    }),
//                ToggleColumn::make('sent')->label('Отправлена'),
                TextColumn::make('created_at')
                    ->date()->label('создан')
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make()->openUrlInNewTab(),
//                Tables\Actions\EditAction::make(),
                Action::make('generate_invoice')
                    ->action(function (Parcel $parcel, GenerateInvoice $generateInvoice) {
//                        dd($parcels);
                        return $generateInvoice($parcel);
                    }),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\BulkAction::make('export_csv')
                        ->action(function (Collection $parcels, GenerateCsv $generateCsv) {
//                        dd($parcels);
                            return $generateCsv($parcels);
                        }),
                ]),
            ]);
    }
    
    public static function getRelations(): array
    {
        return [
            RelationManagers\EnclosuresRelationManager::class,
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListParcels::route('/'),
//            'create' => Pages\CreateParcel::route('/create'),
            'view' => Pages\ViewParcel::route('/{record}'),
//            'edit' => Pages\EditParcel::route('/{record}/edit'),
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
                                            TextEntry::make('sender.name')->label('Имя')->weight('bold'),
                                            TextEntry::make('sender.surname')->label('Фамилия')->weight('bold'),
                                        ])->label('Отправитель'),
                                
                                ]),
                            Components\Grid::make(2)
                                ->schema([
                                    Fieldset::make('sender')
                                        ->schema([
                                            TextEntry::make('recipient.name')->label('Имя')->weight('bold'),
                                            TextEntry::make('recipient.surname')->label('Фамилия')->weight('bold'),
                                        ])->label('Получатель'),
                                
                                ]),
                        
                        ])->from('lg'),
                    ]),
                Components\Section::make()
                    ->schema([
                        Components\Split::make([
                            Components\Grid::make(2)
                                ->schema([
                                    TextEntry::make('delivery_type')->label('Тип доставки'),
                                ]),
                            Components\Grid::make(2)
                                ->schema([
                                    TextEntry::make('delivery_cost')->label('Стоимость доставки'),
                                ]),
                            Components\Grid::make(2)
                                ->schema([
                                    IconEntry::make('custom_delivery')->label('Забрать курьером')
                                        ->boolean()
                                ]),
                            Components\Grid::make(2)
                                ->schema([
                                    TextEntry::make('track')->label('Трек номер')
                                    
                                ]),
                        
                        ])->from('lg'),
                    ]),
                Components\Section::make()
                    ->columns([
                        'sm' => 3,
                    ])
                    ->schema([
                        Fieldset::make('sender')
                            ->schema([
                                TextEntry::make('sender.city')->label('Город'),
                                TextEntry::make('sender.address')->label('Адрес'),
                                TextEntry::make('sender.postal_code')->label('Почтовый индекс'),
                                TextEntry::make('sender.email')->label('E-mail'),
                            ])->label('Адрес отправителя'),
                    ]),
                Components\Section::make()
                    ->columns([
                        'sm' => 3,
                    ])
                    ->schema([
                        Fieldset::make('recipient')
                            ->schema([
                                TextEntry::make('address.full_address')->label('Полный адрес'),
                                TextEntry::make('address.postal_code')->label('Почтовый индекс'),
                                TextEntry::make('address.admin_area')->label('Административный окуг'),
                                TextEntry::make('address.region')->label('Регион'),
                                TextEntry::make('address.city')->label('Город'),
                                TextEntry::make('address.street')->label('Улица'),
                                TextEntry::make('address.house')->label('Дом'),
                                TextEntry::make('address.building')->label('Строение'),
                                TextEntry::make('address.apartment')->label('Квартира'),
                                TextEntry::make('address.comment')->label('Комментарий'),
                            ])->label('Адрес получателя'),
                    ])
            ]);
    }
    
    public static function canCreate(): bool
    {
        return false;
    }
}
