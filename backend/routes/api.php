<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\NotificationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post("notification", [NotificationController::class, "store"]);
Route::get("notification", [NotificationController::class, "show"]);
Route::get("notification/user/{user}", [NotificationController::class, "getByUser"]);
Route::get("notification/sent", [NotificationController::class, "getSent"]);
Route::get("categories", [CategoryController::class, "get"]);
