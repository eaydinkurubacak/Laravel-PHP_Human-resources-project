<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function deleteEmployee(Employee $employee){
        $employee->delete();
        return redirect('/');
    }

    public function updateEmployee(Employee $employee , Request $request){

        $incomingFields = $request->validate([
            'employee_firstname' => 'required',
            'employee_lastname' => 'required',
            'employee_email' => 'nullable|email:rfc,dns,filter,spoof',
            'employee_phone' => 'required|regex:/^[0-9\s+\-\(\)]+$/',
        ],[
            'employee_firstname.required' => 'First name is required.',
            'employee_lastname.required' => 'Last name is required.',
            'employee_phone.required' => 'Phone number is required.',
            'employee_email.email' => 'Email must be a valid.',
            'employee_phone.regex' => 'The phone number must be a valid format with digits, spaces, hyphens, plus signs, and parentheses.'
        ]);

        $employee->first_name = strip_tags($incomingFields['employee_firstname']);
        $employee->last_name = strip_tags($incomingFields['employee_lastname']);
        $employee->email = strip_tags($incomingFields['employee_email']);
        $employee->phone = strip_tags($incomingFields['employee_phone']);

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
            'employee_email' => 'nullable|email:rfc,dns,filter,spoof',
            'employee_phone' => 'required|regex:/^[0-9\s+\-\(\)]+$/',
            'selected_company' => 'required'
        ],[
            'employee_firstname.required' => 'First name is required.',
            'employee_lastname.required' => 'Last name is required.',
            'employee_phone.required' => 'Phone number is required.',
            'employee_email.email' => 'Email must be a valid.',
            'employee_phone.regex' => 'The phone number must be a valid format with digits, spaces, hyphens, plus signs, and parentheses.',
            'selected_company.required' => 'Please select a company for the employee.'
        ]);
   
        $company = Employee::create([
            'first_name' => strip_tags($incomingFields['employee_firstname']),
            'last_name' => strip_tags($incomingFields['employee_lastname']),
            'email' => strip_tags($incomingFields['employee_email']),
            'phone' => strip_tags($incomingFields['employee_phone']),
            'company_id' => $incomingFields['selected_company']
        ]);
        
        return redirect('/');
    }
}