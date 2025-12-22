<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\AuthorizeRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function authorize(AuthorizeRequest $request)
    {
        if (Auth::attempt($request->validated(), true)) {
            $request->session()->regenerate();
            return redirect()->route('main');
        } else {
            return back()->withErrors([
                'email' => 'Неверный логин или пароль',
            ])->onlyInput('email');
        };
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->regenerateToken();
        return redirect()->route('main');
    }
}
