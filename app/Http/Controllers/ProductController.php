<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
// use Illuminate\Support\Facades\DB;


class ProductController extends Controller
{
    function addProduct(Request $req)
    {
        $product = new Product;
        $product->name = $req->input('name');
        $product->price = $req->input('price');
        $product->description = $req->input('description');
        $product->file_path = $req->file('file')->store('products');
        $product->save();
        return $product;
    }
    function list()
    {
        return Product::all();
    }
    function delete($id)
    {
        $result= Product::where('id',$id)->delete();
        if ($result)
        {
            return["result"=>"product has been deleted"];
         }
         else{
            return["result"=>"Operation failed"];
         }
    }
    function getProduct($id)
    {
        return Product::find($id);
    }

    function updateProducts(Request $req, $id) {
        // Find the product by its ID
        $product = Product::find($id);
    
        // Check if the product exists
        if (!$product) {
            // If the product doesn't exist, return an error response
            return response()->json("Product not found!", 404);
        }
    
        // Update the product properties with the new values from the request
        $product->name = $req->input('name');
        $product->price = $req->input('price');
        $product->description = $req->input('description');
    
        // Check if a new file has been uploaded
        if ($req->hasFile('file')) {
        
    
            // Store the new uploaded file
            $product->file_path = $req->file('file')->store('products'); 
        }
        else {
            $product->file_path = $product->file_path;      
          }
    
        // Save the updated product to the database
        $product->save();
        
    
        // Return a success response
        return $product;
    }
    
}
