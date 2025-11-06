<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('highlights', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_film')->constrained('film')->onDelete('cascade');
            $table->string('tagline')->nullable(); // Contoh: "Film Populer Minggu Ini"
            $table->boolean('is_active')->default(true); // Bisa nonaktifin highlight
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('highlights');
    }
};
