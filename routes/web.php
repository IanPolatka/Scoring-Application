<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::get('/api/years', 'YearsController@showall');




//  Years
Route::get('/years', 'YearsController@index');

Route::get('years/create', 'YearsController@create');
Route::post('years/', 'YearsController@store');

Route::get('/years/{year}/edit', 'YearsController@edit');
Route::patch('/years/{year}', 'YearsController@update');

Route::get('years/{year}', 'YearsController@show');
Route::delete('years/{year}', 'YearsController@delete');



//  Game Times
Route::get('/times', 'TimesController@index');

Route::get('times/create', 'TimesController@create');
Route::post('times/', 'TimesController@store');

Route::get('/times/{time}/edit', 'TimesController@edit');
Route::patch('/times/{time}', 'TimesController@update');

Route::get('times/{time}', 'TimesController@show');
Route::delete('times/{time}', 'TimesController@delete');



//  Teams
Route::get('/teams', 'TeamsController@index');

Route::get('/teams/create', 'TeamsController@create');
Route::post('/teams/', 'TeamsController@store');

Route::get('/teams/{team}/edit', 'TeamsController@edit');
Route::patch('/teams/{team}', 'TeamsController@update');

Route::get('/teams/{id}/image-upload','TeamsController@imageUpload');
Route::post('/teams/{id}/image-upload','TeamsController@imageUploadPost');

Route::get('/teams/{team}', 'TeamsController@show');
Route::delete('/teams/{team}', 'TeamsController@delete');

Route::get('/api/{team}', 'TeamsController@apiteam');



//  Current Year
Route::get('/current-year/', 'CurrentyearController@index');

Route::get('/current-year/edit', 'CurrentyearController@edit');
Route::patch('/current-year', 'CurrentyearController@update');



//  Baseball
Route::get('/baseball/', 'BaseballController@index');

Route::get('/baseball/create', 'BaseballController@create');
Route::post('/baseball/', 'BaseballController@store');

Route::get('/baseball/game/{id}/edit', 'BaseballController@edit');
Route::patch('/baseball/game/{baseball}', 'BaseballController@update');

Route::get('/baseball/game/{id}', 'BaseballController@show');
Route::delete('/baseball/game/{id}', 'BaseballController@delete');

Route::get('/baseball/{year}/{team}', 'BaseballController@teamschedule');
Route::get('/baseball/{year}', 'BaseballController@yearschedule');



//  Basketball Boys
Route::get('/basketball-boys/', 'BasketballboysController@index');

Route::get('/basketball-boys/create', 'BasketballboysController@create');
Route::post('/basketball-boys/', 'BasketballboysController@store');

Route::get('/basketball-boys/game/{id}/edit', 'BasketballboysController@edit');
Route::patch('/basketball-boys/game/{basketballboys}', 'BasketballboysController@update');

Route::get('/basketball-boys/game/{id}', 'BasketballboysController@show');
Route::delete('/basketball-boys/{id}', 'BasketballboysController@delete');

Route::get('/basketball-boys/{year}/{team}', 'BasketballboysController@teamschedule');
Route::get('/basketball-boys/{year}', 'BasketballboysController@yearschedule');


Route::get('/api/schedule/{year}/{team}', 'BasketballboysController@apiteamschedule');



//  Basketball Girls
Route::get('/basketball-girls/', 'BasketballgirlsController@index');

Route::get('/basketball-girls/create', 'BasketballgirlsController@create');
Route::post('/basketball-girls/', 'BasketballgirlsController@store');

Route::get('/basketball-girls/game/{id}/edit', 'BasketballgirlsController@edit');
Route::patch('/basketball-girls/game/{basketballgirls}', 'BasketballgirlsController@update');

Route::get('/basketball-girls/game/{id}', 'BasketballgirlsController@show');
Route::delete('/basketball-girls/{id}', 'BasketballgirlsController@delete');

Route::get('/basketball-girls/{year}/{team}', 'BasketballgirlsController@teamschedule');
Route::get('/basketball-girls/{year}', 'BasketballgirlsController@yearschedule');


Route::get('/api/schedule/{year}/{team}', 'BasketballgirlsController@apiteamschedule');



//  Bowling Boys
Route::get('/bowling-boys/', 'BowlingboysController@index');

Route::get('/bowling-boys/create', 'BowlingboysController@create');
Route::post('/bowling-boys/', 'BowlingboysController@store');

