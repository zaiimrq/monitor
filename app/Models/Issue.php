<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Issue extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    protected $casts = [
        'images' => 'array'
    ];

    public function timses(): BelongsTo
    {
        return $this->belongsTo(Timses::class);
    }

    protected static function booted() 
    {
        self::deleted(function (Issue $report) {
            Storage::disk('public')->delete($report?->images ?? false);
        });
    }
}
