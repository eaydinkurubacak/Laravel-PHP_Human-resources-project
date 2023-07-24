<?php

use App\Models\Company;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CompanyController;

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

Route::get('/', function () {
    $companies = Company::all();
    return view('login&main' , ['companies' => $companies]);
});

Route::post('/login' , [UserController::class , 'login']);
Route::post('/logout' , [UserController::class , 'logout']);
Route::post('/create-company' , [CompanyController::class , 'createCompany']);
