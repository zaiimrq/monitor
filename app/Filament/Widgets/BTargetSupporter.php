<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class BTargetSupporter extends ChartWidget
{
    protected static ?string $heading = 'Chart';

    protected function getData(): array
    {
        $supporter = DB::table('supporters')->count();
        $target = DB::table('timses')->sum('target');

        self::$heading = "Total dukungan $supporter/$target";

        return [
            'datasets' => [
                [
                    'label' => 'Dukungan Chart',
                    'data' => [$supporter, max($target - $supporter, 0)],
                    'backgroundColor' => [
                        'rgb(54, 162, 235)',
                        'rgb(255, 99, 132)',
                    ],
                ],
            ],
            'labels' => ['Target', 'Dukungan'],
        ];
    }

    protected function getType(): string
    {
        return 'pie';
    }
}
