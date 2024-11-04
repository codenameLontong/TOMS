<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Directorate extends Model
{
    protected $fillable = ['nama_directorate', 'company_id'];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function divisions()
    {
        return $this->hasMany(Division::class)->orderBy('nama_division', 'asc');
    }
}
