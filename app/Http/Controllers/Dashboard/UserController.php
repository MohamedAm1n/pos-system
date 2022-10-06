<?php

namespace App\Http\Controllers\Dashboard;

use notify;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:users_read'])->only('list');
        $this->middleware(['permission:users_create'])->only('create');
        $this->middleware(['permission:users_update'])->only('update');
        $this->middleware(['permission:users_delete'])->only('destroy');
    }

    public function index(Request $request)
    {
        smilify('success', 'You are successfully reconnected');
        $users=User::whereRoleIs('administrator')->when($request->search,function($query) use($request){
                return $query->where('first_name','like' ,'%' . $request->search . '%')
                ->orWhere('last_name','like','%' . $request->search . '%');
            })->latest()->paginate(10);
    

        return view('dashboard.users.all_users',['users'=>$users]);
    }

    public function list(){

    
}
    public function create()
    {
        return view('dashboard.users.create');
    }

    public function store(StoreUserRequest $request)
    {
        // dd($request->permissions);
        $data=$request->validated();
        $data=$request->except(['password','password_confirmation']);
        if(!$data)
            return back()->with('errors');

        $data['password']=bcrypt($request['password']);

        $user=User::create($data);
        $user->attachRole('Administrator');
        $user->attachPermissions($data['permissions']);
        notify()->success('Laravel Notify is awesome!');
        return redirect(route('users.index'));
    }

    public function show(User $user)
    {
        //
    }

    public function edit(User $user)
    {

    }

    public function update(Request $request, User $user)
    {
        //
    }

    public function destroy(User $user)
    {
        $deleted_user=$user->id;
        User::destroy($deleted_user);
        notify()->success('User Deleted successfully!');

        return back();
    }
}
