<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $username;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');

        $this->username = $this->findUsername();
    }

    public function findUsername()
    {
        $login = request()->input('nama');

        $fieldType = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'nama';

        request()->merge([$fieldType => $login]);

        return $fieldType;
    }

    public function username()
    {
        return $this->username;
    }

    public function login_view()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $message = [
            'max' => 'Login failed!'
        ];
        $this->validate($request, [
            'nama' => 'required|max:20',
            'password' => 'required|max:12'
        ], $message);

        $login_type = filter_var($request->input('nama'), FILTER_VALIDATE_EMAIL)
            ? 'email'
            : 'nama';

        $request->merge([
            $login_type => $request->input('nama')
        ]);

        if (Auth::attempt($request->only($login_type, 'password'))) {
            return redirect()->intended('/dashboard');
        }

        return back()->with('errors', 'Login failed!');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}