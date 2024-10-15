<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PegawaiHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'pegawai_nrp',  // Use `pegawai_nrp` instead of `pegawai_id`
        'action_type',
        'description',
        'user_id',
        'action_date',
    ];

    // Relationship to the Pegawai model, using `pegawai_nrp` to match `nrp` in Pegawai
    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'pegawai_nrp', 'nrp');
    }

    // Relationship to the User model to fetch the user who performed the action
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    protected $casts = [
        'action_date' => 'datetime',
    ];
}
