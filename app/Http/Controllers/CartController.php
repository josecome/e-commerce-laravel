<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Cart;
use Exception;

class CartController extends Controller
{
    function getProductsInCart($user)
    {
        $data = DB::table('cart')->select('*')->where('removed', 0)->get();
        //$data = DB::table('cart')->select('*')->where([['removed', '=', 0], ['removed', '=', 0]])->get();
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
            $result = 'Error ocurred: ' . $e->getMessage();
        }
    }
    function cartUpdate(Request $req, Cart $cart)
    {
        try{
            $cart->fill(
                [
                    'qnty' => $req->qnty,
                    'removed' => $req->removed,
                    'updated_at' => $req->updated_at
                ],
            );
        } catch(Exception $e) {
            return 'Error ocurred';
        }
        $cart->save();
            return 'updated';
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
        } catch(Exception $e) {
            return 'Error ocurred';
        }
        $cart->save();
            return 'updated';
    }
    function Paid(Cart $cart)
    {
        try{
            $cart->fill(
                [
                    'pymnt_status' => 'yes',
                    'pymnt_status_date' => now()
                ],
            );
        } catch(Exception $e) {
            return 'Error ocurred';
        }
        $cart->save();
            return 'updated';
    }
}
