<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use App\Http\Requests\StoreOrganizationRequest;
use App\Http\Requests\StoreSignatureRequest;
use App\Models\Signature;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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
        $organization= Auth::user()->organizations->first();
        return Inertia::render('Organization/Index',['organization' => $organization]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Organization $organization)
    {
        Request::validate([
            'name' => ['required'],
            'acronym' => ['required'],
            'logo' => 'mimes:svg,jpg,png|max:2048'
        ]);
        if (Request::file('logo')) {
            if ($organization->logo != null)
                Storage::delete(['logos/', $organization->logo]);
                $image_path = Request::file('logo')->store('logos','public');
                $organization->where('id', $organization->id)
                   ->update([
                      'name' => Request::get('name'),
                      'acronym' => Request::get('acronym'),
                      'logo' => $image_path
            ]);
        } else
        $organization->update(Request::only('name', 'acronym'));

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

    public function createOfficer()
    {
        $organization = Auth::user()->organization;
        return Inertia::render('Organization/Create', [
            'organization' => $organization
        ]);
    }

    public function storeOfficer()
    {
        Request::validate([
            'last_name' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required',
        ]);

        $user = new User([
            'last_name' => Request::get('last_name'),
            'first_name' => Request::get('first_name'),
            'email' => Request::get('email'),
            'role' => Request::get('role'),
            'department' => Auth::user()->department,
            'password' => Hash::make(Request::get('password')),
            'salutation' => Request::get('salutation')
        ]);
        $user->save();
        $organization = User::find(Auth::user()->id)->organizations()->first();
        $organization->users()->attach($user);
        $users = Organization::find($organization->id)->users()->get();
        return Inertia::render('Organization/Officers', [
            'users' => $users,
        ]);

    }

    public function editOfficer(User $user){
        return Inertia::render('Organization/Edit', [
            'user' => [
                'id' => $user->id,
                'last_name' => $user->last_name,
                'first_name' => $user->first_name,
                'role' => $user->role,
                'email' => $user->email,
                'salutation' => $user->salutation,
            ],
        ]);
    }


    public function updateOfficer(User $user)
    {
        Request::validate([
            'last_name' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'role' => 'required|string|max:255',
           // 'email' => 'required|string|email|max:255|unique:users',
        ]);

        $user->update(Request::only('last_name', 'first_name', 'role', 'salutation'));

        $organization = User::find(Auth::user()->id)->organizations()->first();
        $users = Organization::find($organization->id)->users()->get();
        return Inertia::render('Organization/Officers', [
            'users' => $users,
        ]);
    }

    public function createSignature(User $user){

        $signature = Signature::where("user_id", $user->id)->first();

        if ($signature == null) {
            return Inertia::render('Organization/CreateSignature',[
                'signUser' => $user,
            ]);
        } else {
            return Inertia::render('Organization/ViewSignature', [
                'signature' => $signature,
                 'user'=> $user
            ]);
        }
    }

    public function updateSignature(User $user)
    {
        return Inertia::render('Organization/CreateSignature', [
            'signUser' => $user,
        ]);
    }

    public function storeSignature(User $user)
    {

        $signExist = $user->signature;


        if ($signExist) {
            if (Request::file('sign_image')) {
                //  Storage::delete();
                $sign_path = Request::file('sign_image')->store('signature', 'public');
                Signature::where('id', $signExist->id)
                    ->update([
                        'user_id' => $user->id,
                        'sign_image' => $sign_path
                    ]);
            } else {
                return redirect()->route('users.officers')->with('error', 'Please choose an image signature');
            }

        } else {
            $sign_path = Request::file('sign_image') ? Request::file('sign_image')->store('signature', 'public') : null;
            Signature::create([
                'sign_image' => $sign_path,
                'user_id' => (int) $user->id,
            ]);
            return redirect()->route('users.officers')->with('error', 'Please choose an image signature');

        }

        return redirect()->route('users.officers')->with('success', 'Signature updated!!!');



    }










}
