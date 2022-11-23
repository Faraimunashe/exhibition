<?php

use App\Models\Exhibitor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

function get_user_role($id){
    $role =  DB::table('roles')->where('id', $id)->first();
    return $role->display_name;
}


function get_status($num){
    $status = new stdClass();
    if($num === 0){
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
