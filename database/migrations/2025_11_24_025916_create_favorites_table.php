<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
{
    Schema::create('favorites', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('id_user');
        $table->unsignedBigInteger('id_film');
        $table->timestamps();

        $table->unique(['id_user', 'id_film']); 
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('favorites');
    }
};
