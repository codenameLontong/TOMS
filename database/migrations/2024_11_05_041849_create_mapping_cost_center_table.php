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
        Schema::create('mapping_cost_centers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cost_center_id'); // Foreign key reference to Cost Center
            $table->unsignedBigInteger('department_id'); // Foreign key reference to Department
            $table->unsignedBigInteger('section_id')->nullable(); // Allow NULL values for Section
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('cost_center_id')->references('id')->on('cost_centers')->onDelete('cascade');
            // $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');
            // $table->foreign('section_id')->references('id')->on('sections')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mapping_cost_center');
    }
};
