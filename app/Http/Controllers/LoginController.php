<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index(){
        return view('auth.login');
    }

    //validate user and redirect to feed 
    public function store(Request $request){
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if(!auth()->attempt($request->only('email','password'), $request->remember)){
           return back()->with('message', 'Credenciales Incorrectas');
        }

        return redirect()->route('posts.index', auth()->user()->username);
    }
}
