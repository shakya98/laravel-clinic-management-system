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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('addPatient', [\App\Http\Controllers\Controller::class, 'addPatient'])->name('api.addPatient');
Route::post('addRecord/{id}', [\App\Http\Controllers\Controller::class, 'addRecord'])->name('api.addRecord');
Route::post('getTotalBillAmount', [\App\Http\Controllers\Controller::class, 'getTotalBillAmount'])->name('api.getTotalBillAmount');
Route::get('getPatients', [\App\Http\Controllers\Controller::class, 'getPatients'])->name('api.getPatients');
