<?php

use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('sampleview.index');
// });

Route::get('/',[App\Http\Controllers\SampleController::class,'index']);
Route::get('sample',[App\Http\Controllers\SampleController::class,'index']);
Route::get('sample/create',[App\Http\Controllers\SampleController::class,'create']);
Route::post('sample/create',[App\Http\Controllers\SampleController::class,'store']);
Route::get('sample/{id}/edit',[App\Http\Controllers\SampleController::class,'edit']);
Route::put('sample/{id}/edit',[App\Http\Controllers\SampleController::class,'update']);
Route::get('sample/{id}/delete',[App\Http\Controllers\SampleController::class,'destroy']);
// Route::delete('sample/{id}', [App\Http\Controllers\SampleController::class, 'destroy'])->name('sample.destroy');

