<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appraisal extends Model
{
    use HasFactory;
    public $timestamps = false; // Menonaktifkan otomatis `created_at` dan `updated_at`

    protected $table = 'appraisals'; // Ganti jika tabelmu memiliki nama berbeda
    protected $fillable = [
        'id',
        'appraisal_period',
        'created_at',
        'appraisal_status',
        'id_appraisals_kategori'
    ];
}