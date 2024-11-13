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
            $table->integer('min'); // Minimum score
            $table->integer('max'); // Maximum score
            $table->string('score_value'); // The score value, stored as decimal (adjust precision as needed)
        });
    }

    public function down()
    {
        Schema::dropIfExists('appraisals_score');
    }
};
