<?php

namespace App\Enums;
use Filament\Support\Contracts\HasLabel;

enum Role: string implements HasLabel
{
    case Admin = 'admin';
    case Timses = 'team-sukses';

    public function getLabel(): string|null
    {
        return match ($this) {
            Role::Admin => 'Admin',
            Role::Timses => 'Timses'
        };
    }
}
