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
use App\http\Traits\saveImages;
use Exception;

class ProdCategoriesController extends Controller
{
    use saveImages;
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
        $filename = $this->categories_products_image($req,  $type_of_item);
        if($filename === "No file") {
            $filename = $req->image_link;
        }
        if(!$req->filled('id')) {//Mean that it is new record
            try{
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
        } else {//Record exist in data base
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
        }
        return Redirect::to('/product/{$category}?p='. $result);
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

        if (! Gate::allows('addupdate_ctgry')) {
            //abort(403);
        }

        $userId = 1;// Auth::id();
        //$user = Auth::user();

        $type_of_item = "prod_categories";
        $userId = 1;//Auth::id();
        $filename = $this->categories_products_image($req,  $type_of_item);
        if($filename === "No file") {
            $filename = $req->image_link;
        }
        if(!$req->filled('id')) {
            try{
                $ctgry = new ProdCategories;
                $ctgry->category = $req->category;
                $ctgry->description = $req->description;
                $ctgry->image_link = $filename;
                $ctgry->user_id = $userId;
                $ctgry->save();
            } catch(Exception $e) {
                $result = 'Error ocurred: ' . $e->getMessage();
            }
        } else {
            try{
                $category_product = ProdCategories::updateOrCreate(
                   ['id' => $req->id],
                   ['category' => $req->category, 'description' => $req->description,
                    'image_link' => $filename, 'user_id' => $userId]
                );
            $result = $category_product->wasChanged() ? "updated" : "not updated";
        } catch(Exception $e) {
            $result = 'Error ocurred: ' . $e->getMessage();
        }
        }
        return Redirect::to('/add_successfull?p=' . $result);
    }
}
