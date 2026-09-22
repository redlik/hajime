<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Member extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $guarded = [];

    /**
     * A member has at most one profile photo; adding a new one replaces
     * (and deletes) the previous file automatically.
     */
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('photo')
            ->singleFile()
            ->acceptsMimeTypes([
                'image/jpeg',
                'image/png',
                'image/webp',
                'image/heic',
                'image/heif',
            ]);
    }

    /**
     * Resize the uploaded photo to fit a 400x400 box and convert it to webp
     * for display, so browsers that can't render HEIC directly (or very
     * large originals) still get a fast, consistent image on the profile.
     */
    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('profile')
            ->fit(Fit::Contain, 400, 400)
            ->format('webp')
            ->nonQueued();
    }

    public function club() {
        return $this->belongsTo('App\Models\Club');
    }

    public function membership() {
        return $this->hasMany('App\Models\Membership');
    }

    public function grade() {
        return $this->hasMany('App\Models\Grade');
    }

    public function coach()
    {
        return $this->hasOne('App\Models\Coach');
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

    public function currentMembership()
    {
        return $this->hasOne('App\Models\Membership')->latestOfMany('join_date');
    }

    public function latestExpiryMembership()
    {
        return $this->hasOne('App\Models\Membership')->latestOfMany('expiry_date');
    }

    public function latestGrade()
    {
        return $this->hasMany('App\Models\Grade')->latest('grade_date')->first();
    }

    public function currentGrade()
    {
        return $this->hasOne('App\Models\Grade')->latestOfMany();
    }

    public static function deactivateExpiredMemberships(): int
    {
        $members = self::where('active', 1)
            ->with('latestExpiryMembership')
            ->get();

        $changed = 0;

        foreach ($members as $member) {
            $membership = $member->latestExpiryMembership;

            if ($membership && Carbon::now()->greaterThan($membership->expiry_date)) {
                $member->update(['active' => 0]);
                $changed++;
            }
        }

        return $changed;
    }
}
