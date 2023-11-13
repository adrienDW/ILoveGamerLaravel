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
        /*Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });*/


        //Solofo 2023-11-10
        Schema::create('games', function (Blueprint $table) {

            $table->id();
            $table->string('name');
            $table->string('image_path')->nullable();
            $table->integer('idrawgapi');
            $table->text('description')->nullable();
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('games');
    }
};
