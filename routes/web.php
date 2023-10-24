<?php

use App\Http\Controllers\BoxesController;
use App\Http\Controllers\RoomsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/test', [\App\Http\Controllers\TestController::class, 'test']);

Route::any( '/{any}', function(){
    return view('main');
})->where('any', '^((?!api\/).)*$');

Route::prefix("api")->group(function () {
    Route::middleware('clearRoomsCache')->group(function () {
        Route::prefix("boxes")->group(function () {
            Route::post('/', [BoxesController::class, 'importBoxes']);
            Route::put('/', [BoxesController::class, 'moveBoxes']);
            Route::delete('/', [BoxesController::class, 'exportBoxes']);
        });
    });

    Route::prefix("rooms")->group(function () {
        Route::get('/', [RoomsController::class, 'getRooms']);
    });
});
