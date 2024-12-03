<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cabang extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'kode_cabang',
        'lokasi_cabang',
        'alamat_cabang',
        'is_active',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'is_active' => 'boolean',
    ];

    // Scope for active cabang
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function pegawai()
    {
        return $this->hasMany(Pegawai::class, 'cabang_id', 'id');
    }
}

