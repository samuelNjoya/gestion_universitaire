<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\ClassModel;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class StudentController extends Controller
{
    public function student_list(){
        $data['getRecord'] = User::getStudent(Auth::user()->id, Auth::user()->is_admin);
        $data['meta_title'] = "student List";
        return view('backend.student.list', $data);
    }


    // cette fonction c'est pour dynamiser l'etudiant en fonction de son departement
    public function getclass(Request $request){
        $getClass = ClassModel::getRecordActive($request->school_id);
        $html = '';
        $html .= '<option value="">Select</option>';
        foreach($getClass as $class){
            $html .= '<option value="'.$class->id.'">'.$class->name.'</option>';
        }
        $json['success'] = $html;
        echo json_encode($json);
       // dd($request->school_id);
    }
    
    public function student_create(){
        $data['getClass'] = ClassModel::getRecordActive(Auth::user()->id);
        $data['getSchool'] = User::getSchoolAll();//pour avoir les infos sur le chef de departement
        $data['meta_title'] = "student Create";
        return view('backend.student.create', $data);
    }

   

    public function student_insert(Request $request){
// dd($request->all());
        request()->validate([
            'email' => 'required|email|unique:users',
        ]);

      

       try {
        $user            = new User;
        $user->name      = trim($request->name);
        $user->last_name = trim($request->last_name);
        $user->admission_number         = trim($request->admission_number);
        $user->roll_number   = trim($request->roll_number);
        $user->class_id    = trim($request->class_id);
        $user->gender    = trim($request->gender);
        $user->date_of_birth   = trim($request->date_of_birth);
        $user->mobile_number   = trim($request->mobile_number);
        $user->caste = trim($request->caste);
        $user->admission_date  = trim($request->admission_date);
        $user->address         = trim($request->address);
        $user->permanent_address = trim($request->permanent_address);
        $user->email = trim($request->email);
        $user->password = Hash::make($request->password);
        $user->status   = trim($request->status);
        $user->is_admin = 6;
        if (Auth::user()->is_admin == 1 || Auth::user()->is_admin == 2) {
           $user->created_by_id = $request->school_id;//important lors de la mise a jour edit.blade school name
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

        return redirect('panel/student')->with('success','student successifuly created');
       } catch (QueryException $e) {
        return response()->json(['error' => 'Erreur lors de l\'insertion : ' . $e->getMessage()], 500);
       }
    }

    

    public function student_edit($id){

      //  $data['getSchool'] = User::getSchoolAll();//pour avoir les infos sur le chef de departement
        $getRecord = User::getSingle($id);// les trois premières lignes pour assurer le fais qu'un chef de departement puisse modifier  dynamiquement la class
        $data['getRecord'] = $getRecord;
        $data['getClass'] = ClassModel::getRecordActive($getRecord->created_by_id);
        $data['meta_title'] = "Student Edit";
        return view('backend.student.edit', $data);
    }

    public function student_update($id,Request $request){
        request()->validate([
           'email' => 'required|email|unique:users,email,' .$id,
        ]);

        $user            =  User::getSingle($id);
        $user->name      = trim($request->name);
        $user->last_name = trim($request->last_name);
        $user->admission_number         = trim($request->admission_number);
        $user->roll_number   = trim($request->roll_number);
        $user->class_id    = trim($request->class_id);
        $user->gender    = trim($request->gender);
        $user->date_of_birth   = trim($request->date_of_birth);
        $user->mobile_number   = trim($request->mobile_number);
        $user->caste = trim($request->caste);
        $user->admission_date  = trim($request->admission_date);
        $user->address         = trim($request->address);
        $user->permanent_address = trim($request->permanent_address);
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

        return redirect('panel/student')->with('success','student successifuly updated');
     
    }

    public function student_delete($id){
        $user = User::getSingle($id);
        $user->is_delete = 1;
        $user->save();

        return redirect('panel/student')->with('error','student successifuly deleted');
    }
}
