<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use app\Rubrique;
use app\Http\Controllers\DashboardController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/*
    Route::get('/', function () {
        return view('welcome');
    });
*/

//Solofo : 2023-11-10
//Affiche la page d'accueil
Route::get('/', 'HomeController@index')->name('home');
//Route::get('/', [HomeController::class, 'index'])->name('home');

/**
 * Affiche le tableau de bord : cette route est protégée par le middleware auth
 * pour s'assurer que l'utilisateur est connecté avant d'accéder au tableau de bord
 */
//Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth');
//Route::get('/dashboard', 'DashboardController@index')->middleware('auth');

// Les routes de laravel/breeze

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

//require __DIR__.'/auth.php';
Route::get('/game', 'GameController@index')->middleware(['auth'])->name('game');
Route::post('/game/list', 'GameController@getListGamme')->middleware(['auth'])->name('gameList');
Route::get('/game/add/{id}', 'GameController@addGame')->middleware(['auth'])->name('gameAdd');
Route::get('/game/favorite', 'GameController@myGameFavorite')->middleware(['auth'])->name('gameFavorite');
Route::get('/game/delete/{id}', 'GameController@deleteGame')->middleware(['auth'])->name('gameDelete');


Route::get('/game', function () {
    return view('game');
})->middleware(['auth'])->name('game');


/*View::composer('index', function($view)
{
    $view->with('rubriques', Rubrique::all());
}); */
 
/*Route::get('/', function () {
 return view('index');
});*/