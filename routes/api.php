<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\ClasseController;
use App\Http\Controllers\API\ApiController;
use App\Http\Controllers\API\RoleController;
use App\Http\Controllers\API\EcoleController;
use App\Http\Middleware\isSuperAdminMiddleware;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// Route::post('register', [ApiController::class, 'register']);
Route::post('login', [ApiController::class, 'login']);
//Route protected 
Route::group(['middleware' => 'auth:api'], function () {
    Route::get('logout', [ApiController::class, 'logout']);
    // Route::get('profile', [ApiController::class, 'profile']);
    // Route::put('update-profile/{user}', [ApiController::class, 'updateProfile']);
    Route::get('refreshToken', [ApiController::class, 'refreshToken']);
});



Route::post('/v1-generate-video', [VideoController::class, 'v1GenerateVideo']);
Route::post('/create-video',[VideoController::class,'store']);

Route::apiResource('ecoles', EcoleController::class);
Route::apiResource('classes', ClasseController::class);





//if user is not logged in
// Route::get('login-auth', function (){
// return response()->json([
//     'error' => 'Unauthenticated',
// ], 404);
// })->name('login');
Route::get('documentation', function () {
    return view('api-docs.index');
});