<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions = Permission::all();
        return view('admin.permissions.index', compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('admin.permissions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $permissions = $request->all();
        $permissions = $request->validate([
            'name' => 'required',
        ]);
        $permissions['name'] = $request->name;
        Permission::create($permissions);
        return to_route('admin.permissions.index')->with('success', 'Permission Created Successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Permission $permission)
    {
        $roles = Role::all();
        return view('admin.permissions.edit', compact('permission', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Permission $permission)
    {
        $permissions = $request->validate([
            'name' => 'required',
        ]);
        $permission->update($permissions);
        return to_route('admin.permissions.index')->with('success', 'Permission Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permission $permission)
    {
        $permission->delete();
        return to_route('admin.permissions.index')->with('danger', 'Permission Deleted Successfully');
    }

    public function assignRole(Request $request, Permission $permission)
    {
        if($permission->hasRole($request->role))
        {
            return back()->with('warning', 'Role Exists');
        }
        $permission->assignRole($request->role);
        return back()->with('success', 'Role assigned');
    }

    public function removeRole(Permission $permission, Role $role)
    {
        if($permission->hasRole($role))
        {
            $permission->removeRole($role);
            return back()->with('danger', 'Role Removed');
        }
        return back()->with('warning', 'Role Not Exists');
    }
}
