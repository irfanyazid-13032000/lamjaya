<?php

namespace App\Http\Controllers;

use App\Models\Divisi;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Display the login view.
     */
    public function index(): \Illuminate\View\View
    {
        return view('auth.login');
    }

    /**
     * Handle an authentication attempt.
     */
    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();

            $user = Auth::user();
            $userID = $user->id;
            $request->session()->put('user_id', $userID);


            return redirect()->intended('/');
        }

        return back()->with('loginError', 'Email atau password salah!');
    }

    /**
     * Log the user out of the application.
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }

    /**
     * Display the registration view.
     */
    public function register(): \Illuminate\View\View
    {
        $divisi = Divisi::all();

        return view('auth.register', ['divisi' => $divisi]);
    }

    /**
     * Handle a registration attempt.
     */
    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed',
            'divisi_id' => 'required|string',
            'no_hp' => 'required|numeric',
            'jenis_kelamin' => 'required|string',
            'nim' => 'required|string',
            'jenjang_pendidikan' => 'required|string',
            'jurusan' => 'required|string',
            'universitas' => 'required|string',
        ]);

        $data['password'] = bcrypt($data['password']);

        User::create($data);

        return redirect()->route('login')->with('success', 'Akun berhasil dibuat! Silakan login.');
    }
}
