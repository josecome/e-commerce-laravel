<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Access\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use App\Models\ProdCategories;
use App\Models\Product;
use App\http\Traits\saveImages;
use Exception;

class CategoryController extends Controller
{
    use saveImages;
    function getCategories()
    {
        $data = ProdCategories::all();
        return view('home',['prodcat'=>$data]);
    }
    function addNewCategory(Request $req)
    {
        $result = "Record Successfully added!";
        if (! Gate::allows('isAdmin') && ! Gate::allows('isManager') ) {
            abort(403);
        }

        $userId = Auth::id();
        //$user = Auth::user();

        $type_of_item = "prod_categories";
        $userId = Auth::id();
        $filename = $this->categories_products_image($req,  $type_of_item);
        if($filename === "No file") {
            $filename = $req->image_link;
        }
        if(!$req->filled('id')) {
            try{
                $ctgry = new ProdCategories;
                $ctgry->category = $req->category;
                $ctgry->description = $req->description;
                $ctgry->image_link = $filename;
                $ctgry->user_id = $userId;
                $ctgry->save();
            } catch(Exception $e) {
                $result = 'Error ocurred: ' . $e->getMessage();
            }
        } else {
            try{
                $category_product = ProdCategories::updateOrCreate(
                   ['id' => $req->id],
                   ['category' => $req->category, 'description' => $req->description,
                    'image_link' => $filename, 'user_id' => $userId]
                );
            $result = $category_product->wasChanged() ? "updated" : "not updated";
        } catch(Exception $e) {
            $result = 'Error ocurred: ' . $e->getMessage();
        }
        }
        return Redirect::to('/add_successfull?p=' . $result);
    }
}
