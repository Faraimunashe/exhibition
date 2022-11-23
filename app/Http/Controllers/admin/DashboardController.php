<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Voter;
use Exception;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $vote_requests = Voter::where('status', 2)->latest()->paginate(10);
        return view('admin.dashboard', [
            'requests' => $vote_requests
        ]);
    }

    public function add_voter(Request $request)
    {
        $request->validate([
            'voter_id' => ['required', 'integer'],
            'status' => ['required', 'integer']
        ]);

        try{
            $voter = Voter::find($request->voter_id);
            $voter->delete();

            return redirect()->back()->with('success', 'successfully replied to adjudication');
        }catch(Exception $e)
        {
            return redirect()->back()->with('error', 'ERROR: '.$e->getMessage());
        }
    }
}
