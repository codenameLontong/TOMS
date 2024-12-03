<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pic extends Model
{
    use HasFactory;

    protected $fillable = [
        'vendor_id',
        'nama',
        'no_hp',
        'email',
        'jabatan',
    ];

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }
}
