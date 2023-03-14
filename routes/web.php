<?php

use App\Exports\GradingListExport;
use App\Http\Controllers\ClubDocumentController;
use App\Http\Controllers\ClubViewController;
use App\Http\Controllers\CoachController;
use App\Http\Controllers\GradFormController;
use App\Http\Controllers\MemberDocumentController;
use App\Http\Controllers\MembernoteController;
use App\Http\Controllers\Reports\ActiveCoachReportController;
use App\Http\Controllers\Reports\ClubStatusReportController;
use App\Http\Controllers\Reports\ComplianceStatusReportController;
use App\Http\Controllers\Reports\EmailConsentReportController;
use App\Http\Controllers\Reports\GradingReportController;
use App\Http\Controllers\Reports\InvalidCoachReportController;
use App\Http\Controllers\Reports\InvalidPersonnelReportController;
use App\Http\Controllers\Reports\MembershipReportController;
use App\Http\Controllers\Reports\MembersReportController;
use App\Http\Controllers\UserController;
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

Auth::routes(['register' => false]);
//Auth::routes();

Route::get('/home', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth']], function () {
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
    Route::resource('gradform', GradFormController::class);
    Route::get('clubnote/create/{club}', [ClubnoteController::class, 'createWithClub'])->name('clubnote.create.club');
    Route::get('membernote/create/{club}', [MembernoteController::class, 'createWithmember'])->name('membernote.create.member');
    Route::get('venue/create/{club}', [VenueController::class, 'createWithClub'])->name('venue.create.club');
    Route::get('coach/add/{club}', [CoachController::class, 'addCoach'])->name('coach.addCoach');
    Route::get('club/check-membership/{club}', [ClubController::class, 'checkMemberships'])->name('club.checkMemberships');
    Route::post('member/duplicate/', [MemberController::class, 'duplicate'])->name('member.duplicate');
    Route::get('member/duplicate-existing/{member}', [MemberController::class, 'duplicateExisting'])->name('member.duplicate.existing');
    Route::get('member/create/{club_id?}', [MemberController::class, 'create'])->name('member.createWithClub');
    Route::get('personnel/delete/{id}', [PersonnelController::class, 'destroy'])->name('personnel.delete');
    Route::get('club/{id}/add-personnel/{role}', [PersonnelController::class, 'addPersonnel'])->name('club.addPersonnel');
    Route::get('club/{id}/add-volunteer', [VolunteerController::class, 'addVolunteer'])->name('volunteer.addVolunteer');
});

Route::group(['middleware' => ['auth'], 'prefix' => 'reports'], function () {
    Route::get('/membership-list', [MembershipReportController::class, 'index'])->name('report.membership');
    Route::post('/membership-list', [MembershipReportController::class, 'showMembers'])->name('report.membership.list');
    Route::get('/club-members', [MembersReportController::class, 'index'])->name('report.club-members');
    Route::post('/club-members', [MembersReportController::class, 'showMembers'])->name('report.club-members.list');
    Route::get('/clubs-status', [ClubStatusReportController::class, 'index'])->name('report.club.status');
    Route::get('/invalid-personnel', [InvalidPersonnelReportController::class, 'index'])->name('report.invalid.personnel');
    Route::get('/active-coaches', [ActiveCoachReportController::class, 'index'])->name('report.active.coaches');
    Route::get('/invalid-coaches', [InvalidCoachReportController::class, 'index'])->name('report.invalid.coaches');
    Route::get('/consent-list', [EmailConsentReportController::class, 'index'])->name('report.email.consent');
    Route::get('/grading-list', [GradingReportController::class, 'index'])->name('report.grading.list');
    Route::get('/compliance-status', [ComplianceStatusReportController::class, 'index'])->name('report.compliance-status');
    Route::get('/compliance-status/generate-pdf/{id}', [ComplianceStatusReportController::class, 'generatePdf'])->name('report.compliance-status.generate-pdf');
    Route::post('/grading-list', [GradingReportController::class, 'filteredResults']);
});

Route::group(['middleware' => ['auth'], 'prefix' => 'exports'], function () {
    Route::get('/memberships/{start}/{end}', [MembershipReportController::class, 'export'])->name('report.membership.export');
    Route::get('/members/{club}/{start}/{end}', [MembersReportController::class, 'export'])->name('report.members.export');
    Route::get('/clubs-status', [ClubStatusReportController::class, 'export'])->name('report.status.export');
    Route::get('/invalid-personnel', [InvalidPersonnelReportController::class, 'export'])->name('report.invalid.export');
    Route::get('/active-coaches', [ActiveCoachReportController::class, 'export'])->name('report.active.export');
    Route::get('/invalid-coaches', [InvalidCoachReportController::class, 'export'])->name('report.invalid.coach.export');
    Route::get('/consent-list', [EmailConsentReportController::class, 'export'])->name('report.consent.export');
    Route::get('/grading-list/{request?}', [GradingReportController::class, 'export'])->name('report.grading.export');
});

Route::group(['prefix' => 'club-access'], function() {
   Route::get('users', [ClubViewController::class, 'usersView'])->name('club.access.users');
   Route::post('activate', [UserController::class, 'activateAccount'])->name('user.activate-account');
   Route::post('deactivate', [UserController::class, 'deactivateUser'])->name('user.deactivate-user');
   Route::get('delete/{user}', [UserController::class, 'deleteUser'])->name('user.delete-user');
});

Route::get('register', [ClubViewController::class, 'register'])->name('club.access.register');
Route::post('create-account', [ClubViewController::class, 'createClubManager'])->name('club.access.create-user');
Route::get('club', [ClubViewController::class, 'clubShow'])->middleware(['auth'])->name('club.access.club');
