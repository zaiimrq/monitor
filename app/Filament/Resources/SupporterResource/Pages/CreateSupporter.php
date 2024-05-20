<?php

namespace App\Filament\Resources\SupporterResource\Pages;

use App\Filament\Resources\SupporterResource;
use App\Models\User;
use Filament\Resources\Pages\CreateRecord;

class CreateSupporter extends CreateRecord
{
    protected static string $resource = SupporterResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['timses_id'] = User::find($data['timses_id'] ?? false)?->timses->id
                                    ?? request()->user()?->timses->id;

        return $data;
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
