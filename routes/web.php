<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IngredientController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::resource('ingredients', IngredientController::class);
    Route::resource('recipes', RecipeController::class);
    Route::get('/', [HomeController::class, 'index'])->name('home');
});

Route::match(['get', 'patch'], '/recipes/{recipe}/public', [RecipeController::class, 'updatePublicStatus'])->name('recipes.updatePublicStatus');




