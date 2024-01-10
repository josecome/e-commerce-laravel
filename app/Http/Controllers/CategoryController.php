<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Access\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use App\Models\ProdCategory;
use App\Models\Product;
use App\http\Traits\saveImages;
use App\http\Traits\RecordsEvents;
use Exception;

class CategoryController extends Controller
{
    use saveImages;
    use RecordsEvents;
    function getCategories()
    {
        $data = ProdCategory::all();
        return view('home', ['prodcat' => $data]);
    }
    function getListCategories()
    {
        $data = DB::table('prod_categories')->select('category')->get();
        return json_decode($data);
    }
    function addNewCategory(Request $req)
    {
        $result = config('constants.options.success_insert');
        if (!Gate::allows('isAdmin') && !Gate::allows('isManager')) {
            abort(403);
        }

        $userId = Auth::id();
        //$user = Auth::user();

        $type_of_item = "prod_categories";
        $filename = $this->categories_products_image($req,  $type_of_item);
        if ($filename === "No file") {
            $filename = $req->image_link;
        }
        if (!$req->filled('id')) {
            try {
                $ctgry = new ProdCategory;
                $ctgry->category = $req->category;
                $ctgry->description = $req->description;
                $ctgry->image_link = $filename;
                $ctgry->user_id = $userId;
                $ctgry->save();
                $event_reg = $this->addNewCategoryEvent($ctgry);
                return back()->with('success', $result);
            } catch (Exception $e) {
                $result = config('constants.options.error') . ': ' . $e->getMessage();
                return back()->with('error', $result);
            }
        } else {
            try {
                ProdCategory::find($req->id)->update([
                    'category' => $req->category, 'description' => $req->description,
                    'image_link' => $filename, 'user_id' => $userId
                ]);
                return redirect('/')->with('success', $result);
            } catch (Exception $e) {
                $result = config('constants.options.error') . ': ' . $e->getMessage();
                return back()->with('error', $result);
            }
        }
        //return Redirect::to('/add_successfull?p=' . $result);
    }
}
