<?php
namespace App\Http\Traits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Cart;

use Exception;

trait dataFromStore {
    public function getListOfProductsInCart(request $req){

        $userId = Auth::id();
        $data = Cart::where('user_id', '=', $userId
        )->where('purchased', '=', 0
        )->get();//$data = DB::table('cart')->select('*')->where('purchased', 0)->get();
        /*$data = DB::table('carts')->select('*')->where(
                [['user_id', '=', $userId], ['purchased', '=', 0], ['deleted_at', '=', null]]
            )->get();*/
        return json_decode($data);
    }
}
