<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venue extends Model
{
    protected $guarded = [];

    use HasFactory;

    public function club()
    {
        return $this->belongsTo(Club::class);
    }
}
