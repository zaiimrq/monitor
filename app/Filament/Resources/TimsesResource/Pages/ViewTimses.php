<?php

namespace App\Filament\Resources\TimsesResource\Pages;

use App\Filament\Resources\TimsesResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewTimses extends ViewRecord
{
    protected static string $resource = TimsesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
