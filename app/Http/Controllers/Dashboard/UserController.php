<?php

namespace App\Http\Controllers\Dashboard;

use notify;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use App\Http\Requests\UserStoreRequest;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UserUpdateRequest;

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

            $users=User::whereRoleIs('admin')->where(function($q) use($request){
            return $q->when($request->search,function($query) use($request){
            return $query->where('first_name','like' ,'%' . $request->search . '%')
            ->orWhere('last_name','like','%' . $request->search . '%');
});
            })->latest()->paginate(1);
            
          
        }
        else
            $users=User::whereRoleIs('admin')->paginate(10);


        return view('dashboard.users.user_index',['users'=>$users]);
    }


    public function create()
    {
        return view('dashboard.users.create');
    }

    public function store(UserStoreRequest $request)
    {

        $data=$request->validated();
        if(!$data)
        return back()->with('errors');

        $data=$request->except(['password','password_confirmation','image']);
        $data['password']=bcrypt($request['password']);
        if($request->file('image')){
            Image::make($request->image)->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();

        })->save(public_path('uploads/user_images/'. $request->image->hashName()));

        $data['image']=  $request->image->hashName();
    }


        $user=User::create($data);
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
        return view('dashboard.users.edit',['user'=>$user]);
        
    }

    public function update(UserUpdateRequest $request, User $user)
    {
    // dd($request->all());
        $data= $request->validated();
        if(!$data)
            return back()->with('errors');
        
            $data=$request->except('image');
           
           
            
            if($request->file('image')){
                if($request->image != 'default.png'){
                Storage::disk('public_uploads')->delete('/users_images/'.$request->image);
                }
                Image::make($request->image)->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
    
            })->save(public_path('uploads/user_images/'. $request->image->hashName()));
    
            $data['image']=  $request->image->hashName();
        }
     
        $user->update($data);
        $user->syncPermissions($request->permissions);
        return redirect(route('users.index'));
    }

    public function destroy(User $user)
    {
        if($user->image != 'default.png')
            Storage::disk('public_uploads')->delete('/users_images/'.$user->image);
        
        $deleted_user=$user->id;
        User::destroy($deleted_user);
        notify()->preset('user-deleted');

        return back();
    }
}
