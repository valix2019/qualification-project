<?php

use App\Http\Controllers\Api\Admin\SectionApiController as AdminSectionApiController;
use App\Http\Controllers\Api\Admin\TaskApiController AS AdminTaskApiController;
use App\Http\Controllers\Api\Admin\UserApiController as AdminUserApiController;
use App\Http\Controllers\Api\SectionApiController;
use App\Http\Controllers\Api\TaskApiController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\OAuthController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\Settings\PasswordController;
use App\Http\Controllers\Settings\ProfileController;
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

// Маршруты для админов

Route::group([
    'middleware' => 'auth:api',
    'prefix' => 'admin',
    'as' => 'admin.',
], function () {
    Route::get('sections/tree', [AdminSectionApiController::class, 'tree']);
    Route::get('tasks/handlers', [AdminTaskApiController::class, 'handlers']);

    Route::apiResource('users', AdminUserApiController::class);
    Route::apiResource('sections', AdminSectionApiController::class);
    Route::apiResource('tasks', AdminTaskApiController::class);
});

// Маршруты для зарегистрированных пользователей

Route::group(['middleware' => 'auth:api'], function () {
    Route::post('logout', [LoginController::class, 'logout']);

    Route::get('user', [UserController::class, 'current']);

    Route::patch('settings/profile', [ProfileController::class, 'update']);
    Route::patch('settings/password', [PasswordController::class, 'update']);

    Route::apiResource('sections', SectionApiController::class)->only(['index', 'show']);
    Route::apiResource('tasks', TaskApiController::class)->only(['show']);

    Route::post('tasks/{task}', [TaskApiController::class, 'check']);
});
    Route::get('resources/views/spa', function () {
        return view('spa');
    });

//

Route::group(['middleware' => 'guest:api'], function () {
    Route::post('login', [LoginController::class, 'login']);
    Route::post('register', [RegisterController::class, 'register']);

    Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail']);
    Route::post('password/reset', [ResetPasswordController::class, 'reset']);

    Route::post('email/verify/{user}', [VerificationController::class, 'verify'])->name('verification.verify');
    Route::post('email/resend', [VerificationController::class, 'resend']);

    Route::post('oauth/{driver}', [OAuthController::class, 'redirect']);
    Route::get('oauth/{driver}/callback', [OAuthController::class, 'handleCallback'])->name('oauth.callback');
});
