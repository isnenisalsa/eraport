<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

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

    if (auth()->check() && auth()->user()->level->nama == 'admin') {
        return redirect()->route('dashboard.admin');
    } elseif (auth()->check() && auth()->user()->level->nama == 'guru') {
        return redirect()->route('dashboard.guru');
    } elseif (auth()->check() && auth()->user()->level->nama == 'walas') {
        return redirect()->route('dashboard.walas');
    }

    return redirect()->route('login');
});
Route::get('login', [AuthController::class, "index"])->name('login');
Route::post('proses_login', [AuthController::class, 'proses_login'])->name('proses_login');
