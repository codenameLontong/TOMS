<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appraisal extends Model
{
    use HasFactory;

    protected $table = 'appraisals'; // Ganti jika tabelmu memiliki nama berbeda
    protected $fillable = [
        'id',
        'id_pegawai',
        'appraisal_period',
        'created_at',
        'appraisal_status',
        'pegawai_fill_at',
        'superior_approved_at',
        'rata_rata',
        'nilai_final'
    ];
}