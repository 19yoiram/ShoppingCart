<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Rules\TemplateEmail;
use Illuminate\Http\Request;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\RedirectResponse;

class LoginController extends Controller
{

    public function  index()
    {
        return view('login');
    }

    public function authenticate(Request $request)
    {
    
      
        $request->validate(
            [
                'email' => 'required|email',
                'password' => 'required',
            ]
        );

            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                
                return redirect()->route('home');
            } else {

                return redirect()->route('account.login')
                    ->with('error', 'either email or password is incorrect');
            }
    } 
    
    public function register()
    {
        return view('register');
    }

    public function processRegister(Request $request)
    {
        $request->validate(
            [
            'name'=> 'required',
            'email' => 'required', 'email', 'unique:users',
            'password' => 'required|confirmed',

            ]
    ); 

    User::create($request->all());

            return redirect()->route('account.login')
                ->with('success', 'you have registered successfully.');
        
    }

    public function logout()
    {  
        session()->forget('cart');
         Auth::logout();
        return redirect()->route('account.login');
        
    }
}


