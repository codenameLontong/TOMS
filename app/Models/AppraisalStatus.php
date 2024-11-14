<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppraisalStatus extends Model
{
    use HasFactory;

    protected $table = 'appraisal_status'; // Ganti jika tabelmu memiliki nama berbeda
    public $timestamps = false;
    protected $fillable = [
        'id',
        'status'
    ];
}
