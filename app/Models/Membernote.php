<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Membernote extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function hasAuthor() {
        return $this->belongsTo(User::class, 'author');
    }

}
