<?php

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

Route::prefix('user')->group(function(){
    Route::get('/', [UserController::class, 'getUser'])->name('getUser');
});

Route::prefix('auth')->group(function(){
    Route::post('signin', [AuthController::class, 'signin'])->name('signin');
    Route::post('signup', [AuthController::class, 'signup'])->name('signup');
    Route::post('refresh', [AuthController::class, 'refresh'])->name('refresh');
});


// return function (\Slim\App $app) {

//     $JwtVerification = new Jwt($app->getContainer()->get('AuthService'));

//     $app->options('/{routes:.+}', function ($request, $response) {
//         return $response;
//     });

//     $app->get('/shows[/]', GetShowsAction::class)->setName('getShows');

//     $app->get('/evening/{id}[/]', GetEveningByIdAction::class)->setName('getEveningById');

//     $app->get('/thematics_evening[/]', GetAllThematicAction::class)->setName('getAllThematic');

//     $app->get('/dates_evening[/]', GetAllDatesEveningAction::class)->setName('getAllDatesEvening');

//     $app->get('/spots_evening[/]', GetAllSpotsAction::class)->setName('getAllSpotsEvening');

//     $app->get('/name_spots[/]', GetAllNameSpotsAction::class)->setName('getAllNameSpots');

//     $app->get('/places/{id}[/]', GetNbPlaceAction::class)->setName('getNbPlace');

//     $app->get('/command/{id}[/]', \festochshop\shop\app\action\shop\GetCommandAction::class);

//     $app->post('/commands[/]', \festochshop\shop\app\action\shop\PostCreerCommandeAction::class);

//     $app->patch('/commands/{id_command}[/]', PatchValiderCommandeAction::class)->setName('patch_commandes');

//     $app->get('/user/commands/{mail_client}[/]', \festochshop\shop\app\action\shop\GetCommandByUser::class)->setName('commandsUser');

//     $app->get('/user[/]', \festochshop\shop\app\action\shop\GetUserAction::class)->setName('getUser')->add($JwtVerification);



//     // AUTH

//     $app->post('/auth/signin[/]', PostAuthSigninAction::class)->setName('postAuthSignin');

//     $app->post('/auth/signup[/]', PostAuthSignupAction::class)->setName('postAuthSignup');

//     $app->post('/refresh[/]', PostRefreshAction::class)->setName('postRefresh');

// };

require __DIR__.'/auth.php';
