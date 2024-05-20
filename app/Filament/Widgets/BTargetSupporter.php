<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class BTargetSupporter extends ChartWidget
{
    protected static ?string $heading = 'Chart';

    protected function getData(): array
    {
        $target = DB::table('timses')->sum('target');
        $supporter = DB::table('supporters')->count();

        self::$heading = "Total dukungan $supporter/$target";

        dd($target - $supporter >= 0 ?: 0);

        return [
            'datasets' => [
                [
                    'label' => 'Dukungan Chart',
                    'data' => [$target, $supporter],
                    'backgroundColor' => [
                        'rgb(255, 99, 132)',
                        'rgb(54, 162, 235)',
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
