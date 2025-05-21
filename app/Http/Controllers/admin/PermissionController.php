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
}
