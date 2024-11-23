<?php

use App\Http\Controllers\CommandController;
use App\Http\Controllers\EveningController;
use App\Http\Controllers\SpotController;
use App\Http\Controllers\ShowController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::prefix('commands')->group(function () {
    Route::get('/{id}', [CommandController::class, 'getCommand'])->name('commands.show'); 
    Route::get('/user/{mail_client}', [CommandController::class, 'getCommandsByUser'])->name('commands.user'); 
    Route::patch('/{id}/validate', [CommandController::class, 'patchValiderCommande'])->name('commands.validate');
    Route::post('/', [CommandController::class, 'postCreerCommande'])->name('commands.create');
});


Route::prefix('evenings')->group(function () {
    Route::get('/', [EveningController::class, 'getAllDatesEvening'])->name('evenings.index'); 
    Route::get('/{id}', [EveningController::class, 'getEveningById'])->name('evenings.show');
    Route::get('/thematics', [EveningController::class, 'getAllThematics'])->name('evenings.thematics'); 
    Route::get('/{id}/places', [EveningController::class, 'getNbPlace'])->name('evenings.places'); 
});


Route::prefix('spots')->group(function () {
    Route::get('/', [SpotController::class, 'getAllSpots'])->name('spots.index'); 
    Route::get('/names', [SpotController::class, 'getAllNameSpots'])->name('spots.names'); 
});


Route::prefix('shows')->group(function () {
    Route::get('/', [ShowController::class, 'getShows'])->name('shows.index'); 
});


Route::prefix('users')->group(function () {
    Route::get('/', [UserController::class, 'getUser'])->name('users.show'); 
});


require __DIR__.'/auth.php';
