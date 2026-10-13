<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExpiryNotificationLog extends Model
{
    protected $guarded = [];

    protected $casts = [
        'expiry_date' => 'date',
        'sent_at' => 'datetime',
    ];

    public function club()
    {
        return $this->belongsTo(Club::class);
    }
}
