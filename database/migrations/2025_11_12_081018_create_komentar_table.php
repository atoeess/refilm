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
        Schema::create('komentar', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_user')
                ->nullable()
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->foreignId('id_film')
                ->nullable()
                ->references('id')
                ->on('film')
                ->onDelete('cascade');

            $table->string('isi_komentar');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('komentar');
    }
};
