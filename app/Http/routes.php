<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
|
*/

// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

// Password reset link request routes...
Route::get('password/email', 'Auth\PasswordController@getEmail');
Route::post('password/email', 'Auth\PasswordController@postEmail');

// Password reset routes...
Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');

// Operations
Route::group(['middleware' => 'auth'], function () {


//Admin Activity
  Route::group(
      ['prefix' => 'admin'],
      function () {
        Route::resource('roles', 'RoleController');

        Route::resource('users', 'AdminUsersController');

        Route::resource('permissions', 'PermissionController');

        Route::resource('role-permissions','RolePermissionController');
      }
  );

});

