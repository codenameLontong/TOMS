<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('appraisals_employee', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->unsignedBigInteger('id_appraisal'); // Foreign key to appraisals table
            $table->unsignedBigInteger('pegawai_id'); // Foreign key to employees table, or another appropriate table
            $table->string('appraisal_period'); // Appraisal period
            $table->timestamp('created_at'); // Created at timestamp
            $table->string('appraisal_status'); // Status of the appraisal
            $table->timestamp('pegawai_fill_at'); // Timestamp when filled by employee
            $table->timestamp('superior_approved_at'); // Timestamp when approved by superior
            $table->integer('rata_rata')->nullable(); // Average rating (adjust scale as necessary)
            $table->string('nilai_final')->nullable(); // Final score (adjust scale as necessary)

            // Foreign key constraints (adjust referenced table names as needed)
            $table->foreign('id_appraisal')
                  ->references('id')
                  ->on('appraisals')
                  ->onDelete('cascade'); // Cascade delete if an appraisal is deleted

            $table->foreign('pegawai_id')
                  ->references('id')
                  ->on('pegawais') // Change 'employees' to the actual related table
                  ->onDelete('cascade'); // Cascade delete if an employee is deleted
        });
    }

    public function down()
    {
        Schema::dropIfExists('appraisals_employee');
    }
};
