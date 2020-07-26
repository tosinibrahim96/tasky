<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
  return $request->user();
});


Route::namespace('API')->prefix('/v1')->group(function () use ($router) {
  Route::apiResources(['projects' => 'ProjectController', 'tasks' => 'TaskController', 'projects.payments' => 'PaymentController']);
  Route::get('/dashboard', 'DashboardController@index');
  Route::post('/auth/register', 'AuthController@register');
  Route::post('/auth/login', 'AuthController@login');
});
