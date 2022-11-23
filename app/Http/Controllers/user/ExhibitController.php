<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Exhibitor;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExhibitController extends Controller
{
    public function index()
    {
        return view('user.exhibit');
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
}
