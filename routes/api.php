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
Route::prefix('v1')->group(function (){

    /*
     * Login & Register
     */
    Route::post('register',[
        \App\Http\Controllers\v1\UserController::class,'register'
    ]);

    Route::post('login',[
        \App\Http\Controllers\v1\UserController::class,'login'
    ]);

    Route::prefix('user')->middleware('token')->group(function (){

        Route::get('',[
            \App\Http\Controllers\v1\UserController::class,'show'
        ]);

        /*
         * Manage Credit Carts
         */

        Route::prefix('credential')->group(function (){
            Route::get('',[
                \App\Http\Controllers\v1\CredentialController::class,'index'
            ]);

            Route::post('',[
                \App\Http\Controllers\v1\CredentialController::class,'store'
            ]);

            Route::delete('{credential}',[
                \App\Http\Controllers\v1\CredentialController::class,'destroy'
            ]);

            Route::get('{credential}',[
                \App\Http\Controllers\v1\CredentialController::class,'show'
            ]);
        });

    });
});
