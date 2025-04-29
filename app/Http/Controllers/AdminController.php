<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::all();
        $success = session('success');
        return inertia('Admin/Index', compact('users', 'success'));
    }

    public function updateRole(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required|in:admin,editor_ma,editor_mts,editor_ra,editor_ponpes,user',
            // 'role' => 'required|in:halo,juga'
        ]);

        if ($user->email === "mkhotamirais@gmail.com") {
            return redirect()->route('admin.index')->with('error', "Role user '$user->name' tidak bisa diubah");
        }
        $user->update(['role' => $request->role]);

        return redirect()->route('admin.index')->with('success', "Role user '$user->name' berhasil diubah");
    }
}
