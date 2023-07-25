<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function updateEmployee(Employee $employee , Request $request){

        $incomingFields = $request->validate([
            'employee_firstname' => 'required',
            'employee_lastname' => 'required',
            'employee_email' => 'nullable',
            'employee_phone' => 'required',
        ]);

        $incomingFields['employee_firstname'] = strip_tags($incomingFields['employee_firstname']);
        $incomingFields['employee_lastname'] = strip_tags($incomingFields['employee_lastname']);
        $incomingFields['employee_email'] = strip_tags($incomingFields['employee_email']);
        $incomingFields['employee_phone'] = strip_tags($incomingFields['employee_phone']);

        $employee->first_name = $incomingFields['employee_firstname'];
        $employee->last_name = $incomingFields['employee_lastname'];
        $employee->email = $incomingFields['employee_email'];
        $employee->phone = $incomingFields['employee_phone'];

        $employee->save();
        return redirect('/');
    }

    public function showEditScreen(Employee $employee){
        return view('edit-employee' , ['employee' => $employee]);
    }

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
            'email' => strip_tags($incomingFields['employee_phone']),
            'phone' => strip_tags($incomingFields['employee_email']),
            'company_id' => $incomingFields['selected_company']
        ]);
        
        return redirect('/');
    }
}
