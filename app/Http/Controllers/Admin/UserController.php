<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $roles = Role::all();
        $permissions = Permission::all();
         return view('admin.users.role', compact('user','roles', 'permissions'));
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if($user->hasRole('admin')){
            return back()->with('warning', 'You are Admin');
        }
        $user->delete();
        return to_route('admin.users.index')->with('danger', 'User Deleted Successfully');
    }

    public function assignRole(Request $request, User $user)
    {
        if($user->hasRole($request->role)){
            return back()->with('warning', 'Role Exists');
        }
        $user->assignRole($request->role);
        return back()->with('success', 'Role assigned');
    }

    public function removeRole(User $user, Role $role)
    {
        if($user->hasRole($role))
        {
            $user->removeRole($role);
            return back()->with('danger', 'Role Removed');
        }
        return back()->with('warning', 'Role Not Exists');
    }

    public function givePermission(Request $request, User $user){
        if($user->hasPermissionTo($request->permission)){
            return back()->with('warning', 'Permission exists');
        }
        $user->givePermissionTo($request->permission);
        return back()->with('success', 'Permission added');
    }
    public function revokePermission(User $user, Permission $permission)
    {
        if($user->hasPermissionTo($permission))
        {
            $user->revokePermissionTo($permission);
            return back()->with('destroy', 'Permission Deleted');
        }
        return back()->with('warning', 'Permission Not Exists');
    }

}
