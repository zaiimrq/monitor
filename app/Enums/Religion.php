<?php

namespace App\Enums;
use Filament\Support\Contracts\HasLabel;

enum Religion: string implements HasLabel
{
    case Islam = 'islam';
    case Kristen = 'kristen';
    case Hindu = 'hindu';
    case Budha = 'budha';

    public function getLabel(): string|null
    {
        return match ($this) {
            Religion::Islam => 'Islam',
            Religion::Kristen => 'Kristen',
            Religion::Hindu => 'Hindu',
            Religion::Budha => 'Budha'
        };
    }
}
