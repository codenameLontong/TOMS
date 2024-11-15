<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('appraisals', function (Blueprint $table) {
            $table->id(); // This is the `id` column
            $table->string('appraisal_period'); // For `appraisal_period` field, adjust type as necessary
            $table->timestamp('created_at'); // This field can be nullable if timestamps are disabled
            $table->string('appraisal_status'); // Adjust type as necessary
            $table->string('id_appraisals_kategori'); // Foreign key, adjust related table name as needed

            // Additional indices or constraints can go here
        });
    }

    public function down()
    {
        Schema::dropIfExists('appraisals');
    }
};
