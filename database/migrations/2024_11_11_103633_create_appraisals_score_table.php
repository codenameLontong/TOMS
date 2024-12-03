<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('appraisals_score', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->decimal('min', 3, 2); // Minimum score with precision (3 digits total, 2 decimals)
            $table->decimal('max', 3, 2); // Maximum score with precision
            $table->string('score_value'); // The score value, stored as string
        });
    }

    public function down()
    {
        Schema::dropIfExists('appraisals_score');
    }
};
