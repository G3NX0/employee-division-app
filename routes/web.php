<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Divisions;
use App\Http\Controllers\Controller;
use App\Http\Requests\DivisionController;
use App\Http\Controllers\EmployeeController;


Route::get('/', function () {
    return view('home');
});
Route::get('divisions', [Divisions::class, 'index']);
Route::get('divisions/create', [Divisions::class, 'create']);
Route::post("divisions/store",[Divisions::class,"store"]);
Route::get("divisions/{id}/delete", [Divisions::class,"destroy"]);
Route::get("divisions/{id}/edit", [Divisions::class,"edit"]);
Route::put('divisions/{id}', [Divisions::class, 'update']);

Route::resource('employees', EmployeeController::class);
