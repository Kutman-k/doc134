<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Показать форму регистрации
    public function showRegister()
    {
        return view('auth.register');
    }

    // Обработка регистрации
    public function register(Request $request)
    {
        $data = $request->validate([
            'name'        => 'required|string|max:255',
            'email'       => 'required|string|email|max:255|unique:users',
            'password'    => 'required|string|min:6|confirmed',
            'phone'       => 'required|string|unique:users',
            'gender'      => 'required|in:male,female,other',
            'birth_date'  => 'required|date|before:today',
            'city'        => 'nullable|string|max:100',
            'bio'         => 'nullable|string|max:1000',
            'avatar'      => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'telegram'    => 'nullable|string|max:50',
            'is_subcribed'=> 'nullable|boolean',
        ]);

        $data['is_subcribed'] = $request->boolean('is_subcribed');
        $data['password']     = Hash::make($request->password);

        if ($request->hasFile('avatar')) {
            $data['avatar'] = $request->file('avatar')->store('avatars', 'public');
        }

        $user = User::create($data);
        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('dashboard');
    }

    // Форма логина
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended('dashboard');
        }

        return back()->withErrors([
            'email' => 'Неверный email или пароль!',
        ])->onlyInput('email');
    }

    // Выход из системы
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }

    // Личный кабинет
    public function dashboard()
    {
        return view('dashboard', ['user' => Auth::user()]);
    }
}