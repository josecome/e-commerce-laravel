<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\ProdCategories;
use App\Models\Product;
use App\Models\Cart;
use App\Mail\OrderPurchases;
use App\http\Traits\dataFromStore;
use Illuminate\Support\Facades\Mail;
use App\http\Traits\RecordsEvents;
use Exception;

class ApiController extends Controller
{
    use RecordsEvents;
    use dataFromStore;
    use RecordsEvents;
    function getCategories()
    {
        $data = ProdCategories::all();
        return json_decode($data);
    }
    function getListCategories()
    {
        $data = DB::table('prod_categories')->select('category')->get();
        return json_decode($data);
    }
    function addNewCategory(Request $req)
    {
        $result = "Record Successfully added!";
        if (!Gate::allows('isAdmin') && !Gate::allows('isManager')) {
            abort(403);
        }

        $userId = Auth::id();
        //$user = Auth::user();

        $type_of_item = "prod_categories";
        $userId = Auth::id();
        $filename = $this->categories_products_image($req,  $type_of_item);
        if ($filename === "No file") {
            $filename = $req->image_link;
        }
        if (!$req->filled('id')) {
            try {
                $ctgry = new ProdCategories;
                $ctgry->category = $req->category;
                $ctgry->description = $req->description;
                $ctgry->image_link = $filename;
                $ctgry->user_id = $userId;
                $ctgry->save();
                $event_reg = $this->addNewCategoryEvent($ctgry);
                return back()->with('success', $result);
            } catch (Exception $e) {
                $result = 'Error ocurred: ' . $e->getMessage();
                return response()->json([
                    'error' => $result
                ]);
            }
        } else {
            try {
                $category_product = ProdCategories::updateOrCreate(
                    ['id' => $req->id],
                    [
                        'category' => $req->category, 'description' => $req->description,
                        'image_link' => $filename, 'user_id' => $userId
                    ]
                );
                $result = $category_product->wasChanged() ? "updated" : "not updated";
                $event_reg = $this->addNewCategoryEvent(ProdCategories::find($req->id));
                return response()->json([
                    'success' => $result
                ]);
            } catch (Exception $e) {
                $result = 'Error ocurred: ' . $e->getMessage();
                return response()->json([
                    'error' => $result
                ]);
            }
        }
        //return Redirect::to('/add_successfull?p=' . $result);
    }
    function getProducts($category)
    {
        $data = DB::table('products')->select('*')->where('category', $category)->get();
        return json_decode($data);
    }
    function ProductsForSale($category)
    {
        $data = DB::table('products')->select('*')->where('category', $category)->get();
        return json_decode($data);
    }
    function ProductsForSaleList($category)
    {
        $data = DB::table('products')->select('*')->where('category', $category)->get();
        return json_decode($data);
    }
    function addNewProduct(Request $req)
    {
        if (!Gate::allows('isAdmin') && !Gate::allows('isManager')) {
            abort(403);
        }
        $result = "Record Successfully added!";
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
                $result = 'Error ocurred: ' . $e->getMessage();
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
                $result = 'Error ocurred: ' . $e->getMessage();
            }
        }
        $type_of_result = "sucess";
        if (str_contains($result, 'Error')) {
            $type_of_result = "error";
        }
        return response()->json([
            $type_of_result => $result
        ]);
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
        if (is_null($data)) {
            $data = '{"error":"no_data"}';
        }
        return json_decode($data);
    }
    function getProductsInCart(Cart $cart)
    {
        return $this->getListOfProductsInCart();
    }
    function addNewProductInCart(Request $req)
    {
        $userId = Auth::id();
        $totalprice = 0;
        try {
            $prod = Product::find($req->id);
            $cart = new Cart;
            $cart->product = $prod->product;
            $cart->qnty = 1;
            $cart->description = $prod->description;
            $cart->category = $prod->category;
            $cart->price = $prod->price;
            $cart->totalprice = $prod->price;
            $cart->user_id = $userId;
            $cart->save();
        } catch (Exception $e) {
            return 'Error ocurred: ' . $e->getMessage();
        }
        $event_reg = $this->addNewCartEvent($cart);
        return $this->getListOfProductsInCart();
    }
    function cartUpdate(Request $req, $id)
    {
        $cart = Cart::find($id);
        $this->authorize('update', $cart);

        try {
            $datetime = \Carbon\Carbon::now();
            $formatedDateTime = $datetime->format('Y-m-d H:i:s');
            Cart::where('id', $id)->update(['qnty' => $req->qnty, 'updated_at' => $formatedDateTime]);
        } catch (Exception $e) {
            return 'Error ocurred' . $e->getMessage();
        }
        return $this->getListOfProductsInCart();
    }
    function deleteItemInCart($id)
    {
        $cart = Cart::find($id);
        $this->authorize('update', $cart);

        try {
            Cart::find($id)->delete();
        } catch (Exception $e) {
            return 'Error ocurred' . $e->getMessage();
        }
        return $this->getListOfProductsInCart();
    }
    function Paid(Request $req)
    {
        $cart = Cart::find(Auth::id());
        $this->authorize('update', $cart);
        try {
            DB::table('cart')->whereIn(
                'id',
                array_map('intval', explode(',', $req->ids))
            )->update([
                'purchased' => 1
            ]);
        } catch (Exception $e) {
            return 'Error ocurred';
        }
        $user = User::find(Auth::id());
        Mail::to($user)->send(new OrderPurchases($cart));

        return 'updated';
    }
    function addNewProduct(Request $req)
    {
        $result = "Record Successfully added!";
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
                $result = 'Error ocurred: ' . $e->getMessage();
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
                $result = 'Error ocurred: ' . $e->getMessage();
            }
        }
        $type_of_result = "sucess";
        if (str_contains($result, 'Error')) {
            $type_of_result = "error";
        }
        return response()->json([
            $type_of_result  => $result,
        ]);
    }
}
