<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function Index()
    {
        $users = User::with('roles')->get();
        $roles = Role::pluck('name', 'name')->all();
        return view('admin.UserManage.user', compact('users', 'roles'));
    }

    public function storeUser(Request $request)
    {
        $validateData = $request->validate([
            'user_name' => 'required|string|max:255',
            'user_email' => 'required|email|unique:users,email',
            'user_password' => 'required|string|min:6',
        ]);

        $user = User::create([
            'name' => $validateData['user_name'],
            'email' => $validateData['user_email'],
            'password' => Hash::make($validateData['user_password']),
        ]);

        $user->syncRoles($request->roles);

        return redirect()->back()->with('success', 'User added successfully! ');
    }

    public function updateUser(Request $request)
    {
        // $validateData = $request->validate([
        //     'user_name' => 'required|string|max:255',
        //     'user_email' => 'required|email|unique:users,email',
        //     'user_password' => 'required|string|min:6',
        // ]);

        // $update = User::find($request->user_id);

        // $update->name = $validateData['user_name'];
        // $update->email = $validateData['user_email'];
        // $update->password = $validateData['user_password'];

        // $update->save();

        $user = User::findOrFail($request->user_id);

        
    // Validate that at least one role is selected
    $request->validate([
        'roles' => 'required|array|min:1',
        'roles.*' => 'exists:roles,name',
    ]);

        // Only validate and update fields if they are present
        if ($request->filled('user_name')) {
            $request->validate(['user_name' => 'string|max:255']);
            $user->name = $request->user_name;
        }

        if ($request->filled('user_email')) {
            $request->validate(['user_email' => 'email|unique:users,email,' . $user->id]);
            $user->email = $request->user_email;
        }

        if ($request->filled('user_password')) {
            $request->validate(['user_password' => 'string|min:6']);
            $user->password = Hash::make($request->user_password);
        }

           // Sync roles (already validated)
    $user->syncRoles($request->roles);

        $user->save();

        return redirect()->back()->with('Success', 'User Updated Successfully !');
    }

    public function deleteUser($id)
    {
        $delete = User::find($id);
        $delete->delete();

        return redirect()->back()->with('Success', 'User deleted Successfully !');
    }
}
