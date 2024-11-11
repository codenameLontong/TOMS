<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class AppraisalCategory extends Model
{
    use HasFactory;

    protected $table = 'appraisals_category'; // Ganti jika tabelmu memiliki nama berbeda
    public $timestamps = false;
    protected $fillable = [
        'id',
        'title',
        'description',
        'isactive',
    ];
}
