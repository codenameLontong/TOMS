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

            // Use `timestamps()` for `created_at` and `updated_at` fields if needed
            $table->timestamp('created_at')->useCurrent(); // Set default to current timestamp

            $table->string('appraisal_status'); // Status of the appraisal

            // Set `pegawai_fill_at` and `superior_approved_at` to allow nulls or default to current timestamp
            $table->timestamp('pegawai_fill_at')->nullable(); // Allow null if it won't be immediately filled
            $table->timestamp('superior_approved_at')->nullable(); // Allow null if it won't be immediately filled

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
