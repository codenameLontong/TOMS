<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendors', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('kode_vendor')->unique(); // Kode Vendor
            $table->string('nama_vendor'); // Nama Vendor
            $table->enum('astra_non_astra', ['Astra', 'Non Astra']); // Astra or Non Astra
            $table->boolean('is_active')->default(true); // Is Active
            $table->timestamps(); // created_at and updated_at columns
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vendors');
    }
}

