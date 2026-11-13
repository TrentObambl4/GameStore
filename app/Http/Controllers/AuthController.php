<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            'login' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        $user = User::with('role')
            ->where('login', $data['login'])
            ->first();

        if (!$user || !Hash::check($data['password'], $user->password)) {
            return back()
                ->withInput($request->only('login'))
                ->withErrors([
                    'login' => 'Неверный логин или пароль.',
                ]);
        }

        Auth::login($user);

        $request->session()->regenerate();

        return redirect()->route('home');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'login' => ['required', 'string', 'min:3', 'max:50', 'unique:users,login'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);

        $role = Role::where('name', 'user')->firstOrFail();

        User::create([
            'login' => $data['login'],
            'password' => Hash::make($data['password']),
            'role_id' => $role->id,
        ]);

        return redirect()
            ->route('login')
            ->with('success', 'Регистрация прошла успешно.');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}
