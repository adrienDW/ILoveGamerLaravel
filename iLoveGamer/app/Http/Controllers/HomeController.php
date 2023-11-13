<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    public function index()
    {
        return view("dashboard");
    }

    public function search(Request $request)
    {
        $search = $request->get("search");

        $response = Http::get("https://api.rawg.io/api/games?key=" . "320936eb892d49cea0ef502ce752b61a" . "&search=" . $search);
        dd($response->object()->results);
        $result = $response->object()->results;
    }
}
