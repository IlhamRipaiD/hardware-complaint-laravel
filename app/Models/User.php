<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticatableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Post;
use Illuminate\Database\Eloquent\Relations\HasMany; // Perbaikan namespace


class User extends Model implements Authenticatable
{
    use HasFactory, AuthenticatableTrait;

    // Attribut-atribut yang dapat diisi massal (mass assignable)
    protected $fillable = [
        'email', 'password', 'role', 'active',
    ];

    // Attribut-atribut yang harus disembunyikan
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function riwayatPengaduan(): HasMany
    {
        return $this->hasMany(InsertModel::class, 'user_id');
    }
 
}
