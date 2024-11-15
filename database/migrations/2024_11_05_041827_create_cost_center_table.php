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
        Schema::create('cost_centers', function (Blueprint $table) {
            $table->id();
            $table->string('kode')->unique(); // Unique identifier for cost center
            $table->unsignedBigInteger('coa_id'); // Foreign key reference to COA
            $table->string('nama'); // Name of the Cost Center
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('coa_id')->references('id')->on('coas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cost_center');
    }
};
