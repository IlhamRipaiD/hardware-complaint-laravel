<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PengaduanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pengaduan')->insert([
            [
                'user_id' => '2',
                'unit_ruangan' => 'Gawat Darurat',
                'nama' => 'John Doe',
                'media' => 'Web Pengaduan',
                'masalah' => 'Monitor',
                'kategori' => 'Perangkat Keras',
                'detail_masalah' => 'Monitor tidak menampilkan gambar.',
                'foto' => null,
                'solusi' => 'Mengganti kabel VGA.',
                'status' => 'Proses'
            ],
            [
                'user_id' => '2',
                'unit_ruangan' => 'Instalasi Rawat Inap',
                'nama' => 'Jane Smith',
                'media' => 'Telepon Ex',
                'masalah' => 'CPU',
                'kategori' => 'Perangkat Keras',
                'detail_masalah' => 'CPU tidak menyala.',
                'foto' => null,
                'solusi' => 'Mengganti power supply.',
                'status' => 'Selesai'
            ],
            [
                'user_id' => '2',
                'unit_ruangan' => 'Radiologi',
                'nama' => 'Alex Johnson',
                'media' => 'Web Pengaduan',
                'masalah' => 'Keyboard',
                'kategori' => 'Perangkat Keras',
                'detail_masalah' => 'Beberapa tombol tidak berfungsi.',
                'foto' => null,
                'solusi' => 'Membersihkan dan mengganti keyboard.',
                'status' => 'Proses'
            ],
            [
                'user_id' => '2',
                'unit_ruangan' => 'ICU',
                'nama' => 'Emily Davis',
                'media' => 'Telepon Ex',
                'masalah' => 'Monitor',
                'kategori' => 'Perangkat Keras',
                'detail_masalah' => 'Monitor berkedip-kedip.',
                'foto' => null,
                'solusi' => 'Memeriksa dan mengganti kabel power.',
                'status' => 'Proses'
            ],
            [
                'user_id' => '2',
                'unit_ruangan' => 'Laboratorium',
                'nama' => 'Michael Brown',
                'media' => 'Web Pengaduan',
                'masalah' => 'CPU',
                'kategori' => 'Perangkat Keras',
                'detail_masalah' => 'CPU terlalu panas.',
                'foto' => null,
                'solusi' => 'Membersihkan kipas dan mengganti pasta termal.',
                'status' => 'Proses'
            ],
            [
                'user_id' => '2',
                'unit_ruangan' => 'Forensik',
                'nama' => 'Sarah Wilson',
                'media' => 'Telepon Ex',
                'masalah' => 'Monitor',
                'kategori' => 'Perangkat Keras',
                'detail_masalah' => 'Monitor tidak menyala.',
                'foto' => null,
                'solusi' => 'Mengganti monitor.',
                'status' => 'Proses'
            ],
            [
                'user_id' => '2',
                'unit_ruangan' => 'Fisiotherapi',
                'nama' => 'Robert Moore',
                'media' => 'Web Pengaduan',
                'masalah' => 'CPU',
                'kategori' => 'Perangkat Keras',
                'detail_masalah' => 'CPU sering restart sendiri.',
                'foto' => null,
                'solusi' => 'Memeriksa dan mengganti RAM.',
                'status' => 'Proses'
            ],
            [
                'user_id' => '2',
                'unit_ruangan' => 'Gizi',
                'nama' => 'Linda Taylor',
                'media' => 'Telepon Ex',
                'masalah' => 'Keyboard',
                'kategori' => 'Perangkat Keras',
                'detail_masalah' => 'Keyboard tidak terdeteksi.',
                'foto' => null,
                'solusi' => 'Memeriksa koneksi dan mengganti keyboard.',
                'status' => 'Proses'
            ],
            [
                'user_id' => '2',
                'unit_ruangan' => 'Marketing',
                'nama' => 'James Anderson',
                'media' => 'Web Pengaduan',
                'masalah' => 'Monitor',
                'kategori' => 'Perangkat Keras',
                'detail_masalah' => 'Monitor mati tiba-tiba.',
                'foto' => null,
                'solusi' => 'Memeriksa dan mengganti power supply monitor.',
                'status' => 'Proses'
            ],
            [
                'user_id' => '2',
                'unit_ruangan' => 'SIMRS',
                'nama' => 'Karen Thomas',
                'media' => 'Telepon Ex',
                'masalah' => 'CPU',
                'kategori' => 'Perangkat Keras',
                'detail_masalah' => 'CPU tidak mendeteksi hard drive.',
                'foto' => null,
                'solusi' => 'Memeriksa koneksi SATA dan mengganti kabel.',
                'status' => 'Proses'
            ]
        ]);
    }
}
