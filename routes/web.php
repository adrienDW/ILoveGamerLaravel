<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VideoGamesController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [HomeController::class, 'index'])->name('home');

// Afficher la liste des jeux en fonction du nom saisi
Route::post('/game', [VideoGamesController::class, 'getGameByName'])->name('postGame');
Route::get('/game', [VideoGamesController::class, 'getGameByName']);

// Ajouter le jeu sélectionner aux favoris
Route::post('/video-games/add/{id}', [VideoGamesController::class, 'addFavorite']);
Route::get('/video-games/add/{id}', [VideoGamesController::class, 'addFavorite']);

// Supprimer le jeu sélectionner des favoris
Route::get('/video-games/del/{id}', [VideoGamesController::class, 'delFavorite']);


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
