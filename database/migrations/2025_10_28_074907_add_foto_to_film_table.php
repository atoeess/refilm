<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Kosongkan atau tambahkan perubahan lain yang dibutuhkan
        Schema::table('film', function (Blueprint $table) {
            // misalnya nanti tambahkan kolom lain, tapi bukan 'foto'
        });
    }

    public function down(): void
    {
        Schema::table('film', function (Blueprint $table) {
            // kosongkan juga untuk mencegah error rollback
        });
    }
};
