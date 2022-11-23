<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Notice;
use Exception;
use Illuminate\Http\Request;

class NoticeController extends Controller
{
    public function index()
    {
        $notices = Notice::latest()->paginate(10);
        return view('user.notices', [
            'notices' => $notices
        ]);
    }

    public function add(Request $request)
    {
        $request->validate([
            'topic' => ['required', 'string'],
            'content' => ['required', 'string']
        ]);

        try{
            $notice = new Notice();
            $notice->topic = $request->topic;
            $notice->content = $request->content;
            $notice->save();

            return redirect()->back()->with('success', 'Successfully added a notice');
        }catch(Exception $e)
        {
            return redirect()->back()->with('error', 'ERROR: '.$e->getMessage());
        }
    }

    public function delete(Request $request)
    {
        $request->validate([
            'notice_id' => ['required', 'integer']
        ]);

        try{
            $notice = Notice::find($request->notice_id);
            $notice->delete();

            return redirect()->back()->with('success', 'Successfully deleted a notice');
        }catch(Exception $e)
        {
            return redirect()->back()->with('error', 'ERROR: '.$e->getMessage());
        }
    }
}
