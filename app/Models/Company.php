<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = ['coy'];

    public function directorates()
    {
        return $this->hasMany(Directorate::class)->orderBy('nama_directorate', 'asc');
    }
}
