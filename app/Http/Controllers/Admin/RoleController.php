<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::whereNotIn('name', ['admin'])->get();
        return view('admin.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.roles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $roles = $request->all();
        $roles = $request->validate([
            'name' => 'required',
        ]);
        $roles['name'] = $request->name;
        Role::create($roles);
        return to_route('admin.roles.index')->with('success', 'Role Created Successfully');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $permissions = Permission::all();
        return view('admin.roles.edit', compact('role', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $roles = $request->validate([
            'name' => 'required',
        ]);
        $role->update($roles);
        return to_route('admin.roles.index')->with('success', 'Role Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $role->delete();
        return to_route('admin.roles.index')->with('danger', 'Role Deleted Successfully');
    }

    public function givePermission(Request $request, Role $role){
        if($role->hasPermissionTo($request->permission)){
            return back()->with('warning', 'Permission exists');
        }
        $role->givePermissionTo($request->permission);
        return back()->with('success', 'Permission added');
    }
    public function revokePermission(Role $role, Permission $permission)
    {
        if($role->hasPermissionTo($permission))
        {
            $role->revokePermissionTo($permission);
            return back()->with('destroy', 'Permission Deleted');
        }
        return back()->with('warning', 'Permission Not Exists');
    }
}
