<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index() {
        return view('log');
    }
    
public function auth(Request $request)
{
    $request->validate([
        'driver_license' => 'required',
        'password' => 'required',
    ]);

    // Ищем пользователя по driver_license
    $user = User::where('driver_license', $request->driver_license)->first();

    if ($user && Hash::check($request->password, $user->password)) {
        Auth::login($user);
        return redirect('/requests')->with('success', 'Вы успешно вошли!');
    } else {
        // Передача ошибки обратно на страницу логина
        return redirect()->route('login')
            ->withErrors(['login' => 'Неправильный логин или пароль'])
            ->withInput($request->only('driver_license'));
    }
}

    public function indexReg() {
        return view('reg');
    }

    public function register(Request $request) {
        $request->validate([
            'email' => 'required|email',
            'id_role' => 'required',
            'password' => 'required',
            'phone' => 'required',
            'driver_license' => 'required',
            'full_name' => 'required',
        ]);

        $credentials = $request->all();
        $credentials['password'] = Hash::make($credentials['password']);
        $user = User::create($credentials);
        Auth::login($user);
        return redirect('/requests')->with('success', 'Вы успешно зарегистрировались!');
    }

     // Метод для выхода из системы
    public function logout()
    {
        Auth::logout(); // Выход пользователя из системы
        return redirect()->route('login'); // Перенаправление на страницу логина
    }
}
