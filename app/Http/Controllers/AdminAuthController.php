<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminAuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'access_code' => 'required',
        ]);

        $admin = Admin::where('email', $request->email)
                      ->where('access_code', $request->access_code)
                      ->first();

        if (!$admin || !Hash::check($request->password, $admin->password)) {
            return back()->withErrors(['email' => 'Identifiants incorrects.']);
        }

        session(['admin_logged_in' => true]);

        return redirect()->route('admin.dashboard');
    }
}

