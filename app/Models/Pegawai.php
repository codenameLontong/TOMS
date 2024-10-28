<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

class Pegawai extends Authenticatable
{
    use HasFactory;

        /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        // Add the global scope only when required (e.g., for login)
        if (!app()->runningInConsole() && request()->routeIs('login')) {
            static::addGlobalScope('active', function (Builder $builder) {
                $builder->where('active', 1); // Only retrieve active users
            });
        }
    }

    // Method to disable the global scope for specific queries
    public static function withoutGlobalScopeActive()
    {
        return static::withoutGlobalScope('active');
    }

    protected $fillable = [
        'nrp',
        'nrp_vendor',
        'nama',
        'coy',
        'cabang',
        'kode_cabang',
        'jabatan',
        'directorate',
        'division',
        'department',
        'section',
        'jenis_kelamin',
        'agama',
        'pendidikan',
        'status',
        'tanggal_lahir',
        'umur',
        'tanggal_masuk_tn_shn',
        'tanggal_masuk_vendor',
        'masa_kerja_tn_shn',
        'masa_kerja_vendor',
        'jenis_kontrak_kerjasama',
        'implementasi_kontrak_kerjasama',
        'vendor',
        'lokasi_kerja',
        'project_site',
        'alamat_email',
        'no_hp',
        'employment_status',
        'password'
    ];

    // Hide sensitive fields from JSON outputs
    protected $hidden = [
        'password', // Hide password from being exposed publicly
    ];

    // If you want to hash the password automatically:
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public function getAuthIdentifierName()
    {
        return 'alamat_email';
    }

    // // Helper function to format date difference in "X years Y months Z days"
    // public function formatDateDifference($startDate)
    // {
    //     $start = Carbon::parse($startDate);
    //     $now = Carbon::now();

    //     // Ensure start date is not in the future, if so, return "0 years 0 months 0 days"
    //     if ($start->greaterThan($now)) {
    //         return "0 years 0 months 0 days";
    //     }

    //     $years = $now->diffInYears($start);
    //     $months = $now->diffInMonths($start) % 12;
    //     $days = $now->diffInDays($start->addYears($years)->addMonths($months));

    //     return "$years years $months months $days days";
    // }

    // Accessor for "Umur" in years, months, and days format
    public function getUmurAttribute()
    {
        $dob = Carbon::parse($this->tanggal_lahir);
        $now = Carbon::now();
        return $dob->diff($now)->format('%y tahun %m bulan %d hari');
    }

    // Accessor for "Masa Kerja TN/SHN" in years, months, and days format
    public function getMasaKerjaTnShnAttribute()
    {
        $joinDate = Carbon::parse($this->tanggal_masuk_tn_shn);
        $now = Carbon::now();
        return $joinDate->diff($now)->format('%y tahun %m bulan %d hari');
    }

    // Accessor for "Masa Kerja Vendor" in years, months, and days format
    public function getMasaKerjaVendorAttribute()
    {
        if ($this->tanggal_masuk_vendor) {
            $joinDate = Carbon::parse($this->tanggal_masuk_vendor);
            $now = Carbon::now();
            return $joinDate->diff($now)->format('%y tahun %m bulan %d hari');
        }
        return null;
    }

    public function histories()
    {
        return $this->hasMany(PegawaiHistory::class, 'pegawai_nrp', 'nrp');
    }
}
