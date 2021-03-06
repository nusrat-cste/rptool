<?php

/**
 * Frontend Controllers
 * All route names are prefixed with 'frontend.'.
 */
//Route::get('/', 'FrontendController@index')->name('index');

Route::group(['middleware' => 'guest'], function () {
    //
});
Route::get('/', 'Auth\LoginController@showLoginForm')->name('index');
Route::get('macros', 'FrontendController@macros')->name('macros');

/*
 * These frontend controllers require the user to be logged in
 * All route names are prefixed with 'frontend.'
 */
Route::group(['middleware' => 'auth'], function () {
    Route::group(['namespace' => 'User', 'as' => 'user.'], function () {
        /*
         * User Dashboard Specific
         */
        Route::get('dashboard', 'DashboardController@index')->name('dashboard');

        /*
         * User Dashboard Specific
         */
        Route::get('projects/{id}', 'DashboardController@projectFeedback')->name('dashboard.project.details');

        Route::post('projects/{id}', 'DashboardController@feedbackByUser')->name('dashboard.project.feedback');

        /*
         * User Account Specific
         */
        Route::get('account', 'AccountController@index')->name('account');

        /*
         * User Profile Specific
         */
        Route::patch('profile/update', 'ProfileController@update')->name('profile.update');
    });
});
