<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('highlights', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_film');
            $table->string('thumbnail')->nullable(); // simpan nama/path file thumbnail
            $table->string('tagline')->nullable();
            $table->foreign('id_film')->references('id')->on('film')->onDelete('cascade'); // relasi ke tabel film
            $table->string('kategori')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('highlights');
    }
};
