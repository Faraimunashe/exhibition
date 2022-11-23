<?php

use App\Models\Exhibitor;
use App\Models\Membership;
use App\Models\User;
use App\Models\Vote;
use App\Models\Voter;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

function get_user_role($id){
    $role =  DB::table('roles')->where('id', $id)->first();
    return $role->display_name;
}


function get_status($num){
    $status = new stdClass();
    if($num === 2){
        $status->label = "pending";
        $status->badge = "warning";
    }elseif($num === 1){
        $status->label = "approved";
        $status->badge = "success";
    }else{
        $status->label = "rejected";
        $status->badge = "danger";
    }

    return $status;
}

function get_exhibitor(){
    return Exhibitor::where('user_id', Auth::id())->first();
}

function isVoter(){
    $voter = Voter::where('user_id', Auth::id())->first();
    if(is_null($voter)){
        return false;
    }else{
        if($voter->status == 0 || $voter->status == 2){
            return false;
        }else{
            return true;
        }
    }

}

function hasVoted(){
    $voter = Vote::where('user_id', Auth::id())->first();
    if(is_null($voter)){
        return false;
    }else{
        return true;
    }
}

function get_exhibition($exh_id){
    return Exhibitor::find($exh_id);
}

function get_user($user_id){
    return User::find($user_id);
}
