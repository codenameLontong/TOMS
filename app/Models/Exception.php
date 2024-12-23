<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exception extends Model
{
    use HasFactory;

    protected $table = 'exceptions';

    protected $fillable = [
        'holiday_date',
        'note'
    ];
}
