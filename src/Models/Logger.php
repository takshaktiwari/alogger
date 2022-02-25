<?php

namespace Takshak\Alogger\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Logger extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $casts = [
        'session'   =>  'collection',
        'request'   =>  'collection'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}
