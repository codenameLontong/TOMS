<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CostCenter;

class MappingCostCenter extends Model
{
    use HasFactory;

    protected $fillable = [
        'cost_center_id',
        'department_id',
        'section_id',
    ];

    public function costCenter()
    {
        return $this->belongsTo(CostCenter::class, 'cost_center_id');
    }
}
