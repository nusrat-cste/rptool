<?php

/**
 * All route names are prefixed with 'admin.'.
 */
Route::get('dashboard', 'DashboardController@index')->name('dashboard');

Route::get('projects/{id}/erpimplform', 'RequirementsController@erpimplform')->name('erpimplform');

Route::get('projects/{id}/reprotizer', 'RequirementsController@reprotizer')->name('reprotizer');

Route::get('projects/{id}/erpimpl', 'RequirementsController@erpimpl')->name('erpimpl');


Route::resource('projects', 'ProjectsController');

Route::resource('projects.requirements', 'RequirementsController');

Route::resource('projects.stakeholders', 'StakeholdersController');