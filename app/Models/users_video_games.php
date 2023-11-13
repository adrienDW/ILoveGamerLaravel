<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class users_video_games extends Model
{
    use HasFactory;

    protected $fillable = [
        'users_id',
        'videoGames_id',

    ];
    public function user(){
        return $this->hasMany('App\Models\Users', 'id', 'id');
    }
    public function video_games(){
        return $this->hasMany('App\Models\video_games', 'id', 'id');
    }

}