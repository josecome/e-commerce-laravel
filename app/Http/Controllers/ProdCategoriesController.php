<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\DB;
use App\Models\ProdCategories;
use App\Models\Product;

class ProdCategoriesController extends Controller
{
    function getProdCategories()
    {
        $data = ProdCategories::all();
        return view('home',['prodcat'=>$data]);
    }
    function getProducts($category)
    {
        $data = DB::table('products')->select('*')->where('category', $category)->get();
        return view('product',['prod'=>$data]);
    }
    function addNewProduct(Request $req)
    {
        $category = $req->category;

        $userId = Auth::id();

        $prod = new Product;
        $prod->product = $req->product;
        $prod->description = $req->description;
        $prod->category = $category;
        $prod->user_id = $userId;
        $prod->save();

        return Redirect::to('/product/{$category}');

    }
    function addNewProductForm(){
        return view('/product_form');
    }
}
