<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TanggapanModel extends Model
{
    use HasFactory;
    // Menentukan nama tabel yang digunakan oleh model
   protected $table = 'tanggapan';

   // Attribut-attribut yang dapat diisi massal (mass assignable)
   protected $fillable = ['unit_ruangan', 'nama', 'feedback', 'kritik_saran','created_at'];
}
