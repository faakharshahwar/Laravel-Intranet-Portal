<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\AssignRoleToUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserAccessRoleController extends Controller
{
    public function index()
    {
        $users = User::with('roles')->get();
        $userEmailToRemove = "faakharshahwar@gmail.com";

        // Use the reject method to remove the user with the specified Email
        $users = $users->reject(function ($user) use ($userEmailToRemove) {
            return $user->email === $userEmailToRemove;
        });

        return view('users.user_access_role.user_access_role')->with('users', $users);
    }

    public function create()
    {
        $users = User::all();
        $role = Role::all();
        $RoleToRemove = "Super Admin";
        $rolesPermissions = $role->reject(function ($role) use ($RoleToRemove) {
            return $role->name === $RoleToRemove;
        });
        $userEmailToRemove = "faakharshahwar@gmail.com";
        $users = $users->reject(function ($user) use ($userEmailToRemove) {
            return $user->email === $userEmailToRemove;
        });
        return view('users.user_access_role.assign_role_to_user')->with('users', $users)->with('roles', $rolesPermissions);
    }

    public function store(AssignRoleToUserRequest $request)
    {
        $user_id = $request->user_id;
        $role_id = $request->role_id;
        $user_status = $request->status;

        $user = User::findOrFail($user_id);

        if ($user && $user->status == "0") {
            $userStatus = DB::table('users')
                ->where('id', $user_id)
                ->update(['status' => $user_status]);
        } else {
            $userStatus = true;
        }

        if ($userStatus) {
            if ($user->roles()->exists()) {
                session()->flash('error', 'User already has a role assigned.');
                return redirect(route('user_access_role'));
            }

            $role = Role::findOrFail($role_id);

            $assignRole = $user->assignRole($role);

            if ($assignRole) {
                session()->flash('success', 'Role has been assigned successfully.');
            } else {
                session()->flash('error', 'Sorry! Something went wrong!');
            }
        } else {
            session()->flash('error', 'User status could not be updated.');
        }

        return redirect(route('user_access_role'));
    }


    //Todo: There is bug in edit to fix.
    public function edit($id)
    {
        $user_id = $id;
        $user = User::findorFail($user_id);
        $user_role_id = $user->roles()->pluck('id');
        foreach ($user_role_id as $u_role_id) {
            $role_id = $u_role_id;
        }

        $role = Role::all();

        $RoleToRemove = "Super Admin";
        $rolesPermissions = $role->reject(function ($role) use ($RoleToRemove) {
            return $role->name === $RoleToRemove;
        });

        return view('users.user_access_role.edit_user_access_role')->with('user', $user)->with('roles', $rolesPermissions)->with('role_id', $role_id);
    }

    public function update(AssignRoleToUserRequest $request)
    {
        $user_id = $request->user_id;
        $role_id = $request->role_id;

        $user = User::findorFail($user_id);

        //Get Role Attributes
        $roleElq = Role::where('id', $role_id)->get();
        foreach ($roleElq as $r) {
            $role = $r;
        }
        $detach = $user->roles()->detach();
        if ($detach) {
            $assignRole = $user->assignRole($role);
        }

        if ($assignRole) {
            session()->flash('success', 'Role has been assigned successfully');
        } else {
            session()->flash('error', 'Sorry! Something went wrong!');
        }
        return redirect(route('user_access_role'));
    }

    public function delete($id)
    {
        $user_id = $id;
        $user = User::findorFail($user_id);

        if ($user->status == "1") {
            $userStatus = DB::table('users')
                ->where('id', $id)
                ->update([
                    'status' => 0,
                ]);
        } else {
            $userStatus = true;
        }

        if ($userStatus) {
            $detach = $user->roles()->detach();
        }
        if ($detach) {
            session()->flash('success', 'Role has been deleted successfully');
        } else {
            session()->flash('error', 'Sorry! Something went wrong!');
        }
        return redirect(route('user_access_role'));
    }
}
