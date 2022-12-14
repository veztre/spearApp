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

        $query= Activity::join('organizations','activities.organization_id','=','organizations.id')
                  ->select('acronym','venue', DB::raw("SUBSTR(purpose,1,30) AS purpose"),
                          DB::RAW("CONCAT(DATE_FORMAT(startDate,'%m/%d/%Y'),'-',DATE_FORMAT(endDate,'%m/%d/%Y')) AS targetDate"),
                          'status');
        // dd($queries);

        $activities = QueryBuilder::for($query)
            ->defaultSort('acronym')
            ->allowedSorts(['acronym','purpose', 'venue', 'targetDate','status'])
            ->allowedFilters(['acronym','venue', 'purpose', 'targetDate','status', $globalSearch])
            ->paginate()
            ->withQueryString();

        return Inertia::render('Reports/Index', ['activities' => $activities])->table(function (InertiaTable $table) {
            $table->column('acronym', 'Organization', searchable: true, sortable: true);
            $table->column('purpose', 'Title', searchable: true, sortable: true);
            $table->column('venue', 'Venue', searchable: true, sortable: true);
            $table->column('targetDate', 'Target Date', searchable: true, sortable: true);
            $table->column('status', 'Status', searchable: true, sortable: true);
        });
    }




}
