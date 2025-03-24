<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\Rule;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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
            'password' => ['required', Password::min(12), 'confirmed'],
            'mobile_number' => ['required', 'regex:/^09[0-9]{9}$/', 'digits:11'],
        ]);

        $attributes['mobile_number'] = '63' . substr($attributes['mobile_number'], 1);
        $attributes['password_changed'] = false;
    
        $user = User::create($attributes);
    
        event(new Registered($user));
    
        return redirect('/users')->with('success', 'User created successfully. They must change their password upon first login.');
    }

    public function edit(User $user) {
        return view('users.edit', ['user' => $user]);
    }

    public function update(Request $request, User $user) {
        // Authorize (is the user has permission) on hold...

        $attributes = $request->validate([
            'firstname' => ['required'],
            'middlename' => ['nullable'],
            'lastname' => ['required'],
            'suffix' => ['nullable'],
            'division' => ['required'],
            'role' => ['required'],
            'employee_id_no' => ['required', Rule::unique('users')->ignore($user->id)],
            'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)],
            'mobile_number' => ['required', 'regex:/^63[0-9]{10}$/', 'digits:12'],
        ]);
        
        $user->update($attributes);

        return redirect('/users/' . $user->id);
    }

    // For admin to reset the user's password
    public function updatePassword(User $user)
    {
        $attributespass = request()->validate([
            'password' => ['required', Password::min(12), 'confirmed'],
        ]);

        $user->update([
            'password' => bcrypt($attributespass['password']),
            'password_changed' => false,
        ]);

        return redirect('/users/' . $user->id);
    }


    // Password change requirement for newly created account
    public function changePassword(Request $request)
    {
        $request->validate([
            'password' => 'required|min:12|confirmed',
        ]);

        $user = Auth::user();
        $user->password = Hash::make($request->password);
        $user->password_changed = true; 
        $user->save();

        return redirect('dashboard');
    }


    public function destroy(Request $request, User $user)
    {
        // Validate password input
        $validator = Validator::make($request->all(), [
            'password' => ['required', 'current_password:web'],
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator, 'deletePassword') // Named error bag here
                ->withInput();
        }

        // Prevent deleting yourself (optional, safety)
        if (Auth::id() === $user->id) {
            return back()->withErrors(['error' => 'You cannot delete your own account.']);
        }

        // Delete user
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User account deleted successfully.');
    }

}
