<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MembershipController extends Controller
{
    public function index()
    {
        $member = Member::where('user_id', Auth::id())->first();
        return view('user.membership', [
            'member' => $member
        ]);
    }
}
