<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Supporter extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function timses(): BelongsTo
    {
        return $this->belongsTo(Timses::class);
    }

    protected static function booted()
    {
        self::deleted(function (Supporter $supporter) {
            Storage::disk('public')->delete($supporter?->image ?? false);
        });
    }
}
