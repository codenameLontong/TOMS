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
        Schema::create('overtime_reason_orders', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Insert the predefined data
        DB::table('overtime_reason_orders')->insert([
            ['title' => 'Closing', 'is_active' => true],
            ['title' => 'Work Overload', 'is_active' => true],
            ['title' => 'Emergency Work', 'is_active' => true],
            ['title' => 'Project Deadline', 'is_active' => true],
            ['title' => 'Head Request', 'is_active' => false],
            ['title' => 'Customer Request', 'is_active' => false],
            ['title' => 'Work Order TRS', 'is_active' => false],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('overtime_reason_orders');
    }
};
