<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Exhibitor;
use App\Models\Member;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class ReportController extends Controller
{
    public function index()
    {
        $members = Member::all();
        $exhibitors = Exhibitor::all();
        $products = Product::all();
        $votes = DB::table('votes')
                 ->select('exhibition_id', DB::raw('COUNT(*) as total'))
                 ->groupBy('exhibition_id')
                 ->orderBy('total', 'DESC')
                 ->get();

        //view()->share('employee',$data);
        $pdf = PDF::loadView('pdf.report', [
            'members' => $members,
            'exhibitors' => $exhibitors,
            'products' => $products,
            'votes' => $votes
        ]);
        return $pdf->download('Report'.now().'.pdf');
    }
}
