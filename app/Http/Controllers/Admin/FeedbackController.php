<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;

class FeedbackController extends Controller
{
    public function Index()
    {
        $datacountlists = \App\Models\Feedbacks::get();
        $feedback           = \App\Models\Feedbacks::select('feedbacks.*','users.name AS username')
                                                    ->leftJoin('users','users.id','=','feedbacks.user_id')
                                                    ->paginate('10');
        return view('admin.feedback.index', compact(['datacountlists','feedback']));
    }

    public function view(Request $request, $id='')
    {
        $feedbacks   = \App\Models\Feedbacks::select('feedbacks.*','users.name AS username')
                                ->leftJoin('users','users.id','=','feedbacks.user_id')
                                ->find($id);
        return view('admin.feedback.view', compact(['feedbacks']));
    }

    public function destroy(Request $request,$id='')
    {
        $ids 	= $request->mul_del;
        \App\Models\Feedbacks::whereIn('id',$ids)->delete();
        Session::flash('message', 'Feedback Deleted Successfully! ');
        return redirect()->route('admin.feedback.index');
    }

    
}
