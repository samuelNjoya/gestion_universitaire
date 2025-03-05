<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class TeacherController extends Controller
{
    public function teacher_list(){
        $data['getRecord'] = User::getTeacher(Auth::user()->id, Auth::user()->is_admin);
        $data['meta_title'] = "Teacher List";
        return view('backend.teacher.list', $data);
    }
    
    public function teacher_create(){
        $data['getSchool'] = User::getSchoolAll();//pour avoir les infos sur le chef de departement
        $data['meta_title'] = "Teacher Create";
        return view('backend.teacher.create', $data);
    }

    public function teacher_insert(Request $request){

        request()->validate([
            'email' => 'required|email|unique:users',
        ]);

        $user            = new User;
        $user->name      = trim($request->name);
        $user->last_name = trim($request->last_name);
        $user->gender    = trim($request->gender);
        $user->date_of_birth   = trim($request->date_of_birth);
        $user->date_of_joining = trim($request->date_of_joining);
        $user->mobile_number   = trim($request->mobile_number);
        $user->marital_status         = trim($request->marital_status);
        $user->address         = trim($request->address);
        $user->permanent_address = trim($request->permanent_address);
        $user->qualification    = trim($request->qualification);
        $user->work_experience   = trim($request->work_experience);
        $user->note  = trim($request->note);
        $user->email = trim($request->email);
        $user->password = Hash::make($request->password);
        $user->status   = trim($request->status);
        $user->is_admin = 5;
        if (Auth::user()->is_admin == 1 || Auth::user()->is_admin == 2) {
           $user->created_by_id = $request->school_id;
        } else {
            $user->created_by_id = Auth::user()->id;
        }
        
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

        return redirect('panel/teacher')->with('success','Teacher successifuly created');
        }

        public function teacher_edit($id){
            $data['getRecord'] = User::getSingle($id);
            $data['meta_title'] = "Teacher Edit";
            return view('backend.teacher.edit', $data);
        }

        public function teacher_update($id, Request $request){
            request()->validate([
                'email' => 'required|email|unique:users,email,' .$id,
            ]);
    
            $user            = User::getSingle($id);
            $user->name      = trim($request->name);
            $user->last_name = trim($request->last_name);
            $user->gender    = trim($request->gender);
            $user->date_of_birth   = trim($request->date_of_birth);
            $user->date_of_joining = trim($request->date_of_joining);
            $user->mobile_number   = trim($request->mobile_number);
            $user->marital_status         = trim($request->marital_status);
            $user->address         = trim($request->address);
            $user->permanent_address = trim($request->permanent_address);
            $user->qualification    = trim($request->qualification);
            $user->work_experience   = trim($request->work_experience);
            $user->note  = trim($request->note);
            $user->email = trim($request->email);
           if (!empty($request->password)) {
               $user->password = Hash::make($request->password);
           }
            $user->status   = trim($request->status);
    
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
    
            return redirect('panel/teacher')->with('success','Teacher successifuly updated');
        }

        public function teacher_delete($id){
            $user = User::getSingle($id);
            $user->is_delete = 1;
            $user->save();
    
            return redirect('panel/teacher')->with('error','teacher successifuly deleted');
        }
    
    
}
