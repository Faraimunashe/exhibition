<?php

namespace App\Http\Controllers\exhibitor;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $products = Product::where('exhibition_id', get_exhibitor()->id)->get();
        return view('exhibitor.dashboard', [
            'products' => $products
        ]);
    }
}
