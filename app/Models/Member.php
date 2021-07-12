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

    public function scopeActive($query) {
        return $query->where('active', 1);
    }

    public function scopeActiveMembers($query, $id)
    {
        return $query->where('club_id', $id)->where('active', 1)->orderBy('last_name', 'asc');
    }

    public function scopeJoinedBetween($query, $start_date, $end_date, $club)
    {
        return $query->whereBetween('join_date', [$start_date, $end_date])->where('club_id', $club)->orderBy('last_name', 'asc');
    }

    public function latestMembership()
    {
        return $this->hasMany('App\Models\Membership')->latest('join_date')->first();
    }

    public function selectedMembership($type)
    {
        return $this->hasMany('App\Models\Membership')->where('membership', $type)->latest();
    }

    public function latestGrade()
    {
        return $this->hasMany('App\Models\Grade')->latest('grade_date')->first();
    }
}
