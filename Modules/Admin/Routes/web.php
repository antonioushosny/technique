<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your module. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/auth/redirect/{provider}', 'front\SocialController@redirect');
Route::get('/callback/{provider}', 'front\SocialController@callback');

 
Route::prefix('admin')
->name('admin.')->namespace('Admin')
->group(function () {
	/**
	 * Auth Routes
	 */
    Route::get('login', 'AuthController@getLogin')->name('auth.getLogin')->middleware('guest:admin');
    Route::post('login', 'AuthController@postLogin')->name('auth.postLogin');

    Route::middleware(['auth:admin', 'check_permission'])->group(function() {

		/**
		 * Auth Routes
		 */
	    Route::get('logout', 'AuthController@logout')->name('auth.logout');

		/**
		 * Dashboard Routes
		 */
	    Route::get('/', 'DashboardController@home')->name('dashboard.home');

	    // this sort based on Website Menu in Navbar

	    /**
		 * Info Routes
		 */
	    Route::resource('infos', 'InfosController')->except([ 'create', 'store', 'destroy' ]);
 
	    /**
		 * Advertisements Routes
		 */
	    Route::resource('advertisements', 'AdvertisementsController');

	    /**
		 * Reports Routes
		 */
	  
		
	    /**
		 * ContactUs Routes
		 */
	    Route::resource('contactus', 'ContactUsController');
	    Route::resource('contacts', 'ContactsController');

	    /**
		 * Admins Routes
		 */
	    Route::resource('admins', 'AdminsController');

	    /**
		 * Roles/Permissions Routes
		 */
	    Route::resource('roles', 'RolesController');
	    Route::get('permissions/update', 'RolesController@updatePermissions')->name('permissions.update');

	    /**
		 * MetaTags Routes
		 */
	    Route::resource('metatags', 'MetaTagsController')->except([ 'create', 'store', 'destroy' ]);


	    /**
		 * Settings Routes
		 */
	    Route::resource('settings', 'SettingsController')->except([ 'create', 'store', 'show', 'edit', 'update', 'destroy' ]);
	    Route::get('settings/edit', 'SettingsController@edit')->name('settings.edit');
	    Route::post('settings/update', 'SettingsController@update')->name('settings.update');
		
		

    });
});


