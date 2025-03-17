<?php

use App\Http\Controllers\ActivationCodesController;
use App\Http\Controllers\UserController;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Registration
Route::post('register-user', [UserController::class, 'registerAPIuser'])->name('register_api_user');

//Activation
Route::post('send-activation-code', [UserController::class, 'activateMobile'])->name('activate_mobile');
Route::post('activate-code', [ActivationCodesController::class, 'activateCode'])->name('activate_code');

//Refresh
Route::post('refresh', [UserController::class, 'refreshMobileApplication'])->name('refresh_token');
