<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show_profile()
    {
        return view('profile');
    }

    public function show_messages()
    {
        return view('messages');
    }
}
