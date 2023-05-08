<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProdCategories;
use App\Models\Product;

class ApiController extends Controller
{
    function getCategories()
    {
        $data = ProdCategories::all();
        return json_decode($data);
    }
}
