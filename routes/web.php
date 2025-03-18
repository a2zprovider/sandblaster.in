<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

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

Route::any('admin-access', function () {
    return false;
});

Route::get('/sitemap.xml', 'HomeController@sitemap');
Route::get('/', [HomeController::class, "index"])->name('home');

Route::get('contact', 'HomeController@contact')->name('contact');
Route::get('about', 'HomeController@about')->name('about');

Route::get('blogs', [HomeController::class, "blog_list"])->name('blog');

Route::get('products', 'HomeController@page_list')->name('page.list');
Route::get('application', 'HomeController@apl_list')->name('apl.list');

Route::post('inquery', 'HomeController@inquery')->name('inquery');

Route::post('inquerysp', 'HomeController@inquerysp')->name('inquerysp');

Route::post('ajexinquery', 'HomeController@ajexinquery')->name('ajexinquery');
Route::get('/blog/{post:slug}', 'HomeController@blog_detail')->name('blog.detail');
Route::get('{page:slug}', 'HomeController@page')->name('page');
Route::get('application/{app:slug}', 'HomeController@apl_detail')->name('application');

Route::get('/blog/category/{slug}', [HomeController::class, 'category'])->name('blog.category');
Route::get('/blog/tag/{slug}', [HomeController::class, 'tag'])->name('blog.tag');

Route::get('/blog/year/{year}', [HomeController::class, 'filterByYear'])->name('blog.year');