Route::get('/bowling-boys/{id}/edit', 'BowlingboysController@edit');
Route::patch('/bowling-boys/{bowlingboys}', 'BowlingboysController@update');

Route::get('/bowling-boys/{bowlingboys}', 'BowlingboysController@show');
Route::delete('/bowling-boys/{bowlingboys}', 'BowlingboysController@delete');

Route::get('/bowling-boys/{year}/{team}', 'BowlingboysController@teamschedule');
Route::get('/bowling-boys/{year}', 'BowlingboysController@yearschedule');



//  Bowling Girls
Route::get('/bowling-girls/', 'BowlinggirlsController@index');

Route::get('/bowling-girls/create', 'BowlinggirlsController@create');
Route::post('/bowling-girls/', 'BowlinggirlsController@store');

Route::get('/bowling-girls/{id}/edit', 'BowlinggirlsController@edit');
Route::patch('/bowling-girls/{bowlinggirls}', 'BowlinggirlsController@update');

Route::get('/bowling-girls/match/{bowlinggirls}', 'BowlinggirlsController@show');
Route::delete('/bowling-girls/{bowlinggirls}', 'BowlinggirlsController@delete');

Route::get('/bowling-girls/{year}/{team}', 'BowlinggirlsController@teamschedule');
Route::get('/bowling-girls/{year}', 'BowlinggirlsController@yearschedule');



//  Cross Country
Route::get('/cross-country/', 'CrosscountryController@index');

Route::get('/cross-country/create', 'CrosscountryController@create');
Route::post('/cross-country/', 'CrosscountryController@store');

Route::get('/cross-country/{id}/edit', 'CrosscountryController@edit');
Route::patch('/cross-country/{crosscountry}', 'CrosscountryController@update');

Route::get('/cross-country/match/{crosscountry}', 'CrosscountryController@show');
Route::delete('/cross-country/{crosscountry}', 'CrosscountryController@delete');

Route::get('/cross-country/{year}/{team}', 'CrosscountryController@teamschedule');
Route::get('/cross-country/{year}', 'CrosscountryController@yearschedule');

Route::get('/api/cross-country/schedule/{year}/{team}/{teamlevel}', 'CrosscountryController@apiteamschedule');
Route::get('/api/cross-country/schedule-summary/{year}/{team}', 'CrosscountryController@apiteamschedulesummary');
Route::get('/api/cross-country/todays-events/{team}', 'CrosscountryController@todaysevents');



//  Golf Boys
Route::get('/golf-boys/', 'GolfboysController@index');

Route::get('/golf-boys/create', 'GolfboysController@create');
Route::post('/golf-boys/', 'GolfboysController@store');

Route::get('/golf-boys/{id}/edit', 'GolfboysController@edit');
Route::patch('/golf-boys/{golfboys}', 'GolfboysController@update');

Route::get('/golf-boys/{golfboys}', 'GolfboysController@show');
Route::delete('/golf-boys/{golfboys}', 'GolfboysController@delete');

Route::get('/golf-boys/{year}/{team}', 'GolfboysController@teamschedule');
Route::get('/golf-boys/{year}', 'GolfboysController@yearschedule');

Route::get('/api/golf-boys/schedule/{year}/{team}/{teamlevel}', 'GolfboysController@apiteamschedule');
Route::get('/api/golf-boys/schedule-summary/{year}/{team}', 'GolfboysController@apiteamschedulesummary');
Route::get('/api/golf-boys/todays-events/{team}', 'GolfboysController@todaysevents');



//  Golf Girls
Route::get('/golf-girls/', 'GolfgirlsController@index');

Route::get('/golf-girls/create', 'GolfgirlsController@create');
Route::post('/golf-girls/', 'GolfgirlsController@store');

Route::get('/golf-girls/{id}/edit', 'GolfgirlsController@edit');
Route::patch('/golf-girls/{golfgirls}', 'GolfgirlsController@update');

Route::get('/golf-girls/{golfgirls}', 'GolfgirlsController@show');
Route::delete('/golf-girls/{golfgirls}', 'GolfgirlsController@delete');

Route::get('/golf-girls/{year}/{team}', 'GolfgirlsController@teamschedule');
Route::get('/golf-girls/{year}', 'GolfgirlsController@yearschedule');

Route::get('/api/golf-girls/schedule/{year}/{team}/{teamlevel}', 'GolfgirlsController@apiteamschedule');
Route::get('/api/golf-girls/schedule-summary/{year}/{team}', 'GolfgirlsController@apiteamschedulesummary');
Route::get('/api/golf-girls/todays-events/{team}', 'GolfgirlsController@todaysevents');



