<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    /**
     * Liste tous les utilisateurs qui ont choisi ce jeu.
     *
     * @param null
     * @return tableau d'utilisateurs
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_games', 'game_id', 'user_id');
    }

    /**
     * Supprime un jeu en fonction de son ID.
     *
     * @param int $gameId L'ID du jeu à supprimer.
     * @return bool|null
     */
    public static function deleteGameById($gameId) : bool
    {
        // Utilise la méthode `find` pour récupérer le modèle du jeu en fonction de l'ID.
        $game = self::find($gameId);

        if ($game) {
            // Supprime le jeu.
            return $game->delete();
        }

        return false;
    }
}
