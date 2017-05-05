<?php

/**
 * All route names are prefixed with 'admin.'.
 */
Route::get('dashboard', 'DashboardController@index')->name('dashboard');

Route::resource('projects', 'ProjectsController');

Route::resource('projects.requirements', 'RequirementsController');

Route::resource('projects.stakeholders', 'StakeholdersController');