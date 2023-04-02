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

class ProductController extends Controller
{
    use saveImages;

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
        if (! Gate::allows('isAdmin') && ! Gate::allows('isManager') ) {
            abort(403);
        }
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
        return Redirect::to('/product/' . $req->category . '?p='. $result);
    }
    function addNewProductForm(Request $req){
        if (! Gate::allows('isAdmin') && ! Gate::allows('isManager') ) {
            abort(403);
        }
        $data = null;
        if($req->filled('t') && $req->filled('id')){
            $data = DB::table('products')->select('*')->where('id', $req->id)->first();
        }
        return view('/product_form', ['prod'=>$data]);
    }
}
