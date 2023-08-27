<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class sessionsController extends Controller
{

    public function create()
    {
        return view('login.create');
    }

    public function store()
    {
        $attributes = request()->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);


//        $credentials = request()->only('email', 'password');

        if (auth()->attempt($attributes))
        {
            return to_route('home')->with('success', 'welcome back!');
        }

        throw ValidationException::withMessages([
            'email' => 'Your provided credentials could not be verified'
        ]);

    }

    public function destroy()
    {
        Auth::logout();

        return to_route('home')->with('success', 'good bye!!');
    }
}
