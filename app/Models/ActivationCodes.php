<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivationCodes extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'code',
        'licence',
        'expires_at',
    ];
}
