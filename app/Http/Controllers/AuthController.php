<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
  public function loginPage() {
    return view('auth.login');
  }
  public function registerPage() {
    return view('auth.register');
  }
  public function login(Request $request) {
    $credentials = $request->validate([
      'email' => ['required', 'email'],
      'password' => ['required'],
    ]);
    if (auth()->attempt($credentials)) {
      $request->session()->regenerate();
      // $user = \App\Models\User::whereEmail(request('email'))->first();
      if (auth()->user()->role == 'admin') {
        return redirect()->intended('admin');
      } else {
        return back();
      }
    }

    return back()->withErrors([
        'email' => 'Username / Password Salah.',
    ])->onlyInput('email');
  }
  public function register() {
    request()->validate([
      'name' => 'required',
      'phone' => 'required|numeric',
      'email' => 'required|email',
      'password' => 'required'
    ]);
    $existingUser = \App\Models\User::whereEmail(request('email'))->orWhere('phone',request('phone'))->first();
    if ($existingUser) {
      return back()->with(['error' => 'Email atau Nomor HP sudah terdaftar!']);
    }

    $user = \App\Models\User::create([
      'role' => 'member',
      'name' => request('name'),
      'phone' => request('phone'),
      'email' => request('email'),
      'password' => \Hash::make(request('password')),
    ]);
    auth()->login($user);
    return back();
  }
  public function logout() {
    auth()->logout();
    session()->invalidate();
    session()->regenerateToken();
    return redirect('/');
  }
}
