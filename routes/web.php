<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Installation routes
Route::prefix('install-engine')->group(function(){
    Route::get('/', 'App\Http\Controllers\InstallController@run')->name('einstall-index');
    Route::get('/step-1', 'App\Http\Controllers\InstallController@stepOne')->name('einstall-step-1');
    Route::get('/step-2', 'App\Http\Controllers\InstallController@stepTwo')->name('einstall-step-2');
    Route::post('/create-account', 'App\Http\Controllers\InstallController@createAccount')->name('einstall-create-account');
    Route::get('/finish', 'App\Http\Controllers\InstallController@finish')->name('einstall-finished');
});

// Admin routes
Route::middleware('auth')->prefix('cs-admin')->group(function(){
    Route::get('/', 'App\Http\Controllers\Admin\DashboardController@index')->name('my-admin');
    // Posts
    Route::get('/posts', 'App\Http\Controllers\Admin\DashboardPostsController@index')->name('my-admin-posts');
    Route::get('/posts/edit', function(){
        return redirect(route('my-admin-posts'));
    });
    Route::get('/posts/edit/{id}', 'App\Http\Controllers\Admin\DashboardPostsController@editPost')->name('my-admin-post-edit');
    Route::get('/posts/create', 'App\Http\Controllers\Admin\DashboardPostsController@createPost')->name('my-admin-create-post');
    Route::post('/posts/create/submit', 'App\Http\Controllers\Admin\DashboardPostsController@createPostSubmit')->name('my-admin-create-post-submit');
    Route::post('/posts/edit/submit', 'App\Http\Controllers\Admin\DashboardPostsController@updatePostSubmit')->name('my-admin-update-post-submit');
    Route::get('/posts/update', function(){
        return redirect(route('my-admin-posts'));
    });
    Route::get('/posts/delete/{id}', 'App\Http\Controllers\Admin\DashboardPostsController@deletePost')->name('my-admin-post-delete');
    Route::post('/delete-file', 'App\Http\Controllers\Admin\DashboardPostsController@deleteFile')->name('my-admin-post-delete-file');
    // Themes
    Route::get('/themes', 'App\Http\Controllers\Admin\DashboardThemesController@index')->name('my-admin-themes');
    Route::get('/themes/apply/{name}', 'App\Http\Controllers\Admin\DashboardThemesController@applyTheme')->name('my-admin-apply-theme');
    Route::get('/themes/remove/{name}', 'App\Http\Controllers\Admin\DashboardThemesController@removeTheme')->name('my-admin-remove-theme');
    Route::post('/themes/upload', 'App\Http\Controllers\Admin\DashboardThemesController@uploadTheme')->name('my-admin-upload-theme');
    // Menus
    Route::get('/menus', 'App\Http\Controllers\Admin\DashboardMenusController@index')->name('my-admin-menus');
    Route::get('/menus/create', 'App\Http\Controllers\Admin\DashboardMenusController@createMenu')->name('my-admin-create-menu');
    Route::get('/menus/delete/{id}', 'App\Http\Controllers\Admin\DashboardMenusController@deleteMenu')->name('my-admin-menu-delete');
    // Documentation
    Route::get('/documentation', 'App\Http\Controllers\Admin\DashboardDocumentationController@documentation')->name('my-admin-docs');
});

// Post routes
Route::get('{slug}', 'App\Http\Controllers\PostController@post')->name('post');
