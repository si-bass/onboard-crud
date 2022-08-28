<?php

use App\Http\Controllers\Api\UserController;
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

Route::prefix(prefix: 'users')->group(function () {
    Route::post(uri: '/', action: [UserController::class, 'store']);
    Route::put(uri: '/{id}', action: [UserController::class, 'update']);
    Route::patch(uri: '/{id}/password', action: [UserController::class, 'updatePassword']);
    Route::patch(uri: '/{id}/roles', action: [UserController::class, 'updateRoles']);
    Route::delete(uri: '/{id}', action: [UserController::class, 'delete']);

    Route::get(uri: '/', action: [UserController::class, 'list']);
    Route::get(uri: '/{id}', action: [UserController::class, 'detail']);
});
