<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    function getCategories(Request $req)
    {
        $data = null;
        $typeOfreq = $req->typeofreq;
        $initial_date = $req->initial_date;
        $last_date = $req->last_date;

        switch (true) {
            case $typeOfreq == 'categories_all_list':
                $data = DB::table('prod_categories')->select('*')->where('deleted_at', null)->get();
                break;
            case $typeOfreq == 'categories_all_list_with_deleted_cases':
                $data = DB::table('prod_categories')->select('*')->get();
                break;
            case $typeOfreq == 'categories_with_date_between':
                $data = DB::table('prod_categories')->select('*')->whereBetween('created_at',
                [$initial_date, $last_date])->get();
                break;
            case $typeOfreq == 'categories_with_date_more_than':
                $data = DB::table('prod_categories')->select('*')->where([['created_at', '>', $initial_date]])->get();
                break;
            case $typeOfreq == 'categories_with_date_less_than':
                $data = DB::table('prod_categoriescart')->select('*')->where([['created_at', '<', $last_date]])->get();
                break;
            default:
                $data = DB::table('prod_categories')->select('*')->where('deleted_at', null)->get();
        }

        return json_decode($data);
    }
    function getProducts(Request $req)
    {
        $data = null;
        $typeOfreq = $req->typeofreq;
        $initial_date = $req->initial_date;
        $last_date = $req->last_date;
        $initial_price = $req->initial_price;
        $last_price = $req->last_price;

        switch (true) {
            case $typeOfreq == 'products_all_list':
                $data = DB::table('products')->select('*')->where('deleted_at', null)->get();
                break;
            case $typeOfreq == 'products_all_list_with_deleted_cases':
                $data = DB::table('products')->select('*')->get();
                break;
            case $typeOfreq == 'product_with_price_between':
                $data = DB::table('products')->select('*')->whereBetween('created_at',
                [$initial_date, $last_date])->get();
                break;
            case $typeOfreq == 'products_with_price_more_than':
                $data = DB::table('cart')->select('*')->where([['created_at', '>', $initial_price]]
                )->get();
                break;
            case $typeOfreq == 'products_with_price_less_than':
                $data = DB::table('products')->select('*')->where([['created_at', '<', $last_price]]
                )->get();
                break;
            default:
                $data = DB::table('products')->select('*')->where('deleted_at', null)->get();
        }

        return json_decode($data);
    }
    function getPurchasedProducts(Request $req)
    {
        $data = null;
        $typeOfreq = $req->typeofreq;
        $initial_date = $req->initial_date;
        $last_date = $req->last_date;
        $initial_price = $req->initial_price;
        $last_price = $req->last_price;

        switch (true) {
            case $typeOfreq == 'products_all_list':
                $data = DB::table('cart')->select('*')->where(
                    [['deleted_at', '=', 0], ['purchased', '=', 1]])->with('user')->get();
                break;
            case $typeOfreq == 'products_with_price_more_than':
                $data = DB::table('cart')->select('*')->where(
                    [['deleted_at', '=', 0], ['price', '>', $initial_price]])->with('user')->get();
                break;
            case $typeOfreq == 'products_with_price_less_than':
                $data = DB::table('cart')->select('*')->where(
                    [['deleted_at', '=', 0], ['price', '<', $last_price]])->with('user')->get();
                break;
            default:
                $data = DB::table('cart')->select('*')->where(
                    [['deleted_at', '=', 0], ['purchased', '=', 1]])->with('user')->get();
        }

        return json_decode($data);
    }
    function dsh() {
        return json_decode('a:b');
    }
}
