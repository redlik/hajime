<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MobileToken extends Model
{
    use HasFactory;

    protected $fillable = [
        'token',
        'member_id',
        'expires_at',
    ];

    public function member()
    {
        return $this->belongsTo(Member::class);
    }
}
