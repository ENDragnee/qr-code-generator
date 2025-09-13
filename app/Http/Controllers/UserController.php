<?php

namespace App\Http\Controllers;

use App\Models\User;
use Auth;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $inputs = $request->validate([
            'name' => ['required', 'min:3', 'max:255', 'string', 'unique:users,name'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'min:8'],
        ]);

        $inputs['password'] = bcrypt($inputs['password']);

        $user = User::create($inputs);
        Auth::login($user);

        return redirect('/');
    }
}
