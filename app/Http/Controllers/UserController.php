<?php

namespace App\Http\Controllers;

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
         $table =  User::all();

         return view('admin.users.index', compact('table'));
    }
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $tab = User::findOrFail($id);
        return view('admin.users.show', compact('tab'));  
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $roles = Role::all(); // Assuming you have a Role model
        $tab = User::findOrFail($id);
        return view('admin.users.edit', compact('tab', 'roles'));  
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // $validated = $request->validate([
        //     ''
        // ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $tab)
    {
        $tab->delete();
        return redirect()->route('users.table')->with('success', 'User deleted successfully.');
    }
}
