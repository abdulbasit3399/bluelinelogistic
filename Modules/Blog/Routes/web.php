<?php

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

if (\Illuminate\Support\Facades\Schema::hasTable('translations') && check_module('localization')) {
    Route::group(
        [
            'prefix' => LaravelLocalization::setLocale(),
            'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
        ], function(){
            
        Route::group(['namespace' => 'Front'], function () {

            // posts
            Route::get('/post/{slug}', 'PostController@show')->name('post-page');
            Route::get('/random-post', 'PostController@showRandomPost')->name('post-random');
            Route::post('/load-posts', 'PostController@loadPosts')->name('load-posts');
            Route::post('/filter-posts', 'PostController@filterPosts')->name('posts-filter');

            // comments
            Route::post('/comments', 'CommentController@store')->name('comments.store');
            Route::post('/more-comments', 'CommentController@loadMore')->name('comments.loadMore');
            Route::post('/more-replies-comment', 'CommentController@loadMoreReplies')->name('comments.loadMoreReplies');


            // categories
            Route::get('/blog', 'PostController@showall')->name('blog-page');

            // categories
            Route::get('/category/{slug}', 'CategoryController@show')->name('category-page');

            // tags
            Route::get('/tag/{slug}', 'TagController@show')->name('tag-page');

            // author
            Route::get('/author/{username}', 'AuthorController@show')->name('author-page');


            // search
            Route::get('/search', 'PostController@search')->name('search-post');
            
        });

        Route::middleware('auth')->prefix(env('PREFIX_ADMIN', 'admin'))->group(function() {

            Route::prefix('blog')->group(function() {
                // posts
                Route::resource('/posts', 'PostController')->parameters(['posts' => 'id']);
                Route::delete('/posts-multi-destroy', 'PostController@multiDestroy')->name('posts.multi-destroy');
                Route::get('/posts-search', 'PostController@searchPosts')->name('posts.search');

                
                // categories
                Route::resource('/categories', 'CategoryController')->parameters(['categories' => 'id'])->except('create', 'show');
                Route::delete('/categories-multi-destroy', 'CategoryController@multiDestroy')->name('categories.multi-destroy');
                Route::get('/categories-search', 'CategoryController@searchCategories')->name('categories.search');
                Route::post('/categories-simple-create', 'CategoryController@simpleStore')->name('categories.simple-create');
                
                // tags
                Route::resource('/tags', 'TagController')->parameters(['tags' => 'id'])->except('create', 'show');
                Route::delete('/tags-multi-destroy', 'TagController@multiDestroy')->name('tags.multi-destroy');
                Route::get('/tags-search', 'TagController@searchTags')->name('tags.search');
                
                // comments
                Route::resource('/comments', 'CommentController')->parameters(['comments' => 'id'])->except('store', 'create', 'show');
                Route::delete('/comments-multi-destroy', 'CommentController@multiDestroy')->name('comments.multi-destroy');
                Route::post('/comments-approval', 'CommentController@approval')->name('comments.approval');

            });


            Route::get('/settings/blog', 'SettingsController@index')->name('admin.blog_settings');
            Route::put('/settings/blog', 'SettingsController@update')->name('setting.update');
        });
    });
}else{
    Route::group(['namespace' => 'Front'], function () {

        // posts
        Route::get('/post/{slug}', 'PostController@show')->name('post-page');
        Route::get('/random-post', 'PostController@showRandomPost')->name('post-random');
        Route::post('/load-posts', 'PostController@loadPosts')->name('load-posts');
        Route::post('/filter-posts', 'PostController@filterPosts')->name('posts-filter');

        // comments
        Route::post('/comments', 'CommentController@store')->name('comments.store');
        Route::post('/more-comments', 'CommentController@loadMore')->name('comments.loadMore');
        Route::post('/more-replies-comment', 'CommentController@loadMoreReplies')->name('comments.loadMoreReplies');


        // categories
        Route::get('/category/{slug}', 'CategoryController@show')->name('category-page');

        // tags
        Route::get('/tag/{slug}', 'TagController@show')->name('tag-page');

        // author
        Route::get('/author/{username}', 'AuthorController@show')->name('author-page');


        // search
        Route::get('/search', 'PostController@search')->name('search-post');
        
    });

    Route::middleware('auth')->prefix(env('PREFIX_ADMIN', 'admin'))->group(function() {

        Route::prefix('blog')->group(function() {
            // posts
            Route::resource('/posts', 'PostController')->parameters(['posts' => 'id']);
            Route::delete('/posts-multi-destroy', 'PostController@multiDestroy')->name('posts.multi-destroy');
            Route::get('/posts-search', 'PostController@searchPosts')->name('posts.search');

            
            // categories
            Route::resource('/categories', 'CategoryController')->parameters(['categories' => 'id'])->except('create', 'show');
            Route::delete('/categories-multi-destroy', 'CategoryController@multiDestroy')->name('categories.multi-destroy');
            Route::get('/categories-search', 'CategoryController@searchCategories')->name('categories.search');
            Route::post('/categories-simple-create', 'CategoryController@simpleStore')->name('categories.simple-create');
            
            // tags
            Route::resource('/tags', 'TagController')->parameters(['tags' => 'id'])->except('create', 'show');
            Route::delete('/tags-multi-destroy', 'TagController@multiDestroy')->name('tags.multi-destroy');
            Route::get('/tags-search', 'TagController@searchTags')->name('tags.search');
            
            // comments
            Route::resource('/comments', 'CommentController')->parameters(['comments' => 'id'])->except('store', 'create', 'show');
            Route::delete('/comments-multi-destroy', 'CommentController@multiDestroy')->name('comments.multi-destroy');
            Route::post('/comments-approval', 'CommentController@approval')->name('comments.approval');

        });


        Route::get('/settings/blog', 'SettingsController@index')->name('admin.blog_settings');
        Route::put('/settings/blog', 'SettingsController@update')->name('setting.update');
    });
}




