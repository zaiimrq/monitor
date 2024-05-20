<?php

namespace App\Filament\Resources\ReportResource\Pages;

use App\Filament\Resources\IssueResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewIssue extends ViewRecord
{
    protected static string $resource = IssueResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
