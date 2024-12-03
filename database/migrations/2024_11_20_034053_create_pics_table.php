<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pics', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->unsignedBigInteger('vendor_id'); // Foreign key to vendors table
            $table->string('nama'); // PIC name
            $table->string('no_hp'); // PIC phone number
            $table->string('email'); // PIC email
            $table->string('jabatan'); // PIC position
            $table->timestamps(); // Created and updated timestamps

            // Define foreign key constraint
            $table->foreign('vendor_id')->references('id')->on('vendors')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pics');
    }
}

