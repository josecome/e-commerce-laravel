<?php
namespace App\Http\Traits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Cart;
use App\Models\CartEvent;
use App\Models\Product;
use App\Models\ProductEvent;
use App\Models\ProdCategory;
use App\Models\ProdCategoryEvent;
use Exception;

trait RecordsEvents {

    function addNewCartEvent(Cart $cart)
    {
        $userId = Auth::id();
        try{
            $cart_event = new CartEvent;
            $cart_event->product = $cart->product;
            $cart_event->qnty = $cart->qnty;
            $cart_event->description = $cart->description;
            $cart_event->category = $cart->category;
            $cart_event->price = $cart->price;
            $cart_event->totalprice = $cart->price;
            $cart_event->user_id = $userId;
            $cart_event->save();
        } catch(Exception $e) {
            return 'Error ocurred: ' . $e->getMessage();
        }
        return 'event_inserted';
    }
    function addNewProductEvent(Product $product)
    {
        $userId = Auth::id();
        try{
            $prod_event = new ProductEvent;
            $prod_event->product = $product->product;
            $prod_event->description = $product->description;
            $prod_event->category = $product->category;
            $prod_event->price = $product->price;
            $prod_event->image_link = $product->image_link;
            $prod_event->user_id = $userId;
            $prod_event->save();
        } catch(Exception $e) {
            return 'Error ocurred: ' . $e->getMessage();
        }
        return 'event_inserted';
    }
    function addNewCategoryEvent(ProdCategory $category)
    {
        $userId = Auth::id();
        try{
            $ctgry = new ProdCategoryEvent;
            $ctgry->category = $category->category;
            $ctgry->description = $category->description;
            $ctgry->image_link = $category->image_link;
            $ctgry->user_id = $userId;
            $ctgry->save();
        } catch(Exception $e) {
            return 'Error ocurred: ' . $e->getMessage();
        }
        return 'event_inserted';
    }
}
