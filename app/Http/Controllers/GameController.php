<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;

//use DB;
use App\Models\Game;
use App\Models\User;
use App\Models\UserGame;

class GameController extends Controller
{
   
    /**
     * Instantiate a new UserController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

     /**
     * Show a list of all of the application's games.
     *
     * @return Response
     */   
    public function index()
    {
        $listGames = []; //Liste des jeux
        return view('game', ["listGames" => $listGames]);       
    }

     /**
     * Show a list of all of the application's users.
     *
     * @param Request $request
     * @return Response
     * @author Solofo RAKOTONDRABE
     */
    public function getListGamme(Request $request)
    {

        $listGames = []; //Liste des jeux

        //la game recherchée
        $gameSearch = $request->input('game');

        // Récupérer toutes les données du formulaire
        //$allData = $request->all();
    
        // Vérifier si une clé 'game' de recherche existe dans les données du formulaire
        if ($request->has('game')) {

            // Interroger l'API de rawg.io            
            $apiKey     = env('API_RAWGIO_KEY');              
            $response   = Http::get("https://api.rawg.io/api/games?key=$apiKey&search=$gameSearch");       
            
            //Résultats : liste de jeux            
            $listGames  = $response->object()->results;            
        }

        return view('game', ["listGames" => $listGames]);        
    }

     /**
     * Ajoute un jeu/gamme dans la base pour l'utilisateur en cours de session.
     *
     * @param int $id l'identifiant du jeux sur rawg à insérer en base : idrawgapi = id
     * @param Request $request
     * @return Response
     * @author Solofo RAKOTONDRABE
     */ 
    public function addGame($id, Request $request)    
    {               
        // Interroger l'API de rawg.io   
        $apiKey     = env('API_RAWGIO_KEY');              
        $response   = Http::get("https://api.rawg.io/api/games/$id?key=$apiKey");       

        $results    = $response->object();        
        
        //Insert dans la table games
        $game=new Game();

        $game->name         = $results->name; 
        $game->image_path   = $results->background_image;
        $game->description  = $results->description;
        $game->idrawgapi    = $results->id;
        $game->save();


       /* $insert = DB::table('game')->insertGetId([
            'name'          => $results->name,
            'image_path'    => $results->background_image,
            'description'   => $results->description,
            'idrawgapi'     => $results->id,
        ]);*/

       // dd($insert); // nous retourne : 4

        //Insert dans la table user_games
        $userGame = new UserGame();
        $userGame->user_id  = auth()->user()->id; // Supposons que l'utilisateur actuel est connecté
        $userGame->game_id  = $game->id;
        $userGame->save();       
        
        //On redirige l'utilisateur sur la liste des favorites
        return redirect()->action([GameController::class, 'myGameFavorite']);
    }    

     /**
     * Affiche la liste de mes jeux favoris
     *
     * @param Request $request
     * @return Response
     * @author Solofo RAKOTONDRABE
     */ 
    public function myGameFavorite(Request $request)    
    {
        $listGames = []; //Liste des jeux

        // Utilisateur en cours
        $user = Auth::user();

        // Récupérer tous les jeux associés à l'utilisateur en cours
        $listGames = $user->games;
        
        // Vous pouvez également récupérer toutes les informations de la table 'game' en utilisant le modèle Game
        // $allGames = Game::all();

        return view('game', ["listGameFavorites" => $listGames]);  
   
    }

     /**
     * Supprime le jeux de ma liste de mes jeux favoris
     *
     * @param int $id, l'identifiant du jeux à supprimer
     * @param Request $request
     * @return Response
     * @author Solofo RAKOTONDRABE
     */
    public function deleteGame($id, Request $request)    
    {
        
        //Recherche le jeux selon son $id
        $game = Game::find($id);
        
        if($game) {

            // Supprimer le jeu et les associations en cascade
            $game->deleteGameById($id);
            //return "Le game a été supprimé avec succès.";
        } else {
            return "Game non trouvé.";
        }
  
        //On redirige l'utilisateur sur la liste des favorites
        return redirect()->action([GameController::class, 'myGameFavorite']);
    }    

     /**
     * Affiche la liste de mes jeux favoris : fonction globale
     *
     * @param User $user : l'utilisateur donnée
     * @return Response
     * @author Solofo RAKOTONDRABE
     */
    public function deleteAllGames(User $user)
    {
        // Utilisez la méthode detach pour supprimer tous les jeux associés à l'utilisateur
        $user->games()->detach();
        
        return redirect()->action([GameController::class, 'myGameFavorite']);
    }

}
