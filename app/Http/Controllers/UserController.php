<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use App\Models\User;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class UserController extends Controller
{
    public function index()
    {
        //$organization = User::all()->organization();
        return Inertia::render('Users/Index', [
            'users' => User::paginate(),
        ]);
    }
    public function create()
    {
        return Inertia::render('Users/Create', [
            'users' => User::paginate()
        ]);
    }

    public function store(Request $request)
    {
        Request::validate([
            'last_name' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required',
            'name'=> 'required',
            'department' => 'required'
            ]);

        $organization = new Organization([
                 'name'=>Request::get('name'),
                 'department'=>Request::get('department'),
            ]);
        User::create([
            'last_name' => Request::get('last_name'),
            'first_name' => Request::get('first_name'),
            'email' => Request::get('email'),
            'role' => Request::get('role'),
            'password' => Hash::make(Request::get('password')),
            ])->organization()->save($organization);

        return redirect()->route('users.index');;
    }

    public function edit(User $user)
    {
        $organization=Organization::where('user_id',$user->id)->first();
        
         return Inertia::render('Users/Edit', [
            'user' => [
                'id' => $user->id,
                'last_name' => $user->last_name,
                'first_name' => $user->first_name,
                'role' => $user->role,
                'email' => $user->email,
            ],
            'organization'=> [
                'name'=>$organization->name,
                'department'=> $organization->department           
            ]
        ]);

    }

    public function update(User $user)
    {
       Request::validate([
            'last_name' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required',
            'name'=> 'required',
            'department' => 'required'
            ]);
        $user->update(Request::only('last_name', 'first_name', 'role', 'email'));
        DB::table('organizations')
            ->where('user_id', $user->id)
            ->update(['name' => Request::get('name'),
                     'department' => Request::get('department')
            ]);
        return redirect()->route('users.index')->with('success', 'user  update.');;
    }


    public function destroy(User $user)
    {
        DB::table('organizations')
            ->where('user_id',$user->id)
            ->delete();

        $user->delete();
        return redirect()->route('users.index')->with('success', 'User  Deleted.');
    }



}
