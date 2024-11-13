<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('appraisals_item', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->unsignedBigInteger('id_appraisals_employee'); // Foreign key to appraisals_employee table
            $table->unsignedBigInteger('id_appraisals_kategori'); // Foreign key to appraisals_category table
            $table->integer('pegawai_score')->nullable(); // Employee's score, decimal field (adjust precision as needed)
            $table->integer('final_score_bysuperior')->nullable(); // Final score by superior (adjust precision as needed)

            // Foreign key constraints
            $table->foreign('id_appraisals_employee')
                  ->references('id')
                  ->on('appraisals_employee')
                  ->onDelete('cascade'); // Cascade delete if related appraisal employee record is deleted

            $table->foreign('id_appraisals_kategori')
                  ->references('id')
                  ->on('appraisals_category')
                  ->onDelete('cascade'); // Cascade delete if related appraisal category record is deleted
        });
    }

    public function down()
    {
        Schema::dropIfExists('appraisals_item');
    }
};
