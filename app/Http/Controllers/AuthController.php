<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function login()
    {
        return view('login');
    }
    
    public function register()
    {
        return view('register');
    }

    public function authenticating(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            // $request->session()->regenerate();
            // return redirect()->intended('dashboard');
            if (Auth::user()->status != 'active'){
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                Session::flash('status', 'failed');
                Session::flash('message', 'Your account is not active yet,please contact admin!');
                return redirect('/login');
            }

            if(Auth::user()->role_id == 1){
                return redirect('/dashboard');
            }

            if(Auth::user()->role_id == 2){
                return redirect('/user-rental');
            }

            if(Auth::user()->role_id == 3){
                return redirect('/dashboard/officer');
            }
            // $request->session()->regenerate();
            // if
            // return redirect();
        }

        Session::flash('status', 'failed');
        Session::flash('message', 'Login infalid');
        return redirect('/login');

    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');   
    }

    function registerProcess(Request $request){
        $validated = $request->validate([
            'username' => 'required|unique:users|max:255',
            'password' =>  'required|max:255',
            'nis' => 'required|unique:users|min:12',
            'class' => 'required|max:20',
            'phone' =>  'max:255',
            'address' =>  'required',
        ]);
        // need import class
        $request['password'] = Hash::make($request->password);
        $user = User::create($request->all());

        Session::flash('status', 'success');
        Session::flash('message', 'Register success.Wait admin to approved');

        return redirect('/register');
    }
}


