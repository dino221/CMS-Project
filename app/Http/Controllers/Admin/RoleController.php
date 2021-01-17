<?php

namespace App\Http\Controllers\Admin;
use App\User;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Image;

use App\Http\Controllers\Controller;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles =Role::all();
        return view('admin-panel.roles.index')->with('roles', Role::paginate(10));
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
        return view('admin-panel.roles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\RoleRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [

            'name' => 'required|max:50'
        ]);

        $role = new Role;
        $role->name = $request->name;
        $role->save();

        return redirect()->to(route('admin.roles.index'))->with('success', 'Role created');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(Auth::user()->hasAnyRole('admin') || Auth::user()->hasAnyRole('editor'))

        {
            $role = role::find($id);
            if($role->name == "admin") {
                return redirect()->route('admin.roles.index')->with('warning', 'You are not allowed to edit admin named role');
            }
            else {
                return view ('admin-panel.roles.edit',compact('role'));
            }
        }
        else {
            return redirect()->route('admin.roles.index')->with('warning', 'You are not allowed to edit roles');
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

        $role = Role::find($id);

        if(Auth::user()->hasAnyRole('admin') || Auth::user()->hasAnyRole('editor'))

        {

            if($role->name == "admin") {
                return redirect()->route('admin.roles.index')->with('warning', 'You are not allowed to edit admin named role');
            }
            
            else {

                $role = Role::find($id);
                $role->name = $request->input('name');
                $role->update();

            return redirect()->route('admin.roles.index')->with('success', 'Role has been edited');
            }
            
        }

        else {
            return redirect()->route('admin.roles.index', compact('role'))->with('warning', 'You are not allowed to edit roles');
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

        if(Auth::user()->hasAnyRole('admin'))

        {
            $role = Role::find($id);
            if($role->name == "admin") {
                return redirect()->route('admin.roles.index')->with('warning', 'You are not allowed to delete admin role');
            }

            else {

                $role = Role::find($id);

                if($role) {
                    $role->delete();
                    return redirect()->route('admin.roles.index')->with('success', 'Role has been deleted');
                }

            }
            
        }

        else {
            return redirect()->route('admin.roles.index')->with('warning', 'You are not allowed to delete roles');
        }

    }
}
