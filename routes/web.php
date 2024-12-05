<?php

use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CetakRaporController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EskulController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\ImportExportController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\MapelController;
use App\Http\Controllers\NilaiAkhirController;
use App\Http\Controllers\NilaiController;
use App\Http\Controllers\PembelajaranController;
use App\Http\Controllers\SekolahController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\SiswaKelasController;
use App\Http\Controllers\TahunajaranController;
use App\Http\Controllers\TujuanPembelajaranController;
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
//rute untuk sekolah
Route::prefix('sekolah')->group(function () {
    Route::get('/', [SekolahController::class, 'index'])->name('sekolah.index');
    Route::post('/save', [SekolahController::class, 'save'])->name('sekolah.save');
});

//rute untuk eskul
Route::prefix('eskul')->group(function () {
    Route::get('/', [EskulController::class, 'index'])->name('eskul.index');
    Route::get('/daftar', [EskulController::class, 'DaftarEskul'])->name('eskul.daftar');
    Route::post('/save', [EskulController::class, 'save'])->name('eskul.save');
    Route::put('/update{id}', [EskulController::class, 'update'])->name('eskul.update');
});



//rute untuk guru
Route::prefix('guru')->group(function () {
    Route::get('/', [GuruController::class, 'index'])->name('guru')->middleware('cek_login:1');
    Route::get('/create', [GuruController::class, 'create'])->name('create-guru')->middleware('cek_login:1');
    Route::post('/save', [GuruController::class, 'save'])->name('save-guru')->middleware('cek_login:1');
    Route::get('/edit/{nik}', [GuruController::class, 'edit'])->name('edit')->middleware('cek_login:1');
    Route::put('/update/{nik}', [GuruController::class, 'update'])->name('update')->middleware('cek_login:1');
});

//rute untuk kelas
Route::prefix('kelas')->group(function () {
    Route::get('/', [KelasController::class, 'index'])->name('kelas')->middleware('cek_login:1');
    Route::get('/walas', [KelasController::class, 'KelasWalas'])->name('kelas.walas');
    Route::get('/walas/nilai', [KelasController::class, 'KelasWalasNilai'])->name('kelas.walas.nilai');
    Route::post('/save', [KelasController::class, 'save'])->name('save-kelas')->middleware('cek_login:1');
    Route::get('/edit/{kode_kelas}', [KelasController::class, 'edit'])->name('edit-kelas')->middleware('cek_login:1');
    Route::put('/update/{kode_kelas}', [KelasController::class, 'update'])->name('update-kelas')->middleware('cek_login:1');
});

//rute untuk mapel
Route::prefix('mapel')->group(function () {
    Route::get('/', [MapelController::class, 'index'])->name('mapel')->middleware('cek_login:1');
    Route::post('/save', [MapelController::class, 'save'])->name('save-mapel')->middleware('cek_login:1');
    Route::put('/update/{kode_mapel}', [MapelController::class, 'update'])->name('update-mapel')->middleware('cek_login:1');
});

//rute untuk pembelajaran
Route::middleware(['auth'])->group(function () {
    Route::prefix('pembelajaran')->group(function () {
        Route::get('/', [PembelajaranController::class, 'index'])->name('pembelajaran')->middleware(['cek_login:1']);
        Route::get('/guru', [PembelajaranController::class, 'indexGuru'])->middleware(['cek_login:2']);
        Route::post('/save', [PembelajaranController::class, 'save'])->name('save-pembelajaran')->middleware('cek_login:1');
        Route::get('/edit/{kode_pembelajaran}', [PembelajaranController::class, 'edit'])->name('edit-pembelajaran')->middleware('cek_login:1');
        Route::put('/update/{kode_pembelajaran}', [PembelajaranController::class, 'update'])->name('update-pembelajaran')->middleware('cek_login:1');
    });
});

