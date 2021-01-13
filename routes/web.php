<?php

use App\Http\Controllers\ClubDocumentController;
use App\Http\Controllers\CoachController;
use App\Http\Controllers\MemberDocumentController;
use App\Http\Controllers\MembernoteController;
use App\Http\Controllers\VolunteerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClubController;
use App\Http\Controllers\PersonnelController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\MembershipController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\ClubnoteController;
use App\Http\Controllers\VenueController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function() {
    return view('home');
});

//Auth::routes(['register' => false]);
Auth::routes();

Route::get('/home', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('clubs', ClubController::class);

Route::resource('personnel', PersonnelController::class);
Route::resource('member', MemberController::class);
Route::resource('coach', CoachController::class);
Route::resource('membership', MembershipController::class);
Route::resource('grade', GradeController::class);
Route::resource('clubnote', ClubnoteController::class);
Route::resource('membernote', MembernoteController::class);
Route::resource('volunteer', VolunteerController::class);
Route::resource('venue', VenueController::class);
Route::resource('clubdoc', ClubDocumentController::class);
Route::resource('memberdoc', MemberDocumentController::class);
Route::get('clubnote/create/{club}', [ClubnoteController::class, 'createWithClub'])->name('clubnote.create.club');
Route::get('membernote/create/{club}', [MembernoteController::class, 'createWithmember'])->name('membernote.create.member');
Route::get('venue/create/{club}', [VenueController::class, 'createWithClub'])->name('venue.create.club');
Route::get('coach/add/{club}', [CoachController::class, 'addCoach'])->name('coach.addCoach');
Route::get('club/check-membership/{club}', [ClubController::class, 'checkMemberships'])->name('club.checkMemberships');


Route::get('member/create/{club_id?}', [MemberController::class, 'create'])->name('member.createWithClub');
Route::post('member/duplicate/', [MemberController::class, 'duplicate'])->name('member.duplicate');
Route::get('personnel/delete/{id}', [PersonnelController::class, 'destroy'])->name('personnel.delete');
Route::get('club/{id}/add-personnel/{role}', [PersonnelController::class, 'addPersonnel'])->name('club.addPersonnel');
Route::get('club/{id}/add-volunteer', [VolunteerController::class, 'addVolunteer'])->name('volunteer.addVolunteer');

