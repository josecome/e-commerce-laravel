<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class Controllers extends Controller
{
    function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();

        return Redirect::to('/');
    }
}
