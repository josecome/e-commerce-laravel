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
use Exception;

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
        $result = "Record Successfully added!";
        $response = Gate::inspect('addupdate_ctgry');

        if (! $response->allowed()) {
            //return $response->message() . " <a href='/'>Return</a>";
        }
        if (! Gate::allows('addupdate_ctgry')) {
            //abort(403);
        }

        $userId = 1;// Auth::id();
        //$user = Auth::user();
        /*if ($user->can('create', ProdCategories::class)) {
            //echo 'Current logged in user is allowed to create new articles.';
        } else {
            //return 'Not Authorized';
        }*/
        $path = "";
        try {
            $img = $req->file('image');
            $filename = $img->getClientOriginalName();
            //$path = $req->file('image')->store('public/images/prod_categories');
            $path = $req->file('image')->storeAs('public/images/prod_categories', $filename);
            $ctgy = new ProdCategories;
            $ctgy->category = $req->category;
            $ctgy->description = $req->description;
            $ctgy->image_link = $filename;
            $ctgy->user_id = $userId;
            $ctgy->save();
        } catch(Exception $e) {
            $result = 'Error ocurred: ' . $e->getMessage();
        }
        return Redirect::to('/add_successfull?p=' . $result);

    }
}
