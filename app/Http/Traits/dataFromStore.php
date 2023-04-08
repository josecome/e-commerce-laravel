<?php
namespace App\Http\Traits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Exception;

trait dataFromStore {
    public function getListOfProductsInCart() {
        $userId = Auth::id();
        //$data = DB::table('cart')->select('*')->where('purchased', 0)->get();
        $data = DB::table('cart')->select('*')->where(
                [['user_id', '=', $userId], ['purchased', '=', 0], ['deleted_at', '=', null]]
            )->get();
        return json_decode($data);
    }
}
