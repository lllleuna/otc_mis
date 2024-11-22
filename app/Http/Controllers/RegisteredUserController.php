<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\Rule;

class RegisteredUserController extends Controller
{
    public function index() 
    {
        $users = User::orderBy('created_at', 'desc')->paginate(10);
        return view('users.index',compact('users'));
    }

    public function search(Request $request) 
    {
        $search = $request->search;

        $users = User::where(function($query) use ($search){

            $query->where('firstname', 'like', "%$search%")
            ->orWhere('lastname', 'like', "%$search%")
            ->orWhere('division', 'like', "%$search%")
            ->orWhere('employee_id_no', 'like', "%$search%")
            ->orWhere('role', 'like', "%$search%");
        })
        ->orderBy('created_at', 'desc')
        ->paginate(10);

        return view('users.index', compact('users','search'));
    }

    public function create() 
    {
        return view('users.create');
    }

    public function show(User $user) {
        return view('users.show', ['user' => $user]);
    }

    public function store()
    {
        $attributes = request()->validate([
            'firstname' => ['required'],
            'middlename' => ['nullable'],
            'lastname' => ['required'],
            'suffix' => ['nullable'],
            'division' => ['required'],
            'role' => ['required'],
            'employee_id_no' => ['required', 'unique:'.User::class],
            'email' => ['required', 'email', 'unique:'.User::class],
            'password' => ['required', Password::min(12), 'confirmed']
        ]);

        User::create($attributes);

        // Auth::login($user);

        return redirect('/users');
    }

    public function edit(User $user) {
        return view('users.edit', ['user' => $user]);
    }

    public function update(User $user) {
        // Authorize (is the user has permission) on hold...

        $attributes = request()->validate([
            'firstname' => ['required'],
            'middlename' => ['nullable'],
            'lastname' => ['required'],
            'suffix' => ['nullable'],
            'division' => ['required'],
            'role' => ['required'],
            'employee_id_no' => ['required'],
            'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)],
        ]);
        
        $user->update($attributes);

        return redirect('/users/' . $user->id);
    }
}
