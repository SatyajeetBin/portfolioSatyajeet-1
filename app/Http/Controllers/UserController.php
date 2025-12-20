<?php

namespace App\Http\Controllers;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class UserController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware(middleware: 'role:User'),
        ];
    }


    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
            if (request()->ajax()) {

                $data = User::where([['id', '<>', Auth::user()->id], ['role_id', '!=', 1]])->orderBy('id', 'DESC');

                if ($request->role_id_filter) {
                    $data->where('role_id', $request->role_id_filter);
                }

                $allData = $data->orderBy('id', 'DESC')->get();
                // dd($allData);
                return datatables()->of($allData)
                    ->editColumn('role_id', function ($request) {
                        return $request->role->name;
                    })
                    ->addIndexColumn()
                    ->addColumn('action', function ($row) {
                        $html = "";
                        $readCheck = Permission::checkCRUDPermissionToUser("User", "read");
                        $updateCheck = Permission::checkCRUDPermissionToUser("User", "update");
                        $deleteCheck = Permission::checkCRUDPermissionToUser("User", "delete");
                        $isSuperAdmin = Permission::isSuperAdmin();
                        if ($updateCheck) {
                            $html .= '<li><a class="dropdown-item dropdown-trigger-17500btn waves-effect" href="user/' . $row->id . '/edit">Edit</a></li>';
                            $html .= '<li><a class="dropdown-item dropdown-trigger-17500btn waves-effect" href="user/' . $row->id . '/permissions">Add Permissions</a></li>';
                        }
                        if ($readCheck) {
                            $html .= '<li><a class="dropdown-item dropdown-trigger-17500btn waves-effect" href="user/' . $row->id . '">View</a></li>';
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
            $roles = Role::where('id', '!=', 1)->get();
            return view('user.index', compact( 'request', 'roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::where('id', '!=', 1)->get();

        return view('user.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $params = $request->all();
        $validator = Validator::make($params, [
            'name' => ['required'],
            'email' => ['required', 'string', 'email', 'max:255', 'lowercase', 'regex:/^([a-zA-Z0-9._%-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,})$/', 'unique:users'],
            // 'password' => ['required', 'confirmed', 'min:8'],
            'contact' => ['required', 'min:7', 'max:12'],
            'role_id' => ['required'],
            /* 'department_id' => ['required'], */
        ], [
            'role_id' => 'The role field is required.',
            /* 'department_id' => 'The department field is required.' */
        ]);

        if ($request->page == 'modal') {
            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'errors' => $validator->errors()
                ]);
            }
        } else {
            if ($validator->fails()) {
                return Redirect::back()->withErrors($validator)->withInput($params);
            }
        }

        // $randomPassword = $params['password'];
        $randomPassword = Str::random(10);
        $params['role_id'] = $request->role_id ? $params['role_id'] : 3;
        $params['password'] = Hash::make($randomPassword);

        $user = User::create($params);

        // if ($user) {
        //     $mailArr = [
        //         "email" => $user->email,
        //         "user" => $user,
        //         "title" => "User credentials!",
        //         'randomPassword' => $randomPassword,
        //         "body" => "Thank you",
        //     ];

        //     Mail::send('mail/user-sent-mail', $mailArr, function ($message) use ($mailArr) {
        //         $message->to($mailArr["email"], $mailArr["email"])
        //             ->subject($mailArr["title"]);
        //     });

        //     activity('User')
        //         ->performedOn($user)
        //         ->causedBy(
        //             Auth::user()
        //         )
        //         ->event('Send User credentials')
        //         ->withProperties([
        //             'attributes' => [
        //                 'id' => $user->id,
        //                 'name' => $user->full_name,
        //                 'email' => $user->email,
        //             ],
        //         ])
        //         ->log(
        //             Auth::user()->full_name . ' has sent the email'
        //         );
        // }
        if ($request->page == 'modal') {
            return response()->json([
                'user' => $user,
                'message' => 'User Added Successfully!',
                'status' => 'success'
            ]);
        } else {
            return redirect('user')->with([
                'message' => 'User Added Successfully!',
                'status' => 'success'
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::whereId($id)->first();
        return view('user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::whereId($id)->first();
        $roles = Role::where('id', '!=', 1)->get();
        return view('user.update', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $payLoad = $request->all();

        unset($payLoad['_token']);
        unset($payLoad['_method']);

        $validator = Validator::make($payLoad, [
            'name' => ['required'],
            'email' => ['required', 'string', 'email', 'max:255', 'lowercase', 'regex:/^([a-zA-Z0-9._%-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,})$/', 'unique:users,email,' . $id],
            'contact' => ['required', 'min:7', 'max:12'],
            'role_id' => ['required'],
            /* 'department_id' => ['required'], */
        ], [
            'role_id' => 'The role field is required.',
            /* 'department_id' => 'The department field is required.' */
        ]);


        if ($request->page == 'modal') {
            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'errors' => $validator->errors()
                ]);
            }
        } else {
            if ($validator->fails()) {
                return Redirect::back()->withErrors($validator)->withInput($payLoad);
            }
        }
        $user = User::find($id);
        $user->update($payLoad);

        if ($request->page == 'modal') {
            return response()->json([
                'user' => $user,
                'message' => 'User Updated Successfully!',
                'status' => 'success'
            ]);
        } else {
            return redirect('user')->with([
                'message' => 'User Updated Successfully!',
                'status' => 'success'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (!empty($id)) {
            $user = User::find($id);
            $isDeleted = $user->delete();

            if ($isDeleted) {
                return response()->json([
                    'status' => true,
                    'message' => 'User Deleted Successfully!'
                ]);
            } else {
                return Redirect::back()->with('error', 'Something went wrong.');
            }
        } else {
            return Redirect::back()->with('error', 'Id not selected or found.');
        }
    }

    // public function resetPassword(Request $request)
    // {
    //     $param = $request->all();
    //     $user = User::find($param['id']);
    //     $user->update([
    //         'password' => bcrypt($param['password'])
    //     ]);
    //     return response()->json([
    //         "status" => true,
    //         "msg" => 'Password reset successfully'
    //     ]);
    // }
}
