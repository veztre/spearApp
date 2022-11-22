<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Comment;
use DateTime;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class CommentController extends Controller
{
    public function index()
    {
        return Inertia::render('Comment/Index', [
            'comments' => Comment::paginate()
        ]);
    }


    public function create(Activity $activity)
    {

        return Inertia::render('Comment/Create',[
            'activity_id'=> $activity->id
        ]
    );
    }


    public function store(){

        Request::validate([
            'comment' => 'required',
        ]);

        DB::table('comments')->insert([
            'comment' => Request::get('comment'),
            'user_id' => Auth::user()->id,
            'activity_id' => Request::get('activity_id'),
            'updated_at' =>  new DateTime()
        ]);
        Activity::where('id', Request::get('activity_id'))
            ->update([
                'status' => 'for update',
            ]);
        return redirect()->route('activity.index')->with('success', 'Comment  created.');
    }


}
