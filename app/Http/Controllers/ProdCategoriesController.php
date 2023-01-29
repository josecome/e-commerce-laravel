<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProdCategories;

class ProdCategoriesController extends Controller
{
    function getProdCategories()
    {
        $data = ProdCategories::all();
        return view('home',['prodcat'=>$data]);
    }
}
