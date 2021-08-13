<?php

use App\Http\Controllers\Education;
use App\Http\Controllers\EducationController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::group(["middleware" => ['auth:sanctum', 'verified']], function () {
    Route::view('/dashboard', "dashboard")->name('dashboard');

    Route::get('/user', [UserController::class, "index_view"])->name('user');
    Route::view('/user/new', "pages.user.user-new")->name('user.new');
    Route::view('/user/edit/{userId}', "pages.user.user-edit")->name('user.edit');

    Route::get('/edu', [EducationController::class, "index_view"])->name('edu');
    Route::view('/edu/new', "pages.edu.edu-new")->name('edu.new');
    Route::view('/edu/edit/{eduId}', "pages.edu.edu-edit")->name('edu.edit');
});
