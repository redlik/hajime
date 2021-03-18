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
}
