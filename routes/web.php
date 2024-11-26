<?php

use App\Http\Controllers\CommandController;
use App\Http\Controllers\EveningController;
use App\Http\Controllers\SpotController;
use App\Http\Controllers\ShowController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Command routes
Route::prefix('commands')->group(function () {
    Route::get('/{id}', [CommandController::class, 'getCommand'])->name('commands.show'); // Afficher une commande
    Route::get('/user/{mail_client}', [CommandController::class, 'getCommandsByUser'])->name('commands.user'); // Commandes par utilisateur
    Route::patch('/{id}/validate', [CommandController::class, 'patchValiderCommande'])->name('commands.validate'); // Valider une commande
    Route::post('/', [CommandController::class, 'postCreerCommande'])->name('commands.create'); // Créer une commande
});

// Evening routes
Route::prefix('evenings')->group(function () {
    Route::get('/', [EveningController::class, 'getAllDatesEvening'])->name('evenings.index'); // Lister toutes les soirées
    Route::get('/{id}', [EveningController::class, 'getEveningById'])->name('evenings.show'); // Afficher une soirée
    Route::get('/thematics', [EveningController::class, 'getAllThematics'])->name('evenings.thematics'); // Lister les thématiques
    Route::get('/{id}/places', [EveningController::class, 'getNbPlace'])->name('evenings.places'); // Nombre de places pour une soirée
});

// Spot routes
Route::prefix('spots')->group(function () {
    Route::get('/', [SpotController::class, 'getAllSpots'])->name('spots.index'); // Lister tous les spots
    Route::get('/names', [SpotController::class, 'getAllNameSpots'])->name('spots.names'); // Lister les noms des spots
});

// Show routes
Route::prefix('shows')->group(function () {
    Route::get('/', [ShowController::class, 'getShows'])->name('shows.index'); // Lister les shows
});

// User routes
Route::prefix('users')->group(function () {
    Route::get('/', [UserController::class, 'getUser'])->name('users.show'); // Afficher l'utilisateur connecté
});


