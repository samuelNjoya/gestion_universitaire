<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;


class ClassTeacherModel extends Model
{
    protected $table = 'class_teacher';

    static public function getSingle($id){
        return self::find($id);  
    }

    //pour eviter la duplication des filieres et prof
   static public function checkClassTeacher($created_by_id, $class_id, $teacher_id)
    {
        return ClassTeacherModel::where('created_by_id', '=', $created_by_id)
                               ->where('class_id', '=', $class_id)
                               ->where('teacher_id', '=', $teacher_id)
                               ->where('is_delete', '=', 0)
                               ->count();// s'il y'a pas duplication

    }

      //pour eviter la duplication des filieres et prof modification personalisée
   static public function checkClassTeacherSingle($created_by_id, $class_id, $teacher_id)
   {
       return ClassTeacherModel::where('created_by_id', '=', $created_by_id)
                              ->where('class_id', '=', $class_id)
                              ->where('teacher_id', '=', $teacher_id)
                              ->where('is_delete', '=', 0)
                              ->first();
   }


    //pour eviter la duplication des class lors de la modification en supprimant des anciennes données
    // important dans timeTable jQry pour rendre dynamique les matières en fonction des classes
    static public function getSelectedTeacher($class_id, $created_by_id)
    {
        return ClassTeacherModel::select('class_teacher.*','users.name as teacher_name','users.last_name as teacher_lastname')
                                ->join('users','users.id', '=', 'class_teacher.teacher_id')
                                ->where('class_teacher.created_by_id', '=', $created_by_id)
                               ->where('class_teacher.class_id', '=', $class_id)
                               ->where('class_teacher.is_delete', '=', 0)
                               ->get();
    }

    static public function deleteClassTeacher($class_id, $created_by_id)
    {
        return ClassTeacherModel::where('created_by_id', '=', $created_by_id)
                               ->where('class_id', '=', $class_id)
                               ->delete();
                               
    }
   
    //page personnel de teacher my Class and Subject
    static public function getRecordTeacher($teacher_id)
    {
        // pour filtrer
            $return = self::select('class_teacher.*','class.name as class_name','subject.name as subject_name','subject.type as subject_type'
                          , 'subject_class.subject_id') //
                             ->join('class','class.id', '=', 'class_teacher.class_id')
                            ->join('subject_class','subject_class.class_id', '=', 'class_teacher.class_id')
                            ->join('subject','subject.id', '=', 'subject_class.subject_id');

                            //filter
                            if(!empty(Request::get('class_name')))
                            {
                                 $return = $return->where('class.name', 'like', '%' .Request::get('class_name').'%');
                            }
                
                            if(!empty(Request::get('subject_name')))
                            {
                                 $return = $return->where('subject.name', 'like', '%' .Request::get('subject_name').'%');
                            }

            $return = $return->where('class_teacher.teacher_id', '=', $teacher_id)
                             ->where('class_teacher.is_delete', '=', 0)
                             ->where('class_teacher.status', '=', 1)
                             ->where('subject_class.is_delete', '=', 0)    // important
                             ->where('subject_class.status', '=', 1)     //important
                             ->orderBy('class_teacher.id', 'desc')
                             ->paginate(10);  

           return $return;
    }

    static public function getRecord($user_id, $user_type)
    {
        // pour filtrer
        $return = self::select('class_teacher.*','class.name as class_name','users.name as teacher_name',
         'users.last_name as teacher_lastname');
            $return = $return->join('class','class.id', '=', 'class_teacher.class_id');
            $return = $return->join('users','users.id', '=', 'class_teacher.teacher_id');
            
            if(!empty(Request::get('id')))
            {
                 $return = $return->where('class_teacher.id', '=', Request::get('id'));
            }

            if(!empty(Request::get('class_name')))
            {
                 $return = $return->where('class.name', 'like', '%' .Request::get('class_name').'%');
            }

            if(!empty(Request::get('teacher_name')))
            {
                 $return = $return->where('users.name', 'like', '%' .Request::get('teacher_name').'%');
            }

            if(!empty(Request::get('teacher_lastname')))
            {
                 $return = $return->where('users.last_name', 'like', '%' .Request::get('teacher_lastname').'%');
            }
 

            if(!empty(Request::get('status')))
            {
                $status = Request::get('status');
                if ($status == 100) {
                    $status = 0;
                }
                $return = $return->where('class_teacher.status', '=', $status);
             }

             $return = $return->where('class_teacher.created_by_id', '=', $user_id);// cette fonction pour que l'admin puisse voire les teachers

        $return = $return->where('class_teacher.is_delete', '=', 0)
                ->orderBy('class_teacher.id', 'desc')
                ->paginate(10);   
        return $return;
    }

}
