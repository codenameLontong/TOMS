<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OvertimeReasonOrder extends Model
{
    use HasFactory;

    // Define the table name if it doesn't follow Laravel's naming convention
    protected $table = 'overtime_reason_orders'; 

    // Define which fields are mass-assignable
    protected $fillable = ['title', 'is_active'];
}
