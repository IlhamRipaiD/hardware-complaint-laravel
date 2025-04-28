<?php
  
namespace App\Http\Controllers;

use Session;
use Carbon\Carbon;
use Dompdf\Dompdf;
use Dompdf\Options;
use App\Models\InsertModel;
use Illuminate\Http\Request;
use App\Models\TanggapanModel;
use App\Services\TelegramService;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class HomeController extends Controller {//public function = fungsi yang menyimpan logika yang ditempatkan dan akan dipanggil di web.php

//INI FUNGSI - FUNGSI ADMIN

            public function admin() // halaman kabag dengan data tanggapan
            {
                $tanggapan = TanggapanModel::all();
                return view('admin');
            }

            public function riwayattanggapan() // halaman kabag dengan data tanggapan
                {
                    $tanggapan = TanggapanModel::all();
                    return view('riwayattanggapan', compact('tanggapan'));
                }

            public function halExportPDF() // halaman kabag dengan data tanggapan
                {
                    return view('export-pdf');
                }

            public function exportPDF(Request $request) // fungsi export PDF untuk kabag
                {
                    // Ambil data berdasarkan rentang tanggal yang dikirim dari form
                    $start_date = $request->input('start_date');
                    $end_date = $request->input('end_date');

                    // Jika tidak ada rentang tanggal yang disediakan, maka hanya ambil data untuk hari ini
                    if (!$start_date && !$end_date) {
                        $start_date = Carbon::today()->toDateString();
                        $end_date = Carbon::today()->toDateString();
                    }

                    // Query untuk mengambil data sesuai rentang tanggal
                    $rekapData = InsertModel::whereDate('created_at', '>=', $start_date)
                        ->whereDate('created_at', '<=', $end_date)
                        ->orderBy('created_at', 'asc')
                        ->get();

                    // Inisialisasi Dompdf
                    $pdfOptions = new Options();
                    $pdfOptions->set('defaultFont', 'Helvetica');
                    $pdf = new Dompdf($pdfOptions);

                    // Muat tampilan 'export_pdf' dengan data pengaduan
                    $pdf->loadHtml(view('export_pdf', compact('rekapData', 'start_date', 'end_date')));

                    // Atur ukuran kertas dan orientasi
                    $pdf->setPaper('A4', 'landscape');

                    // Render PDF
                    $pdf->render();

                    // Stream PDF ke browser untuk diunduh
                    return $pdf->stream('rekap_data_pengaduan.pdf');
                }

            public function delete_tanggapan($id)  //menghapus data dengan mencari data user id : kabid
                {
                    $data = TanggapanModel::findOrFail($id);
                    $data->delete();

                    return redirect()->route('riwayattanggapan')->with('success', 'Data berhasil dihapus.');
                }

            public function visualisasiPengaduan()
                {
                    // Ambil semua pengaduan
                    $riwayatpengaduan = InsertModel::all();

                    return view('visualisasidata', compact('riwayatpengaduan'));
                }

            public function riwayatpengaduan() 
                {
                    // Dapatkan semua riwayat pengaduan
                    $riwayatpengaduan = InsertModel::latest()->paginate(10); // Gantilah 'RiwayatPengaduan' dengan model yang sesuai jika berbeda
                    
                    return view('riwayatpengaduan', compact('riwayatpengaduan'));
                }


            public function rekap(Request $request) //fungsi rekap : kabid
                {
                    // Ambil data berdasarkan rentang tanggal yang dikirim dari form
                    $start_date = $request->input('start_date');
                    $end_date = $request->input('end_date');
                    $searchTerm = $request->input('search');

                    // Jika tidak ada rentang tanggal yang disediakan, maka hanya ambil data untuk hari ini
                    if (!$start_date && !$end_date) {
                        $start_date = Carbon::today()->toDateString();
                        $end_date = Carbon::today()->toDateString();
                    }

                    // Query untuk mengambil data sesuai rentang tanggal
                    $rekapData = InsertModel::whereDate('created_at', '>=', $start_date)
                        ->whereDate('created_at', '<=', $end_date)
                        ->when($searchTerm, function ($query, $searchTerm) {
                            return $query->where('nama', 'like', '%' . $searchTerm . '%');
                        })
                        ->orderBy('created_at', 'asc')
                        ->get();

                    $insert = InsertModel::get();

                    // Kembalikan view 'rekap' dengan data rekap
                    return view('rekap', compact('insert', 'rekapData', 'searchTerm', 'start_date', 'end_date'));
                }


    
//INI FUNGSI - FUNGSI USER
            protected $telegramService;

            public function __construct(TelegramService $telegramService)
                {
                    $this->telegramService = $telegramService;
                }

                public function actioninsert(Request $request)
                {
                    // Validasi input
                    $request->validate([
                        'unit_ruangan' => 'required|string|max:255',
                        'nama' => 'required|string|max:255',
                        'media' => 'required|string',
                        'masalah' => 'required|array', // Memastikan masalah adalah array
                        'masalah.*' => 'string', // Setiap elemen dalam array adalah string
                        'detail_masalah' => 'nullable|string',
                        'solusi' => 'nullable|string',
                        'status' => 'nullable|string',
                        'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi gambar
                    ]);
                
                    $imageName = null;
                
                    if ($request->hasFile('foto') && $request->file('foto')->isValid()) {
                        $imageName = time() . '.' . $request->foto->extension();
                        $request->foto->move(public_path('images'), $imageName);
                    }
                
                    // Menyimpan data ke database
                    $user = InsertModel::create([
                        'unit_ruangan' => $request->unit_ruangan,
                        'nama' => $request->nama,
                        'media' => $request->media,
                        'masalah' => implode(', ', $request->masalah), // Mengubah array masalah menjadi string
                        'kategori' => $request->kategori, // Pastikan ada input kategori di form
                        'detail_masalah' => $request->detail_masalah,
                        'solusi' => $request->solusi,
                        'status' => $request->status,
                        'foto' => $imageName,
                    ]);
                
                    try {
                        $message = "Ada pengaduan baru dari Unit Ruangan: {$request->unit_ruangan}.\n\n"
                                . "Dengan nama pelapor: {$request->nama}.\n\n"
                                . "Kategori masalah: " . implode(', ', $request->masalah) . ".\n\n" // Mengubah array menjadi string
                                . "Detail masalah:\n{$request->detail_masalah}";
                
                        if ($imageName) {
                            $photoPath = public_path('images') . '/' . $imageName;
                            $response = $this->telegramService->sendPhoto($message, $photoPath);
                        } else {
                            $response = $this->telegramService->sendMessage($message);
                        }
                
                        // Handle jika pengiriman pesan berhasil
                        Session::flash('message', 'Data Pengaduan berhasil disimpan.');
                        return redirect('user');
                    } catch (\Exception $e) {
                        // Handle jika terjadi kesalahan dalam mengirim pesan
                        Session::flash('error', 'Gagal mengirim notifikasi Telegram: ' . $e->getMessage());
                        return redirect('user');
                    }
                }
                
    
                public function actiontanggapan(Request $request) // fungsi saat menekan tombol dan menyimpan data tanggapan
                {
                    // Membuat tanggapan baru tanpa menggunakan user_id
                    $tanggapan = TanggapanModel::create([
                        'unit_ruangan' => $request->unit_ruangan,
                        'nama' => $request->nama,
                        'feedback' => $request->feedback,
                        'kritik_saran' => $request->kritik_saran,
                    ]);
                
                    // Menyimpan pesan sukses ke sesi
                    Session::flash('message', 'success', 'Tanggapan berhasil disimpan.');
                    
                    // Redirect ke halaman tanggapan
                    return redirect('tanggapan');
                }
                

                public function searchuser(Request $request) //fungsi mencari data pengaduan : user
                {
                    $searchTerm = $request->input('search');
                
                    // Mencari data pengaduan tanpa memfilter berdasarkan user_id
                    $riwayatpengaduan = InsertModel::where(function ($query) use ($searchTerm) {
                        $query->where('nama', 'LIKE', "%$searchTerm%")
                            ->orWhere('unit_ruangan', 'LIKE', "%$searchTerm%")
                            ->orWhere('masalah', 'LIKE', "%$searchTerm%")
                            ->orWhere('detail_masalah', 'LIKE', "%$searchTerm%")
                            ->orWhere('solusi', 'LIKE', "%$searchTerm%")
                            ->orWhere('status', 'LIKE', "%$searchTerm%")
                            ->orWhere('kategori', 'LIKE', "%$searchTerm%");
                    })
                    ->orderBy('created_at', 'desc')
                    ->get();
                
                    return view('search_results', compact('riwayatpengaduan', 'searchTerm'));
                }
                 

            public function search(Request $request) //fungsi mencari data pengaduan : kabid
                {
                    $searchTerm = $request->input('search');

                    // Lakukan pencarian data di sini menggunakan model
                    $searchResults = InsertModel::where('nama', 'like', '%' . $searchTerm . '%')
                    ->orWhere('unit_ruangan', 'like', '%' . $searchTerm . '%')
                    ->orWhere('masalah', 'like', '%' . $searchTerm . '%')
                    ->orWhere('detail_masalah', 'like', '%' . $searchTerm . '%')
                    ->orWhere('solusi', 'like', '%' . $searchTerm . '%')
                    ->orWhere('status', 'like', '%' . $searchTerm . '%')
                    ->orWhere('kategori', 'like', '%' . $searchTerm . '%')

                    ->get();
                    return view('search_results', compact('searchResults', 'searchTerm'));
                }   

                public function edit($id)
                {
                    // Ambil data pengaduan berdasarkan ID
                    $data = InsertModel::findOrFail($id);

                    // Ambil unit_ruangan dari record pengaduan
                    $unit_ruangan = $data->unit_ruangan;

                    // Ambil semua masalah yang mungkin
                    $allMasalah = ['Keyboard', 'Monitor', 'CPU', 'WIFI', 'Mouse', 'Printer', 'Dan lain-lain'];

                    $selectedMasalah = $data->masalah ? explode(',', str_replace(', ', ',', $data->masalah)) : [];

                    // Pisahkan solusi yang sudah ada menjadi array
                    $selectedSolusi = explode(',', $data->solusi);
                    
                    return view('edit', compact('data', 'unit_ruangan', 'selectedSolusi', 'allMasalah', 'selectedMasalah'));
                }

                

                public function update(Request $request, $id)
                {
                    // Ambil data pengaduan berdasarkan ID
                    $data = InsertModel::findOrFail($id);
                    
                    // Validasi jika diperlukan
                    $request->validate([
                        'masalah' => 'required|array',
                        'masalah.*' => 'string',
                        'solusi' => 'nullable|array', // Validasi untuk solusi
                        'solusi.*' => 'string', // Validasi untuk setiap solusi
                        // Tambahkan validasi lain sesuai kebutuhan
                    ]);

                    // Jika ada file foto yang di-upload
                    if ($request->hasFile('foto')) {
                        $imageName = time() . '.' . $request->foto->extension();
                        $request->foto->move(public_path('images'), $imageName);
                        $data->foto = $imageName; // Simpan nama foto baru
                    }

                    // Update data lainnya
                    $data->unit_ruangan = $request->unit_ruangan;
                    $data->nama = $request->nama;
                    $data->media = $request->media;
                    $data->masalah = implode(',', $request->masalah); // Simpan sebagai string yang dipisahkan dengan koma
                    $data->kategori = $request->kategori;
                    $data->detail_masalah = $request->detail_masalah;

                    // Simpan solusi sebagai string jika diperlukan
                    $data->solusi = isset($request->solusi) ? implode(',', $request->solusi) : ''; // Ubah jika solusi disimpan sebagai string yang dipisahkan koma
                    // Jika Anda ingin menyimpan solusi dalam format JSON, gunakan json_encode()
                    // $data->solusi = isset($request->solusi) ? json_encode($request->solusi) : '';

                    $data->status = $request->status;
                    $data->save(); // Simpan perubahan

                    return redirect()->route('riwayatpengaduan')->with('success', 'Data berhasil diperbarui.');
                }


            public function delete($id)
            {
                $data = InsertModel::findOrFail($id);
                
                // Menghapus foto terkait jika ada
                if ($data->foto) {
                    File::delete(public_path('images/' . $data->foto));
                }

                $data->delete();

                // Setelah berhasil hapus, kembali ke riwayat tanggapan
                return redirect()->route('riwayatpengaduan')->with('success', 'Data berhasil dihapus.');
            }

            public function deleteFoto($id)
                {
                $data = InsertModel::findOrFail($id);

                if ($data->foto) {
                    $fotoPath = public_path('images') . '/' . $data->foto;

                    if (file_exists($fotoPath)) {
                        unlink($fotoPath); // Hapus file foto dari server
                    }

                    $data->foto = null; // Hapus path foto dari database
                    $data->save();
                }
                return redirect()->route('edit', $data->id)->with('success', 'Foto berhasil dihapus.');
                }
}