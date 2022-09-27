<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategoryController;
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

Route::get('/', function () {
    return view('welcome');
});



Route::get('/dashboard',[CategoryController::class, 'index'])
    ->middleware(['auth'])->name('dashboard');
Route::get('/articles',[ArticleController::class, 'show'])->name('articles');
Route::get('/categories',[CategoryController::class, 'show'])->name('categories');

Route::middleware('auth')->prefix('article')->group(function (){
    Route::get('/',[ArticleController::class, 'create'])->name('article_create');
    Route::post('/',[ArticleController::class, 'store'])->name('article_store');
    Route::get('/{article}', [ArticleController::class, 'edit'])->name('article_edit');
    Route::post('/{article}', [ArticleController::class, 'update'])->name('article_update');
    Route::post('/delete/{article}', [ArticleController::class, 'delete'])->name('article_delete');
    Route::post('/publish/{article}', [ArticleController::class, 'publish'])->name('article_publish');
    Route::post('/draft/{article}', [ArticleController::class, 'draft'])->name('article_draft');
});

Route::middleware('auth')->prefix('category')->group(function (){
    Route::get('/',[CategoryController::class, 'create'])->name('category_create');
    Route::post('/',[CategoryController::class, 'store'])->name('category_store');
    Route::get('/{category}', [CategoryController::class, 'edit'])->name('category_edit');
    Route::post('/{category}', [CategoryController::class, 'update'])->name('category_update');
    Route::post('/delete/{category}', [CategoryController::class, 'delete'])->name('category_delete');
    Route::post('/publish/{category}', [CategoryController::class, 'publish'])->name('category_publish');
    Route::post('/draft/{category}', [CategoryController::class, 'draft'])->name('category_draft');
});
require __DIR__.'/auth.php';


Route::group(['prefix' => 'blog'], function () {
    Route::get('/ascending', [BlogController::class, 'ascending'])->name('sort_ascending');
    Route::get('/descending', [BlogController::class, 'descending'])->name('sort_descending');
    Route::get('/{category}', [BlogController::class, 'filter'])->name('filter');
    Route::get('/article/{article}', [BlogController::class, 'readArticle'])->name('read_article');
    Route::get('/', [BlogController::class, 'index'])->name('blog');
    Route::get('/hashtags/{hashtag}', [BlogController::class, 'searchHashtag'])->name('search_hashtag');
});
