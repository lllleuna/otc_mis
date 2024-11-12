<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Validation\Rules\Password;

class RegisteredUserController extends Controller
{
    public function create() 
    {
        return view('auth.register');
    }

    public function store()
    {
        $attributes = request()->validate([
            'name' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', Password::min(12), 'confirmed']
        ]);

        $user = User::create($attributes);

        Auth::login($user);

        return redirect('/welcome');
    }
}
