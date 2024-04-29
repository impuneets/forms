<?php

use App\Http\Controllers\AthleteController;
use App\Http\Controllers\RegistrationController;
use App\Http\Middleware\LoginCheck;
use App\Models\Athlete;
use Illuminate\Support\Facades\Route;
use GuzzleHttp\Psr7\Request;

Route::get('/register', [RegistrationController::class, 'index'])->middleware(LoginCheck::class);
Route::post('/register', [RegistrationController::class, 'register']);
Route::group(['prefix' => '/athletes'], function () {
    Route::get('/', [RegistrationController::class, 'athletes'])->middleware(LoginCheck::class);
    Route::get('/edit/{id}', [RegistrationController::class, 'edit'])->name('athlete.edit')->middleware(LoginCheck::class);
    Route::post('/update/{id}', [RegistrationController::class, 'update'])->name('athlete.update')->middleware(LoginCheck::class);
    Route::get('/status/{id}', [RegistrationController::class, 'status'])->name('athlete.status')->middleware(LoginCheck::class);
});
Route::get('/login', [RegistrationController::class, 'login']);
Route::post('/login', [RegistrationController::class, 'signin']);
Route::get('signup', [RegistrationController::class, 'signup']);
Route::post('signup', [RegistrationController::class, 'createUser']);
Route::get('/logout', [RegistrationController::class, 'logout']);
