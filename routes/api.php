<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//Vamos a crear una nueva API
Route::get('post', function(){
    return response()->json([   // Al parecer estamos creando una API que nos retornará un JSON, recuerde que estos se crean en PHP con arrays asociativos
        'post' => [
            [
                'title' => 'Post One'
            ]
        ]
    ]);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
