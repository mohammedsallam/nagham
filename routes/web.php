<?php

use App\Models\Details;
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

// Route::get('/', function () {
//     return view('admin.web.index');
// });

Route::get('/city', [App\Http\Controllers\CityController::class, 'index'])->name('cityIndex');
Route::post('/Addcity', [App\Http\Controllers\CityController::class, 'create'])->name('cityAdd');
Route::patch('/Editcity/{id}', [App\Http\Controllers\CityController::class, 'update'])->name('cityEdit');
Route::get('/Deletecity/{id}', [App\Http\Controllers\CityController::class, 'delete'])->name('cityDelete');

Route::get('/type/{city?}', [App\Http\Controllers\TypeController::class, 'index'])->name('typeIndex');
Route::post('/Addtype', [App\Http\Controllers\TypeController::class, 'create'])->name('typeAdd');
Route::patch('/Edittype/{id}', [App\Http\Controllers\TypeController::class, 'update'])->name('typeEdit');
Route::delete('/Deletetype/{id}', [App\Http\Controllers\TypeController::class, 'delete'])->name('typeDelete');

Route::get('/content/{type_id}', [App\Http\Controllers\ContentController::class, 'index'])->name('contentIndex');
Route::post('/Addcontent', [App\Http\Controllers\ContentController::class, 'create'])->name('contentAdd');
Route::patch('/Editcontent', [App\Http\Controllers\ContentController::class, 'update'])->name('contentEdit');
Route::delete('/Deletecontent/{id}', [App\Http\Controllers\ContentController::class, 'delete'])->name('contentDelete');

Route::get('/details', [App\Http\Controllers\DetailsController::class, 'index'])->name('detailsIndex');
Route::post('/Adddetails', [App\Http\Controllers\DetailsController::class, 'create'])->name('detailsAdd');
Route::patch('/Editdetails', [App\Http\Controllers\DetailsController::class, 'update'])->name('detailsEdit');
Route::delete('/Deletedetails/{id}', [App\Http\Controllers\DetailsController::class, 'delete'])->name('detailsDelete');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

////relation

//Route::get('/has-one', [App\Http\Controllers\RrlationController::class, 'hasoneRrlation']);
//
Route::get('/has-mny', [App\Http\Controllers\RrlationController::class, 'citytype']);
//
// Route::get('/cities_has_types', [App\Http\Controllers\CityController::class, 'citiesHasTypes']);

// Route::get('/cities_nothas_types', [App\Http\Controllers\CityController::class, 'citiesNotHasTypes']);
