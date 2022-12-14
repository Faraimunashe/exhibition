<?php

namespace App\Http\Controllers\exhibitor;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductImage;
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
            //'category_id' => ['required', 'integer'],
            'name' => ['required', 'string'],
            'description' => ['required', 'string']
        ]);

        try{
            $product = new Product();
            $product->exhibition_id = get_exhibitor()->id;
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

    public function update(Request $request)
    {
        $request->validate([
            'product_id' => ['required', 'integer'],
            'name' => ['required', 'string'],
            'description' => ['required', 'string']
        ]);

        try{
            $product = Product::find($request->product_id);
            $product->name = $request->name;
            $product->description = $request->description;

            if(isset($request->price)){
                $product->price = $request->price;
            }

            $product->save();
            return redirect()->back()->with('success', 'successfully updated product');
        }catch(Exception $e)
        {
            return redirect()->back()->with('error', 'ERROR: '.$e->getMessage());
        }
    }

    public function delete(Request $request)
    {
        $request->validate([
            'product_id' => ['required', 'integer'],
        ]);

        try{
            $product = Product::find($request->product_id);
            $product->delete();
            return redirect()->back()->with('success', 'successfully deleted product');
        }catch(Exception $e)
        {
            return redirect()->back()->with('error', 'ERROR: '.$e->getMessage());
        }
    }

    public function add_pic(Request $request)
    {
        $request->validate([
            'product_id' => ['required', 'integer'],
            'file' => ['required', 'image', 'mimes:png,jpg,jpeg', 'max:2048']
        ]);

        try{
            $imageName = time().'.'.$request->file->extension();
            $request->file->move(public_path('images'), $imageName);

            $img = new ProductImage();
            $img->product_id = $request->product_id;
            $img->file = $imageName;
            $img->save();

            return redirect()->back()->with('success', 'successfully added product image');
        }catch(Exception $e)
        {
            return redirect()->back()->with('error', 'ERROR: '.$e->getMessage());
        }
    }
}
