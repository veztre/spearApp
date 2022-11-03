<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf as PDF;


use Illuminate\Http\Request;

class PDFController extends Controller
{

    public function generatePDF(){
    $data = [
        'title' => 'Welcome to ItSolutionStuff.com',
        'date' => date('m/d/Y')
    ];
    $pdf = PDF::loadView('PDF/myPDF', $data);

    return $pdf->download('itsolutionstuff.pdf');

   }


    public function activityPDF(Activity $activity)
    {

        $organization =$activity->organization;
        $signatures=$activity->signatures;

        foreach ($signatures as $signature){
            $user=User::where('id',$signature->user_id)->first();
            if($user->role=='student'){
                $sign_owner= $signature->sign_image;
                $owner_firstname = $user->first_name;
                $owner_lastname = $user->last_name;
                $owner_role = $user->role;

            }
            if ($user->role == 'student body') {
                $sign_stud_body = $signature->sign_image;
                $stud_body_firstname = $user->first_name;
                $stud_body_lastname = $user->last_name;
                $stud_body_role = $user->role;
            }

        }
        $data = [
           'purpose' => $activity->purpose,
           'venue' => $activity->venue,
           'date' => $activity->updated_at,
           'startDate' => $activity->startDate,
           'endDate' => $activity->endDate,
           'org_name' =>$organization->name,
           'department' => $organization->department,
           //for owner
           'sign_owner'=> $sign_owner,
           'owner_firstname'=>$owner_firstname,
           'owner_lastname'=> $owner_lastname,
           'role' =>$owner_role,
           //for student body
           'sign_stud_body' => $sign_stud_body,
           'stud_body_firstname' => $stud_body_firstname,
           'stud_body_lastname' => $stud_body_lastname,
           'stud_body_role' => $stud_body_role



        ];
        // $pdf = PDF::loadView('PDF/myPDF',$data);
        // return $pdf->stream('activity.pdf');
        return view('PDF/myPDF',$data);
    }

}
