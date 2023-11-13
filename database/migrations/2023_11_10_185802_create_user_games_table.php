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
        Schema::create('user_games', function (Blueprint $table) {
            $table->id();

            // Clés étrangères
            //$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            //$table->foreign('game_id')->references('id')->on('games')->onDelete('cascade');

            $table->foreignId('user_id')
                    ->constrained( table: 'users', indexName: 'user_games_user_id' )            
                    ->onUpdate('cascade')
                    ->onDelete('cascade');

            $table->foreignId('game_id')
                    ->constrained( table: 'games', indexName: 'user_games_game_id' )            
                    ->onUpdate('cascade')
                    ->onDelete('cascade');

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_games');
    }
};
