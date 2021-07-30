<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/sidemenu', function () {
    return Auth::user()->notes()->with('sections:id,note_id,title')->get();
})->middleware('auth:sanctum');

Route::post('/section', 'SectionController@store');
Route::get('/section/{section}', 'SectionController@show');
Route::patch('/section/{section}', 'SectionController@update');
Route::delete('/section/{section}/destroy', 'SectionController@delete');

Route::get('notename', function () {
    return auth()->user()->notes()->select('name')->get();
});
