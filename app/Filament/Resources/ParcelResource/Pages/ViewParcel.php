<?php

namespace App\Filament\Resources\ParcelResource\Pages;

use App\Filament\Resources\ParcelResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewParcel extends ViewRecord
{
    protected static string $resource = ParcelResource::class;

    protected function getHeaderActions(): array
    {
        return [
        
        ];
    }
}
