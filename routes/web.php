<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClubController;

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

Route::get('/', function () {
    return view('welcome');
});
Auth::routes();

Route::get('/home', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/clubs', [ClubController::class, 'index'])->name('clubs');
Route::get('/add-club', [ClubController::class, 'create'])->name('club.add');

