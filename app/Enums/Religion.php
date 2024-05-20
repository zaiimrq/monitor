<?php

namespace App\Enums;
use Filament\Support\Contracts\HasLabel;

enum Religion: string implements HasLabel
{
    case Islam = 'Islam';
    case Kristen = 'Kristen';
    case Hindu = 'Hindu';
    case Budha = 'Budha';

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
