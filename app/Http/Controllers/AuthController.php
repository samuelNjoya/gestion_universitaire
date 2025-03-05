<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(){
        // echo Hash::make(123456);
        // die;
        // dd(Hash::make(123456));
        return view('auth.login');
    }

    public function logout(){
        Auth::logout();
        return redirect(url(''));
    }

    public function auth_login(Request $request){
           //dd($request->all());
        //    $this->validate($request, [
        //     'email'   => 'required|email',
        //     'password' => 'required|min:6'
        // ]);
           if(Auth::attempt(['email' => $request->email, 'password' => $request->password, 'is_delete' => 0], true)){

             if(Auth::user()->is_admin == 5)
             {
                return redirect('teacher/dashboard');
             }else if(Auth::user()->is_admin == 6)
             {
                return redirect('student/dashboard');
             }else
             {
                return redirect('panel/dashboard');
             }
           
           }else{
            return redirect()->back()->with('error','enter current email and password');
           }
    }

    public function forgot(){
        return view('auth.forgot');
       
    }
}
