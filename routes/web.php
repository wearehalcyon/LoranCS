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
    Route::get('/core/update', 'App\Http\Controllers\Admin\DashboardController@coreUpdate')->name('my-admin-core-update');
    Route::get('/core', function(){
        return redirect()->route('my-admin');
    });

    // Posts
    Route::prefix('/posts')->group(function(){
        Route::get('/', 'App\Http\Controllers\Admin\DashboardPostsController@index')->name('my-admin-posts');
        Route::get('/edit', function(){
            return redirect(route('my-admin-posts'));
        });
        Route::get('/edit/{id}', 'App\Http\Controllers\Admin\DashboardPostsController@editPost')->name('my-admin-post-edit');
        Route::get('/create', 'App\Http\Controllers\Admin\DashboardPostsController@createPost')->name('my-admin-create-post');
        Route::post('/create/submit', 'App\Http\Controllers\Admin\DashboardPostsController@createPostSubmit')->name('my-admin-create-post-submit');
        Route::post('/edit/submit', 'App\Http\Controllers\Admin\DashboardPostsController@updatePostSubmit')->name('my-admin-update-post-submit');
        Route::get('/update', function(){
            return redirect(route('my-admin-posts'));
        });
        Route::get('/delete/{id}', 'App\Http\Controllers\Admin\DashboardPostsController@deletePost')->name('my-admin-post-delete');
        Route::post('/delete-file', 'App\Http\Controllers\Admin\DashboardPostsController@deleteFile')->name('my-admin-post-delete-file');
    });

    // Themes
    Route::prefix('/themes')->group(function(){
        Route::get('/', 'App\Http\Controllers\Admin\DashboardThemesController@index')->name('my-admin-themes');
        Route::get('/apply/{name}', 'App\Http\Controllers\Admin\DashboardThemesController@applyTheme')->name('my-admin-apply-theme');
        Route::get('/remove/{name}', 'App\Http\Controllers\Admin\DashboardThemesController@removeTheme')->name('my-admin-remove-theme');
        Route::post('/upload', 'App\Http\Controllers\Admin\DashboardThemesController@uploadTheme')->name('my-admin-upload-theme');
    });

    // Menus
    Route::prefix('/menus')->group(function(){
        Route::get('/', 'App\Http\Controllers\Admin\DashboardMenusController@index')->name('my-admin-menus');
        Route::post('/create/submit', 'App\Http\Controllers\Admin\DashboardMenusController@createMenuSubmit')->name('my-admin-create-menu-submit');
        Route::get('/create', function(){
            return redirect(route('my-admin-menus'));
        });
        Route::get('/edit/{id}', 'App\Http\Controllers\Admin\DashboardMenusController@editMenu')->name('my-admin-edit-menu');
        Route::get('/edit', function(){
            return redirect(route('my-admin-menus'));
        });
        Route::post('/edit/submit', 'App\Http\Controllers\Admin\DashboardMenusController@editMenuSubmit')->name('my-admin-edit-menu-submit');
        Route::get('/edit', function(){
            return redirect(route('my-admin-menus'));
        });
        Route::post('/remove-item/submit/{id}', 'App\Http\Controllers\Admin\DashboardMenusController@removeMenuItemSubmit')->name('my-admin-remove-menu-item-submit');
        Route::get('/remove-item', function(){
            return redirect(route('my-admin-menus'));
        });
        Route::get('/remove-item/submit', function(){
            return redirect(route('my-admin-menus'));
        });
        Route::get('/delete/{id}', 'App\Http\Controllers\Admin\DashboardMenusController@deleteMenu')->name('my-admin-menu-delete');
    });

    // Site Options
    Route::prefix('/general-settings')->group(function(){
        Route::get('/', 'App\Http\Controllers\Admin\DashboardSettingsController@index')->name('my-admin-settings');
        Route::get('/update', 'App\Http\Controllers\Admin\DashboardSettingsController@update')->name('my-admin-gsettings-update');
    });

    // Documentation
    Route::prefix('/documentation')->group(function(){
        Route::get('/', 'App\Http\Controllers\Admin\DashboardDocumentationController@documentation')->name('my-admin-docs');
    });
});

// Post routes
Route::get('{slug}', 'App\Http\Controllers\PostController@post')->name('post');
