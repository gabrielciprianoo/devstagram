<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LogoutController extends Controller
{
    // logout user and redirect to login
    public function store(){
        auth()->logout();
        return redirect()->route('login');
    }
}
