<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Exhibitor;
use App\Models\Vote;
use App\Models\Voter;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExhibitController extends Controller
{
    public function index()
    {
        $adj = Voter::where('user_id', Auth::id())->first();
        return view('user.exhibit', ['adj' => $adj]);
    }

    public function apply(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string'],
            'phone' => ['required', 'digits:10', 'starts_with:07'],
            'address' => ['required', 'string']
        ]);

        try{
            $ex = new Exhibitor();
            $ex->name = $request->name;
            $ex->phone = $request->phone;
            $ex->address = $request->address;
            $ex->user_id = Auth::id();
            $ex->save();

            return redirect()->back()->with('success', 'Successfully applied for exhibition spot');
        }catch(Exception $e)
        {
            return redirect()->back()->with('error', 'ERROR: '.$e->getMessage());
        }
    }

    public function adjudication()
    {
        try{
            $voter = new Voter();
            $voter->user_id = Auth::id();
            $voter->status = 2;
            $voter->save();

            return redirect()->back();
        }catch(Exception $e)
        {
            return redirect()->back()->with('error', 'ERROR: '.$e->getMessage());
        }
    }
}
