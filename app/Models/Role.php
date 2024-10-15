<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    // If the table is named 'roles', you don't need to specify it, but if it's different:
    protected $table = 'roles';

    // Mass assignable attributes
    protected $fillable = ['name'];

    /**
     * Define any relationships here if necessary.
     * For example, if a Role belongs to Users:
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
