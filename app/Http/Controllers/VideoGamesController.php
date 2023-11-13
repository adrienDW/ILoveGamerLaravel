<?php

namespace App\Http\Controllers;

use App\Models\users_video_games;
use Illuminate\Http\Request;
use App\Models\video_games;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;



class VideoGamesController extends Controller
{
    public function getGameByName(Request $request){
        $nameGame = $request->get('nameGame');
        $key = 'bb3ab1cea0ff4dd5a74c621ad9cea8f3';
        $response = Http::get('https://api.rawg.io/api/games?key='.$key.'&search='.$nameGame);
        $result = $response->object()->results;
        // dd($result);
        return view('listOfGames', compact('result'));
    }

    public function addFavorite(int $id){
        $user = Auth::user();
        $exist = video_games::where('id_api', $id)->get()->first();
        $pivot = new users_video_games();
        $key = 'bb3ab1cea0ff4dd5a74c621ad9cea8f3';
        $response = Http::get("https://api.rawg.io/api/games/".$id."?key=".$key);
        $result = $response->object();
        $game = new video_games();
        $game->name = $result->name;
        $game->img = $result->background_image;
        $game->id_api = $result->id;
        $pivot->users_id = $user->id;


        if($exist == null){
            echo "le jeu n'existe pas";
            $game->save();
            $pivot->videoGames_id = $game->id;
        }elseif($exist->id > 0){
            echo "le jeu existe";
            $pivot->videoGames_id = $exist->id;
        }
        $pivot->save();

        return redirect('/');
    }

    public function delFavorite(int $id){
    $user = Auth::user();
    $favToDelete = DB::table('users_video_games')
                    ->where('users_id', $user->id)
                    ->where('videoGames_id', $id)
                    ->delete();
    return redirect('/');
    
    }
}

