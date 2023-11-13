<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class GameController extends Controller
{
    public function index(Request $request)
    {
        $games = [];

        if ($request->isMethod('post')) {
            $search = $request->get('game');
            
            $apiKey = env('RAWG_API_KEY');
            
            $response = Http::get("https://api.rawg.io/api/games?key=$apiKey&search=$search&dates=2010-01-01,2011-12-31");
            $games = $response->object()->results;
            // dd($games);
        
        }

        return view("games.index", ["games" => $games]);
    }


    public function search()
    {



        


        //dd ($response->object();)
    }
    public function add($id,Request $request)
    {
        $id;

    }
}
