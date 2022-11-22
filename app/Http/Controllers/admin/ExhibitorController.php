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
            'name' => ['required', 'string'],
            'phone' => ['required', 'digits:10', 'starts_with:07'],
            'address' => ['required', 'string']
        ]);

        try{
            $user = Exhibitor::where('user_id', $request->user_id)->first();
            if(!is_null($user))
            {
                return redirect()->back()->with('error', 'User already an exhibitor');
            }
            $exh = new Exhibitor();
            $exh->user_id = $request->user_id;
            $exh->name = $request->name;
            $exh->phone = $request->phone;
            $exh->address = $request->address;
            $exh->save();

            DB::update('UPDATE role_user SET role_id = 2 WHERE user_id = ?', [Auth::id()]);

            return redirect()->back()->with('success', 'Successfully added exhibitor');
        }catch(Exception $e)
        {
            return redirect()->back()->with('error', 'ERROR: '.$e->getMessage());
        }
    }
}
