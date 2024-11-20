<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\ImportExportController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\MapelController;
use App\Http\Controllers\PembelajaranController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\SiswaKelasController;
use App\Http\Controllers\TahunajaranController;
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
    Route::get('/', [GuruController::class, 'index'])->name('guru');
    Route::get('/create', [GuruController::class, 'create'])->name('create-guru');
    Route::post('/save', [GuruController::class, 'save'])->name('save-guru');
    Route::get('/edit/{nik}', [GuruController::class, 'edit'])->name('edit');
    Route::put('/update/{nik}', [GuruController::class, 'update'])->name('update');
});

//rute untuk kelas
Route::prefix('kelas')->group(function () {
    Route::get('/', [KelasController::class, 'index'])->name('kelas');
    Route::post('/save', [KelasController::class, 'save'])->name('save');
    Route::get('/edit/{kode_kelas}', [KelasController::class, 'edit'])->name('edit-kelas');
    Route::put('/update/{kode_kelas}', [KelasController::class, 'update'])->name('update-kelas');
});

//rute untuk mapel
Route::prefix('mapel')->group(function () {
    Route::get('/', [MapelController::class, 'index'])->name('mapel');
    Route::post('/save', [MapelController::class, 'save'])->name('save-mapel');
    Route::put('/update/{kode_mapel}', [MapelController::class, 'update'])->name('update-mapel');
});

//rute untuk pembelajaran
Route::prefix('pembelajaran')->group(function () {
    Route::get('/', [PembelajaranController::class, 'index'])->name('pembelajaran');
    Route::post('/save', [PembelajaranController::class, 'save'])->name('save-pembelajaran');
    Route::get('/edit/{kode_pembelajaran}', [PembelajaranController::class, 'edit'])->name('edit-pembelajaran');
    Route::put('/update/{kode_pembelajaran}', [PembelajaranController::class, 'update'])->name('update-pembelajaran');
});

//rute untuk siswa
Route::prefix('siswa')->group(function () {
    Route::get('/', [SiswaController::class, 'index'])->name('siswa');
    Route::get('/create', [SiswaController::class, 'create'])->name('create');
    Route::post('/save', [SiswaController::class, 'save'])->name('save-siswa');
    Route::get('/edit/{nis}', [SiswaController::class, 'edit'])->name('edit-siswa');
    Route::put('/update/{nis}', [SiswaController::class, 'update'])->name('update-siswa');
});

//rute untuk tahun ajaran
Route::prefix('tahun_ajaran')->group(function () {
    Route::get('/', [TahunajaranController::class, 'index'])->name('tahun_ajaran');
    Route::post('/save', [TahunajaranController::class, 'save'])->name('save-tahun_ajaran');
    Route::put('/update/{kode_tahun_ajaran}', [TahunajaranController::class, 'update'])->name('update-tahun_ajaran');
});

Route::controller(ImportExportController::class)->group(function () {
    Route::get('import_export', 'importExport');
    Route::post('import', 'import')->name('import');
    Route::get('export', 'export')->name('export');
});

//rute untuk siswa
Route::prefix('siswa_kelas')->group(function () {
    Route::get('/', [SiswaKelasController::class, 'index'])->name('siswa_kelas');
    Route::get('/create', [SiswaKelasController::class, 'create'])->name('create');
    Route::post('/save', [SiswaKelasController::class, 'save'])->name('save-siswa_kelas');
});

