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

Route::group(['middleware' => 'guest:admin', 'namespace' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/login', 'LoginController@index')->name('login');
    Route::post('/checklogin', 'LoginController@checklogin')->name('checklogin');
});

Route::group(['middleware' => 'auth:admin', 'namespace' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/', 'DashboardController@index')->name('home');
    Route::get('/logout', 'LoginController@logout')->name('logout');

    // Product Meta
    Route::get('/meta/product', 'ProductController@meta_index')->name('meta.product.index');
    Route::get('/meta/product/{product:id}', 'ProductController@meta_edit')->name('meta.product.edit');
    Route::post('/meta/product/{product:id}', 'ProductController@meta_update')->name('meta.product.update');

    // Blog Meta
    Route::get('/meta/blog', 'BlogController@meta_index')->name('meta.blog.index');
    Route::get('/meta/blog/{blog:id}', 'BlogController@meta_edit')->name('meta.blog.edit');
    Route::post('/meta/blog/{blog:id}', 'BlogController@meta_update')->name('meta.blog.update');

    // Application Meta
    Route::get('/meta/application', 'ApplicationController@meta_index')->name('meta.application.index');
    Route::get('/meta/application/{application:id}', 'ApplicationController@meta_edit')->name('meta.application.edit');
    Route::post('/meta/application/{application:id}', 'ApplicationController@meta_update')->name('meta.application.update');

    Route::post('/inquiry/deleteAll', 'InquiryController@deleteAll')->name('inquiry.deleteAll');
    Route::post('/product/deleteAll', 'ProductController@deleteAll')->name('product.deleteAll');

    Route::get('/inquiry/dashboard', 'InquiryController@dashboard')->name('inquiry.dashboard');

    Route::post('/author/product', 'ProductController@author')->name('author.product');
    Route::post('/author/blog', 'BlogController@author')->name('author.blog');
    Route::post('/author/application', 'ApplicationController@author')->name('author.application');

    // Restore
    Route::get('/product/restore/{product:id}', 'ProductController@restore')->name('product.restore');
    Route::get('/blog/restore/{blog:id}', 'BlogController@restore')->name('blog.restore');
    Route::get('/application/restore/{application:id}', 'ApplicationController@restore')->name('application.restore');
    Route::get('/faq/restore/{faq:id}', 'FaqController@restore')->name('faq.restore');
    Route::get('/category/restore/{category:id}', 'CategoryController@restore')->name('category.restore');
    Route::get('/blogcategory/restore/{blogcategory:id}', 'BlogcategoryController@restore')->name('blogcategory.restore');
    Route::get('/tag/restore/{tag:id}', 'TagController@restore')->name('tag.restore');
    Route::get('/inquiry/restore/{inquiry:id}', 'InquiryController@restore')->name('inquiry.restore');

    // Product
    Route::post('/product/location', 'ProductController@location')->name('product.location');
    Route::post('/product/image', 'ProductController@image_upload')->name('product.image');
    Route::post('/product/image/detele', 'ProductController@image_delete')->name('product.image.delete');
    Route::post('/product/thumb-image', 'ProductController@thumb_image_upload')->name('product.thumb_image');
    Route::post('/product/thumb-image/detele', 'ProductController@thumb_image_delete')->name('product.thumb_image.delete');
    Route::post('/product/multi-image', 'ProductController@multi_image_upload')->name('product.multi.image');
    Route::post('/product/multi-image/detele', 'ProductController@multi_image_delete')->name('product.multi.image.delete');

    Route::get('/product/permisssion', 'ProductController@permission')->name('product.permission');
    Route::get('/blog/permisssion', 'BlogController@permission')->name('blog.permission');
    Route::get('/application/permisssion', 'ApplicationController@permission')->name('application.permission');

    Route::resources([
        'product' => 'ProductController',
        'inquiry' => 'InquiryController',
    ]);

    Route::get('/profile', 'UserController@profile')->name('profile');

    // About
    Route::get('/about', 'AboutController@edit')->name('about.edit');
    Route::post('/about', 'AboutController@update')->name('about.update');
    Route::post('/about/image', 'AboutController@image_upload')->name('about.image');
    Route::post('/about/image/detele', 'AboutController@image_delete')->name('about.image.delete');

    // Setting
    Route::get('/setting', 'SettingController@edit')->name('setting');
    Route::post('/setting', 'SettingController@update')->name('setting.update');
    Route::post('/setting/logo', 'SettingController@logo_upload')->name('setting.logo');
    Route::post('/setting/logo/detele', 'SettingController@logo_delete')->name('setting.logo.delete');
    Route::post('/setting/favicon', 'SettingController@favicon_upload')->name('setting.favicon');
    Route::post('/setting/favicon/detele', 'SettingController@favicon_delete')->name('setting.favicon.delete');

    // Home Setting
    Route::get('/homesetting', 'SettingController@homeedit')->name('homesetting');
    Route::post('/homesetting', 'SettingController@homeupdate')->name('homesetting.update');

    Route::get('/change-password', 'LoginController@change_password')->name('user.changepassword');
    Route::post('/change-password', 'LoginController@save_password')->name('user.savepassword');

    Route::post('/inquery/{id}', 'DashboardController@destroy')->name('inquery_delete');

    Route::post('/category/deleteAll', 'CategoryController@deleteAll')->name('category.deleteAll');
    Route::post('/blog/deleteAll', 'BlogController@deleteAll')->name('blog.deleteAll');
    Route::post('/blogcategory/deleteAll', 'BlogcategoryController@deleteAll')->name('blogcategory.deleteAll');
    Route::post('/tag/deleteAll', 'TagController@deleteAll')->name('tag.deleteAll');
    Route::post('/faq/deleteAll', 'FaqController@deleteAll')->name('faq.deleteAll');
    Route::post('/slider/deleteAll', 'SliderController@deleteAll')->name('slider.deleteAll');
    Route::post('/application/deleteAll', 'ApplicationController@deleteAll')->name('application.deleteAll');

    Route::post('/user/deleteAll', 'UserController@deleteAll')->name('user.deleteAll');
    Route::post('/role/deleteAll', 'RoleController@deleteAll')->name('role.deleteAll');

    Route::post('/country/deleteAll', 'CountryController@deleteAll')->name('country.deleteAll');
    Route::post('/state/deleteAll', 'StateController@deleteAll')->name('state.deleteAll');
    Route::post('/city/deleteAll', 'CityController@deleteAll')->name('city.deleteAll');

    // Blog
    Route::post('/blog/image', 'BlogController@image_upload')->name('blog.image');
    Route::post('/blog/image/detele', 'BlogController@image_delete')->name('blog.image.delete');
    Route::post('/blog/thumb-image', 'BlogController@thumb_image_upload')->name('blog.thumb_image');
    Route::post('/blog/thumb-image/detele', 'BlogController@thumb_image_delete')->name('blog.thumb_image.delete');

    // Application
    Route::post('/application/image', 'ApplicationController@image_upload')->name('application.image');
    Route::post('/application/image/detele', 'ApplicationController@image_delete')->name('application.image.delete');
    Route::post('/application/thumb-image', 'ApplicationController@thumb_image_upload')->name('application.thumb_image');
    Route::post('/application/thumb-image/detele', 'ApplicationController@thumb_image_delete')->name('application.thumb_image.delete');

    // Category
    Route::post('/category/image', 'CategoryController@image_upload')->name('category.image');
    Route::post('/category/image/detele', 'CategoryController@image_delete')->name('category.image.delete');

    // Blog Category
    Route::post('/blogcategory/image', 'BlogcategoryController@image_upload')->name('blogcategory.image');
    Route::post('/blogcategory/image/detele', 'BlogcategoryController@image_delete')->name('blogcategory.image.delete');

    // Slider
    Route::post('/slider/image', 'SliderController@image_upload')->name('slider.image');
    Route::post('/slider/image/detele', 'SliderController@image_delete')->name('slider.image.delete');


    Route::get('/userhistory', 'UserHistoryController@index')->name('userhistory.index');
    Route::post('/userhistory/deleteAll', 'UserHistoryController@deleteAll')->name('userhistory.deleteAll');

    Route::resources([
        'blog'      => 'BlogController',
        'category'  => 'CategoryController',
        'blogcategory' => 'BlogcategoryController',
        'tag' => 'TagController',
        'faq' => 'FaqController',
        'slider' => 'SliderController',
        'application' => 'ApplicationController',

        'country' => 'CountryController',
        'state' => 'StateController',
        'city' => 'CityController',
        'user' => 'UserController',
        'role' => 'RoleController',
    ]);
});
