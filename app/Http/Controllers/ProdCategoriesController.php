<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProdCategories;
use App\Models\Product;

class ProdCategoriesController extends Controller
{
    function getProdCategories()
    {
        $data = ProdCategories::all();
        return view('home',['prodcat'=>$data]);
    }
    function getProducts($id)
    {
        $data = Product::find($id);
        $data = $data->get()->toArray();
        return view('product',['prod'=>$data]);
    }
}
