<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Qualification extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function scopeReferee($query)
    {
        return $query->where('type', 'referee');
    }

    public function scopeTableOfficial($query)
    {
        return $query->where('type', 'table_official');
    }

    public function scopeCoach($query)
    {
        return $query->where('type', 'coach');
    }
}
