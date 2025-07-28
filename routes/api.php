<?php

use App\Http\Controllers\IdeaController;
use Illuminate\Support\Facades\Route;

Route::post('/ideas', [IdeaController::class, 'store']);



