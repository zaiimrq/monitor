<?php

namespace App\Enums;
use Filament\Support\Contracts\HasLabel;

enum Gender: string implements HasLabel
{
    case L = 'laki';
    case P = 'perempuan';

    public function getLabel(): string|null
    {
        return match ($this) {
            Gender::L => 'Laki-laki',
            Gender::P => 'Perempuan'
        };
    }
}
