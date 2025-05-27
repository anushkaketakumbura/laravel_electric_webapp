<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
     public function Index(){
        $roles = Role::all();
        return view('admin.UserManage.role',compact('roles'));
    }

    public function storeRole(Request $request){
        $validateData = $request->validate([
            'role_name' => 'required'
        ]);

        Role::create([
            'name' => $validateData['role_name'],
        ]);

        return redirect()->back()->with('Success', 'Role added successfully!'); 
    }

    public function updateRole(Request $request){
        $validateData = $request->validate([
            'role_name' => 'required'

        ]);

        $update = Role::find($request->role_id);
        $update->name = $validateData['role_name'];
        $update->save();

        return redirect()->back()->with('Success', 'Role updated successfully!'); 
    }

    public function deleteRole($id){
        $Role = Role::find($id);
        $Role->delete();
        return redirect()->back()->with('Success', 'Role deleted successfully!');
    }

    public function permissionToRole($id){
        $permissions = Permission::all();
        $role = Role::findOrfail($id);

        $rolePermissions = DB::table('role_has_permissions')
            ->where('role_id', $id)
            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')->all();

        return view('admin.UserManage.givePermissionToRole', compact('permissions', 'role', 'rolePermissions'));
    }

    public function givePermissionToRole(Request $request,$role_id){
        $request->validate([
            'permissions' => 'required',
        ]);
        $role = Role::findOrfail($role_id);
        $role->syncPermissions($request->permissions);

        return redirect()->back()->with('Success', 'Permissions assigned to role successfully!');
    }
    // public function removePermissionToRole(Request $request){
    //     $role = Role::findOrfail($request->role_id);
    //     $permissions = $request->permissions;

    //     if($permissions){
    //         $role->revokePermissionTo($permissions);
    //     } else {
    //         $role->revokePermissionTo([]);
    //     }

    //     return redirect()->back()->with('Success', 'Permissions removed from role successfully!');
    // }
}
