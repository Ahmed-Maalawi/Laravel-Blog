<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class RegisterController extends Controller
{
    public function create()
    {
        return view('register.create');
    }

    public function store()
    {
        // create the user

        $attributes = request()->validate([
            'name' => 'required|max:255',
            'user_name' => 'required|min:3|max:255|unique:users,user_name',
            'email' => ['required', 'min:3', 'max:255', Rule::unique('users', 'email')],
            'password' => 'required|min:7|max:255',
        ]);

        $user = User::create($attributes);

        Auth::login($user);

        return to_route('home')->with('success', 'Your account has been created.');
    }
}
