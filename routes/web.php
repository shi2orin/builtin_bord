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
Route::group(['middleware' => ['guest']], function () {
    Route::namespace('Auth')->group(function () {
        Route::get('/login', 'LoginController@loginView')->name('loginView');
        Route::post('/login/post', 'LoginController@loginPost')->name('loginPost');
        Route::get('/register', 'RegisterController@registerView')->name('registerView');
        Route::post('/register/post', 'RegisterController@registerPost')->name('registerPost');
        Route::get('/register/confirmed', 'RegisterController@registerConfirmed')->name('registerConfirmed');
    });
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/logout', 'HomeController@logout')->name('logout');
    Route::get('/posts/{keyword?}', 'User\Post\PostsController@show')->name('top.show');
    Route::post('/favorite/post/{id}', 'User\Post\PostsController@postFavorite')->name('post.favorite');
    Route::post('/unfavorite/post/{id}', 'User\Post\PostsController@postUnFavorite')->name('post.unfavorite');

    // カテゴリー追加画面
    Route::get('/category', 'Admin\Post\PostMainCategoriesController@show')->name('category.show');
    Route::post('main_category/create', 'Admin\Post\PostMainCategoriesController@mainCategoryCreate')->name('main.category.create');
    Route::post('sub_category/create', 'Admin\Post\PostMainCategoriesController@subCategoryCreate')->name('sub.category.create');
    Route::get('sub_category/{id}/delete', 'Admin\Post\PostMainCategoriesController@subCategoryDelete')->name('sub.category.delete');
    Route::get('main_category/{id}/delete', 'Admin\Post\PostMainCategoriesController@mainCategoryDelete')->name('main.category.delete');

    // 投稿詳細画面
    Route::get('/post/{id}', 'User\Post\PostsController@postDetail')->name('post.detail');
    Route::post('/favorite/comment/{id}', 'User\Post\PostsController@postCommentFavorite')->name('post.comment.favorite');
    Route::post('/unfavorite/comment/{id}', 'User\Post\PostsController@postCommentUnFavorite')->name('post.comment.unfavorite');

    // 新規投稿・編集・削除
    Route::get('/post/create/new', 'User\Post\PostsController@newPost')->name('post.new');
    Route::post('/post/create', 'User\Post\PostsController@postCreate')->name('post.create');
    Route::get('/post/edit/{id}', 'User\Post\PostsController@postEditShow')->name('post.edit.show');
    Route::post('/post/edit', 'User\Post\PostsController@postEdit')->name('post.edit');
    Route::get('/post/{id}/delete', 'User\Post\PostsController@postDelete')->name('post.delete');

    // コメント編集・削除
    Route::get('/comment/edit/{id}', 'User\Post\PostCommentsController@commentEditShow')->name('comment.edit.show');
    Route::post('/comment/edit', 'User\Post\PostCommentsController@commentEdit')->name('comment.edit');
    Route::get('/comment/{id}/delete', 'User\Post\PostCommentsController@commentDelete')->name('comment.delete');
    Route::post('/comment/create', 'User\Post\PostCommentsController@commentCreate')->name('comment.create');
});
