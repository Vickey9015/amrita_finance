<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\UserAuthController;
use App\Http\Controllers\api\AadharAuth;
use App\Http\Controllers\api\PanValidate;
use App\Http\Controllers\api\PennyDrop;

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

Route::post("login", [UserAuthController::class, "login"]);
Route::post("generate_token", [UserAuthController::class, "generate_token"]);

Route::group(['middleware' => "auth:sanctum"], function () {
    Route::post("check", [UserAuthController::class, "check"]);
    Route::post("aadharvalidation_details", [AadharAuth::class, "aadharvalidation_details"]);
    Route::post("otp_verify_aadharVal", [AadharAuth::class, "otp_verify_aadharVal"]);
    Route::post("pan_validate", [PanValidate::class, "pan_validate"]);
    Route::get("penny_drop", [PennyDrop::class, "penny_drop"]);
    
    
});

Route::get("login", [UserAuthController::class, "login"])->name('login');
