<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use App\Models\ProdCategories;
use App\Models\Product;
use App\http\Traits\saveImages;
use App\http\Traits\RecordsEvents;
use Illuminate\Support\Facades\Cache;
use Exception;

class ProductController extends Controller
{
    use saveImages;
    use RecordsEvents;

    function getProducts($category)
    {
        $data = Product::where('category', $category)->paginate(6);
        return view('product', ['prod' => $data]);
        //return ProductResource::collection(Product::all());
    }
    function ProductsForSale($category)
    {
        return view('/products_for_sale');
    }
    function ProductsForSaleAll() {
        return view('/products_for_sale_all');
    }
    function ProductsForSaleList($category)
    {

        $Product_list = null;
        $Product_list = Cache::remember('pull-requests-product-list', 60, function () use ($category) {
            return DB::table('products')->select('*')->where('category', $category)->get();
        });
        //if(!Cache::has('pull-requests-product-list')) {
        //    $Product_list = DB::table('products')->select('*')->where('category', $category)->get();
        //    Cache::set('pull-requests-product-list', $Product_list, 60);
        //} else {
        //    $Product_list = Cache::get('pull-requests-product-list');
        //}
        return json_decode($Product_list);
    }
    function ProductsForSaleListAll() {
        $Product_list = null;
        $Product_list = Cache::remember('pull-requests-product-list-all', 60, function () {
            return DB::table('products')->select('*')->orderByRaw('RAND()')->take(20)->get();
        });
        return json_decode($Product_list);
    }
    function addNewProduct(Request $req)
    {
        if (!Gate::allows('isAdmin') && !Gate::allows('isManager')) {
            abort(403);
        }
        $result = config('constants.options.success_insert');
        $type_of_item = "products";
        $userId = Auth::id();
        $filename = $this->categories_products_image($req,  $type_of_item);
        if ($filename === "No file") {
            $filename = $req->image_link;
        }
        if (!$req->filled('id')) { //Mean that it is new record
            try {
                $prod = new Product;
                $prod->product = $req->product;
                $prod->description = $req->description;
                $prod->category = $req->category;
                $prod->price = $req->price;
                $prod->image_link = $filename;
                $prod->user_id = $userId;
                $prod->save();
                $event_reg = $this->addNewProductEvent($prod);
            } catch (Exception $e) {
                $result = config('constants.options.error') . ': ' . $e->getMessage();
            }
        } else { //Record exist in data base
            try {
                $product = Product::updateOrCreate(
                    ['id' => $req->id],
                    [
                        'product' => $req->product, 'description' => $req->description, 'price' => $req->price,
                        'image_link' => $filename, 'user_id' => $userId
                    ]
                );
                $result = $product->wasChanged() ? "updated" : "not updated";
                $event_reg = $this->addNewProductEvent(Product::find($req->id));
            } catch (Exception $e) {
                $result = config('constants.options.error') . ': ' . $e->getMessage();
            }
        }
        $type_of_result = "sucess";
        if (str_contains($result, 'Error')) {
            $type_of_result = "error";
        }
        return Redirect::to(
            '/product/' . $req->category . '?p=' . $result
        )->with($type_of_result, $result);
    }
    function addNewProductForm(Request $req)
    {
        if (!Gate::allows('isAdmin') && !Gate::allows('isManager')) {
            abort(403);
        }
        $data = null;
        if ($req->filled('t') && $req->filled('id')) {
            $data = DB::table('products')->select('*')->where('id', $req->id)->first();
        }
        return view('/product_form', ['prod' => $data]);
    }
}
