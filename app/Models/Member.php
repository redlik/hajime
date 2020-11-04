<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Member extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function club() {
        return $this->belongsTo('App\Models\Club');
    }

    public function membership() {
        return $this->hasMany('App\Models\Membership');
    }

    public function grade() {
        return $this->hasMany('App\Models\Grade');
    }

    public function getAgeAttribute()
    {
        return Carbon::parse($this->attributes['dob'])->age;
    }
}
