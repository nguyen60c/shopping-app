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
use App\Http\Controllers\carts\CartController;
use App\Http\Controllers\orders\OrderDetailsController;
use App\Http\Controllers\orders\OrderController;

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
        Route::group(["middleware" => ["role:user"]], function () {
            Route::get("/cart", [CartController::class, "index"])
                ->name("cart.index");

            Route::get("/cart/products",[CartController::class, "products"])
                ->name("cart.products");

            Route::post("/cart/add", [CartController::class, "add"])
                ->name("cart.store");

            Route::post("/cart/update", [CartController::class, "update"])
                ->name("cart.update");

            Route::post("/cart/remove", [CartController::class, "remove"])
                ->name("cart.remove");

            Route::post("/cart/clear", [CartController::class, "clear"])
                ->name("cart.clear");
        });

        /*
         * Orders details Routes
         */
        Route::group(["middleware" => ["role:user"]], function () {
            Route::get("/order", [OrderDetailsController::class, "index"])
                ->name("order.index");
            Route::post("/order",[OrderDetailsController::class, "store"])
                ->name("order.store");
        });

        /*Order Routes*/
        Route::group(["middleware"=>["role:user"]],function(){
            Route::get("orders",[OrderController::class,"index"])
                ->name("orders.index");
        });

        /*
         * Product Routes
         */
        Route::group(['middleware' => 'role:admin|seller|user'], function () {
            Route::get('/products', [productsController::class, "index"])->name('products.index');
            Route::get('/products/create', [productsController::class, "create"])->name('products.create');
            Route::post('/products/create', [productsController::class, "store"])->name('products.store');
            Route::get('/products/{product}/show', [productsController::class, "show"])->name('products.show');
            Route::get('/products/{product}/edit', [productsController::class, "edit"])->name('products.edit');
            Route::patch('/products/{product}/update', [productsController::class, "update"])->name('products.update');
            Route::delete('/products/{product}/delete', [productsController::class, "destroy"])->name('products.destroy');

            /*Ajax*/
            Route::get("/{product}/fetch", [productsController::class, "fetchProduct"])
                ->name("product.fetch");
            Route::get("/fetch", [productsController::class, "fetchProducts"])
                ->name("products.fetch");

        });

        Route::resource('roles', RolesController::class)
            ->middleware(["role:admin"]);
        Route::resource('permissions', PermissionsController::class)
            ->middleware(["role:admin"]);
    });
});
