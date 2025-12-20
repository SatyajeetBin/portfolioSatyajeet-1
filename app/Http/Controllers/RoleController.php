<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use App\Models\UserNotification;
use App\Notifications\RoleUpdatedNotification;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware(middleware: 'role:Role'),
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // dd();
        if (request()->ajax()) {
            $data = Role::where('id', '!=', 1)->orderBy('id', 'desc');
            $allData = $data->get();

            return datatables()->of($allData)
                ->editColumn('created_at', function ($request) {
                    return $request->created_at->format('d/m/Y');
                })
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $html = "";
                    $readCheck = Permission::checkCRUDPermissionToUser("Role", "read");
                    $updateCheck = Permission::checkCRUDPermissionToUser("Role", "update");
                    $deleteCheck = Permission::checkCRUDPermissionToUser("Role", "delete");
                    $isSuperAdmin = Permission::isSuperAdmin();
                    if ($updateCheck) {
                        $html .= '<li><a class="dropdown-item dropdown-trigger-17500btn waves-effect" href="role/' . $row->id . '/edit">Edit</a></li>';
                    }
                    if ($readCheck) {
                        $html .= '<li><a class="dropdown-item dropdown-trigger-17500btn waves-effect" href="role/' . $row->id . '">View</a></li>';
                    }
                    if ($isSuperAdmin || $deleteCheck) {
                        $html .= '<li><a class="dropdown-item dropdown-trigger-17500btn waves-effect" href="javascript:void(0)" onclick="deleteRole(' . $row->id . ', \'' . $row->name . '\')">Delete</a></li>';
                    }
                    if (!$isSuperAdmin && !$updateCheck && !$readCheck && !$deleteCheck) {
                        return '';
                    }
                    return
                        '<div class="dropdown">
                            <button type="button" class="btn btn-primary px-1 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                Action
                            </button>
                            <div class="dropdown-menu">
                                ' . $html . '
                            </div>
                        </div>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('role.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('role.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $params = $request->all();

        $validator = Validator::make($params, [
            'name' => ['required', 'string', 'max:20', 'unique:roles,name'],
        ], [
            'name' => 'The role field is required.',
            'name.unique' => 'The role name has already been taken.',
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput($params);
        }

        $role = Role::create([
            'name' => $request->input('name'),
            'guard_name' => 'admin',
        ]);

        return redirect('role/' . $role->id . '/edit')->with('success', 'Created Successfully.!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, $id)
    {
        $tablesArr = [];
        $breadcrumbs = [];
        $pageConfigs = ['pageHeader' => true];
        if ($id) {
            $role = Role::find($id);

            $tables = DB::select('SHOW TABLES');
            foreach ($tables as $table) {
                $host = $request->getHttpHost();
                if ($host == 'localhost') {
                    $tablesArr[$table->Tables_in_mineology_server] = $table->Tables_in_mineology_server;
                } else {
                    $tablesArr[$table->{'Tables_in_' . env('DB_DATABASE')}] = $table->{'Tables_in_' . env('DB_DATABASE')};
                }
            }

            $filterArr = [];

            if ($tablesArr['activity_log']) {
                $filterArr['Activity Log'] = 'Activity Log';
            }

            if ($tablesArr['roles']) {
                $filterArr['Role'] = 'Role';
            }

            if ($tablesArr['users']) {
                $filterArr['User'] = 'User';
            }

           

            $permissionData = new Permission();
            return view('role.show', ['pageConfigs' => $pageConfigs, 'role' => $role, 'accessData' => $filterArr, 'permissionData' => $permissionData]);
        } else {
            return Redirect::back()->with('error', 'ID not selected or not found.!');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, $id)
    {
        $tablesArr = [];
        $breadcrumbs = [];
        $pageConfigs = ['pageHeader' => true];
        if ($id) {
            $role = Role::find($id);

            $tables = DB::select('SHOW TABLES');
            foreach ($tables as $table) {
                $host = $request->getHttpHost();
                if ($host == 'localhost') {
                    $tablesArr[$table->Tables_in_mineology_server] = $table->Tables_in_mineology_server;
                } else {
                    $tablesArr[$table->{'Tables_in_' . env('DB_DATABASE')}] = $table->{'Tables_in_' . env('DB_DATABASE')};
                }
            }

            $filterArr = [];

            if ($tablesArr['activity_log']) {
                $filterArr['Activity Log'] = 'Activity Log';
            }

            if ($tablesArr['roles']) {
                $filterArr['Role'] = 'Role';
            }

            if ($tablesArr['users']) {
                $filterArr['User'] = 'User';
            }

            $permissionData = new Permission();
            return view('role.update', ['pageConfigs' => $pageConfigs, 'role' => $role, 'accessData' => $filterArr, 'permissionData' => $permissionData]);
        } else {
            return Redirect::back()->with('error', 'ID not selected or not found.!');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $param = $request->all();
        $role = Role::find($param['id']);
        $validator = Validator::make($param, [
            'name' => ['required', 'string', 'max:20', 'unique:roles,name,' . $role->id],
        ], [
            'name' => 'The role field is required.',
            'name.unique' => 'The role name has already been taken.',
        ]);
        if ($validator->fails()) {
            return Redirect::back()
                ->withErrors($validator)
                ->withInput();
        }
        $role_id = $param['id'];

        if (!empty($param['permission'])) {
            Permission::where('role_id', $role_id)->delete();
            foreach ($param['permission'] as $key => $value) {
                $value['module'] = $key;
                $value['role_id'] = $role_id;
                Permission::create($value);
            }
        } else {
            Permission::where('role_id', $role_id)->delete();
        }
        if (!empty($param)) {
            $role = Role::find($param['id']);
            unset($param['id']);
            $isUpdated = $role->update($param);
            $updatedBy = Auth::user()->name;

            // $userNotificationId = UserNotification::where('role_update', true)->get()->pluck('user_id');
            // $users = User::where('role_id', $role->id)->whereIn('id', $userNotificationId)->get();

            // if (isset($param['permission'])) {
            //     $permission = $param['permission'];
            //     Notification::send($users, new RoleUpdatedNotification($role->name, 'updated', $updatedBy, $permission));
            // }

            if ($isUpdated) {
                return redirect('role')->with('success', 'Updated Successfully.!');
            } else {
                return Redirect::back()->with('error', 'Something Wrong happend.!');
            }
        } else {
            return Redirect::back()->with('error', 'ID not selected or not found.!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role, $id)
    {
        $user = User::where('role_id', $id)->exists();
        $permission = Permission::where('role_id', $id)->exists();

        if ($user || $permission) {
            return response()->json([
                'status' => false,
                'message' => 'This is already in Use'
            ]);
        }

        if (!empty($id)) {
            $data = Role::find($id);
            $isDeleted = $data->delete();

            if ($isDeleted) {
                return response()->json([
                    'status' => true,
                    'message' => 'Role  Deleted Successfully!'
                ]);
            } else {
                return Redirect::back()->with('error', 'Something went wrong.');
            }
        } else {
            return Redirect::back()->with('error', 'Id not selected or found.');
        }
    }
}
