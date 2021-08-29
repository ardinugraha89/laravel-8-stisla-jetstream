<?php

use App\Http\Controllers\EducationController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\KenaikanGajiBerkalaController;
use App\Http\Controllers\LampiranController;
use App\Http\Controllers\PangkatController;
use App\Http\Controllers\PelatihanController;
use App\Http\Controllers\RiwayatJabatanController;
use App\Http\Controllers\RiwayatPangkatController;
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

    Route::get('/pelatihan', [PelatihanController::class, "index_view"])->name('pelatihan');
    Route::view('/pelatihan/new', "pages.pelatihan.pelatihan-new")->name('pelatihan.new');
    Route::view('/pelatihan/edit/{pelatihanId}', "pages.pelatihan.pelatihan-edit")->name('pelatihan.edit');

    Route::get('/jabatan', [JabatanController::class, "index_view"])->name('jabatan');
    Route::view('/jabatan/new', "pages.jabatan.jabatan-new")->name('jabatan.new');
    Route::view('/jabatan/edit/{jabatanId}', "pages.jabatan.jabatan-edit")->name('jabatan.edit');

    Route::get('/pangkat', [PangkatController::class, "index_view"])->name('pangkat');
    Route::view('/pangkat/new', "pages.pangkat.pangkat-new")->name('pangkat.new');
    Route::view('/pangkat/edit/{pangkatId}', "pages.pangkat.pangkat-edit")->name('pangkat.edit');

    Route::get('/lampiran', [LampiranController::class, "index_view"])->name('lampiran');
    Route::view('/lampiran/new', "pages.lampiran.lampiran-new")->name('lampiran.new');
    Route::view('/lampiran/edit/{lampiranId}', "pages.lampiran.lampiran-edit")->name('lampiran.edit');

    Route::get('/riwayat/jabatan', [RiwayatJabatanController::class, "index_view"])->name('jabatan.user');
    Route::view('/riwayat/jabatan/new', "pages.riwayatjbt.riwayatjbt-new")->name('riwayatjbt.new');
    Route::view('/riwayat/jabatan/edit/{riwayatjbtId}', "pages.riwayatjbt.riwayatjbt-edit")->name('riwayatjbt.edit');

    Route::get('/riwayat/pangkat', [RiwayatPangkatController::class, "index_view"])->name('pangkat.user');
    Route::view('/riwayat/pangkat/new', "pages.riwayatpkt.riwayatpkt-new")->name('riwayatpkt.new');
    Route::view('/riwayat/pangkat/edit/{riwayatpktId}', "pages.riwayatpkt.riwayatpkt-edit")->name('riwayatpkt.edit');

    Route::get('/kenaikan/gaji', [KenaikanGajiBerkalaController::class, "index_view"])->name('kgb');
    Route::view('/kenaikan/gaji/new', "pages.kgb.kgb-new")->name('kgb.new');
    Route::view('/kenaikan/gaji/edit/{kgbId}', "pages.kgb.kgb-edit")->name('kgb.edit');
});
