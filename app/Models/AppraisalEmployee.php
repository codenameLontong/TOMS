<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppraisalEmployee extends Model
{
    use HasFactory;
    public $timestamps = false; // Menonaktifkan otomatis `created_at` dan `updated_at`

    protected $table = 'appraisals_employee'; // Ganti jika tabelmu memiliki nama berbeda
    protected $fillable = [
        'id',
        'id_appraisal',
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