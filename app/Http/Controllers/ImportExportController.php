<?php

namespace App\Http\Controllers;

use App\Exports\ExportSiswa;
use App\Imports\GuruImport;
use App\Imports\ImportSiswa;
use App\Imports\SiswaImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;

class ImportExportController extends Controller
{
    public function importExport()
    {
        return view('import');
    }

    public function import(Request $request)
    {
        Excel::import(new SiswaImport, $request->file('file'));
        return redirect()->back()->with('success', 'Data siswa berhasil diimport');
    }
    public function importGuru(Request $request)
    {
        try {
            $import = new GuruImport();
            Excel::import($import, $request->file('file'));

            // Jika berhasil
            return back()->with('success', 'Data Guru berhasil diimpor!');
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();

            return back()->with('failures', $failures);
        }
    }
}
