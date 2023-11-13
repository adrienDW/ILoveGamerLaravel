<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class video_games extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'img',
        'id_api',
    ];

    public function users(): BelongsToMany{
        return $this->belongsToMany(Users::class);

    }
}
