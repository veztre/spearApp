<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;
use App\Models\Activity;
use App\Models\Organization;
use App\Models\Organization_User;
use App\Models\User;
use Illuminate\Support\Facades\Request;
class DashboardController extends Controller
{
    public function index(){

        if (Auth::user()->role=='student organization'){
                    $activities = Activity::where("status", "for approval - office of the student organization")->get();
        }else if (Auth::user()->role=='president'){
                    $organization = Auth::user()->organizations->first();
                    $activities= Organization::find($organization->id)->activities()->get();
        } else if (Auth::user()->role == 'dean') {
            $users= User::select('id')->where([['department','=',Auth::user()->department],
                                 ['role','=','president']])->get();
            $organizations = Organization_User::select('organization_id')->whereIn('user_id',$users)->get();
            $activities = Activity::whereIn('organization_id',$organizations)
                            ->where('status','for approval-dean')->get();
        }else{
            $activities = Activity::where("status", "for approval-chancellor")->get();
        }

        Request::session()->put('totalActivity', count($activities));
        $default_password = Hash::check('password', Auth::user()->password);
        return Inertia::render('Dashboard',[
            'default_password'=> $default_password,'totalActivity'=>count($activities)]
        );


    }

}
