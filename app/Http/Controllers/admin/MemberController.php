<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Member;
use Exception;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function index()
    {
        $members = Member::latest()->paginate(10);
        return view('admin.members', [
            'members' => $members
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'user_id' => ['required', 'integer'],
            'status' => ['required', 'integer']
        ]);

        try{
            $member = Member::where('user_id', $request->user_id)->first();
            if($request->status === 0){

                $member->delete();
                return redirect()->back()->with('success', 'successfully rejected user membership');
            }elseif($request->status === 1)
            {
                $member->status = 1;
                $member->save();
                return redirect()->back()->with('success', 'successfully accept user membership');
            }
        }catch(Exception $e)
        {
            return redirect()->back()->with('error', 'ERROR: '.$e->getMessage());
        }
    }
}
