<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClubDocument extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function scopeForm($query, $club) {
        return $query->where('type', 'Form')->where('club_id', $club)->orderBy('created_at', 'desc');
    }

    public function scopeDocument($query, $club) {
        return $query->where('type', 'Document')->where('club_id', $club)->orderBy('created_at', 'desc');
    }
}
