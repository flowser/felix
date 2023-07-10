<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\PostController;
use App\Http\Controllers\API\WebsiteController;
use App\Http\Controllers\API\AUTH\AuthController;
use App\Http\Controllers\API\SubscriberController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;

Route::post('/login/password/resetlink', [AuthController::class, 'resetlink']);
Route::post('/login/password/reset', [AuthController::class, 'reset']);

Route::post('/login/password/resetlink', [ForgotPasswordController::class, 'sendResetLinkEmail']);
Route::get('/password/reset/{token}', [ResetPasswordController::class, 'showResetForm']);
Route::post('/password/reset', [ResetPasswordController::class, 'reset']);

Route::post('/login', [AuthController::class, 'login']);
Route::post('/refreshtoken', [AuthController::class, 'refreshtoken']);

// Route::get('/unauthorized', [AuthController::class,'unauthorized']);
Route::middleware('auth:api')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::get('user', [AuthController::class, 'user']);
});

// WebsiteController
Route::get('/websites', [WebsiteController::class, 'index']);
Route::post('/website/create', [WebsiteController::class, 'store']);
Route::patch('/website/update/{id}', [WebsiteController::class, 'update']);
Route::get('/website/delete/{id}', [WebsiteController::class, 'destroy']);


Route::get('/posts', [PostController::class, 'index']);
Route::post('/post/create', [PostController::class, 'store']);
Route::patch('/post/update/{id}', [PostController::class, 'update']);
Route::get('/post/delete/{id}', [PostController::class, 'destroy']);


Route::get('/subscribers', [SubscriberController::class, 'index']);
Route::post('/subscriber/create', [SubscriberController::class, 'store']);
Route::patch('/subscriber/update/{id}', [SubscriberController::class, 'update']);
Route::get('/subscriber/delete/{id}', [SubscriberController::class, 'destroy']);


