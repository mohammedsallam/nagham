<?php

use App\Models\Detail;
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

 Route::get('/', function () {
     return redirect()->route('login');
 });


Route::group(['middleware' => 'auth'], function(){
    Route::get('/home', [App\Http\Controllers\Admin\HomeController::class, 'index'])->name('home');

    Route::resource('/cities', App\Http\Controllers\Admin\CityController::class);
    Route::resource('/types', App\Http\Controller\Admin\TypeController::class);
    Route::resource('/contents', App\Http\Controllers\Admin\ContentController::class);
    Route::resource('/details', App\Http\Controllers\Admin\DetailsController::class);
    Route::resource('/users', App\Http\Controllers\Admin\UserController::class);

});

Auth::routes();



//Route::get('/has-one', [App\Http\Controllers\RrlationController::class, 'hasoneRrlation']);
//
Route::get('/has-mny', [App\Http\Controllers\RrlationController::class, 'citytype']);
//
// Route::get('/cities_has_types', [App\Http\Controllers\CityController::class, 'citiesHasTypes']);

// Route::get('/cities_nothas_types', [App\Http\Controllers\CityController::class, 'citiesNotHasTypes']);
