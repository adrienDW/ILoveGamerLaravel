<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
     /**
     * Affiche la page d'accueil
     *
     * @param Request $request
     * @return Response
     * @author Solofo RAKOTONDRABE
     */
    public function index(Request $request)
    {   //ex: name passé en paramètre
        //$name = $request->get(key: 'name');     
        return view('home');
    }
}
