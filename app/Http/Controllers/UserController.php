<?php

namespace App\Http\Controllers;
use App\Http\Requests\UserStoreRequest;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;

use Illuminate\Support\Facades\Auth;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()


    {
         
        $users = auth()->user();
        return view('profile.index', compact('users'));
    }



    /**
     * Show the form for creating a new resource.
     */

    public function table(){
         $users =  User::all();

         return view('admin.users.index', compact('users'));
    }
    public function create()
    {
        $roles = Role::all();
        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $data = $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'min:8'],
            'role_id'  => ['required', 'exists:roles,id'],
        ]);
        $data['password'] = bcrypt($data['password']);

        User::create($data);

        return to_route('users.table')->with('success', 'User Yaratildi ');

    }


    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        
        return view('admin.users.show', compact('user'));  
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $roles = Role::all(); // Assuming you have a Role model
        return view('admin.users.edit', compact('user', 'roles'));  
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'. $user->id,
            'role_id' => 'required|exists:roles,id', 
        ]);

        $user->update($validated);

        return redirect()->route('users.table')->with('success', 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.table')->with('success', 'User deleted successfully.');
    }
}
