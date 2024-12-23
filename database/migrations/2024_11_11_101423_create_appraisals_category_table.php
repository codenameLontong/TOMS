<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('appraisals_category', function (Blueprint $table) {
            $table->id();  // Automatically creates an `unsignedBigInteger` primary key
            $table->string('title');
            $table->string('description');
            $table->boolean('isactive')->default(1);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('appraisals_category');
    }
};
