<?php

namespace App\Filament\Resources\TrackResource\Pages;

use App\Filament\Resources\TrackResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageTracks extends ManageRecords
{
    protected static string $resource = TrackResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
