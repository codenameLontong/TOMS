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
            $table->enum('coy', ['TN', 'SHN']);
            $table->enum('cabang', [
                'BANDAR LAMPUNG', 'BANDUNG', 'BANJARMASIN', 'JAKARTA', 'JAMBI', 'JAYAPURA',
                'MAKASSAR', 'MEDAN', 'PALEMBANG', 'PADANG', 'PEKANBARU', 'PONTIANAK',
                'SAMARINDA', 'SAMPIT', 'SEMARANG', 'SURABAYA'
            ]);
            $table->string('jabatan');
            $table->enum('directorate', [
                'Branch Support and Improvement', 'Corporate Procurement',
                'Finance and Administration', 'Human Capital & Sustainability',
                'Marketing & Sales', 'Material Handling Business',
                'Power, Agro and Construction Business'
            ]);
            $table->enum('division', [
                'Branch Support and Improvement', 'Corporate Procurement',
                'Finance, Accounting, Taxes and IT', 'Human Capital, SSEHS and General Affair',
                'Marketing', 'Material Handling Sales and Marketing',
                'Product Support', 'Rental Marketing and Business Controller',
                'Rental, FG Wilson and Genset Center'
            ]);
            $table->string('department');
            $table->enum('jenis_kelamin', ['MALE', 'FEMALE']);
            $table->enum('agama', ['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Khonghucu']);
            $table->enum('pendidikan', ['SD', 'SMP', 'SLTP', 'SMA', 'SMK', 'S1', 'D1', 'D3', 'D4']);
            $table->enum('status', ['TK', 'K1', 'K2', 'K3', 'K4', 'K5']); // keep this 'status' enum column
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
