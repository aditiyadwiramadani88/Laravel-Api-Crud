<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductC as Myproduct;
use App\Http\Middleware\Token;


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});



Route::middleware([Token::class])->prefix('crud')->group(function () {
Route::any('/list', [Myproduct::class, 'List_Data']);
Route::any('/details/{id}', [Myproduct::class, 'Details']);

});

Route::post('login', [Myproduct::class, 'Login']);
Route::post('register/', [Myproduct::class, 'Register']);