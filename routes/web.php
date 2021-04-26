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
    return redirect()->route('home');
});
Route::get('/blank', function(){
    return view('blank');
})->name('blank');

Route::get('lang/{lang}', 'Controller@lang')->name('lang');
Auth::routes();

Route::get(trans('routes.aboutUs'), 'MainController@aboutUs')->name('aboutUs'); // about us page
Route::get(trans('routes.terms'), 'MainController@terms')->name('terms'); // about us page
Route::get(trans('routes.policy'), 'MainController@policy')->name('policy'); // about us page
Route::get(trans('routes.contactus'), 'MainController@contactus')->name('contactus'); // complaints  page
Route::post('/contactus/add', 'MainController@addcontactus')->name('postcontactus'); // complaints  post 

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/news', 'HomeController@news')->name('news');
Route::get('/news/{news}', 'HomeController@showNews')->name('news.show');
Route::get('/videos', 'HomeController@videos')->name('videos');
Route::get('/phones', 'HomeController@phones')->name('phones');
Route::get('/phones/comparisons', 'HomeController@comparisons')->name('comparisons');



 


 