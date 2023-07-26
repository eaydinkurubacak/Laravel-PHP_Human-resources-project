<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function login(Request $request){
        $incomingFields = $request->validate([
            'login_email' => 'required',
            'login_password' => 'required'
        ]);

        if(auth()->attempt(['email' => $incomingFields['login_email'],'password' => $incomingFields['login_password']])){
            $request->session()->regenerate();
        }

        return redirect('/');
    }

    public function logout(){
        auth()->logout();
        return redirect('/');
    }
}