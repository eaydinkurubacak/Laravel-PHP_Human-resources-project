<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
{
    public function updateCompany(Company $company , Request $request){

        $incomingFields = $request->validate([
            'company_name' => 'required',
            'company_address' => 'nullable',
            'company_phone' => 'nullable',
            'company_email' => 'nullable',
            'company_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'company_website' => 'nullable'
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

        $company->name = $incomingFields['company_name'];
        $company->address = $incomingFields['company_address'];
        $company->phone = $incomingFields['company_phone'];
        $company->email = $incomingFields['company_email'];
        $company->logo = $imageName;
        $company->website = $incomingFields['company_website'];
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
            'company_phone' => 'nullable',
            'company_email' => 'nullable',
            'company_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'company_website' => 'nullable'
        ]);
        
        $imageName = time() . '.' . $request->company_logo->extension();  
        $request->company_logo->storeAs('public', $imageName); // storage/app/public/file.png

        // DB kayıt işlemi başarılı.
        $company = Company::create([
            'name' => $incomingFields['company_name'],
            'address' => $incomingFields['company_address'],
            'phone' => $incomingFields['company_phone'],
            'email' => $incomingFields['company_email'],
            'logo' => $imageName,
            'website' => $incomingFields['company_website']
        ]);

        return redirect('/');
    }
}
