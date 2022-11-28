<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;
use ProtoneMedia\LaravelQueryBuilderInertiaJs\InertiaTable;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class UserController extends Controller
{
    public function index()
    { {
            $globalSearch = AllowedFilter::callback('global', function ($query, $value) {
                $query->where(function ($query) use ($value) {
                    Collection::wrap($value)->each(function ($value) use ($query) {
                        $query
                           ->orWhere('first_name', 'LIKE', "%{$value}%")
                           ->orWhere('last_name', 'LIKE', "%{$value}%")
                           ->orWhere('role', 'LIKE', "%{$value}%")
                           ->orWhere('department', 'LIKE', "%{$value}%");
                    });
                });
            });
            $users = QueryBuilder::for(User::class)
            ->defaultSort('first_name')
            ->allowedSorts(['first_name', 'last_name','role','department'])
            ->allowedFilters(['lastname_name','last_name', 'role','department', $globalSearch])
            ->paginate()
            ->withQueryString();

            return Inertia::render('Users/Index', ['users' => $users])->table(function (InertiaTable $table) {
                $table->column('first_name', 'First Name', searchable: true, sortable: true);
                $table->column('last_name', 'Last Name', searchable: true, sortable: true);
                $table->column('role', 'Role', searchable: true, sortable: true);
                $table->column('department', 'Department', searchable: true, sortable: true);
                $table->column(label: 'Actions');

            });

        }
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
            ]);
        if (Request::get('role')=='president'){
            $organization = new Organization([
                'name' => "for update",
                'acronym' => "FUD",
            ]);
            $organization->save();
            $user= new User([
                'last_name' => Request::get('last_name'),
                'first_name' => Request::get('first_name'),
                'email' => Request::get('email'),
                'role' => Request::get('role'),
                'department' => Request::get('department'),
                'password' => Hash::make(Request::get('password')),
                'salutation' => Request::get('salutation')
            ]);
            $user->save();
            $organization->users()->attach($user);
        }else{
            User::create([
                'last_name' => Request::get('last_name'),
                'first_name' => Request::get('first_name'),
                'email' => Request::get('email'),
                'role' => Request::get('role'),
                'department' => Request::get('department'),
                'password' => Hash::make(Request::get('password')),
                'salutation' => Request::get('salutation')]);
        }
        return redirect()->route('users.index')->with('success','User Created') ;
    }

    public function edit(User $user)
    {

            return Inertia::render('Users/Edit', [
                'user' => [
                    'id' => $user->id,
                    'last_name' => $user->last_name,
                    'first_name' => $user->first_name,
                    'role' => $user->role,
                    'email' => $user->email,
                    'salutation' => $user->salutation,
                    'department' => $user->department
                ],
            ]);

    }

    public function update(User $user)
    {
       Request::validate([
            'last_name' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'role' => 'required|string|max:255',
          //  'email' => 'required|string|email|max:255|unique:users',
         //   'salutation'=> 'required',
          //  'department' => 'required'

            ]);
        $user->update(Request::only('last_name', 'first_name', 'role', 'salutation','department'));
        return redirect()->route('users.index')->with('success', 'user  updated');;
    }


    public function destroy(User $user)
    {
        // DB::table('organizations')
        //     ->where('user_id',$user->id)
        //     ->delete();
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User  Deleted.');
    }
    public function officers()
    {
        $organization = User::find(Auth::user()->id)->organizations()->first();
        //dd($organization->id);
        $users= Organization::find($organization->id)->users()->get();
        return Inertia::render('Organization/Officers', [
            'users'=>$users,
        ]);
     }




}
