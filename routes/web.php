<?php

use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/post/{post}', 'PostController@show')->name('post');


Route::middleware('auth')->group(function(){

    Route::get('/admin', 'AdminsController@index')->name('admin.index');

    Route::get('/admin/posts', 'PostController@index')->name('post.index');
    Route::get('/admin/posts/create', 'PostController@create')->name('post.create');
    Route::post('/admin/posts', 'PostController@store')->name('post.store');

    Route::delete('/admin/posts/{post}/destroy', 'PostController@destroy')->name('post.destroy');
    Route::patch('/admin/posts/{post}/update', 'PostController@update')->name('post.update');
    Route::get('/admin/posts/{post}/edit', 'PostController@edit')->name('post.edit');

    Route::get('/admin/users/{user}/profile', 'UserController@show')->name('user.profile.show');
    Route::put('/admin/users/{user}/update', 'UserController@update')->name('user.profile.update');

    Route::delete('/admin/users/{user}/destroy', 'UserController@destroy')->name('user.destroy');

});

Route::middleware(['role:admin','auth'])->group(function(){

    Route::get('/admin/users', 'UserController@index')->name('users.index');
    Route::get('/admin/users/{user}/attach', 'UserController@attach')->name('user.role.attach');
    Route::get('/admin/users/{user}/detach', 'UserController@detach')->name('user.role.detach');

    Route::get('/admin/auth/roles', 'RoleController@index')->name('roles.index');
    Route::post('/admin/auth/roles', 'RoleController@store')->name('roles.store');
    Route::delete('/admin/auth/roles/{role}/destroy', 'RoleController@destroy')->name('roles.destroy');
    Route::get('/admin/auth/roles/{role}/edit', 'RoleController@edit')->name('roles.edit');
    Route::put('/admin/auth/roles/{role}/update', 'RoleController@update')->name('roles.update');
    Route::get('/admin/auth/roles/{role}/attach', 'RoleController@attach')->name('roles.permission.attach');
    Route::get('/admin/auth/roles/{role}/detach', 'RoleController@detach')->name('roles.permission.detach');

    Route::get('/admin/auth/permissions', 'PermissionController@index')->name('permission.index');
//    Route::post('/admin/auth/permissions', 'PermissionController@store')->name('permission.store');
    Route::post('/admin/auth/permissions', 'PermissionController@store');
    Route::delete('/admin/auth/permissions/{permission}/destroy', 'PermissionController@destroy')->name('permission.destroy');
    Route::get('/admin/auth/permissions/{permission}/edit', 'PermissionController@edit')->name('permission.edit');
    Route::put('/admin/auth/permissions/{permission}/update', 'PermissionController@update')->name('permission.update');
});




