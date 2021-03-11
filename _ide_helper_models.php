<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\Club
 *
 * @property int $id
 * @property string $name
 * @property string $address1
 * @property string|null $address2
 * @property string $city
 * @property string $county
 * @property string|null $eircode
 * @property string $province
 * @property string $type
 * @property string|null $phone
 * @property string|null $email
 * @property string|null $website
 * @property string|null $facebook
 * @property int $compliant
 * @property int $voting_rights
 * @property string|null $postal
 * @property string|null $correspondence
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Member[] $member
 * @property-read int|null $member_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Personnel[] $personnel
 * @property-read int|null $personnel_count
 * @method static \Illuminate\Database\Eloquent\Builder|Club newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Club newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Club query()
 * @method static \Illuminate\Database\Eloquent\Builder|Club whereAddress1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Club whereAddress2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Club whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Club whereCompliant($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Club whereCorrespondence($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Club whereCounty($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Club whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Club whereEircode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Club whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Club whereFacebook($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Club whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Club whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Club wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Club wherePostal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Club whereProvince($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Club whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Club whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Club whereVotingRights($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Club whereWebsite($value)
 */
	class Club extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ClubDocument
 *
 * @property int $id
 * @property string $title
 * @property string $link
 * @property string|null $type
 * @property int $club_id
 * @property int|null $author
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User|null $hasAuthor
 * @method static \Illuminate\Database\Eloquent\Builder|ClubDocument document($club)
 * @method static \Illuminate\Database\Eloquent\Builder|ClubDocument form($club)
 * @method static \Illuminate\Database\Eloquent\Builder|ClubDocument newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClubDocument newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClubDocument query()
 * @method static \Illuminate\Database\Eloquent\Builder|ClubDocument whereAuthor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClubDocument whereClubId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClubDocument whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClubDocument whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClubDocument whereLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClubDocument whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClubDocument whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ClubDocument whereUpdatedAt($value)
 */
	class ClubDocument extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Clubnote
 *
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property string $body
 * @property int $club_id
 * @property int|null $author
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User|null $hasAuthor
 * @method static \Illuminate\Database\Eloquent\Builder|Clubnote newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Clubnote newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Clubnote query()
 * @method static \Illuminate\Database\Eloquent\Builder|Clubnote whereAuthor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Clubnote whereBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Clubnote whereClubId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Clubnote whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Clubnote whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Clubnote whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Clubnote whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Clubnote whereUpdatedAt($value)
 */
	class Clubnote extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Coach
 *
 * @property int $id
 * @property string $name
 * @property string|null $phone
 * @property string|null $email
 * @property string $vetting_completion
 * @property string $vetting_expiry
 * @property string $safeguarding_completion
 * @property string $safeguarding_expiry
 * @property string|null $first_aid_completion
 * @property string|null $first_aid_expiry
 * @property string|null $coaching_qualification
 * @property string|null $coaching_date
 * @property int $club_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Coach newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Coach newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Coach query()
 * @method static \Illuminate\Database\Eloquent\Builder|Coach whereClubId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coach whereCoachingDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coach whereCoachingQualification($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coach whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coach whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coach whereFirstAidCompletion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coach whereFirstAidExpiry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coach whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coach whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coach wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coach whereSafeguardingCompletion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coach whereSafeguardingExpiry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coach whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coach whereVettingCompletion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coach whereVettingExpiry($value)
 */
	class Coach extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\GradForm
 *
 * @property int $id
 * @property string $title
 * @property string $link
 * @property int $club_id
 * @property int|null $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User|null $author
 * @method static \Illuminate\Database\Eloquent\Builder|GradForm newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|GradForm newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|GradForm query()
 * @method static \Illuminate\Database\Eloquent\Builder|GradForm whereClubId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GradForm whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GradForm whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GradForm whereLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GradForm whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GradForm whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GradForm whereUserId($value)
 */
	class GradForm extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Grade
 *
 * @property int $id
 * @property string $grade_level
 * @property string|null $grade_date
 * @property string|null $grade_points
 * @property int $member_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Grade newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Grade newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Grade query()
 * @method static \Illuminate\Database\Eloquent\Builder|Grade whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Grade whereGradeDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Grade whereGradeLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Grade whereGradePoints($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Grade whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Grade whereMemberId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Grade whereUpdatedAt($value)
 */
	class Grade extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Member
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string $number
 * @property string $address1
 * @property string|null $address2
 * @property string $city
 * @property string|null $county
 * @property string|null $eircode
 * @property string|null $province
 * @property string $dob
 * @property string $gender
 * @property string|null $parent
 * @property string|null $phone
 * @property string|null $mobile
 * @property string|null $email
 * @property int $adaptive
 * @property string|null $special
 * @property int $active
 * @property int|null $club_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Club|null $club
 * @property-read mixed $age
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Grade[] $grade
 * @property-read int|null $grade_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Membership[] $membership
 * @property-read int|null $membership_count
 * @method static \Illuminate\Database\Eloquent\Builder|Member active()
 * @method static \Illuminate\Database\Eloquent\Builder|Member newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Member newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Member query()
 * @method static \Illuminate\Database\Eloquent\Builder|Member whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Member whereAdaptive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Member whereAddress1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Member whereAddress2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Member whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Member whereClubId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Member whereCounty($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Member whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Member whereDob($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Member whereEircode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Member whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Member whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Member whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Member whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Member whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Member whereMobile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Member whereNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Member whereParent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Member wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Member whereProvince($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Member whereSpecial($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Member whereUpdatedAt($value)
 */
	class Member extends \Eloquent {}
}

namespace App\Models{
/**
 * MemberDocument
 *
 * @property int $id
 * @property string $title
 * @property string $link
 * @property string|null $type
 * @property int $member_id
 * @property int|null $author
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User|null $hasAuthor
 * @method static \Illuminate\Database\Eloquent\Builder|MemberDocument document($club)
 * @method static \Illuminate\Database\Eloquent\Builder|MemberDocument form($club)
 * @method static \Illuminate\Database\Eloquent\Builder|MemberDocument newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MemberDocument newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MemberDocument query()
 * @method static \Illuminate\Database\Eloquent\Builder|MemberDocument whereAuthor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MemberDocument whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MemberDocument whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MemberDocument whereLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MemberDocument whereMemberId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MemberDocument whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MemberDocument whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MemberDocument whereUpdatedAt($value)
 */
	class MemberDocument extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Membernote
 *
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property string $body
 * @property int $member_id
 * @property int|null $author
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User|null $hasAuthor
 * @method static \Illuminate\Database\Eloquent\Builder|Membernote newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Membernote newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Membernote query()
 * @method static \Illuminate\Database\Eloquent\Builder|Membernote whereAuthor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Membernote whereBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Membernote whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Membernote whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Membernote whereMemberId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Membernote whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Membernote whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Membernote whereUpdatedAt($value)
 */
	class Membernote extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Membership
 *
 * @property int $id
 * @property string $membership_type
 * @property string $join_date
 * @property string $expiry_date
 * @property int $member_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Member $member
 * @method static \Illuminate\Database\Eloquent\Builder|Membership newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Membership newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Membership query()
 * @method static \Illuminate\Database\Eloquent\Builder|Membership whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Membership whereExpiryDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Membership whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Membership whereJoinDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Membership whereMemberId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Membership whereMembershipType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Membership whereUpdatedAt($value)
 */
	class Membership extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Personnel
 *
 * @property int $id
 * @property string $name
 * @property string $role
 * @property string|null $phone
 * @property string|null $email
 * @property string|null $vetting_completion
 * @property string|null $vetting_expiry
 * @property string|null $safeguarding_completion
 * @property string|null $safeguarding_expiry
 * @property string|null $first_aid_completion
 * @property string|null $first_aid_expiry
 * @property string|null $coaching_qualification
 * @property string|null $coaching_date
 * @property int $club_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Club $club
 * @method static \Illuminate\Database\Eloquent\Builder|Personnel childrenofficer()
 * @method static \Illuminate\Database\Eloquent\Builder|Personnel coach()
 * @method static \Illuminate\Database\Eloquent\Builder|Personnel designatedofficer()
 * @method static \Illuminate\Database\Eloquent\Builder|Personnel headcoach()
 * @method static \Illuminate\Database\Eloquent\Builder|Personnel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Personnel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Personnel query()
 * @method static \Illuminate\Database\Eloquent\Builder|Personnel secretary()
 * @method static \Illuminate\Database\Eloquent\Builder|Personnel volunteer()
 * @method static \Illuminate\Database\Eloquent\Builder|Personnel whereClubId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Personnel whereCoachingDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Personnel whereCoachingQualification($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Personnel whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Personnel whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Personnel whereFirstAidCompletion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Personnel whereFirstAidExpiry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Personnel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Personnel whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Personnel wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Personnel whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Personnel whereSafeguardingCompletion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Personnel whereSafeguardingExpiry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Personnel whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Personnel whereVettingCompletion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Personnel whereVettingExpiry($value)
 */
	class Personnel extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ClubDocument[] $club_document
 * @property-read int|null $club_document_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Clubnote[] $club_note
 * @property-read int|null $club_note_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\MemberDocument[] $member_document
 * @property-read int|null $member_document_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Membernote[] $member_note
 * @property-read int|null $member_note_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Venue
 *
 * @property int $id
 * @property string $name
 * @property string $address1
 * @property string|null $address2
 * @property string $city
 * @property string $county
 * @property string|null $eircode
 * @property string|null $phone
 * @property string|null $contact
 * @property int $club_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Venue newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Venue newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Venue query()
 * @method static \Illuminate\Database\Eloquent\Builder|Venue whereAddress1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Venue whereAddress2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Venue whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Venue whereClubId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Venue whereContact($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Venue whereCounty($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Venue whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Venue whereEircode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Venue whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Venue whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Venue wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Venue whereUpdatedAt($value)
 */
	class Venue extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Volunteer
 *
 * @property int $id
 * @property string $name
 * @property string|null $phone
 * @property string|null $email
 * @property string|null $vetting_completion
 * @property string|null $vetting_expiry
 * @property string|null $safeguarding_completion
 * @property string|null $safeguarding_expiry
 * @property int $club_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Volunteer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Volunteer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Volunteer query()
 * @method static \Illuminate\Database\Eloquent\Builder|Volunteer whereClubId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Volunteer whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Volunteer whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Volunteer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Volunteer whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Volunteer wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Volunteer whereSafeguardingCompletion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Volunteer whereSafeguardingExpiry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Volunteer whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Volunteer whereVettingCompletion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Volunteer whereVettingExpiry($value)
 */
	class Volunteer extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\memberrole
 *
 * @method static \Illuminate\Database\Eloquent\Builder|memberrole newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|memberrole newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|memberrole query()
 */
	class memberrole extends \Eloquent {}
}

