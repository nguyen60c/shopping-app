<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\products\ProductsController;
use App\Http\Controllers\auth\RegisterController;
use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\users\HomeController;
use App\Http\Controllers\users\LogoutController;
use App\Http\Controllers\users\UsersController;
use App\Http\Controllers\permissions\RolesController;
use App\Http\Controllers\permissions\PermissionsController;
use App\Http\Controllers\products\CartController;

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

Route::group(["namspace" => "App\Http\Controllers"], function () {

    /*
     * Home Routes
     */
    Route::get("/", [HomeController::class, "index"])->name("home.index");
    Route::post("/add-to-cart", [HomeController::class, "addToCart"])
        ->name("index.add-cart")
        ->middleware("auth");

    Route::middleware("guest")->group(function () {
        /*
         * Register Routes
         */

        /*Display form*/
        Route::get("/register", [RegisterController::class, "show"])
            ->name("register.show");
        /*Create new account*/
        Route::post("/register", [RegisterController::class, "register"])
            ->name("register.perform");

        /*
         * Login Routes
         */

        /*Display login form*/
        Route::get("login", [LoginController::class, "show"])
            ->name("login.show");

        /*Login user*/
        Route::post("login", [LoginController::class, "login"])
            ->name("login.perform");
    });

    Route::middleware("auth")->group(function () {
        /*
         * Logout Routes
         */
        Route::get("logout", [LogoutController::class, "perform"])
            ->name("logout.perform");

        /*
         * User Routes
         */
        Route::group(['prefix' => 'users'], function () {
            Route::get('/', [UsersController::class, "index"])->name("users.index");
            Route::get('/create', [UsersController::class, "create"])->name("users.create");
            Route::post('/create', [UsersController::class, "store"])->name("users.store");
            Route::get('/{user}/show', [UsersController::class, "show"])->name("users.show");
            Route::get('/{user}/edit', [UsersController::class, "edit"])->name("users.edit");
            Route::patch('/{user}/update', [UsersController::class, "update"])->name("users.update");
            Route::delete('/{user}/delete', [UsersController::class, "destroy"])->name("users.destroy");
        });

        /*
         * Cart Routes
         */
        Route::Group(["prefix" => "cart"], function () {
            Route::get("/", [CartController::class, "index"])
                ->name("cart.index")
                ->middleware("auth");
        });

        /*
         * Product Routes
         */
        Route::group(['prefix' => 'products'], function () {
            Route::get('/', [productsController::class, "index"])->name('products.index');
            Route::get('/create', [productsController::class, "create"])->name('products.create');
            Route::post('/create', [productsController::class, "store"])->name('products.store');
            Route::get('/{product}/show', [productsController::class, "show"])->name('products.show');
            Route::get('/{product}/edit', [productsController::class, "edit"])->name('products.edit');
            Route::patch('/{product}/update', [productsController::class, "update"])->name('products.update');
            Route::delete('/{product}/delete', [productsController::class, "destroy"])->name('products.destroy');

            /*Ajax*/
            Route::get("/{product}/fetch", [productsController::class, "fetchProduct"])
                ->name("product.fetch");
            Route::get("/fetch", [productsController::class, "fetchProducts"])
                ->name("products.fetch");
        });

        Route::resource('roles', RolesController::class);
        Route::resource('permissions', PermissionsController::class);
    });
});
