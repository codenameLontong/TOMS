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
        Schema::table('overtime', function (Blueprint $table) {
            $table->unsignedBigInteger('deleted_by')->nullable(); // New column
            $table->date('deleted_at')->nullable(); // New column
            $table->boolean('is_deleted')->default(false); // New column
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('overtime', function (Blueprint $table) {
            $table->dropColumn('deleted_by'); // Remove column
            $table->dropColumn('deleted_at'); // Remove column
            $table->dropColumn('is_deleted'); // Remove column
        });
    }
};
