<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Exhibitor;
use App\Models\Vote;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        return view('user.votes', [
            'votes' => $votes
        ]);
    }

    public function vote($exh_id)
    {
        try{
            $vote = Vote::where('user_id', Auth::id())->first();
            if(is_null($vote)){
                $vote = new Vote();
                $vote->user_id = Auth::id();
                $vote->exhibition_id = $exh_id;

                $vote->save();
                return redirect()->back();
            }else{
                $vote->delete();
                return redirect()->back();
            }
        }catch(Exception $e)
        {
            return redirect()->back()->with('error','ERRER: '.$e->getMessage());
        }
    }
}
