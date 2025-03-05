<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function admin_list(){
        $data['getRecord'] = User::getAdmin();
        $data['meta_title'] = "admin List";
        return view('backend.admin.list', $data);
    }
    
    public function admin_create(){
        $data['meta_title'] = "admin Create";
        return view('backend.admin.create', $data);
    }

    public function admin_insert(Request $request){
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
        $user->is_admin = trim($request->is_admin);
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

        return redirect('panel/admin')->with('success','admin successifuly created');
    }

    public function admin_edit($id){
        $data['getRecord'] = User::getSingle($id);
        $data['meta_title'] = "admin Edit";
        return view('backend.admin.edit', $data);
    }

    public function admin_update($id,Request $request){
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
        $user->is_admin = trim($request->is_admin);
       
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

        return redirect('panel/admin')->with('success','admin successifuly updated');
    }

    public function admin_delete($id){
        $user = User::getSingle($id);
        $user->is_delete = 1;
        $user->save();

        return redirect('panel/admin')->with('error','admin successifuly deleted');
    }
}
