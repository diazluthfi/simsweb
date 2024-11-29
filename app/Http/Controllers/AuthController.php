<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Produk;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $user = DB::table('users')
            ->where('email', '=', $credentials['email'])
            ->first();

        if ($user && password_verify($credentials['password'], $user->password)) {
            Auth::loginUsingId($user->id);
            return redirect()->route('showIndex');
        } else {
            return redirect()->route('login')->with('loginError', 'Invalid credentials');
        }
    }

    public function showProfile()
    {
        $user = Auth::user();
        return view('profile.profile', compact('user'));
    }

    public function logout()
    {
        Auth::logout();
        return view('login');
    }
}
