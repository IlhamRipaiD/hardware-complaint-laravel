<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Auth\Authenticatable as AuthenticatableTrait;

class InsertModel extends Model implements Authenticatable
{
    use HasFactory, AuthenticatableTrait;

   // Menentukan nama tabel yang digunakan oleh model
   protected $table = 'pengaduan';

   // Attribut-attribut yang dapat diisi massal (mass assignable)
   protected $fillable = ['unit_ruangan', 'nama', 'media', 'masalah', 'kategori', 'detail_masalah', 'foto', 'solusi', 'status', 'created_at', 'updated_at'];

}
