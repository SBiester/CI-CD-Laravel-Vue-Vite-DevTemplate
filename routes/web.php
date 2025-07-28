<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InfoController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\MicrosoftGraphController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\GraphController;




Route::get('/', function () {
    return view('app');
});

Route::get('/dashboard', function () {
    return view('app');
});


Route::get('/user/manager', [App\Http\Controllers\MicrosoftGraphController::class, 'showManager']);
Route::get('/user/reporters', [App\Http\Controllers\MicrosoftGraphController::class, 'showReportees']);

// Route, um die OAuth-Anfrage zu starten
Route::get('login/azure', [LoginController::class, 'redirectToProvider']);

// Route, um die Antwort von Azure AD zu handhaben
Route::get('login/azure/callback', [LoginController::class, 'handleProviderCallback']);

Route::get('/users/all', [MicrosoftGraphController::class, 'getAllUsers']);


