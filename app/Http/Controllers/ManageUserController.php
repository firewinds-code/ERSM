<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;

class ManageUserController extends Controller
{
    public function list(Request $request)
    {
        try {
            if ($request->ajax()) {
                $data = User::select('*');
                return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function ($user) {
                        if ($user->id == Auth::user()->id) {
                            $btn = '<a onclick="editUser(' . $user->id . ')" href="#"  class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-default-lg-edit"><i class="nav-icon fa fa-edit" style="padding:2px"></i></a>';
                        } else {
                            $btn = '<a onclick="editUser(' . $user->id . ')" href="#"  class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-default-lg-edit"><i class="fa fa-edit" style="padding: 2px"></i></a>
                            <a href="#"  onclick="deleteUser(' . $user->id . ')" class="btn btn-danger btn-sm">  <i class="fa fa-trash" style="padding:2px"></i></a>';
                        }
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            }
            return view('manageuser.list');
        } catch (Exception $e) {
            return back()->with("error","Something Went Wrong");
        }
    }
    
    public function add()
    {
        try {
            $html = view('manageuser.add')->render();
            return response()->json(['html' => $html, 'success' => true]);
        } catch (Exception $e) {
            return back()->with("error","Something Went Wrong");
        }
    }
    
    public function postadd(Request $request)
    {
        try {
            $user = new User;
            $user->name = $request->name;
            $user->empID = $request->empID;
            $user->pri_no = $request->pri_no;
            $user->password = Hash::make($request->password);
            $user->usertype = $request->usertype;
            // Check if the email already exists in the database
            $existingUser = User::where('email', $request->email)->first();
            if ($existingUser) {
                return back()->with('error', 'Email already exists');
            }
            $user->email = $request->email;
            $user->save();
            return back()->with('success', 'User Created Successfully');
        } catch (Exception $e) {
            return back()->with("error","Something Went Wrong");
        }
    }
    
    public function editUser(Request $request)
    {
        try {
            $id = $request->id;
            $data = User::find($id);
            $html = view('manageuser.edit', compact('data'))->render();
            return response()->json(['html' => $html, 'success' => true]);
        } catch (Exception $e) {
            return back()->with("error","Something Went Wrong");
        }
    }
    
    public function update(Request $request)
    {
        try {
            $user = User::find($request->id_edit);
            $user->email = $request->email;
            $user->name = $request->name;
            $user->empID = $request->empID;
            $user->pri_no = $request->pri_no;
            if ($request->password != NULL) {
                $user->password = Hash::make($request->password);
            }
            $user->usertype = $request->usertype;
            $user->update();
            return back()->with('success', 'User Updated Successfully');
        } catch (Exception $e) {
            return back()->with("error","Something Went Wrong");
        } 
    }

    public function delete(Request $request)
    {
        try {
            $delete =  User::where('id', $request->id)->delete();
            if ($delete) {
                return response()->json(['message' => 'User Deleted Succesfully', 'status' => 'success']);
            }
            return response()->json(['message' => 'User Deleted Failed', 'status' => 'error']);
        } catch (Exception $e) {
            return back()->with("error","Something Went Wrong");
        } 
    }

    
    public function changepassword(Request $request)
    {
        try {
            $id = Auth::user()->id;
            $data = user::find($id);
            $html = view('manageuser.changepassword', compact('data'))->render();
            return response()->json(['html' => $html, 'success' => true]);
        } catch (Exception $e) {
            return back()->with('error', 'Something Went Wrong');
        }
    }

    public function updatepassword(Request $request)
    {
        try {
            $id = Auth::user()->id;
            $data = user::find($id);
            if (Hash::check($request->oldpassword, $data->password)) {
                $data->password = Hash::make($request->newpassword);
                $data->save();
                return back()->with('success', 'Password Updated Successfully');
            } else {
                return back()->with('error', 'Your old password does not match');
            }
        } catch (Exception $e) {
            return back()->with('error', 'Something Went Wrong');
        }
    }

}