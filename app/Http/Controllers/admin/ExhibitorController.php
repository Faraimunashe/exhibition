<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Exhibitor;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ExhibitorController extends Controller
{
    public function index()
    {
        $exhibitors = Exhibitor::latest()->paginate(10);
        return view('admin.exhibitors', [
            'exhibitors' => $exhibitors
        ]);
    }

    public function add(Request $request)
    {
        $request->validate([
            'user_id' => ['required', 'integer'],
            'exhibition_id' => ['required', 'integer'],
            'status' => ['required', 'integer']
        ]);

        try{
            $exh = Exhibitor::find($request->exhibition_id);
            if(is_null($exh))
            {
                return redirect()->back()->with('error', 'User details not found');
            }

            $exh->status = $request->status;
            $exh->save();

            DB::update('UPDATE role_user SET role_id = 2 WHERE user_id = ?', [$request->user_id]);

            return redirect()->back()->with('success', 'Successfully added exhibitor');
        }catch(Exception $e)
        {
            return redirect()->back()->with('error', 'ERROR: '.$e->getMessage());
        }
    }
}
