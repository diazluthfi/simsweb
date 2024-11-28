<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Produk;
use App\Models\Category;
use App\Models\User;
use App\Exports\ProdukExport;
use Maatwebsite\Excel\Facades\Excel;
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

        // Menggunakan prepared statement untuk validasi login
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

    public function showIndex(Request $request)
    {
        $query = Produk::query();

        // Pencarian berdasarkan nama produk
        if ($request->filled('search')) {
            $query->where('name', 'ILIKE', '%' . $request->search . '%');
        }


        // Filter berdasarkan kategori
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        // Ambil data dengan pagination
        $produks = $query->paginate(10); // 10 item per halaman

        $categories = Category::all(); // Data kategori untuk dropdown

        return view('index', compact('produks', 'categories'));
    }




    public function showProfile()
    {
        $user = Auth::user(); // Mengambil data pengguna yang sedang login

        return view('profile', compact('user')); // Mengirimkan data pengguna ke view
    }


    public function logout()
    {
        Auth::logout();
        return view('login');
    }
}
