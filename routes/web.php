<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GuruController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    if (auth()->check()) {
        switch (auth()->user()->level->nama) {
            case 'admin':
                return redirect()->route('dashboard.admin');
            case 'guru':
                return redirect()->route('dashboard.guru');
            case 'walas':
                return redirect()->route('dashboard.walas');
        }
    }
    return redirect()->route('login');
});

Route::get('login', [AuthController::class, "index"])->name('login');
Route::post('proses_login', [AuthController::class, 'proses_login'])->name('proses_login');
Route::get('logout', [AuthController::class, "logout"])->name('logout');
Route::middleware(['auth'])->group(function () {
    // Rute untuk Admin
    Route::get('/dashboard/admin', [DashboardController::class, 'index'])
        ->middleware('cek_login:1')
        ->name('dashboard.admin');

    // Rute untuk Guru
    Route::get('/dashboard/guru', [DashboardController::class, 'guru'])
        ->middleware('cek_login:2')
        ->name('dashboard.guru');

    // Rute untuk Walas
    Route::get('/dashboard/walas', [DashboardController::class, 'walas'])
        ->middleware('cek_login:3')
        ->name('dashboard.walas');
});

Route::prefix('guru')->group(function () {
    Route::get('/', [GuruController::class, 'index'])->middleware('cek_login:1')->name('index');
    Route::get('/create', [GuruController::class, 'create'])->middleware('cek_login:1')->name('create');
    Route::post('/save', [GuruController::class, 'save'])->name('save');
    Route::get('/edit/{nik}', [GuruController::class, 'edit'])->middleware('cek_login:1')->name('edit');
    Route::put('/update/{nik}', [GuruController::class, 'update'])->middleware('cek_login:1')->name('update');
});
