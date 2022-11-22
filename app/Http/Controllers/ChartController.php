<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class ChartController extends Controller
{
   public function index(){

        $activities = DB::select("SELECT status, COUNT(status) status_count
                                FROM activities GROUP BY status");
        foreach ($activities as $activity) {
            $setAxis[] = $activity->status;
            $setData[] = $activity->status_count;
        }
        
        $activities_per_month = DB::select("SELECT DATE_FORMAT(startDate, '%M') AS Month, COUNT(startDate) num
                                            FROM activities
                                            GROUP BY DATE_FORMAT(startDate, '%M') ORDER BY 1 DESC");
        foreach ($activities_per_month as  $mon){
            $months[] = $mon->Month;
            $number_activities[] = $mon->num;
        }

        return Inertia::render('Statistics', [
            'axis' => $setAxis,
            'activity_data' => $setData,
            'months'=> $months,
            'number_activities'=> $number_activities

        ]);
}
}
