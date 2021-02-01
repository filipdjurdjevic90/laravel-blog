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


Route::get('/', 'IndexController@index')->name('front.index.index');

Route::prefix('/blog')->group(function (){
    Route::get('/' , 'BlogsController@blogIndex')->name('front.blogs.index');
    
    Route::get('/blog-post/{blog}', 'BlogsController@single')->name('front.blogs.blog_post');
   
    
    Route::get('/blog-category/{blog}', 'BlogsController@blogCatgory')->name('front.blogs.blog_category');
    Route::get('/blog-autor/{blog}', 'BlogsController@blogAutor')->name('front.blogs.blog_autor');
    Route::get('/blog-tag/{blog}', 'BlogsController@blogTag')->name('front.blogs.blog_tag');
});




Route::get('/contact', 'ContactController@index')->name('front.contact.index');
Route::post('/contact/send-message', 'ContactController@sendMessage')->name('front.contact.send_message');



Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::middleware('auth')->prefix('/admin')->namespace('Admin')->group(function() {

    Route::get('/', 'IndexController@index')->name('admin.index.index');


    Route::prefix('/tags')->group(function () {

        Route::get('/', 'TagsController@index')->name('admin.tags.index');
        Route::get('/add', 'TagsController@add')->name('admin.tags.add');
        Route::post('/insert', 'TagsController@insert')->name('admin.tags.insert');

        Route::get('/edit/{tag}', 'TagsController@edit')->name('admin.tags.edit');
        Route::post('/update/{tag}', 'TagsController@update')->name('admin.tags.update');

        Route::post('/delete', 'TagsController@delete')->name('admin.tags.delete');
    });

    Route::prefix('/blog-categories')->group(function() {

        Route::get('/', 'BlogCategoriesController@index')->name('admin.blog_categories.index');
        Route::get('/add', 'BlogCategoriesController@add')->name('admin.blog_categories.add');
        Route::post('/insert', 'BlogCategoriesController@insert')->name('admin.blog_categories.insert');

        Route::get('/edit/{blogCategory}', 'BlogCategoriesController@edit')->name('admin.blog_categories.edit');
        Route::post('/update/{blogCategory}', 'BlogCategoriesController@update')->name('admin.blog_categories.update');

        Route::post('/delete', 'BlogCategoriesController@delete')->name('admin.blog_categories.delete');


        Route::post('/change-priorities', 'BlogCategoriesController@changePriorities')->name('admin.blog_categories.change_priorities');
    });

    Route::prefix('/index_sliders')->group(function() {

        Route::get('/', 'IndexSlidersController@index')->name('admin.index_sliders.index');
        Route::get('/add', 'IndexSlidersController@add')->name('admin.index_sliders.add');
        Route::post('/insert', 'IndexSlidersController@insert')->name('admin.index_sliders.insert');

        Route::get('/edit/{indexSlider}', 'IndexSlidersController@edit')->name('admin.index_sliders.edit');
        Route::post('/update/{indexSlider}', 'IndexSlidersController@update')->name('admin.index_sliders.update');

        Route::post('/delete', 'IndexSlidersController@delete')->name('admin.index_sliders.delete');

        Route::post('/delete-photo/{indexSlider}', 'IndexSlidersController@deletePhoto')->name('admin.index_sliders.delete_photo');

        Route::post('/change-priorities', 'IndexSlidersController@changePriorities')->name('admin.index_sliders.change_priorities');
    });

    Route::prefix('/blogs')->group(function () {

        Route::get('/', 'BlogsController@index')->name('admin.blogs.index');
        Route::get('/add', 'BlogsController@add')->name('admin.blogs.add');
        Route::post('/insert', 'BlogsController@insert')->name('admin.blogs.insert');

        Route::get('/edit/{blog}', 'BlogsController@edit')->name('admin.blogs.edit');
        Route::post('/update/{blog}', 'BlogsController@update')->name('admin.blogs.update');

        Route::post('/delete', 'BlogsController@delete')->name('admin.blogs.delete');
        Route::post('/delete-photo/{blog}', 'BlogsController@deletePhoto')->name('admin.blogs.delete_photo');

        Route::post('/datatable', 'BlogsController@datatable')->name('admin.blogs.datatable');
    });

    Route::prefix('/users')->group(function () {

        Route::get('/', 'UsersController@index')->name('admin.users.index');
        Route::get('/add', 'UsersController@add')->name('admin.users.add');
        Route::post('/insert', 'UsersController@insert')->name('admin.users.insert');

        Route::get('/edit/{user}', 'UsersController@edit')->name('admin.users.edit');
        Route::post('/update/{user}', 'UsersController@update')->name('admin.users.update');

        Route::post('/delete', 'UsersController@delete')->name('admin.users.delete');
        Route::post('/disable', 'UsersController@disable')->name('admin.users.disable');
        Route::post('/enable', 'UsersController@enable')->name('admin.users.enable');
        Route::post('/delete-photo/{user}', 'UsersController@deletePhoto')->name('admin.users.delete_photo');

        Route::post('/datatable', 'UsersController@datatable')->name('admin.users.datatable');
    });
});

