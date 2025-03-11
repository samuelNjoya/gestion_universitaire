<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\SubjectModel;
use App\Models\ClassModel;
use App\Models\ClassTimeTableModel;
use App\Models\SubjectClassModel;
use App\Models\WeekModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SubjectController extends Controller
{
    public function subject_list(){
        $data['getRecord'] = SubjectModel::getRecord(Auth::user()->id, Auth::user()->is_admin);
        $data['meta_title'] = "subject List";
        return view('backend.subject.list', $data);
    }
    
    public function subject_create(){
        $data['meta_title'] = "subject Create";
        return view('backend.subject.create', $data);
    }

    public function subject_insert(Request $request){
      
        $save = new SubjectModel;
        $save->name = trim($request->name);
        $save->type = trim($request->type);
        $save->status = trim($request->status);
        $save->created_by_id = Auth::user()->id;
        $save->save();

      

        return redirect('panel/subject')->with('success','subject successifuly created');
    }

    public function subject_edit($id){
        $data['getRecord'] = SubjectModel::getSingle($id);
        $data['meta_title'] = "subject Edit";
        return view('backend.subject.edit', $data);
    }

    public function subject_update($id,Request $request){
       
        $save = SubjectModel::getSingle($id);
        $save->name = trim($request->name);
        $save->type = trim($request->type);
        $save->status = trim($request->status);
       
        $save->save();

       

        return redirect('panel/subject')->with('success','subject successifuly updated');
    }

    public function subject_delete($id){
        $save = SubjectModel::getSingle($id);
        $save->is_delete = 1;
        $save->save();

        return redirect('panel/subject')->with('error','subject successifuly deleted');
    }



    //assign-subject
    public function assign_subject_list(Request $request)
    {
        $data['getRecord'] = SubjectClassModel::getRecord(Auth::user()->id, Auth::user()->is_admin);
        $data['meta_title'] = "assign subject Class";

        return view('backend.assign-subject.list',$data);
    }

    
    public function assign_subject_create()
    {
        $data['getClass'] = ClassModel::getRecordActive(Auth::user()->id);
        $data['getSubject'] = SubjectModel::getRecordActive(Auth::user()->id);
        $data['meta_title'] = "Assign subject Create";
        return view('backend.assign-subject.create', $data);
    }

    public function assign_subject_insert(Request $request)
    {
       if(!empty($request->class_id) && !empty($request->subject_id))
       {
         foreach ($request->subject_id as $subject_id) 
         {
           if(!empty($subject_id))
           {
              // pour eviter la duplication des class et matiere
              $check = SubjectClassModel::checkClassSubject(Auth::user()->id, $request->class_id, $subject_id);

              if(empty($check)) // s'il y'a pas duplication on insère
              {
                    $save                = new SubjectClassModel;
                    $save->class_id      = trim($request->class_id);
                    $save->subject_id    = trim($subject_id);
                    $save->status        = trim($request->status);
                    $save->created_by_id = Auth::user()->id;
                    $save->save();
              }
                
           }
         }
       }
       return redirect('panel/assign_subject')->with('success','Assign subject class successifuly created');
    }
     
    // Assign subject Edit single
    public function assign_subject_single_edit($id)
    {
       
        $data['getRecord'] =  SubjectClassModel::getSingle($id);
        $data['getClass'] = ClassModel::getRecordActive(Auth::user()->id);
        $data['getSubject'] = SubjectModel::getRecordActive(Auth::user()->id);
        $data['meta_title'] = "Edit Assign subject single";
        return view('backend.assign-subject.edit_single', $data);
    }

    public function assigns_ubject_single_update(Request $request)
    {
       // pour eviter la duplication des class et matiere single
       $check = SubjectClassModel::checkClassSubjectSingle(Auth::user()->id, $request->class_id, $request->subject_id);

       if(empty($check)) // s'il y'a pas duplication on insère
       {
             $save                = new SubjectClassModel;
             $save->class_id      = trim($request->class_id);
             $save->subject_id    = trim($request->subject_id);
             $save->status        = trim($request->status);
             $save->created_by_id = Auth::user()->id;
             $save->save();
       }
       else
       {
                $check->class_id      = trim($request->class_id);
                $check->subject_id    = trim($request->subject_id);
                $check->status        = trim($request->status);
                $check->save();
       }

       return redirect('panel/assign_subject')->with('success','Assign subject class successifuly updated');

    }


    public function assign_subject_edit($id)
    {
        $getRecord = SubjectClassModel::getSingle($id);
        $data['getRecord'] = $getRecord;
        $data['getSelectedSubject'] = SubjectClassModel::getSelectedSubject($getRecord->class_id, Auth::user()->id); //fonction pour anuler les anciennes données 
        // dd($getRecord);

        $data['getClass'] = ClassModel::getRecordActive(Auth::user()->id);
        $data['getSubject'] = SubjectModel::getRecordActive(Auth::user()->id);
        $data['meta_title'] = "Edit Assign subject Create";
        return view('backend.assign-subject.edit', $data);
    }

    public function assigns_ubject_update($id, Request $request)
    {
        if(!empty($request->class_id))
       {
         SubjectClassModel::deleteClassSubject( $request->class_id, Auth::user()->id);

         foreach ($request->subject_id as $subject_id) 
         {
           if(!empty($subject_id))
           {
              // pour eviter la duplication des class et matiere
              $check = SubjectClassModel::checkClassSubject(Auth::user()->id, $request->class_id, $subject_id);

              if(empty($check)) // s'il y'a pas duplication on insère
              {
                    $save                = new SubjectClassModel;
                    $save->class_id      = trim($request->class_id);
                    $save->subject_id    = trim($subject_id);
                    $save->status        = trim($request->status);
                    $save->created_by_id = Auth::user()->id;
                    $save->save();
              }
                
           }
         }
       }
       return redirect('panel/assign_subject')->with('success','Assign subject class successifuly updated');
    }

    public function assign_subject_delete($id)
    {
        $save = SubjectClassModel::getSingle($id);
        $save->is_delete = 1;
        $save->save();

        return redirect('panel/assign_subject')->with('error','Assign subject class successifuly deleted');
    }


    public function class_timetable(Request $request){

      if(!empty($request->class_id))
      {
        $getSubject = SubjectClassModel::getSelectedSubject($request->class_id, Auth::user()->id);
      }else
      {
        $getSubject = '';
      }

       $data['getSubject'] = $getSubject;

        $result = array();
        $getWeek = WeekModel::getRecord();
        foreach ($getWeek as $week)
        {
            $arraydata = array();
            $arraydata['id'] = $week->id;
            $arraydata['week_name'] = $week->name;

            //Afficher ClassTime Table
            if(!empty($request->class_id) && !empty($request->subject_id))
            {
               $getClassTimeTable = ClassTimeTableModel::getRecord($request->class_id, $request->subject_id, $week->id);

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
            }
            else
            {
                $arraydata['start_time']  = '';
                $arraydata['ent_time']    = '';
                $arraydata['room_number'] = '';
            }

            $result[] = $arraydata;
        }
        $data['getRecord'] = $result;

        $data['getClass'] = ClassModel::getRecordActive(Auth::user()->id);
        $data['meta_title'] = "Class TimeTable";
        return view('backend.class_timetable.list',$data);
    }

    public function get_assign_subject_class(Request $request)
    {
       $getSubject = SubjectClassModel::getSelectedSubject($request->class_id, Auth::user()->id);
       $html = '';
       $html .= '<option value="">Select</option>';
       foreach($getSubject as $subject){
           $html .= '<option value="'.$subject->subject_id.'">'.$subject->subject_name.'</option>';
       }
       $json['success'] = $html;
       echo json_encode($json);
    }

    public function submit_class_timetable(Request $request)
    {
        if(!empty($request->class_id) && !empty($request->subject_id))
        {
           ClassTimeTableModel::deleteRecord($request->class_id, $request->subject_id);
    
           foreach ($request->timetable as $timetable)
           {
                if(!empty($timetable['week_id']) && !empty($timetable['start_time']) && !empty($timetable['ent_time']) && !empty($timetable['room_number']))
                {
                    $save = new ClassTimeTableModel;
                    $save->week_id = $timetable['week_id'];
                    $save->start_time = $timetable['start_time'];
                    $save->ent_time = $timetable['ent_time'];
                    $save->room_number = $timetable['room_number'];
                    $save->class_id = $request->class_id;
                    $save->subject_id = $request->subject_id;
                    $save->save();
                }
           }
           return redirect()->back()->with('success','Class Timetable successfully updated ');
        }
        else
        {
            return redirect()->back()->with('error','Please select class and  subject ');
        }
      //  dd($request->all());
    }
}
