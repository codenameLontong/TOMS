<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coa extends Model
{
    use HasFactory;

    protected $fillable = [
        'type_coa', // Fillable field for type_coa
    ];

    /**
     * Relationship to CostCenter (One-to-Many)
     */
    public function costCenters()
    {
        return $this->hasMany(CostCenter::class, 'coa_id', 'id'); // Correct relationship
    }
}
