<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SocialLoginController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('login/{provider}', [SocialLoginController::class,'redirect']);
	Route::get('login/{provider}/callback',[SocialLoginController::class,'Callback']);


Route::get('/', function () {
    return view('welcome');
});
// Route::get('/adminlogin', [UserController::class, 'index']);
Route::get('adminlogin',[LoginController::class,'adminlogin']);
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
