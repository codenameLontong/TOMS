<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    protected $fillable = ['nama_section', 'department_id'];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}

