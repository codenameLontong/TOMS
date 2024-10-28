<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    protected $fillable = ['nama_division', 'directorate_id'];

    public function directorate()
    {
        return $this->belongsTo(Directorate::class);
    }

    public function departments()
    {
        return $this->hasMany(Department::class);
    }
}
