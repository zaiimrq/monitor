<?php

namespace App\Filament\Resources\SupporterResource\Pages;

use App\Filament\Resources\SupporterResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateSupporter extends CreateRecord
{
    protected static string $resource = SupporterResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['timses_id'] = $data['timses_id'] ?? request()->user()->timses?->id;
        return $data;
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
