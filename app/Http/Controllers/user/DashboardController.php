<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Exhibitor;
use App\Models\Product;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $exhibitors = Exhibitor::latest()->paginate(10);
        return view('user.home', [
            'exhibitors' => $exhibitors
        ]);
    }

    public function products($exhibitor_id)
    {
        $products = Product::where('exhibitor_id', $exhibitor_id)->get();
        $exhibitor = Exhibitor::find($exhibitor_id);

        return view('user.products', [
            'products' => $products,
            'exhibitor' => $exhibitor
        ]);
    }
}
