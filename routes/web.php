<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\ReviewController;

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

Route::get('/upload', function () {
    return view('upload');
});

Route::post('/upload', [UploadController::class, 'uploadToDB']);



Route::get('/review', [ReviewController::class, 'parseDB']);

Route::post('/review', [ReviewController::class, 'parseDBWithParams']);

