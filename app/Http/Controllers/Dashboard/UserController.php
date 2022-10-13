<?php

namespace App\Http\Controllers\Dashboard;

use notify;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use App\Http\Requests\StoreUserRequest;
use Illuminate\Support\Facades\Storage;

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

        if ($request->search){

            $users=User::whereRoleIs('admin')->when($request->search,function($query) use($request){
                return $query->where('first_name','like' ,'%' . $request->search . '%')
                ->orWhere('last_name','like','%' . $request->search . '%');
            })->latest()->paginate(1);
        }
        else
            $users=User::paginate(10);


        return view('dashboard.users.user_index',['users'=>$users]);
    }

    public function list(){


}
    public function create()
    {
        return view('dashboard.users.create');
    }

    public function store(StoreUserRequest $request)
    {

        $data=$request->validated();
        $data=$request->except(['password','password_confirmation','image']);
        if(!$data)
            return back()->with('errors');

        $data['password']=bcrypt($request['password']);



        if($request->file('image')){
            Image::make($request->image)->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();

        })->save(public_path('uploads/user_images/'. $request->image->hashName()));

        $data['image']=  $request->image->hashName();
    }


        $user=User::create($data);
        dd($user);
        $user->attachRole('admin');
        $user->attachPermissions($data['permissions']);
        notify()->success('User Added Successfully!');
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
        if($user->image != 'default.png'){
            Storage::disk('public_uploads')->delete('/users_images/'.$user->image);
        }
        $deleted_user=$user->id;
        User::destroy($deleted_user);
        notify()->preset('user-deleted');

        return back();
    }
}
