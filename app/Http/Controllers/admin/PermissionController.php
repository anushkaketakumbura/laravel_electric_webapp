<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function Index(){
        $permissions = Permission::all();
        return view('admin.UserManage.permissions',compact('permissions'));
    }

    public function storePermission(Request $request){
        $validateData = $request->validate([
            'permission_name' => 'required'
        ]);

        Permission::create([
            'name' => $validateData['permission_name'],
        ]);

        return redirect()->back()->with('Success', 'Permission added successfully!'); 
    }

    public function updatePermission(Request $request){
        $validateData = $request->validate([
            'permission_name' => 'required'
        ]);

        $update = Permission::find($request->permission_id);
        $update->name = $validateData['permission_name'];
        $update->save();

        return redirect()->back()->with('Success', 'Permission updated successfully!'); 
    }

    public function deletePermission($id){
        $permission = Permission::find($id);
        $permission->delete();
        return redirect()->back()->with('Success', 'Permission deleted successfully!');
    }
}
