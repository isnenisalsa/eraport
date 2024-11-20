<?php

namespace App\Http\Controllers;

use App\Models\GuruModel;
use App\Models\KelasModel;
use App\Models\SiswaKelasModel;
use App\Models\SiswaModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SiswaKelasController extends Controller
{
    public function index() {
        {

            $breadcrumb = (object) [
                'title' => 'Daftar Siswa',
            ];
    
            
            $activeMenu = 'Data Siswa';
            $user = Auth::user();
            $kelas = KelasModel::where('guru_nik',$user->nik)->value('kode_kelas');
         


            $siswa_kelas = SiswaKelasModel::with('siswa', 'kelas')
            ->where('kelas_id', $kelas)
            ->get(); 
                      
$siswa = SiswaModel::all();
$kelas = KelasModel::all();
            return view('walas\siswa\index', ['breadcrumb' => $breadcrumb, 'siswa_kelas' => $siswa_kelas,  'siswa' => $siswa, 'kelas' => $kelas, 'activeMenu' => $activeMenu]);
        }
    }

    public function save( Request $request){
$request->validate([
   'siswa_id' =>  'required',
   'kelas_id' => 'required',
]);

SiswaKelasModel::create([
    'siswa_id' => $request->siswa_id,
    'kelas_id' => $request->kelas_id,
]);
return redirect()->route('siswa_kelas');
    }
}