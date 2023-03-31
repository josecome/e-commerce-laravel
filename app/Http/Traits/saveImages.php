<?php
namespace App\Http\Traits;
use Illuminate\Http\Request;
use Exception;

trait saveImages {
    public function categories_products_image(Request $req, $type_of_item) {
        $result = "saved";
        try {
            if (!$req->hasFile('image')) {
                return "No file";
            }
            $filename = $req->file('image')->getClientOriginalName();
            //$path = $req->file('image')->store('public/images/prod_categories');
            $path = $req->file('image')->storeAs('public/images/' . $type_of_item, $filename); //By give 'public/images/' image will be saved in 'storage/app/public/images/'
            //Having link in public folder, this image will be available to be accessed through link.
            return $filename;
        } catch(Exception $e) {
            echo $e->getMessage();
            return 'Error ocurred: ' . $e->getMessage();
        }
    }
}
