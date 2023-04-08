<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Cart;
use App\http\Traits\dataFromStore;
use Exception;

class CartController extends Controller
{
    use dataFromStore;
    function getProductsInCart()
    {
        return $this->getListOfProductsInCart();
    }
    function addNewProductInCart(Request $req)
    {
        $userId = Auth::id();
        $totalprice = 0;
        try{
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
        } catch(Exception $e) {
            return 'Error ocurred: ' . $e->getMessage();
        }
        return $this->getListOfProductsInCart();
    }
    function cartUpdate(Request $req, $id)
    {
        try{
            $datetime = \Carbon\Carbon::now();
            $formatedDateTime = $datetime->format('Y-m-d H:i:s');
            Cart::where('id', $id)->update(['qnty' => $req->qnty, 'updated_at' => $formatedDateTime]);
        } catch(Exception $e) {
            return 'Error ocurred' . $e->getMessage();
        }
        return $this->getListOfProductsInCart();
    }
    function deleteItemInCart($id)
    {
        try {
            Cart::find($id)->delete();
        } catch(Exception $e) {
            return 'Error ocurred' . $e->getMessage();
        }
        return $this->getListOfProductsInCart();
    }
    function Paid(Request $req)
    {
        try {
            DB::table('cart')->whereIn('id', array_map('intval', explode(',', $req->ids))
                )->update([
                'purchased' => 1
            ]);
        } catch(Exception $e) {
            return 'Error ocurred';
        }
        return 'updated';
    }
}
