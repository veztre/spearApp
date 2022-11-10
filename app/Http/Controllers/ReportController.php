<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request ;
use Inertia\Inertia;
use ProtoneMedia\LaravelQueryBuilderInertiaJs\InertiaTable;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class ReportController extends Controller
{
    public function index()
    {

        $globalSearch = AllowedFilter::callback('global', function ($query, $value) {
            $query->where(function ($query) use ($value) {
                Collection::wrap($value)->each(function ($value) use ($query) {
                    $query
                        ->orWhere('purpose', 'LIKE', "%{$value}%")
                        ->orWhere('venue', 'LIKE', "%{$value}%")
                        ->orWhere('startDate', 'LIKE', "%{$value}%")
                        ->orWhere('status', 'LIKE', "%{$value}%")
                        ->orWhere('endDate', 'LIKE', "%{$value}%");
                });
            });
        });

        $query= Activity::select('id','venue', DB::raw("SUBSTR(purpose,1,30) AS purpose"), 'startDate', 'endDate','status');
        //dd($query);
        $activities = QueryBuilder::for($query)
            ->defaultSort('id')
            ->allowedSorts(['purpose', 'venue', 'start_date','status'])
            ->allowedFilters(['venue', 'purpose', 'startDate', 'endDate','status', $globalSearch])
            ->paginate(8)
            ->withQueryString();

        return Inertia::render('Reports/Index', ['activities' => $activities])->table(function (InertiaTable $table) {
            $table->column('id', 'ID', searchable: true, sortable: true);
            $table->column('venue', 'Venue', searchable: true, sortable: true);
            $table->column('purpose', 'Purpose', searchable: true, sortable: true);
            $table->column('status', 'Status', searchable: true, sortable: true);
            $table->column('startDate', 'Start Date', searchable: true, sortable: true);
            $table->column('endDate', 'End Date', searchable: true, sortable: false);
        });
    }




}
