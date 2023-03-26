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
        $result = "Record Successfully added!";
        $type_of_item = "products";
        $userId = 1;//Auth::id();
        $filename = $this->saveImage($req,  $type_of_item);
        if(strpos($filename, "Error") !== false) {
            $filename = $req->image_link;
        }
        try{
            $product = Product::updateOrCreate(
                ['id' => $req->id],
                ['product' => $req->product, 'description' => $req->description, 'price' => $req->price,
                 'image_link' => $filename, 'user_id' => $userId]
            );
            $result = $product->wasChanged() ? "updated" : "not updated";
        } catch(Exception $e) {
            $result = 'Error ocurred: ' . $e->getMessage();
        }
        return Redirect::to('/product/{$category}?p='. $result);

        /*try{
            $prod = new Product;
            $prod->product = $req->product;
            $prod->description = $req->description;
            $prod->category = $req->category;
            $prod->price = $req->price;
            $prod->image_link = $filename;
            $prod->user_id = $userId;
            $prod->save();
        } catch(Exception $e) {
            $result = 'Error ocurred: ' . $e->getMessage();
        }
        return Redirect::to('/product/{$category}?p='. $result);*/
    }
    function addNewProductForm(Request $req){
        $data = null;
        if($req->filled('t') && $req->filled('id')){
            $data = DB::table('products')->select('*')->where('id', $req->id)->first();
        }
        return view('/product_form', ['prod'=>$data]);
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
        $type_of_item = "prod_categories";
        $filename = $this->saveImage($req, $type_of_item);
        if(strpos($filename, "Error") !== false){
            return Redirect::to('/add_successfull?p=Error Ocurred');
        }

        try {
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
    function saveImage(Request $req, $type_of_item){
        $result = "saved";
        try {
            $filename = null;
            if(null !== $req->input('image')){
               $filename = $req->file('image')->getClientOriginalName();
            } else {
                return 'Error ocurred';
            }
            //$path = $req->file('image')->store('public/images/prod_categories');
            $path = $req->file('image')->storeAs('public/images/' . $type_of_item, $filename); //By give 'public/images/' image will be saved in 'storage/app/public/images/'
            //Having link in public folder, this image will be available to be accessed through link.
            return $filename;
        } catch(Exception $e) {
            return 'Error ocurred: ' . $e->getMessage();
        }
    }
}
