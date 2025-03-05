<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SchoolAdminController extends Controller
{
    public function school_admin_list(){
        $data['getRecord'] = User::getSchoolAdmin(Auth::user()->id, Auth::user()->is_admin);
        $data['meta_title'] = "school_admin List";
        return view('backend.school_admin.list', $data);
    }
    
    public function school_admin_create(){
        $data['getSchool'] = User::getSchoolAll();//pour avoir les infos sur le chef de departement
        $data['meta_title'] = "school_admin Create";
        return view('backend.school_admin.create', $data);
    }

    public function school_admin_insert(Request $request){
        request()->validate([
           'email' => 'required|email|unique:users',
        ]);

        $user = new User;
        $user->name = trim($request->name);
        $user->email = trim($request->email);
        $user->password = Hash::make($request->password);
        $user->address = trim($request->address);
        $user->status = trim($request->status);
        $user->is_admin = 4;
         if (Auth::user()->is_admin == 1 || Auth::user()->is_admin == 2) {
           $user->created_by_id = $request->school_id;
        } else {
            $user->created_by_id = Auth::user()->id;
        }
        $user->save();

        if(!empty($request->file('profile_pic'))){
            $ext = $request->file('profile_pic')->getClientOriginalExtension();
            $file = $request->file('profile_pic');
            $randomStr = date('Ymdhis').Str::random(20);
            $filename = strtolower($randomStr).'.'.$ext;
            $file->move('upload/profile/', $filename);

            $user->profile_pic = $filename;
            $user->save();
        }

        return redirect('panel/school_admin')->with('success','school Admin successifuly created');
    }

    public function school_admin_edit($id){
        $data['getRecord'] = User::getSingle($id);
        $data['meta_title'] = "school_admin Edit";
        return view('backend.school_admin.edit', $data);
    }

    public function school_admin_update($id,Request $request){
        request()->validate([
           'email' => 'required|email|unique:users,email,' .$id,
        ]);
       
        $user = User::getSingle($id);
        $user->name = trim($request->name);
        $user->email = trim($request->email);
        if (!empty($request->password)) {
            $user->password = Hash::make($request->password);
        }
        $user->address = trim($request->address);
        $user->status = trim($request->status);
       
        $user->save();

        if(!empty($request->file('profile_pic'))){
            $ext = $request->file('profile_pic')->getClientOriginalExtension();
            $file = $request->file('profile_pic');
            $randomStr = date('Ymdhis').Str::random(20);
            $filename = strtolower($randomStr).'.'.$ext;
            $file->move('upload/profile/', $filename);

            $user->profile_pic = $filename;
            $user->save();
        }

        return redirect('panel/school_admin')->with('success','school Admin successifuly updated');
    }

    public function school_admin_delete($id){
        $user = User::getSingle($id);
        $user->is_delete = 1;
        $user->save();

        return redirect('panel/school_admin')->with('error','school Admin successifuly deleted');
    }
}
