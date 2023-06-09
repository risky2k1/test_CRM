<?php

namespace App\Http\Controllers;

use App\Enums\UserRoleEnum;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        return redirect()->route('login');
    }

    public function callback($provider): RedirectResponse
    {
        $user = Socialite::driver($provider)->user();
//        dd($user);
        $existUser = User::where('email', $user->getEmail())
            ->first();

        $user = User::updateOrCreate([
            'email' => $user->getEmail(),
        ], [
            'name' => $user->getName(),
        ]);

        Auth::login($user);

        if ($existUser) {
            return redirect()->route('admin.welcome');
        } else {
            return redirect()->route('register');
        }

    }

    public function registering(Request $request)
    {
        $password = Hash::make($request->password);
        $role = $request->role;
//        dd($role);
        if (auth()->check()) {
            User::where('id', auth()->user()->id)
                ->update([
                    'password' => $password,
                    'role' => $role,
                ]);
        } else {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $password,
                'role' => $role,
            ]);
            Auth::login($user);
        }
        return redirect()->route('welcome');
    }

}
