<?php

namespace App\Filament\Widgets;

use App\Models\Supporter;
use App\Models\Timses;
use Illuminate\Support\Number;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class AStatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Target', Timses::query()->sum('target'))
                ->description('Target dukungan')
                ->color('danger'),

            Stat::make('Dukungan', Supporter::query()->count())
                    ->description('Total dukungan')
                    ->color('success'),
            Stat::make('Anggaran', 'Rp. ' . Number::format(
                    number: Timses::query()->sum('budget'),
                    locale: 'id',
                    precision: 0
                ))
                ->description('Total anggaran')
                ->color('warning'),
        ];
    }
}
