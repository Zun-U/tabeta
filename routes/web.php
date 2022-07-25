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


Route::group(['middleware' => 'auth'], function () {

    // レシピ一覧画面
    Route::get('/', 'RecipeController@getArticleAll')->name('articles');

    // レシピ作成画面
    Route::get('/recipes/create', 'RecipeController@showCreateForm')->name('recipes.create');

});

// ユーザー認証機能
Auth::routes();
