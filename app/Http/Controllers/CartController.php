<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Cart;
use App\Models\User;
use App\http\Traits\dataFromStore;
use App\http\Traits\RecordsEvents;
use App\Mail\OrderPurchases;
use Illuminate\Support\Facades\Mail;
use Exception;

class CartController extends Controller
{
    use dataFromStore;
    use RecordsEvents;
    function getProductsInCart(Request $req, Cart $cart)
    {
        return $this->getListOfProductsInCart($req);
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
        return $this->getListOfProductsInCart($req);
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
        return $this->getListOfProductsInCart($req);
    }
    function deleteItemInCart(Request $req, $id)
    {
        $cart = Cart::find($id);
        //$this->authorize('update', $cart);

        try {
            Cart::find($id)->delete();
        } catch (Exception $e) {
            return 'Error ocurred' . $e->getMessage();
        }
        return $this->getListOfProductsInCart($req);
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
            return config('constants.options.error');
        }
        $user = User::find(Auth::id());
        Mail::to($user)->send(new OrderPurchases($cart));

        return config('constants.options.updated');
    }
}
