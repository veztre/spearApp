<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Activity_Signature;
use App\Models\Organization;
use App\Models\Signature;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Mail\Attachment;
use LDAP\Result;

class ActivityController extends Controller
{
    public function index()
    {

        if (Auth::user()->role=='student body'){
            $activities = Activity::where("status", "for approval-student Body")->get();
             return Inertia::render('Activity/Index',[
            'activities' => $activities
            ]);
        }else if (Auth::user()->role=='student'){
            $activities = Organization::where("user_id", Auth::user()->id)->first()->activities()->get();
            $forUpdates = $activities->where('status','for update')->count();
            return Inertia::render('Activity/Index', [
                'activities' => $activities,
                'forUpdates' => $forUpdates
            ]);
        } else if (Auth::user()->role == 'dean') {
            $activities = Activity::where("status", "for approval-dean")->get();
            //$forUpdates = $activities->where('status', 'for update')->count();
            return Inertia::render('Activity/Index', [
                'activities' => $activities,
            ]);

        }else{
            $activities = Activity::all();
            return Inertia::render('Activity/Index',[
            'activities' => $activities
        ]);
    }
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
        $image_path = Request::file('attachment') ? Request::file('attachment')->store('public') : null;


        DB::table('activities')->insert([
            'organization_id' => $org_id->id,
            'status' =>Request::get('status'),
            'venue' => Request::get('venue'),
            'purpose' => Request::get('purpose'),
            'endDate' => Request::get('endDate'),
            'startDate' => Request::get('startDate'),
            'attachment'=> $image_path,
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
                'status'=> $activity->status,


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
            $image_path = Request::file('attachment')->store('public');
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

        if (Request::get('status')=='for approval-student body'){
            $signature = Auth::user()->signature;
            $act_signature = Activity_Signature::where([['activity_id','=',Request::get('id')],
            ['signature_id','=',$signature->id]])->first();

            if ($act_signature==null){
                DB::table('activity_signature')->insert(
                    [
                        'activity_id' => Request::get('id'),
                        'signature_id' => $signature->id
                    ]
                );
            }


        }


     return redirect()->route('activity.index')->with('success', 'Activity  updated.');;
    }


    public function approvedByOrg(Activity $activity){

        Activity::where('id',$activity->id)
            ->update([
            'status' =>'for approval-dean']);
            $signature = Auth::user()->signature;
            $act_signature = Activity_Signature::where([
                ['activity_id', '=', $activity->id],
                ['signature_id', '=', $signature->id]
            ])->first();
            if ($act_signature == null) {
                DB::table('activity_signature')->insert(
                    [
                        'activity_id' =>  $activity->id,
                        'signature_id' => $signature->id
                    ]
                );
            }
        return redirect()->route('activity.index')->with('success', 'Activity  Submitted to Chancellor\'s Office.');

    }

    public function approvedByDean(Activity $activity)
    {

        Activity::where('id', $activity->id)
            ->update([
                'status' => 'for approval-chancellor'
            ]);
        $signature = Auth::user()->signature;
        $act_signature = Activity_Signature::where([
            ['activity_id', '=', Request::get('id')],
            ['signature_id', '=', $signature->id]
        ])->first();
        if ($act_signature == null) {
            DB::table('activity_signature')->insert(
                [
                    'activity_id' =>  $activity->id,
                    'signature_id' => $signature->id
                ]
            );
        }
        return redirect()->route('activity.index')->with('success', 'Activity  Submitted to Dean\'s Office.');
    }

    public function approvedByChancellor(Activity $activity)
    {

        Activity::where('id', $activity->id)
            ->update([
                'status' => 'approved'
            ]);
        $signature = Auth::user()->signature;
        $act_signature = Activity_Signature::where([
            ['activity_id', '=', Request::get('id')],
            ['signature_id', '=', $signature->id]
        ])->first();
        if ($act_signature == null) {
            DB::table('activity_signature')->insert(
                [
                    'activity_id' =>  $activity->id,
                    'signature_id' => $signature->id
                ]
            );
        }
        return redirect()->route('activity.index')->with('success', 'Activity  is approved.');
    }



    public function destroy(Activity $activity)
    {
        $activity->delete();
        return redirect()->route('activity.index')->with('success', 'Activity  Deleted.');
    }

    public function viewAttachment(Activity $activity)
    {
        return  Storage::download($activity->attachment);
    }



}

