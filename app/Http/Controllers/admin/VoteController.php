<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Notice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VoteController extends Controller
{
    public function index()
    {
        $votes = DB::table('votes')
                 ->select('exhibition_id', DB::raw('COUNT(*) as total'))
                 ->groupBy('exhibition_id')
                 ->orderBy('total', 'DESC')
                 ->get();
        return view('admin.votes', [
            'votes' => $votes
        ]);
    }
}
