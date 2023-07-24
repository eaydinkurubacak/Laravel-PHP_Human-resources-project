<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function createCompany(Request $request){

        $incomingFields = $request->validate([
            'company_name' => 'required',
            'company_address' => 'nullable',
            'company_phone' => 'nullable',
            'company_email' => 'nullable',
            'company_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'company_website' => 'nullable'
        ]);

        // return $incomingFields['company_logo']; // directory dönüyor.

        
        $imageName = time() . '.' . $request->company_logo->extension();  
        $request->company_logo->storeAs('public', $imageName); // storage/app/public/file.png

        /*
        Company::create($incomingFields);
        */

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
