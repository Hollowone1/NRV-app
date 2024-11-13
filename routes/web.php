<?php

use App\Http\Controllers\CommandController;
use App\Http\Controllers\EveningController;
use App\Http\Controllers\PlaceController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


Route::prefix('evenings')->group(function(){
    Route::get('{id}, /' , [EveningController::class, 'getEveningById'])->name('getEveningById');
    Route::get('dates', [EveningController::class, 'getAllDatesEvening'])->name('getAllDatesEvening');
    Route::get('spots', [EveningController::class, 'getAllSpotsEvening'])->name('getAllSpotsEvening');
    Route::get('thematics', [EveningController::class, 'getAllThematicEvening'])->name('getAllThematicEvening');
});

Route::prefix('places')->group(function(){
    Route::get('{id}', [PlaceController::class, 'getNumberPlace'])->name('getNumberPlace');
});

Route::prefix('commands')->group(function(){
    Route::get('{id}', [CommandController::class, 'getCommandById'])->name('getCommandById');
    Route::post('/', [CommandController::class, 'createCommand'])->name('createCommand');
    Route::patch('{id}', [CommandController::class, 'validateCommand'])->name('validateCommand');
    Route::get('user/{mail}', [CommandController::class, 'getCommandByUser'])->name('getCommandByUser');
});
    

Route::prefix('auth')->group(function(){
    Route::get('/', [ProfileController::class, 'getUser'])->name('getUser');
    Route::post('signin', [ProfileController::class, 'signin'])->name('signin');
    Route::post('signup', [ProfileController::class, 'signup'])->name('signup');
    Route::post('refresh', [ProfileController::class, 'refresh'])->name('refresh');
});

require __DIR__.'/auth.php';
