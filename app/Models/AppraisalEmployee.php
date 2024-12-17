<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Appraisal;
use App\Models\Pegawai;
use App\Models\AppraisalItem;

class AppraisalEmployee extends Model
{
    use HasFactory;
    public $timestamps = false; // Menonaktifkan otomatis `created_at` dan `updated_at`

    protected $table = 'appraisals_employee'; // Ganti jika tabelmu memiliki nama berbeda
    protected $fillable = [
        'id',
        'id_appraisal',
        'pegawai_id',
        'appraisal_period',
        'created_at',
        'appraisal_status',
        'pegawai_fill_at',
        'superior_approved_at',
        'rata_rata',
        'nilai_final'

    ];

    public function appraisal()
    {
        return $this->belongsTo(Appraisal::class, 'id_appraisal');
    }

    // Define relationship with Pegawai
    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'pegawai_id');
    }

    public function appraisalItems()
    {
        return $this->hasMany(AppraisalItem::class, 'id_appraisals_employee');
    }
}
