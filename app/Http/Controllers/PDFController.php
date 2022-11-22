<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PDFController extends Controller
{

    public function activityPDF(Activity $activity)
    {
        //for activity owner
        $sign_owner= "";
        $owner_firstname = "";
        $owner_lastname = "";
        $owner_role = "Position";
        //for  adviser
        $sign_adviser = "";
        $adviser_firstname = "";
        $adviser_lastname = "";
        $adviser_role = "Position";
        //for chairperson owner
        $sign_chairperson = "";
        $chairperson_firstname = "";
        $chairperson_lastname = "";
        $chairperson_role = "Position";
        //for student leader
        $sign_stud_body = "";
        $stud_body_firstname = "";
        $stud_body_lastname = "";
        $stud_body_role = "Student Org Leader";
        //for dean
        $dean_sign = "";
        $dean_firstname = "";
        $dean_lastname = "";
        $dean_role = "Dean";
        //for chancellor
        $chancellor_sign = "";
        $chancellor_firstname = "";
        $chancellor_lastname = "";
        $chancellor_role = "Chancellor";

        $organization =$activity->organization;

        $signatures=$activity->signatures;



        foreach ($signatures as $signature){
            $user=User::where('id',$signature->user_id)->first();
            if($user->role=='president'){
                $sign_owner= $signature->sign_image;
                $owner_firstname = $user->first_name;
                $owner_lastname = $user->last_name;
                $owner_role = ucfirst($user->role);

            }
            if ($user->role == 'adviser') {
                $sign_adviser = $signature->sign_image;
                $adviser_firstname = $user->first_name;
                $adviser_lastname = $user->last_name;
                $adviser_role = ucfirst($user->role);
            }
            if ($user->role == 'chairperson') {
                $sign_chairperson = $signature->sign_image;
                $chairperson_firstname = $user->first_name;
                $chairperson_lastname = $user->last_name;
                $chairperson_role = ucfirst($user->role);
            }

            if ($user->role == 'student body') {
                $sign_stud_body = $signature->sign_image;
                $stud_body_firstname = $user->first_name;
                $stud_body_lastname = $user->last_name;
                $stud_body_role = ucfirst($user->role);
            }
            if ($user->role == 'dean') {
                $dean_sign = $signature->sign_image;
                $dean_firstname = $user->first_name;
                $dean_lastname = $user->last_name;
                $dean_role = ucfirst($user->role);
            }
            if ($user->role == 'admin') {
                $chancellor_sign = $signature->sign_image;
                $chancellor_firstname = $user->first_name;
                $chancellor_lastname = $user->last_name;
                $chancellor_role = ucfirst($user->role);
            }



        }
        $data = [
           'purpose' => $activity->purpose,
           'venue' => $activity->venue,
           'date' => $activity->updated_at,
           'startDate' => $activity->startDate,
           'endDate' => $activity->endDate,
           'org_name' =>$organization->name,
           'logo'=>$organization->logo,
          'department' => $organization->department,
           //for owner
           'sign_owner'=> $sign_owner,
           'owner_firstname'=>$owner_firstname,
           'owner_lastname'=> $owner_lastname,
           'role' =>$owner_role,
            //for adviser
            'sign_adviser' => $sign_adviser,
            'adviser_firstname' => $adviser_firstname,
            'adviser_lastname' => $adviser_lastname,
            'adviser_role' => $adviser_role,
            //for chairperson
            'sign_chairperson' => $sign_chairperson,
            'chairperson_firstname' => $chairperson_firstname,
            'chairperson_lastname' => $chairperson_lastname,
            'chairperson_role' => $chairperson_role,
           //for student body
           'sign_stud_body' => $sign_stud_body,
           'stud_body_firstname' => $stud_body_firstname,
           'stud_body_lastname' => $stud_body_lastname,
           'stud_body_role' => $stud_body_role,
            //for dean
            'dean_sign'=>$dean_sign,
            'dean_firstname'=>$dean_firstname,
            'dean_lastname'=>$dean_lastname,
            'dean_role'=>$dean_role,
            //for chancellor
            'chancellor_sign'=>$chancellor_sign,
            'chancellor_firstname'=>$chancellor_firstname,
            'chancellor_lastname'=>$chancellor_lastname,
            'chancellor_role'=>$chancellor_role,
        ];
        $pdf = PDF::loadView('PDF/myPDF',$data);
        return $pdf->stream('activity.pdf');

//        return view('PDF/myPDF',$data);
    }

    public function activityReport(Request $request)
    {

        $organizations= Auth::user()->organizations->first();
        //dd($organizations);
           if ($request->status=='all' || $request->status=='null'){
                if (Auth::user()->role=='president'){
                     $data = Activity::where("organization_id", $organizations->id)->get();
                }else{
                    $data = Activity::all();
                }
                $status = "All Activity Status ";

            }else{
                if (Auth::user()->role == 'president'){
                    $data = Activity::where("organization_id", $organizations->id)
                        ->where('status', '=', $request->status)->get();
                }else{
                    $data = Activity::where('status', '=', $request->status)->get();
                }
                $status = strtoupper($request->status) . " Status";

            }
            $activities = $data->toArray();
            $pdf = PDF::loadView('PDF/activity', ['activities' => $activities,'status'=>$status,'organization'=>$organizations]);
            return $pdf->download('activity.pdf');
            // return view('PDF/activity', ['activities' => $activities, 'status' => $status, 'organization' => $organizations]);



    }

}
