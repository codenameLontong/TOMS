<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('pegawais', function (Blueprint $table) {
            $table->id();
            $table->string('nrp')->unique();
            $table->string('nrp_vendor')->nullable();
            $table->string('nama');
            $table->string('coy');
            $table->string('cabang');
            $table->string('jabatan');
            $table->string('directorate');
            $table->string('division');
            $table->string('department');
            $table->string('section')->nullable();
            $table->enum('jenis_kelamin', ['PRIA', 'PEREMPUAN']);
            $table->enum('agama', ['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Khonghucu']);
            $table->enum('pendidikan', ['SD/Sederajat', 'SMP/Sederajat', 'SMA/Sederajat', 'S1', 'D1', 'D2', 'D3', 'D4']);
            $table->enum('status', ['TK', 'K0','K1', 'K2', 'K3', 'K4', 'K5']); // keep this 'status' enum column
            $table->date('tanggal_lahir');
            $table->string('umur')->nullable(); // Calculated field
            $table->date('tanggal_masuk_tn_shn');
            $table->date('tanggal_masuk_vendor')->nullable();
            $table->string('masa_kerja_tn_shn')->nullable(); // Calculated field
            $table->string('masa_kerja_vendor')->nullable(); // Calculated field
            $table->enum('jenis_kontrak_kerjasama', ['LABOUR SUPPLY', 'JOB SUPPLY']);
            $table->enum('implementasi_kontrak_kerjasama', ['LABOUR SUPPLY', 'JOB SUPPLY']);
            $table->string('vendor');
            $table->string('lokasi_kerja');
            $table->string('project_site')->nullable();
            $table->string('alamat_email')->unique();
            $table->string('no_hp');
            $table->string('employment_status')->default('active'); // renamed 'status' to 'employment_status'
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pegawais');
    }
};
