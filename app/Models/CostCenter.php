<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CostCenter extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode',
        'coa_id',
        'nama',
    ];

    /**
     * Relationship to Coa (belongsTo)
     */
    public function coaId()
    {
        return $this->belongsTo(Coa::class, 'coa_id', 'id'); // Corrected to reference the Coa model
    }
}
