<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WEB\WebController;


Route::get('/', [WebController::class, 'guest']);
Route::get('/{any?}', [WebController::class, 'guest'])->where('any', '^(?!api\/)[\/\w\.-]*');
