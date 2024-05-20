<?php

namespace App\Filament\Widgets;

use App\Models\Timses;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class AStatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Target', Timses::query()->sum('target')),
            Stat::make('Tim Sukses', Timses::query()->count()),
            Stat::make('Total Anggaran', Timses::query()->sum('budget')),
        ];
    }
}
