<?php

use App\Models\Company;
use App\Models\Employee;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EmployeeController;

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
    $employees = Employee::all();
    return view('login&main' , ['companies' => $companies , 'employees' => $employees]);
});

Route::post('/login' , [UserController::class , 'login']);
Route::post('/logout' , [UserController::class , 'logout']);
Route::post('/create-company' , [CompanyController::class , 'createCompany']);
Route::post('/create-employee' , [EmployeeController::class , 'createEmployee']);

Route::get('/edit-company/{company}' , [CompanyController::class , 'showEditScreen']);
Route::put('/edit-company/{company}' , [CompanyController::class , 'updateCompany']);

Route::get('/edit-employee/{employee}' , [EmployeeController::class , 'showEditScreen']);
Route::put('/edit-employee/{employee}' , [EmployeeController::class , 'updateEmployee']);