<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class AppraisalScore extends Model
{
    use HasFactory;

    protected $table = 'appraisals_score'; // Ganti jika tabelmu memiliki nama berbeda
    public $timestamps = false;
    protected $fillable = [
        'id',
        'min',
        'max',
        'score_value',
    ];
}
