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

Route::group(["namspace"=>"App\Http\Controllers"],function(){

    /*
     * Home Routes
     */
    Route::get("/","HomeController@index")->name("home.index");

    Route::middleware("guest")->group(function(){
        /*
         * Register Routes
         */

        /*Display form*/
        Route::get("/register","auth\RegisterController@show")
            ->name("register.show");
        /*Create new account*/
        Route::post("/register","auth\RegisterController@register")
            ->name("register.perform");

        /*
         * Login Routes
         */

        /*Display login form*/
        Route::get("login","auth\LoginController@show")
            ->name("login.show");

        /*Login user*/
        Route::post("login","auth\LoginController@login")
            ->name("login.perform");
    });

    Route::middleware("auth")->group(function(){
        /*
         * Logout Routes
         */
        Route::get("logout","users\LogoutController@perform")
            ->name("logout.perform");
    });
});
