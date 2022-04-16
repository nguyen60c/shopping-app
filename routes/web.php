<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\auth\RegisterController;
use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\users\HomeController;
use App\Http\Controllers\users\LogoutController;

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
    });
});
