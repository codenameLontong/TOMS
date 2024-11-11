<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('coa', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('type_coa_id'); // Foreign key reference to Type COA
            $table->string('name'); // COA name or details
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('type_coa_id')->references('id')->on('type_coa')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coa');
    }
};
