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
        Schema::create('film', function (Blueprint $table) {
            $table->id();
            $table->string('foto')->nullable();
            $table->string('judul');
            $table->string('deskripsi')->nullable();
            $table->integer('tahun')->nullable();

            $table->foreignId('id_negara')
                ->constrained('negara')
                ->onDelete('cascade');

            // 👇 diubah: boleh NULL biar gak error saat insert tanpa genre
            $table->foreignId('genre_id')
                ->nullable()
                ->constrained('genres')
                ->onDelete('set null');

            $table->text('sinopsis')->nullable();
            $table->string('trailer')->nullable();
            $table->string('slug')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('film');
    }
};
