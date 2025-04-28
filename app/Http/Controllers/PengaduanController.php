<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\PengaduanExport;
use Maatwebsite\Excel\Facades\Excel;

class PengaduanController extends Controller
{
    public function exporttoexcel(Request $request)
        {
        // Validasi input
        $request->validate([
            'start_date' => 'required|date_format:Y-m-d',
            'end_date' => 'required|date_format:Y-m-d|after_or_equal:start_date',
        ]);
        
        // Mendapatkan rentang tanggal dari input
        $startDate = $request->start_date;
        $endDate = $request->end_date;

        // Simpan rentang tanggal dalam session
        $request->session()->put('export_start_date', $startDate);
        $request->session()->put('export_end_date', $endDate);

        try {
            $fileName = 'pengaduan_' . $startDate . '_to_' . $endDate . '.xlsx';
            return Excel::download(new PengaduanExport($startDate, $endDate), $fileName);
        } catch (\Exception $e) {
            return back()->withError('Terjadi kesalahan saat mengunduh file Excel: ' . $e->getMessage());
        }
    }
}
