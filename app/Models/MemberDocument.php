<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemberDocument extends Model
{
    use HasFactory;

    public function scopeForm($query, $club) {
        return $query->where('type', 'form')->where('club_id', $club)->orderBy('created_at', 'desc');
    }
}
