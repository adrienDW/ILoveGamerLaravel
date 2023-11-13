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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('role');
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('video_games', function(Blueprint $table){
            $table->id();
            $table->string('name');
            $table->string('img');
            $table->integer('id_api');
            $table->timestamps();
        });

        Schema::create('users_video_games', function(Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('users_id')->unsigned();
            $table->unsignedBigInteger('videoGames_id')->unsigned();
            $table->foreign('users_id')->references('id')->on('users')->onDelete(('cascade'));
            $table->foreign('videoGames_id')->references('id')->on('video_games')->onDelete(('cascade'));
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('video_games');
        Schema::dropIfExists('users_video_games');
    }
};
