<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
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
        return view('product', ['prod'=>$data]);
    }
    function ProductsForSale($category)
    {
        return view('/products_for_sale');
    }
    function ProductsForSaleList($category)
    {
        $data = DB::table('products')->select('*')->where('category', $category)->get();
        return json_decode($data);
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

    function addNewCategory(Request $req)
    {
        $response = Gate::inspect('addupdate_ctgry');

        if (! $response->allowed()) {
            return $response->message() . " <a href='/'>Return</a>";
        }
        /*if (! Gate::allows('addupdate_ctgry')) {
            abort(403);
        }*/

        $userId = Auth::id();
        $user = Auth::user();
        if ($user->can('create', ProdCategories::class)) {
            echo 'Current logged in user is allowed to create new articles.';
          } else {
            return 'Not Authorized';
          }
        $ctgy = new ProdCategories;
        $ctgy->category = $req->category;
        $ctgy->description = $req->description;
        $ctgy->user_id = $userId;
        $ctgy->save();

        return Redirect::to('/add_successfull');

    }
}
