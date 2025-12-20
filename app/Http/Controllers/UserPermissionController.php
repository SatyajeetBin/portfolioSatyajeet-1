<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use App\Models\UserPermission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class UserPermissionController extends Controller
{
    public function edit(Request $request, $id)
    {

        $pageConfigs = ['pageHeader' => true];

        $user = User::find($id);
        if (!$user) {
            return Redirect::back()->with('error', 'User not found!');
        }

        $role = Role::where('id', $user->role_id)->first();

        // Get table names
        $tables = DB::select('SHOW TABLES');
        $tableKey = 'Tables_in_' . env('DB_DATABASE');
        $tablesArr = array_map(fn($t) => $t->$tableKey, $tables);

        $filterArr = [];
        if (in_array('activity_log', $tablesArr))
            $filterArr['Activity Log'] = 'Activity Log';
        if (in_array('roles', $tablesArr))
            $filterArr['Role'] = 'Role';
        if (in_array('users', $tablesArr))
            $filterArr['User'] = 'User';

        // Preload permissions
        $rolePermissionData = Permission::where('role_id', $user->role_id)->get()->keyBy('module');
        $userPermissionData = UserPermission::where('user_id', $user->id)->get()->keyBy('module');

        return view('user.permissions', [
            'pageConfigs' => $pageConfigs,
            'user' => $user,
            'role' => $role,
            'accessData' => $filterArr,
            'rolePermissionData' => $rolePermissionData,
            'userPermissionData' => $userPermissionData,
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'permission' => 'nullable|array',
        ]);

        $user_id = $request->input('user_id');

        if ($request->has('permission')) {
            foreach ($request->input('permission') as $module => $value) {
                $userPermission = UserPermission::where('user_id', $user_id)
                    ->where('module', $module)
                    ->first();

                $data = [
                    'create' => !empty($value['create']) ? '1' : '0',
                    'read' => !empty($value['read']) ? '1' : '0',
                    'update' => !empty($value['update']) ? '1' : '0',
                    'delete' => !empty($value['delete']) ? '1' : '0',
                ];

                if ($userPermission) {
                    $userPermission->update($data);
                } else {
                    // dd($data);
                    UserPermission::create(array_merge([
                        'user_id' => $user_id,
                        'module' => $module
                    ], $data));
                }
            }

            return redirect()->route('user.index')->with('success', 'User permissions updated successfully!');
        }

        return redirect()->route('user.index')->with('success', 'No permissions submitted!');
    }


}
