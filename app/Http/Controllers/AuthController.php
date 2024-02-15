<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\RegisterUserRequest;
use App\Models\User;
use App\Services\DownloadFileService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    function show_register()
    {

        return view('register');
    }

    function show_login()
    {
        return view('login');
    }

    public function register(RegisterUserRequest $request, DownloadFileService $action)
    {
        $action->download_file_form($request->file('userpic_file'), 'avatars');

        $user = User::create([
            'login' => $request->login,
            'email' => $request->email,
            'password' => $request->password,
            'avatar' => $action->get_filename()
        ]);


        return redirect(route('login'));
    }

    public function login(LoginUserRequest $request)
    {
        if (Auth::attempt($request->validated())) {

            $request->session()->regenerate();

            return redirect(route('feed') . "?category=all");
        }
        return back()->with(['error_not_exist' => 'Такого пользователя не существует']);
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
