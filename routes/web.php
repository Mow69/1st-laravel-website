<?php

use App\Http\Controllers\PagesController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', "PagesController@accueil");

Auth::routes();



// PRODUITS

// Route::get('/produits/create', "ProduitsController@create")->middleware(('auth')); // si je veux protéger la création de produit par l'authentification préalable du user

Route::get('/produits/create', "ProduitsController@create");

Route::get('/produits/{produit}/edit', "ProduitsController@edit");


// Route::get('/produits/{produit}', "ProduitsController@show");

// Route::get('/produits', "ProduitsController@index");

// Ou si j'ai bien dans menu.blade.php le href={{route}}
Route::get('/produits/{produit}', "ProduitsController@show")->name("produits.show");
Route::get('/produits', "ProduitsController@index")->name("produits.index");



Route::put('/produits/{produit}', "ProduitsController@update");

Route::post('/produits', "ProduitsController@store");


Route::delete('/produits/{produit}', "ProduitsController@destroy");



// Ou pour avoir accès aux 7 routes accessibles (crud) de la route /produits) :
// Route::resource("produits", "ProduitsController");

// PAGES
Route::get('/about', "PagesController@about");

Route::get('/contact', "PagesController@contact");

Route::post('/contact', "PagesController@store");


Route::get('/home', 'HomeController@index')->name('home');
