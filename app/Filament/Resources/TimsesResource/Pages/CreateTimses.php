<?php

namespace App\Filament\Resources\TimsesResource\Pages;

use App\Filament\Resources\TimsesResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateTimses extends CreateRecord
{
    protected static string $resource = TimsesResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
