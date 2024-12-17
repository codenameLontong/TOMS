<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\AppraisalEmployee;

class AppraisalItem extends Model
{
    use HasFactory;
    public $timestamps = false; // Menonaktifkan otomatis `created_at` dan `updated_at`

    protected $table = 'appraisals_item'; // Ganti jika tabelmu memiliki nama berbeda
    protected $fillable = [
        'id',
        'id_appraisals_employee',
        'id_appraisals_kategori',
        'pegawai_score',
        'final_score_bysuperior'
    ];

    public function appraisalEmployee()
    {
        return $this->belongsTo(AppraisalEmployee::class, 'id_appraisals_employee');
    }
}
