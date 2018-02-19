<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


$api = app('Dingo\Api\Routing\Router');


$api->version("v1", function($api){

// $api->group(['middleware' => 'cors'], function ($api) {

    $pong = function () {
        return "pong";
    };

    $api->get( '/ping', $pong );


    //TestSansToken
    $api->get("ping", "App\Http\Controllers\TestController@ping");

    //ForAdmin
    $api->post('addMoney', 'App\Http\Controllers\Api\Money\MoneyController@insertAllMoney');

    //Auth
    $api->post('login', 'App\Http\Controllers\Api\Auth\LoginController@login');
    $api->post('register', 'App\Http\Controllers\Api\Auth\RegisterController@register');

    //CheckAuth
    $api->post("checkAuth", "App\Http\Controllers\Api\Auth\CheckController@checkAuth");

    //Logout -> blacklist token
    $api->post("logOut",'App\Http\Controllers\Api\Auth\LogOutController@logOut');

    //Secure
    $api->group(["middleware" => "api.auth"], function($api){

        //TestAvecToken
        $api->get("pingSecure", "App\Http\Controllers\TestController@pingSecure");

        //Favoris
        $api->post("getFavoris", "App\Http\Controllers\Api\User\FavorisController@getFavoris");
        $api->post("addFavoris", "App\Http\Controllers\Api\User\FavorisController@addFavoris");
        $api->post("deleteFavoris", "App\Http\Controllers\Api\User\FavorisController@deleteFavoris");

    });
// });
});





