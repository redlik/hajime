<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Club extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'address1', 'address2', 'town', 'county', 'eircode', 'province', 'type', 'phone', 'email', 'website', 'facebook', 'compliant', 'voting_rights'];

    public function personnel()
    {
        return $this->hasMany('App\Models\Personnel');
    }
}
