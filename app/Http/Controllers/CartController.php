<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Cart extends Controller
{
    function ProductsInCart($user)
    {
        $data = DB::table('cart')->select('*')->where('removed', 0)->get();
        return json_decode($data);
    }
}
