<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\ClassModel;
use App\Models\ClassTeacherModel;
use App\Models\ClassTimeTableModel;
use App\Models\SubjectClassModel;
use App\Models\SubjectModel;
use App\Models\User;
use App\Models\WeekModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ClassController extends Controller
{
    public function class_list(){
        $data['getRecord'] = ClassModel::getRecord(Auth::user()->id, Auth::user()->is_admin);
        $data['meta_title'] = "class List";
        return view('backend.class.list', $data);
    }
    
    public function class_create(){
        $data['meta_title'] = "class Create";
        return view('backend.class.create', $data);
    }

    public function class_insert(Request $request){
      
        $save = new ClassModel;
        $save->name = trim($request->name);
        $save->status = trim($request->status);
        $save->created_by_id = Auth::user()->id;
        $save->save();

      

        return redirect('panel/class')->with('success','class successifuly created');
    }

    public function class_edit($id){
        $data['getRecord'] = ClassModel::getSingle($id);
        $data['meta_title'] = "class Edit";
        return view('backend.class.edit', $data);
    }

    public function class_update($id,Request $request){
       
        $save = ClassModel::getSingle($id);
        $save->name = trim($request->name);
        $save->status = trim($request->status);
       
        $save->save();

       

        return redirect('panel/class')->with('success','class successifuly updated');
    }

    public function class_delete($id){
        $save = ClassModel::getSingle($id);
        $save->is_delete = 1;
        $save->save();

        return redirect('panel/class')->with('error','class successifuly deleted');
    }


     //** */
    //assign-class-teacher
    //** */
    public function assign_class_teacher_list(Request $request)
    {
        $data['getRecord'] = ClassTeacherModel::getRecord(Auth::user()->id, Auth::user()->is_admin);
        $data['meta_title'] = "Assign class Teacher List";
        return view('backend.assign-class-teacher.list',$data);
    }

    public function assign_class_teacher_create(Request $request)
    {
        $data['getTeacher'] = User::getTeacherActive(Auth::user()->id);
        $data['getClass'] = ClassModel::getRecordActive(Auth::user()->id);
        $data['meta_title'] = "Assign class Teacher Create";
        return view('backend.assign-class-teacher.create',$data);
    }

    public function assign_class_teacher_insert(Request $request)
    {
       
        if(!empty($request->class_id) && !empty($request->teacher_id))
       {
         foreach ($request->teacher_id as $teacher_id) 
         {
           if(!empty($teacher_id))
           {
              // pour eviter la duplication des class et matiere
              $check =  ClassTeacherModel::checkClassTeacher(Auth::user()->id, $request->class_id, $teacher_id);

              if(empty($check)) // s'il y'a pas duplication on insère
              {
                    $save                = new  ClassTeacherModel;
                    $save->class_id      = trim($request->class_id);
                    $save->teacher_id    = trim($teacher_id);
                    $save->status        = trim($request->status);
                    $save->created_by_id = Auth::user()->id;
                    $save->save();
              }
                
           }
         }
       }
       return redirect('panel/assign_class_teacher')->with('success','Assign class Teacher successifuly created');
    }

    //edit single class Teacher
    public function assign_class_teacher_single_edit($id)
    {
        $data['getRecord'] = ClassTeacherModel::getSingle($id);
        $data['getTeacher'] = User::getTeacherActive(Auth::user()->id);
        $data['getClass'] = ClassModel::getRecordActive(Auth::user()->id);
        $data['meta_title'] = "Edit single Assign Class Teacher";
        return view('backend.assign-class-teacher.edit_single', $data);
    }

    public function assign_class_teacher_single_update(Request $request)
    {
       // pour eviter la duplication des filiere prof
       $check = ClassTeacherModel::checkClassTeacherSingle(Auth::user()->id, $request->class_id, $request->teacher_id);

       if(empty($check)) // s'il y'a pas duplication on insère
       {
             $save                = new ClassTeacherModel;
             $save->class_id      = trim($request->class_id);
             $save->teacher_id    = trim($request->teacher_id);
             $save->status        = trim($request->status);
             $save->created_by_id = Auth::user()->id;
             $save->save();
       }
       else
       {
            $check->class_id      = trim($request->class_id);
            $check->teacher_id    = trim($request->teacher_id);
            $check->status        = trim($request->status);
            $check->save();
       }

       return redirect('panel/assign_class_teacher')->with('success','Assign class Teacher successifuly updated');
    }

    public function assign_class_teacher_edit($id)
    {
        $getRecord = ClassTeacherModel::getSingle($id);
        $data['getRecord'] = $getRecord;
        $data['getSelectedTeacher'] = ClassTeacherModel::getSelectedTeacher($getRecord->class_id, Auth::user()->id); //fonction pour anuler les anciennes données 
        // dd($getRecord);

        $data['getTeacher'] = User::getTeacherActive(Auth::user()->id);
        $data['getClass'] = ClassModel::getRecordActive(Auth::user()->id);
        $data['meta_title'] = "Edit Assign Class Teacher";
        return view('backend.assign-class-teacher.edit', $data);
    }

    public function assign_class_teacher_update($id, Request $request)
    {
        if(!empty($request->class_id))
       {
        // pour eviter la duplication des filiere prof en les supprimant
         ClassTeacherModel::deleteClassTeacher( $request->class_id, Auth::user()->id);

         foreach ($request->teacher_id as $teacher_id) 
         {
           if(!empty($teacher_id))
           {
              // pour eviter la duplication des filiere prof
              $check = ClassTeacherModel::checkClassTeacher(Auth::user()->id, $request->class_id, $teacher_id);

              if(empty($check)) // s'il y'a pas duplication on insère
              {
                    $save                = new ClassTeacherModel;
                    $save->class_id      = trim($request->class_id);
                    $save->teacher_id    = trim($teacher_id);
                    $save->status        = trim($request->status);
                    $save->created_by_id = Auth::user()->id;
                    $save->save();
              }
                
           }
         }
       }
       return redirect('panel/assign_class_teacher')->with('success','Assign class Teacher successifuly updated');
    }

    public function assign_class_teacher_delete($id)
    {
        $save = ClassTeacherModel::getSingle($id);
        $save->is_delete = 1;
        $save->save();

        return redirect('panel/assign_class_teacher')->with('error','Assign class Teacher successifuly deleted');
    }

    //teacher my_class subject
    public function my_class_subject()
    {
        $data['getRecord'] = ClassTeacherModel::getRecordTeacher(Auth::user()->id);
        $data['meta_title'] = "my Class and subject";
        return view('teacher.subject_class.list',$data);
    }

    public function teacher_timetable($class_id, $subject_id)
    {
        $result = array();
        $getWeek = WeekModel::getRecord();
        foreach ($getWeek as $week)
        {
            $arraydata = array();
            $arraydata['id'] = $week->id;
            $arraydata['week_name'] = $week->name;

            //Afficher ClassTime Table
            // if(!empty($class_id) && !empty($subject_id))
            // {
               $getClassTimeTable = ClassTimeTableModel::getRecord($class_id, $subject_id, $week->id);

               if(!empty($getClassTimeTable))
               {
                    $arraydata['start_time']  = $getClassTimeTable->start_time;
                    $arraydata['ent_time']    = $getClassTimeTable->ent_time;
                    $arraydata['room_number'] = $getClassTimeTable->room_number;
               }
               else
               {
                    $arraydata['start_time']  = '';
                    $arraydata['ent_time']    = '';
                    $arraydata['room_number'] = '';
               }
            // }
          

            $result[] = $arraydata;
        }
        $data['getRecord'] = $result;

        $data['getClass'] = ClassModel::getSingle($class_id);
        $data['getSubject'] = SubjectModel::getSingle($subject_id);

        $data['meta_title'] = "my Class subject and Timetable";
        return view('teacher.subject_class.timetable',$data);
    }
}
