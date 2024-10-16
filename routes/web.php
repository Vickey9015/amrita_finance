<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\dashboard\Analytics;
use App\Http\Controllers\dashboard\Analytics_org;
use App\Http\Controllers\pages\AccountSettingsAccount;
use App\Http\Controllers\pages\Users;
use App\Http\Controllers\authentications\LoginBasic;
use App\Http\Controllers\authentications\RegisterBasic;
use App\Http\Controllers\authentications\ForgotPasswordBasic;



// Start  : @Auther:Vickey --------------------------------------User------------------------------------------//


//Main Page Route
Route::get('/dashboard/analytics', [Analytics::class, 'index'])->name('dashboard-analytics');
Route::get('/dashboard/analytics_org', [Analytics_org::class, 'index'])->name('dashboard-analytics_org');

Route::get('/pages/aadhar-authentication-validation', [AccountSettingsAccount::class, 'index'])->name('aadhar-authentication-validation');
Route::get('/pages/aadhar_report_page', [AccountSettingsAccount::class, 'aadhar_report_page'])->name('aadhar_report_page');

Route::post('aadharvalidate', [AccountSettingsAccount::class, 'aadharvalidate'])->name('aadharvalidate');
Route::post('otp_verify', [AccountSettingsAccount::class, 'otp_verify'])->name('otp_verify');

// authentication
Route::match(["get", "post"], "/", [LoginBasic::class, "index"])->name("auth-login-basic");
Route::match(["get", "post"], "auth/login-basic", [LoginBasic::class, "logout"])->name("auth-logout-basic");
Route::get('/auth/register-basic', [RegisterBasic::class, 'index'])->name('auth-register-basic');
Route::get('/auth/forgot-password-basic', [ForgotPasswordBasic::class, 'index'])->name('auth-reset-password-basic');

// End  : @Auther:Vickey --------------------------------------User------------------------------------------//


// Start: @Auther:Vickey-------------------------------Organisation------------------------------------------//


Route::match(["post","get"], "/register", [RegisterBasic::class, "register"])->name("register");
Route::match(["get", "post"], "organisation-login", [LoginBasic::class, "org_login"])->name("organisation-login");
Route::get('/pages/users', [Users::class, 'index'])->name('users');
Route::match(["get", "post"],'/pages/addUser', [Users::class, 'addUser'])->name('addUser');


// End  : @Auther:Vickey -------------------------------Organisation------------------------------------------//