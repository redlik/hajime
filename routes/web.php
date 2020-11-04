<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClubController;
use App\Http\Controllers\PersonnelController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\MembershipController;
use App\Http\Controllers\GradeController;

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

Route::get('/home', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('clubs', ClubController::class);

Route::resource('personnel', PersonnelController::class);
Route::resource('member', MemberController::class);
Route::resource('membership', MembershipController::class);
Route::resource('grade', GradeController::class);
Route::get('member/create/{club_id?}', [MemberController::class, 'create'])->name('member.createWithClub');
Route::get('personnel/delete/{id}', [PersonnelController::class, 'destroy'])->name('personnel.delete');
Route::get('club/{id}/add-personnel', [PersonnelController::class, 'addPersonnel'])->name('club.addPersonnel');

