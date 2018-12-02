<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    
    return response(\App\Flight::all()->toJson());
    
});

$router->get('flights','FlightController@index');

$router->get('flights/{id}','FlightController@show');

$router->get('flights/{id}/seats','SeatsController@index');

$router->get('flights/{id}/seats/{seat_id}','SeatsController@show');

$router->post('flights/{flight_id}/booking[/{class_code}]','BookingController@find_store');

$router->post('flights/{flight_id}/seats/{seat_id}/booking','BookingController@store');

