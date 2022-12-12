<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Activity_Signature;
use App\Models\Comment;
use App\Models\Organization;
use App\Models\Organization_User;
use App\Models\Signature;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Carbon\Carbon;
use Illuminate\Mail\Attachment;
use LDAP\Result;

class ActivityController extends Controller
{
    public function index()
    {




        if (Auth::user()->role=='student organization'){
            $activities = Activity::where("status", "for approval - office of the student organization")->get();
            foreach ($activities as $activity){
                $activity->acronym = $activity->organization->acronym;
            }

             return Inertia::render('Activity/IndexStudentOrg',[
            'activities' => $activities
            ]);

        }else if (Auth::user()->role=='president'){
            if (Auth::user()->signature==null){
                return redirect()->route('dashboard')->with('pageError', 'Create a signature before creating an activity ');;
            }
            $organization = Auth::user()->organizations->first();
            $activities= Organization::find($organization->id)->activities()->get();
            //dd($activities);
            return Inertia::render('Activity/Index', [
               'activities' => $activities
            ]);


        } else if (Auth::user()->role == 'dean') {
            $users= User::select('id')->where([['department','=',Auth::user()->department],
                                 ['role','=','president']])->get();
            $organizations = Organization_User::select('organization_id')->whereIn('user_id',$users)->get();
            $activities = Activity::whereIn('organization_id',$organizations)
                            ->where('status','for approval-dean')->get();
             foreach ($activities as $activity){
                $activity->acronym = $activity->organization->acronym;
            }
            return Inertia::render('Activity/IndexDean', [
                'activities' => $activities,
            ]);

        }else{
            $activities = Activity::where("status", "for approval-chancellor")->get();
             foreach ($activities as $activity){
                $activity->acronym = $activity->organization->acronym;
            }
            //$forUpdates = $activities->where('status', 'for update')->count();
            return Inertia::render('Activity/IndexChancellor', [
                'activities' => $activities,
            ]);
        }
    }


    public function create()
    {
        return Inertia::render('Activity/Create');
    }



    public function store()
    {
        $organization = Auth::user()->organizations->first();
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
            'organization_id' => $organization->id,
            'status' =>Request::get('status'),
            'venue' => Request::get('venue'),
            'purpose' => Request::get('purpose'),
            'endDate' => Request::get('endDate'),
            'startDate' => Request::get('startDate'),
            'attachment'=> $image_path,
            'updated_at'=> date("Y-m-d H:i:s"),
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
            'venue' => 'required',
            'purpose' => 'required',
            'startDate' => 'required' ,
            'endDate' => 'required',
            'status' => 'required',
            'attachment' => 'mimetypes:application/pdf|max:2048',
        ]);
        $signature = Auth::user()->signature;
        $organization = User::find(Auth::user()->id)->organizations()->first();

        $org_officers = Organization::find($organization->id)->users()->get();

        if (Request::get('status')=='for approval - office of the student organization'){
            if ($signature == null) {
                return redirect()->route('activity.index')->with('error', 'Please Create Signature before approving an activity ');
            }
            $activity->update(Request::only('venue', 'purpose', 'status', 'startDate', 'endDate'));
            $act_signature = Activity_Signature::where([
                ['activity_id', '=', Request::get('id')],
                ['signature_id', '=', $signature->id]
            ])->first();
            if ($act_signature == null) {
                foreach ($org_officers as $officer) {
                    $signID = $officer->signature;
                    DB::table('activity_signature')->insert(
                        [
                            'activity_id' => Request::get('id'),
                            'signature_id' => $signID->id
                        ]
                    );
                }
            }
        }
        if (Request::file('attachment')){
            if ($activity->attachment!=null  ){
                Storage::delete([$activity->attachment]);
                $attachment_path = Request::file('attachment')->store('public');
                Activity::where('id',Request::get('id'))
                ->update([
                'status' =>Request::get('status'),
                'venue' => Request::get('venue'),
                'purpose' => Request::get('purpose'),
                'endDate' => Request::get('endDate'),
                'startDate' => Request::get('startDate'),
                'attachment' =>$attachment_path]);
                }
        }
      return redirect()->route('activity.index')->with('success', 'Activity  updated.');
    }


    public function approvedByOrg(Activity $activity){

            $signature = Auth::user()->signature;

            if ($signature==null){
               return redirect()->route('dashboard')->with('pageError', 'Please Create Signature before approving an activity ');
            }

            Activity::where('id', $activity->id)
            ->update([
                'status' => 'for approval-dean'
            ]);

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
        return redirect()->route('dashboard')->with('success', 'Activity  Submitted to Dean\'s Office.');

    }

    public function approvedByDean(Activity $activity)
    {
        $signature = Auth::user()->signature;
        if ($signature == null) {
            return redirect()->route('dashboard')->with('pageError', 'Please Create Signature before approving an activity ');
        }

        Activity::where('id', $activity->id)
            ->update([
                'status' => 'for approval-chancellor'
            ]);

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
        return redirect()->route('dashboard')->with('success', 'Activity  Submitted to Chancellor\'s Office.');
    }

    public function approvedByChancellor(Activity $activity)
    {
      $signature = Auth::user()->signature;
        if ($signature == null) {
            return redirect()->route('dashboard')->with('pageError', 'Please Create Signature before approving an activity ');
        }

        Activity::where('id', $activity->id)
            ->update([
                'status' => 'approved'
            ]);
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
        return redirect()->route('dashboard')->with('success', 'Activity  is approved.');
    }



    public function destroy(Activity $activity)
    {
        $activity->delete();
        return redirect()->route('activity.index')->with('success', 'Activity  Deleted.');
    }

    public function viewComment(Activity $activity){
        $comments = $activity->comments()->get();
        foreach($comments as $comment){
            $user = User::where('id', $comment->user_id)->first();
            $fullname = $user->first_name . " " . $user->last_name;
            $comment->fullname = $fullname;
            $comment->updated_at =
            Carbon::createFromFormat('Y-m-d H:i:s',$comment->updated_at)
            ->format('m/d/Y');
        }
        return Inertia::render('Activity/Comments', [
            'comments' => $comments,
        ]);
    }

    public function viewAttachment(Activity $activity)
    {
        return  Storage::download($activity->attachment);
    }



}

