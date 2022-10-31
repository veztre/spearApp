<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Organization;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Storage;

class ActivityController extends Controller
{
    public function index()
    {

        if (Auth::user()->role=='student body'){
            $activities = Activity::where("status", "for approval-student Body")->get();
        }else if (Auth::user()->role=='student'){
            $activities = Organization::where("user_id", Auth::user()->id)->first()->activities()->get();
        }
        return Inertia::render('Activity/Index',[
            'activities' => $activities
        ]);
    }

    public function create()
    {
        return Inertia::render('Activity/Create');
    }

    public function store()
    {
        $org_id=Organization::where('user_id',Auth::user()->id)->first();
        Request::validate([
            'venue' => 'required',
            'purpose' => 'required',
            'status' => 'required',
            'startDate' => 'required',
            'endDate' => 'required',
            'attachment' => 'required|mimetypes:application/pdf|max:2048',

        ]);
        // create pdf attachment
        $image_path = Request::file('attachment') ? Request::file('attachment')->store('PDF','public') : null;

        DB::table('activities')->insert([
            'organization_id' => $org_id->id,
            'status' =>Request::get('status'),
            'venue' => Request::get('venue'),
            'purpose' => Request::get('purpose'),
            'endDate' => Request::get('endDate'),
            'startDate' => Request::get('startDate'),
            'attachment'=>$image_path,
        ]);

        return redirect()->route('activity.index')->with('success', 'Activity  created.');
    }

    public function edit(Activity $activity)
    {


        return Inertia::render('Activity/Edit', [
            'activity' => [
                'id' => $activity->id,
                'purpose' => $activity->purpose,
                'venue' => $activity->venue,
                'startDate' => $activity->startDate,
                'endDate' => $activity->endDate,
                'status'=> $activity->status
            ],
        ]);
    }

    public function update(Activity $activity)
    {
        Request::validate([
            'venue' => ['required', 'max:50'],
            'purpose' => ['required'],
            'startDate' => ['required' ],
            'endDate' => ['required'],
            'status' => ['required'],
            'attachment' => 'mimetypes:application/pdf|max:2048',


        ]);
        if (Request::file('attachment'))
        {
            if ($activity->attachment!=null  )
                Storage::delete(['public/', $activity->attachment]);
            $image_path = Request::file('attachment')->store('PDF','public');
            Activity::where('id',Request::get('id'))
                ->update([
                'status' =>Request::get('status'),
                'venue' => Request::get('venue'),
                'purpose' => Request::get('purpose'),
                'endDate' => Request::get('endDate'),
                'startDate' => Request::get('startDate'),
                'attachment' =>$image_path]);
        }else
            $activity->update(Request::only('venue', 'purpose', 'status', 'startDate', 'endDate'));
     return redirect()->route('activity.index')->with('success', 'Activity  updated.');;
    }

    public function destroy(Activity $activity)
    {
        $activity->delete();
        return redirect()->route('activity.index')->with('success', 'Activity  Deleted.');
    }

}

