<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Cart;
use Exception;

class CartController extends Controller
{
    function getProductsInCart()
    {
        $userId = Auth::id();
        //$data = DB::table('cart')->select('*')->where('purchased', 0)->get();
        $data = DB::table('cart')->select('*')->where(
                [['user_id', '=', $userId], ['purchased', '=', 0], ['deleted_at', '=', null]]
            )->get();
        return json_decode($data);
    }
    function addNewProductInCart(Request $req)
    {
        $userId = Auth::id();
        $totalprice = 0;
        try{
            $cart = new Cart;
            $cart->product = $req->product;
            $cart->qnty = $req->qnty;
            $cart->description = $req->description;
            $cart->category = $req->category;
            $cart->price = $req->price;
            $cart->totalprice = $totalprice;
            $cart->user_id = $userId;
            $cart->save();
        } catch(Exception $e) {
            return 'Error ocurred: ' . $e->getMessage();
        }
        return 'updated';
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
        return 'updated';
    }
    function deleteItemInCart($id)
    {
        try {
            Cart::find($id)->delete();
        } catch(Exception $e) {
            return 'Error ocurred' . $e->getMessage();
        }
        return 'deleted';
    }
    function waitPayment(Cart $cart)
    {
        try{
            $cart->fill(
                [
                    'pymnt_status' => 'waiting',
                    'pymnt_status_date' => now()
                ],
            );
            $cart->save();
        } catch(Exception $e) {
            return 'Error ocurred';
        }
        return 'updated';
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
