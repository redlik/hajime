<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Club extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function personnel()
    {
        return $this->hasMany('App\Models\Personnel');
    }

    public function member() {
        return $this->hasMany('App\Models\Member');
    }

    public function activeMembersCount()
    {
        return $this->member->where('active', 1)->count();
    }

    public function getProvinceAttribute($value)
    {
        return ucwords($value);
    }

    public function manager()
    {
        return $this->hasMany(User::class);
    }

    public function venues()
    {
        return $this->hasMany(Venue::class);
    }

    public function volunteer()
    {
        return $this->hasMany(Volunteer::class);
    }

    public function coach()
    {
        return $this->hasMany(Coach::class);
    }
}