//rute untuk siswa
Route::prefix('siswa')->group(function () {
    Route::get('/', [SiswaController::class, 'index'])->name('siswa')->middleware('cek_login:1');
    Route::get('/create', [SiswaController::class, 'create'])->name('create')->middleware('cek_login:1');
    Route::post('/save', [SiswaController::class, 'save'])->name('save-siswa')->middleware('cek_login:1');
    Route::get('/edit/{nis}', [SiswaController::class, 'edit'])->name('edit-siswa')->middleware('cek_login:1');
    Route::put('/update/{nis}', [SiswaController::class, 'update'])->name('update-siswa')->middleware('cek_login:1');
});

//rute untuk tahun ajaran
Route::prefix('tahun/ajaran')->group(function () {
    Route::get('/', [TahunajaranController::class, 'index'])->name('tahun_ajaran')->middleware('cek_login:1');
    Route::post('/save', [TahunajaranController::class, 'save'])->name('save-tahun_ajaran')->middleware('cek_login:1');
    Route::put('/update/{kode_tahun_ajaran}', [TahunajaranController::class, 'update'])->name('update-tahun_ajaran')->middleware('cek_login:1');
});

Route::controller(ImportExportController::class)->group(function () {
    Route::get('import_export', 'importExport')->middleware('cek_login:1');
    Route::post('import', 'import')->name('import')->middleware('cek_login:1');
    Route::get('export', 'export')->name('export')->middleware('cek_login:1');
});

//rute untuk siswa kelas
Route::prefix('kelas/siswa')->group(function () {
    Route::get('/{kode_kelas}', [SiswaKelasController::class, 'index'])->name('siswa_kelas');
    Route::post('/save/{kode_kelas}', [SiswaKelasController::class, 'save'])->name('save-siswa_kelas');
});
//rute untuk siswa eskul
Route::prefix('eskul/siswa')->group(function () {
    Route::get('/{id}', [EskulController::class, 'DaftarSiswa'])->name('eskul.siswa.pembina');
    Route::post('/save/{id}', [EskulController::class, 'saveSiswa'])->name('save.eskul.siswa');
});
//rute untuk absensi
Route::prefix('absensi')->group(function () {
    Route::get('/kelas', [AbsensiController::class, 'KelasAbsensi'])->name('absensi.kelas');
    Route::get('/index/{kelas_id}', [AbsensiController::class, 'index'])->name('absensi.index');
    Route::post('/update/{kelas_id}', [AbsensiController::class, 'update'])->name('update.absensi');
});

//rute untuk tupel
Route::prefix('tupel')->group(function () {
    Route::get('/{id}', [TujuanPembelajaranController::class, 'index'])->name('tupel.index');
    Route::post('/save/{id}', [TujuanPembelajaranController::class, 'save'])->name('save.tupel');
    Route::post('/update', [TujuanPembelajaranController::class, 'update'])->name('update.tupel');
    Route::delete('/tupel/{id}', [TujuanPembelajaranController::class, 'destroy'])->name('delete.tupel');
});

//rute untuk nilai
Route::prefix('nilai')->group(function () {
    Route::get('/{id}', [NilaiController::class, 'index'])->name('nilai.index');
    Route::post('/update', [NilaiController::class, 'update'])->name('update.nilai');
});

//rute untuk nilai akhir
Route::prefix('walas/nilai/akhir')->group(function () {
    Route::get('/{id}', [NilaiAkhirController::class, 'index'])->name('nilai.akhir.index');
    Route::post('/save/{kode_kelas}', [NilaiAkhirController::class, 'save'])->name('save-siswa_nilai');
});
//rute cetak rapor
Route::prefix('cetak/rapor')->group(function () {
    Route::get('/kelas', [CetakRaporController::class, 'KelasRapor'])->name('rapor.kelas');
    Route::get('/{id}', [CetakRaporController::class, 'index'])->name('cetak.rapor.index');
    Route::post('/update/{kelas_id}', [CetakRaporController::class, 'update'])->name('update.cetak.rapor');
});
