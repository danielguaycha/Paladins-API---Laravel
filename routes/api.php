<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//Game Data
Route::get('/data/{type}', 'InitController@getData');
// Player data
Route::get('/champ-ranks/{nick}', 'InitController@getChampRanks');
Route::get('/player/friends/{nick}', 'InitController@getfriends');
Route::get('/player/stats/{nick}/{queue}', 'InitController@getPlayerStats');
Route::get('/player/{nick}/', 'InitController@getPlayer');
Route::get('/player/data/{player_id}/', 'InitController@getPlayerData'); // id = 10561387
Route::get('/player/status/{player}/', 'InitController@getPlayerStatus');
Route::get('/player/loadouts/{player_id}/', 'InitController@getPlayerLoadOuts');
//Champions Data

Route::get('/champion/{name}', 'ChampionController@view'); //local for vue
Route::get('/champions', 'InitController@getChamps'); //Api
Route::get('/champions/cards/{champ_id}', 'InitController@getChampionsCards'); //Api
Route::get('/champions/{champ_id}/{queue}/list', 'InitController@getChampionLeaderboard'); //Api


Route::get('/champs', 'InitController@getChampions');
Route::get('/items', 'InitController@getItems');

// Matches Data
Route::get('/matches/{nick}', 'InitController@getMatches');
Route::get('/matches/detail/{id}', 'InitController@getMatchById');
Route::get('/matches/players/{match_id}', 'InitController@getMatchPlayerDetails'); //238326797
Route::get('/matches/join/{matches}', 'InitController@getMatchBatch'); // match_id,match_id,match_id ....
// Season Data
Route::get('/season-data', 'InitController@getSessionData');
Route::get('/season/{queue}', 'InitController@getLeagueSeasons');
Route::get('/motd', 'InitController@getMotd');
//LeaderBoard
Route::get('/leaderboard/{queue}/{rank}/{season}', 'InitController@getLeaderBoard');

// items
Route::post('/items/update', 'ItemsController@update');
Route::post('/items', 'ItemsController@store');
Route::get('/items/exist', 'ItemsController@getExist');

// vue ui
Route::get('/champions/all', 'ChampionController@json_view');
