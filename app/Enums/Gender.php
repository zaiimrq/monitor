<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum Gender: string implements HasLabel
{
    case L = 'L';
    case P = 'P';

    public function getLabel(): ?string
    {
        return match ($this) {
            Gender::L => 'Laki-laki',
            Gender::P => 'Perempuan'
        };
    }
}
