<?php

namespace App\Http\Controllers\exhibitor;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()->paginate(10);
        return view('exhibitor.products', [
            'products' => $products
        ]);
    }

    public function add(Request $request)
    {
        $request->validate([
            'category_id' => ['required', 'integer'],
            'name' => ['required', 'string'],
            'description' => ['required', 'string']
        ]);

        try{
            $product = new Product();
            $product->category_id = $request->category_id;
            $product->name = $request->name;
            $product->description = $request->description;

            if(isset($request->price)){
                $product->price = $request->price;
            }

            $product->save();
            return redirect()->back()->with('success', 'successfully added product');
        }catch(Exception $e)
        {
            return redirect()->back()->with('error', 'ERROR: '.$e->getMessage());
        }
    }
}
