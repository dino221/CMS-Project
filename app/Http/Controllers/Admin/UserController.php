<?php

namespace App\Http\Controllers\Admin;
use App\User;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Image;

use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users =User::all();
        return view('admin-panel.users.index')->with('users', User::paginate(10));
    }

    
     /**
     * Show the form for creating a new resource.
     *
     * @param \Fer\Admin\Form\Builder $builder
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::user()->hasAnyRole('admin'))

        {
            $roles =  Role::all();
            return view('admin-panel.users.create', compact('roles'));

        }
        else {
            return redirect()->route('admin.users.index')->with('warning', 'You are not allowed to create users');
        }
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\userRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        if(Auth::user()->hasAnyRole('admin'))

        {
            
            $this->validate(request(), [
                'name' => 'required',
                'email' => 'required|email',
                'password' => 'required|confirmed'
            ]);

          
            
            $user = User::create(request(['name', 'email', 'password','phone', 'avatar']));

               // Handle the user upload of avatar
               if($request->hasFile('avatar')){
                $avatar = $request->file('avatar');
                $filename = time() . '.' . $avatar->getClientOriginalExtension();
                Image::make($avatar)->resize(300, 300)->save( public_path('/uploads/avatars/' . $filename ) );
                $user->avatar = $filename;
                $user->save();
            }
            
            return redirect()->route('admin.users.index')->with('success', 'User has been created');

        }
        else {
            return redirect()->route('admin.users.index')->with('warning', 'You are not allowed to create users');
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        if(Auth::user()->hasAnyRole('admin') || Auth::user()->hasAnyRole('editor')  || Auth::user()->id == $id)

        {
            return view ('admin-panel.users.edit')->with(['user' => User::find($id), 'roles' => Role::all()]); 
        }

        else {
            return redirect()->route('admin.users.index')->with('warning', 'You are not allowed to edit users');
        }
       
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $user = User::find($id);

        if(Auth::user()->id == $id || Auth::user()->hasAnyRole('admin') || Auth::user()->hasAnyRole('editor')) {


            // Handle the user upload of avatar
            if($request->hasFile('avatar')){
                $avatar = $request->file('avatar');
                $filename = time() . '.' . $avatar->getClientOriginalExtension();
                Image::make($avatar)->resize(300, 300)->save( public_path('/uploads/avatars/' . $filename ) );
                $user->avatar = $filename;
                $user->save();
            }

            $user->name = $request->input('name');
            $user->phone = $request->input('phone');
            $user->email = $request->input('email');
            $user->update();

            if(Auth::user()->hasAnyRole('admin') || Auth::user()->hasAnyRole('editor'))

            {
            
                $user->roles()->sync($request->roles);
                $roles =  Role::all();
                    return redirect()->route('admin.users.index', compact('user', 'roles'))->with('success', 'User has been edited');
            }
            else {
                return redirect()->route('admin.users.edit', $id)->with('success', 'Profile has been edited');
            }

         }

        else {
            return redirect()->route('admin.users.index')->with('warning', 'You are not allowed to edit users');
        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Auth::user()->id == $id)

        {
            return redirect()->route('admin.users.index')->with('warning', 'You are not allowed to delete yourself');
        }

        if(Auth::user()->hasAnyRole('admin'))

        { 
            $user = User::find($id);

            if($user) {
                $user->roles()->detach(); //REMOVE USER AND ITS ROLES ON USER DELETE
                $user->delete();
                return redirect()->route('admin.users.index')->with('success', 'User has been deleted');
            }

         }
         
        return redirect()->route('admin.users.index')->with('warning', 'This user cannot be deleted');

    }
}