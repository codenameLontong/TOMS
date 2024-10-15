<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if (!Schema::hasTable('pegawai_histories')) {
            Schema::create('pegawai_histories', function (Blueprint $table) {
                $table->id();
                $table->string('pegawai_nrp');  // Use pegawai_nrp instead of pegawai_id
                $table->string('action_type');
                $table->text('description')->nullable();
                $table->unsignedBigInteger('user_id'); // Assuming a user model exists
                $table->timestamp('action_date')->nullable();
                $table->timestamps();

                // Foreign key reference to pegawais table based on nrp
                $table->foreign('pegawai_nrp')->references('nrp')->on('pegawais')->onDelete('cascade');
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('pegawai_histories');
    }
};