//  Tennis Boys
Route::get('/tennis-boys/', 'TennisboysController@index');

Route::get('/tennis-boys/create', 'TennisboysController@create');
Route::post('/tennis-boys/', 'TennisboysController@store');

Route::get('/tennis-boys/{id}/edit', 'TennisboysController@edit');
Route::patch('/tennis-boys/{tennisboys}', 'TennisboysController@update');

Route::get('/tennis-boys/match/{tennisboys}', 'TennisboysController@show');
Route::delete('/tennis-boys/{tennisboys}', 'TennisboysController@delete');

Route::get('/tennis-boys/{year}/{team}', 'TennisboysController@teamschedule');
Route::get('/tennis-boys/{year}', 'TennisboysController@yearschedule');



//  Tennis Girls
Route::get('/tennis-girls/', 'TennisgirlsController@index');

Route::get('/tennis-girls/create', 'TennisgirlsController@create');
Route::post('/tennis-girls/', 'TennisgirlsController@store');

Route::get('/tennis-girls/{id}/edit', 'TennisgirlsController@edit');
Route::patch('/tennis-girls/{tennisgirls}', 'TennisgirlsController@update');

Route::get('/tennis-girls/match/{tennisgirls}', 'TennisgirlsController@show');
Route::delete('/tennis-girls/{tennisgirls}', 'TennisgirlsController@delete');

Route::get('/tennis-girls/{year}/{team}', 'TennisgirlsController@teamschedule');
Route::get('/tennis-girls/{year}', 'TennisgirlsController@yearschedule');



//  Football
Route::get('/football/', 'FootballController@index');

Route::get('/football/create', 'FootballController@create');
Route::post('/football/', 'FootballController@store');

Route::get('/football/game/{id}/edit', 'FootballController@edit');
Route::patch('/football/game/{football}', 'FootballController@update');

Route::get('/football/game/{id}', 'FootballController@show');
Route::delete('/football/{id}', 'FootballController@delete');

Route::get('/football/{year}/{team}', 'FootballController@teamschedule');
Route::get('/football/{year}', 'FootballController@yearschedule');


Route::get('/api/football/schedule/{year}/{team}/{teamlevel}', 'FootballController@apiteamschedule');
Route::get('/api/football/schedule-summary/{year}/{team}', 'FootballController@apiteamschedulesummary');
Route::get('/api/football/game/{id}', 'FootballController@apigame');
Route::get('/api/football/todays-events/{team}', 'FootballController@todaysevents');
Route::get('/api/football/standings/{year}/{team}', 'FootballController@districtstandings');
Route::get('/api/football/record/{year}/{team}', 'FootballController@yearsummary');



//  Soccer Boys
Route::get('/soccer-boys/', 'SoccerboysController@index');

Route::get('/soccer-boys/create', 'SoccerboysController@create');
Route::post('/soccer-boys/', 'SoccerboysController@store');

Route::get('/soccer-boys/match/{id}/edit', 'SoccerboysController@edit');
Route::patch('/soccer-boys/match/{soccerboys}', 'SoccerboysController@update');

Route::get('/soccer-boys/match/{soccerboys}', 'SoccerboysController@show');
Route::delete('/soccer-boys/{soccerboys}', 'SoccerboysController@delete');

Route::get('/soccer-boys/{year}/{team}', 'SoccerboysController@teamschedule');
Route::get('/soccer-boys/{year}', 'SoccerboysController@yearschedule');

Route::get('/api/soccer-boys/schedule/{year}/{team}/{teamlevel}', 'SoccerboysController@apiteamschedule');
Route::get('/api/soccer-boys/schedule-summary/{year}/{team}', 'SoccerboysController@apiteamschedulesummary');
Route::get('/api/soccer-boys/game/{id}', 'SoccerboysController@apigame');
Route::get('/api/soccer-boys/todays-events/{team}', 'SoccerboysController@todaysevents');



//  Soccer Girls
Route::get('/soccer-girls/', 'SoccergirlsController@index');

Route::get('/soccer-girls/create', 'SoccergirlsController@create');
Route::post('/soccer-girls/', 'SoccergirlsController@store');

Route::get('/soccer-girls/match/{id}/edit', 'SoccergirlsController@edit');
Route::patch('/soccer-girls/match/{soccergirls}', 'SoccergirlsController@update');

