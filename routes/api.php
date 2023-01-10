<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\ContactController;
use App\Http\Controllers\API\NewsletterController;

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

Route::post('login', [AuthController::class, 'signin']);
Route::post('register', [AuthController::class, 'signup']);
Route::post('contacts/create', [ContactController::class, 'store']);
//Route::post('newsletter/create', [NewsletterController::class, 'store']);
//Route::delete('newsletter-lists/delete', [NewsletterController::class, 'delete']);
Route::resource('newsletters', NewsletterController::class);

//Route::get('contacts', [ContactController::class, 'index']);
//Route::post('contacts/update', [ContactController::class, 'update']);

Route::middleware('auth:sanctum')->group( function () {
    Route::resource('contacts', ContactController::class);
    //Route::resource('newsletter-lists', NewsletterController::class);
});
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
