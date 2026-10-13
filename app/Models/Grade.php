<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function club()
    {
        return $this->belongsTo(Club::class, 'club_id');
    }

    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id');
    }
}