Route::get('/soccer-girls/match/{soccergirls}', 'SoccergirlsController@show');
Route::delete('/soccer-girls/{soccergirls}', 'SoccergirlsController@delete');

Route::get('/soccer-girls/{year}/{team}', 'SoccergirlsController@teamschedule');
Route::get('/soccer-girls/{year}', 'SoccergirlsController@yearschedule');

Route::get('/api/soccer-girls/schedule/{year}/{team}/{teamlevel}', 'SoccergirlsController@apiteamschedule');
Route::get('/api/soccer-girls/schedule-summary/{year}/{team}', 'SoccergirlsController@apiteamschedulesummary');
Route::get('/api/soccer-girls/game/{id}', 'SoccergirlsController@apigame');
Route::get('/api/soccer-girls/todays-events/{team}', 'SoccergirlsController@todaysevents');



//  Softball
Route::get('/softball/', 'SoftballController@index');

Route::get('/softball/create', 'SoftballController@create');
Route::post('/softball/', 'SoftballController@store');

Route::get('/softball/game/{id}/edit', 'SoftballController@edit');
Route::patch('/softball/game/{softball}', 'SoftballController@update');

Route::get('/softball/game/{id}', 'SoftballController@show');
Route::delete('/softball/game/{id}', 'SoftballController@delete');

Route::get('/softball/{year}/{team}', 'SoftballController@teamschedule');
Route::get('/softball/{year}', 'SoftballController@yearschedule');



//  Swimming
Route::get('/swimming/', 'SwimmingController@index');

Route::get('/swimming/create', 'SwimmingController@create');
Route::post('/swimming/', 'SwimmingController@store');

Route::get('/swimming/{id}/edit', 'SwimmingController@edit');
Route::patch('/swimming/event/{swimming}', 'SwimmingController@update');

Route::get('/swimming/event/{swimming}', 'SwimmingController@show');
Route::delete('/swimming/{swimming}', 'SwimmingController@delete');

Route::get('/swimming/{year}/{team}', 'SwimmingController@teamschedule');
Route::get('/swimming/{year}', 'SwimmingController@yearschedule');



//  Track
Route::get('/track/', 'TrackController@index');

Route::get('/track/create', 'TrackController@create');
Route::post('/track/', 'TrackController@store');

Route::get('/track/{id}/edit', 'TrackController@edit');
Route::patch('/track/event/{track}', 'TrackController@update');

Route::get('/track/event/{track}', 'TrackController@show');
Route::delete('/track/{track}', 'TrackController@delete');

Route::get('/track/{year}/{team}', 'TrackController@teamschedule');
Route::get('/track/{year}', 'TrackController@yearschedule');




//  Wrestling
Route::get('/wrestling/', 'WrestlingController@index');

Route::get('/wrestling/create', 'WrestlingController@create');
Route::post('/wrestling/', 'WrestlingController@store');

Route::get('/wrestling/{id}/edit', 'WrestlingController@edit');
Route::patch('/wrestling/{wrestling}', 'WrestlingController@update');

Route::get('/wrestling/match/{wrestling}', 'WrestlingController@show');
Route::delete('/wrestling/{wrestling}', 'WrestlingController@delete');

Route::get('/wrestling/{year}/{team}', 'WrestlingController@teamschedule');
Route::get('/wrestling/{year}', 'WrestlingController@yearschedule');



//  Volleyball
Route::get('/volleyball/', 'VolleyballController@index');

Route::get('/volleyball/create', 'VolleyballController@create');
Route::post('/volleyball/', 'VolleyballController@store');

Route::get('/volleyball/match/{id}/edit', 'VolleyballController@edit');
Route::patch('/volleyball/match/{volleyball}', 'VolleyballController@update');

Route::get('/volleyball/match/{id}', 'VolleyballController@show');
Route::delete('/volleyball/{id}', 'VolleyballController@delete');

Route::get('/volleyball/{year}/{team}', 'VolleyballController@teamschedule');
Route::get('/volleyball/{year}', 'VolleyballController@yearschedule');


Route::get('/api/volleyball/schedule/{year}/{team}/{teamlevel}', 'VolleyballController@apiteamschedule');
Route::get('/api/volleyball/schedule-summary/{year}/{team}', 'VolleyballController@apiteamschedulesummary');
Route::get('/api/volleyball/match/{id}', 'VolleyballController@apigame');
Route::get('/api/volleyball/todays-events/{team}', 'VolleyballController@todaysevents');


