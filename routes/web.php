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

// $router->get('/', function () use ($router) {
//     return $router->app->version();
// });

$router->get('login/','UserController@authenticate');

$router->group(['prefix' => 'fields', 'middleware' => 'auth'], function () use ($router) {
    $router->get('/{id}', [ 'as' => 'fields.show', 'uses' => 'FieldController@show']);
    $router->get('/', [ 'as' => 'fields.index', 'uses' => 'FieldController@index']);
    $router->post('/', [ 'as' => 'fields.store', 'uses' => 'FieldController@store']);
    $router->put('/{id}', [ 'as' => 'fields.update', 'uses' => 'FieldController@update']);
    $router->delete('/{id}', [ 'as' => 'fields.destroy', 'uses' => 'FieldController@destroy']);
});

$router->group(['prefix' => 'tractors', 'middleware' => 'auth'], function () use ($router) {
    $router->get('/{id}', [ 'as' => 'tractors.show', 'uses' => 'TractorController@show']);
    $router->get('/', [ 'as' => 'tractors.index', 'uses' => 'TractorController@index']);
    $router->post('/', [ 'as' => 'tractors.store', 'uses' => 'TractorController@store']);
    $router->put('/{id}', [ 'as' => 'tractors.update', 'uses' => 'TractorController@update']);
    $router->delete('/{id}', [ 'as' => 'tractors.destroy', 'uses' => 'TractorController@destroy']);
});

$router->group(['prefix' => 'processed-fields', 'middleware' => 'auth'], function () use ($router) {
    $router->get('/report', [ 'as' => 'processed-fields.report', 'uses' => 'ProcessedFieldController@report']);
    $router->get('/approve/{id}', [ 'as' => 'processed-fields.approve', 'uses' => 'ProcessedFieldController@approve']);
    $router->get('/{id}', [ 'as' => 'processed-fields.show', 'uses' => 'ProcessedFieldController@show']);
    $router->get('/', [ 'as' => 'processed-fields.index', 'uses' => 'ProcessedFieldController@index']);
    $router->post('/', [ 'as' => 'processed-fields.store', 'uses' => 'ProcessedFieldController@store']);
    $router->put('/{id}', [ 'as' => 'processed-fields.update', 'uses' => 'ProcessedFieldController@update']);
    $router->delete('/{id}', [ 'as' => 'processed-fields.destroy', 'uses' => 'ProcessedFieldController@destroy']);
});

