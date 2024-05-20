<?php

namespace App\Filament\Resources\TimsesResource\Pages;

use App\Filament\Resources\TimsesResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTimses extends ListRecords
{
    protected static string $resource = TimsesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
