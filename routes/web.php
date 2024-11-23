<?php

use App\Http\Controllers\CommandController;
use App\Http\Controllers\EveningController;
use App\Http\Controllers\SpotController;
use App\Http\Controllers\ShowController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// Command routes
Route::prefix('commands')->group(function () {
    Route::get('/{id}', [CommandController::class, 'getCommand'])
        ->name('commands.show')
        ->uses(fn ($id) => Inertia::render('Commands/Show', ['id' => $id])); // Vue pour afficher une commande

    Route::get('/user/{mail_client}', [CommandController::class, 'getCommandsByUser'])
        ->name('commands.user')
        ->uses(fn ($mail_client) => Inertia::render('Commands/UserCommands', ['mail_client' => $mail_client])); // Vue pour les commandes utilisateur

    Route::patch('/{id}/validate', [CommandController::class, 'patchValiderCommande'])
        ->name('commands.validate')
        ->uses(fn ($id) => Inertia::render('Commands/Validate', ['id' => $id])); // Vue pour valider une commande

    Route::post('/', [CommandController::class, 'postCreerCommande'])
        ->name('commands.create')
        ->uses(fn () => Inertia::render('Commands/Create')); // Vue pour créer une commande
});

// Evening routes
Route::prefix('evenings')->group(function () {
    Route::get('/', [EveningController::class, 'getAllDatesEvening'])
        ->name('evenings.index')
        ->uses(fn () => Inertia::render('Evenings/Index')); // Vue pour lister toutes les soirées

    Route::get('/{id}', [EveningController::class, 'getEveningById'])
        ->name('evenings.show')
        ->uses(fn ($id) => Inertia::render('Evenings/Show', ['id' => $id])); // Vue pour afficher une soirée

    Route::get('/thematics', [EveningController::class, 'getAllThematics'])
        ->name('evenings.thematics')
        ->uses(fn () => Inertia::render('Evenings/Thematics')); // Vue pour les thématiques

    Route::get('/{id}/places', [EveningController::class, 'getNbPlace'])
        ->name('evenings.places')
        ->uses(fn ($id) => Inertia::render('Evenings/Places', ['id' => $id])); // Vue pour les places
});

// Spot routes
Route::prefix('spots')->group(function () {
    Route::get('/', [SpotController::class, 'getAllSpots'])
        ->name('spots.index')
        ->uses(fn () => Inertia::render('Spots/Index')); // Vue pour lister tous les spots

    Route::get('/names', [SpotController::class, 'getAllNameSpots'])
        ->name('spots.names')
        ->uses(fn () => Inertia::render('Spots/Names')); // Vue pour les noms des spots
});

// Show routes
Route::prefix('shows')->group(function () {
    Route::get('/', [ShowController::class, 'getShows'])
        ->name('shows.index')
        ->uses(fn () => Inertia::render('Shows/Index')); // Vue pour lister les shows avec filtres
});

// User routes
Route::prefix('users')->group(function () {
    Route::get('/', [UserController::class, 'getUser'])
        ->name('users.show')
        ->uses(fn () => Inertia::render('Users/Show')); // Vue pour afficher l'utilisateur connecté
});



require __DIR__.'/auth.php';
