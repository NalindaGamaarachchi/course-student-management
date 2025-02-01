<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleController extends Controller
{
    public function index()
    {
        $users = User::with('role')->get();
        return view('roles.index', compact('users'));
    }


    public function assignRole(Request $request, User $user)
    {
        if (!Auth::check() || Auth::user()->role !== 'super_admin') {
            abort(403, 'Unauthorized Access');
        }

        $request->validate([
            'role_id' => 'required|exists:roles,id'
        ]);

        $user->role_id = $request->role_id;
        $user->save();

        return redirect()->route('roles.index')->with('success', 'User role updated successfully.');
    }
}
