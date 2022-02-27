<?php

namespace Takshak\Alogger\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\MassPrunable;

class Logger extends Model
{
    use HasFactory, MassPrunable;

    protected $guarded = [];
    protected $casts = [
        'session'   =>  'array',
        'request'   =>  'array',
        'data'      =>  'array',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function prunable()
    {
        return static::where(
            'created_at',
            '<=',
            now()->subDays(config('alogger.max_days', 60))
        );
    }
}
