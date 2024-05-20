<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Report extends Model
{
    use HasFactory;

    protected $casts = [
        'images' => 'array'
    ];

    public function timses(): BelongsTo
    {
        return $this->belongsTo(Timses::class);
    }

    protected static function booted() 
    {
        self::deleted(function (Report $report) {
            Storage::disk('public')->delete($report?->images ?? false);
        });
    }
}
