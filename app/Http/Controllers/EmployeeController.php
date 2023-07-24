<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function createEmployee(Request $request){

        $incomingFields = $request->validate([
            'employee_firstname' => 'required',
            'employee_lastname' => 'required',
            'employee_email' => 'nullable',
            'employee_phone' => 'required',
            'selected_company' => 'required'
        ]);
   
        // DB kayıt işlemi başarılı. ?
        $company = Employee::create([
            'first_name' => strip_tags($incomingFields['employee_firstname']),
            'last_name' => strip_tags($incomingFields['employee_lastname']),
            'phone' => strip_tags($incomingFields['employee_email']),
            'email' => strip_tags($incomingFields['employee_phone']),
            'company_id' => $incomingFields['selected_company']
        ]);
        
        return redirect('/');
    }
}
