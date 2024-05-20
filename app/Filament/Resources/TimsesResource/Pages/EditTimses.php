<?php

namespace App\Filament\Resources\TimsesResource\Pages;

use App\Filament\Resources\TimsesResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTimses extends EditRecord
{
    protected static string $resource = TimsesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): ?string
    {
        return $this->getResource()::getUrl('index');
    }
}
