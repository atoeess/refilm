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
                ->references('id')
                ->on('negara')
                ->onDelete('cascade');

            $table->text('sinopsis')->nullable();
            $table->string('trailer')->nullable(); // bisa untuk link YouTube misalnya
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
