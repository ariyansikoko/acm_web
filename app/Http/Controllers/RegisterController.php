<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;

class RegisterController extends Controller
{
    public function index()
    {
        $this->authorize('admin');

        return view('register.index', [
            'title' => 'Register'
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255|unique:users',
            'email' => 'required|email:dns|unique:users',
            'password' => [
                'required',
                Password::min(6)
                    ->mixedCase()
                    ->numbers()
                    ->uncompromised(),
            ],
        ]);

        User::create($validated);

        return redirect('/dashboard/account')->with('success', 'Registrasi berhasil');
    }
}
