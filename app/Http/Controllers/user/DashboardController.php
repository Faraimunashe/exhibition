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

    public function products($exhibition_id)
    {
        $products = Product::where('exhibition_id', $exhibition_id)->latest()->paginate(10);
        $exhibitor = Exhibitor::find($exhibition_id);

        return view('user.products', [
            'products' => $products,
            'exhibitor' => $exhibitor
        ]);
    }
}
