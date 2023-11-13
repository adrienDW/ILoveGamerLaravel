<?php

namespace App\Http\Controllers;

use App\Models\users_video_games;
use App\Models\video_games;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Collection;

class HomeController extends Controller
{
    public function index(){
        $user = Auth::user();
        // $favs = users_video_games::where('users_id',$user->id)->get();
        // $favs = video_games::where('users_id',$user->id)->get();
        // dd($user->videoGames()->get());
        // dd($favs);
        // $favsTab = $favs->all();
        
        // return view('home', compact('user', 'favs'));
        if($user != null){
            return view('home')
            ->with('UsersVideos',$user->videoGames()->get())
            ->with('user',$user)    
        ;
        }else{
            return view('home');
        }
        
    }
    public function getGameByName(Request $request){
        $nameGame = $request->get('nameGame');
        // $nameGame = Request::input('nameGame');
        $key = 'bb3ab1cea0ff4dd5a74c621ad9cea8f3';
        $response = Http::get('https://api.rawg.io/api/games?key='.$key.'&search='.$nameGame);
        $result = $response->object();
        return redirect('/');
    }
}
