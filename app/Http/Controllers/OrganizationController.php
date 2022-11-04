<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use App\Http\Requests\StoreOrganizationRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use League\CommonMark\Node\Query\OrExpr;

class OrganizationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $organization= Auth::user()->organization;
        return Inertia::render('Organization/Index',[
            'organization' => $organization
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Organization $organization)
    {
        Request::validate([
            'name' => ['required', 'max:50'],
            'department' => ['required'],
            'logo' => 'mimes:svg,jpg,png|max:2048'
        ]);
        if (Request::file('logo')) {
            if ($organization->logo != null)
                Storage::delete(['public/', $organization->logo]);
                $image_path = Request::file('logo')->store('logos','public');
                $organization->where('id', $organization->id)
                   ->update([
                      'name' => Request::get('name'),
                      'department' => Request::get('department'),
                      'logo' => $image_path
            ]);
        } else
            $organization->update(Request::only('name', 'department'));

        return redirect()->route('dashboard')->with('success', 'Organization  updated.');;

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreOrganizationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOrganizationRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Organization  $organization
     * @return \Illuminate\Http\Response
     */
    public function show(Organization $organization)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Organization  $organization
     * @return \Illuminate\Http\Response
     */
    public function edit(Organization $organization)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOrganizationRequest  $request
     * @param  \App\Models\Organization  $organization
     * @return \Illuminate\Http\Response
     */
    public function update(StoreOrganizationRequest $request, Organization $organization)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Organization  $organization
     * @return \Illuminate\Http\Response
     */
    public function destroy(Organization $organization)
    {
        //
    }
}
