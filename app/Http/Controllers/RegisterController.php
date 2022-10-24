<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function register_view()
    {
        return view('auth.register');
    }
    public function register(Request $request)
    {
        $validate = $request->validate([
            'nama' => 'required|min:5|max:20|unique:customers|alpha_num',
            'alamat' => 'required|max:30',
            'noHP' => 'required|numeric|digits_between:8,14',
            'email' => 'required|email:dns|unique:customers|max:20',
            'password' => 'required|max:12',
        ]);

        // $validate['password'] = bcrypt($validate['password']);
        $validate['password'] = Hash::make($validate['password']);

        Customer::create($validate);

        // $request->session()->flash('success', 'User Create Successfully!');

        return redirect('/dashboard');
    }
}