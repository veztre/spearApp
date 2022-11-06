<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;

 use Illuminate\Support\Facades\DB;

class MonthlyUsersChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): array
    {
        $activities=DB::select("SELECT status, COUNT(status) status_count
                                FROM activities GROUP BY status");
        foreach($activities as $activity){
            $setAxis[]=$activity->status;
            $setData[]=$activity->status_count;
        }

     return $this->chart->pieChart()
            ->setTitle('Total Number of Activity By Status')
            ->addData($setData)
            ->setLabels($setAxis)
            ->toVue();
    }
}
