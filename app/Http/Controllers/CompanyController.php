<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
{
    public function deleteCompany(Company $company){

        if ($company->logo) {
            Storage::delete('public/' . $company->logo);
        }

        $company->delete();
        return redirect('/');
    }

    public function updateCompany(Company $company , Request $request){

        $incomingFields = $request->validate([
            'company_name' => 'required',
            'company_address' => 'nullable',
            'company_phone' => 'nullable|regex:/^[0-9\s+\-\(\)]+$/',
            'company_email' => 'nullable|email:rfc,dns,filter,spoof',
            'company_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|dimensions:min_width=100,min_height=100',
            'company_website' => 'nullable'
        ],[
            'company_name.required' => 'Name is required.',
            'company_logo.dimensions' => 'The image dimensions must be at least 100x100 pixels.',
            'company_email.email' => 'Email must be a valid.',
            'company_phone.regex' => 'The phone number must be a valid format with digits, spaces, hyphens, plus signs, and parentheses.'
        ]);

        $imageName = '';

        if ($request->hasFile('company_logo')) {

            $imageName = time() . '.' . $request->company_logo->extension();  
            $request->company_logo->storeAs('public', $imageName); // storage/app/public/file.png

            if ($company->logo) {
                Storage::delete('public/' . $company->logo);
            }
        } 
        else {
            $imageName = $company->logo;
        }

        $company->name = strip_tags($incomingFields['company_name']);
        $company->address = strip_tags($incomingFields['company_address']);
        $company->phone = strip_tags($incomingFields['company_phone']);
        $company->email = strip_tags($incomingFields['company_email']);
        $company->logo = $imageName;
        $company->website = strip_tags($incomingFields['company_website']);
        $company->save();

        return redirect('/');
    }

    public function showEditScreen(Company $company){
        return view('edit-company' , ['company' => $company]);
    }

    public function createCompany(Request $request){

        $incomingFields = $request->validate([
            'company_name' => 'required',
            'company_address' => 'nullable',
            'company_phone' => 'nullable|regex:/^[0-9\s+\-\(\)]+$/',
            'company_email' => 'nullable|email:rfc,dns,filter,spoof',
            'company_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|dimensions:min_width=100,min_height=100',
            'company_website' => 'nullable'
        ],[
            'company_name.required' => 'Name is required.',
            'company_logo.dimensions' => 'The image dimensions must be at least 100x100 pixels.',
            'company_email.email' => 'Email must be a valid.',
            'company_phone.regex' => 'The phone number must be a valid format with digits, spaces, hyphens, plus signs, and parentheses.'
        ]);
        
        $imageName = time() . '.' . $request->company_logo->extension();  
        $request->company_logo->storeAs('public', $imageName); // storage/app/public/file.png

        $company = Company::create([
            'name' => strip_tags($incomingFields['company_name']),
            'address' => strip_tags($incomingFields['company_address']),
            'phone' => strip_tags($incomingFields['company_phone']),
            'email' => strip_tags($incomingFields['company_email']),
            'logo' => $imageName,
            'website' => strip_tags($incomingFields['company_website'])
        ]);

        return redirect('/');
    }
}