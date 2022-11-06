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
        return Inertia::render('Dashboard', [
            'axis' => $setAxis,
            'activity_data' => $setData
        ]);
}
}
