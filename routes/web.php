<?php

use Illuminate\Http\Request;
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

Route::get('/', 'WelcomeController@index')->name('welcome');

Auth::routes();

Route::group(['middleware' => 'sponsor'], function () {
	Route::get('/new-activity', 'SponsorsController@new_index')->name('sponsor.new');
	Route::post('/new', 'ActivitiesController@store')->name('activity.store');
	Route::post('/rate', 'RatingsController@store')->name('rating.store');
});

Route::group(['middleware' => 'volunteer'], function () {
	Route::post('/partake', 'VolunteersController@store')->name('volunteer.store');
	Route::delete('/quit', 'VolunteersController@destroy')->name('volunteer.destroy');
});

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/activity/{activity}', 'ActivitiesController@index')->name('activity.index');
Route::get('/profile/{profile}', 'ProfilesController@index')->name('profile.index');

Route::post('/comment', 'CommentsController@store')->name('comment.store');
Route::post('/sponsorrating', 'SponsorRatingsController@store')->name('sponsorRating.store');
Route::patch('/sponsorrating/edit', 'SponsorRatingsController@update')->name('sponsorRating.update');