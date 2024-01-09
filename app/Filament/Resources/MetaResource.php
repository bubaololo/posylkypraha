<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MetaResource\Pages;
use App\Filament\Resources\MetaResource\RelationManagers;
use App\Models\Meta;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MetaResource extends Resource
{
    protected static ?string $model = Meta::class;
    
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->maxLength(255),
                Forms\Components\TextInput::make('comment')
                    ->maxLength(255),
                Forms\Components\Textarea::make('content')
                    ->rows(20)
                    ->required(),
            ]);
    }
    
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('comment')->limit(50),
                Tables\Columns\TextColumn::make('content')->limit(50),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime('M j, Y H:i'),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime('M j, Y H:i')->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
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
            'index' => Pages\ListMetas::route('/'),
            'create' => Pages\CreateMeta::route('/create'),
            'edit' => Pages\EditMeta::route('/{record}/edit'),
        ];
    }
}
