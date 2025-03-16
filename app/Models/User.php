<?php

namespace App\Models;

use App\Mail\SendCode;
use Exception;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Mail;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use hasRoles;
    use TwoFactorAuthenticatable;

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
        'status',
        'email_request_status',
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

    public function generateCode()
    {
        $code = rand(100000, 999999);

        UserCode::updateOrCreate(
            [ 'user_id' => auth()->user()->id ],
            [ 'code' => $code ]
        );

        try {

            Mail::to(auth()->user()->email)->send(new SendCode($code));

        } catch (Exception $e) {
            info("Error: ". $e->getMessage());
        }
    }


}
