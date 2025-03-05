<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SchoolController extends Controller
{
    public function school_list(){
        $data['getSchool'] = User::getSchool();
        $data['meta_title'] = "School List";
        return view('backend.school.list', $data);
    }
    
    public function school_create(){
        $data['meta_title'] = "School Create";
        return view('backend.school.create', $data);
    }

    public function school_insert(Request $request){
        request()->validate([
           'email' => 'required|email|unique:users',
        ]);
        // dd($request->all());
        $user = new User;
        $user->name = trim($request->name);
        $user->email = trim($request->email);
        $user->password = Hash::make($request->password);
        $user->address = trim($request->address);
        $user->status = trim($request->status);
        $user->is_admin = 3;
        $user->created_by_id = Auth::user()->id;
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

        return redirect('panel/school')->with('success','school successifuly created');
    }

    public function school_edit($id){
        $data['getSchool'] = User::getSingle($id);
        $data['meta_title'] = "School Edit";
        return view('backend.school.edit', $data);
    }

    public function school_update($id,Request $request){
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

        return redirect('panel/school')->with('success','school successifuly updated');
    }

    public function school_delete($id){
        $user = User::getSingle($id);
        $user->is_delete = 1;
        $user->save();

        return redirect('panel/school')->with('error','school successifuly deleted');
    }
}
