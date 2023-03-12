<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    use hasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'club_id',
        'password',
        'status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function club_document() {
        return $this->hasMany(ClubDocument::class);
    }

    public function member_document() {
        return $this->hasMany(MemberDocument::class);
    }

    public function club_note() {
        return $this->hasMany(Clubnote::class);
    }

    public function member_note() {
        return $this->hasMany(Membernote::class);
    }

    public function club_manager()
    {
        return $this->belongsTo(Club::class, 'club_id');
    }
}
