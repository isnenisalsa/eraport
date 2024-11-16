<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\MapelController;
use App\Http\Controllers\PembelajaranController;
use App\Models\MapelModel;
use Illuminate\Support\Facades\Auth;

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
    // Only proceed if the user is authenticated
    if (Auth::check()) {
        $user = Auth::user();
        $roleIds = $user->roles->pluck('id')->toArray();

        // Redirect berdasarkan role_id
        if (in_array(1, $roleIds)) {
            return redirect()->route('dashboard.admin');
        } elseif (in_array(2, $roleIds)) {
            return redirect()->route('dashboard.guru');
        } elseif (in_array(3, $roleIds)) {
            return redirect()->route('dashboard.walas');
        } else {
            return redirect('login')->withErrors(['access_denied' => 'Akses ditolak. Role Anda tidak dikenali.']);
        }
    } else {
        // Redirect to login page if not authenticated
        return redirect('login');
    }
})->middleware('auth');

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

//rute untuk guru
Route::prefix('guru')->group(function () {
    Route::get('/', [GuruController::class, 'index'])->middleware('cek_login:1')->name('guru');
    Route::get('/create', [GuruController::class, 'create'])->middleware('cek_login:1')->name('create');
    Route::post('/save', [GuruController::class, 'save'])->name('save-guru');
    Route::get('/edit/{nik}', [GuruController::class, 'edit'])->middleware('cek_login:1')->name('edit');
    Route::put('/update/{nik}', [GuruController::class, 'update'])->middleware('cek_login:1')->name('update');
});

//rute untuk kelas
Route::prefix('kelas')->group(function () {
    Route::get('/', [KelasController::class, 'index'])->middleware('cek_login:1')->name('kelas');
    Route::post('/save', [KelasController::class, 'save'])->name('save');
    Route::get('/edit/{kode_kelas}', [KelasController::class, 'edit'])->middleware('cek_login:1')->name('edit-kelas');
    Route::put('/update/{kode_kelas}', [KelasController::class, 'update'])->middleware('cek_login:1')->name('update-kelas');
});

//rute untuk mapel
Route::prefix('mapel')->group(function () {
    Route::get('/', [MapelController::class, 'index'])->middleware('cek_login:1')->name('mapel');
    Route::post('/save', [MapelController::class, 'save'])->name('save-mapel');
    Route::put('/update/{kode_mapel}', [MapelController::class, 'update'])->middleware('cek_login:1')->name('update-mapel');
});

//rute untuk pembelajaran
Route::prefix('pembelajaran')->group(function () {
    Route::get('/', [PembelajaranController::class, 'index'])->middleware('cek_login:1')->name('pembelajaran');
    Route::post('/save', [PembelajaranController::class, 'save'])->name('save-pembelajaran');
    Route::get('/edit/{kode_pembelajaran}', [PembelajaranController::class, 'edit'])->middleware('cek_login:1')->name('edit-pembelajaran');
    Route::put('/update/{kode_pembelajaran}', [PembelajaranController::class, 'update'])->middleware('cek_login:1')->name('update-pembelajaran');
});
