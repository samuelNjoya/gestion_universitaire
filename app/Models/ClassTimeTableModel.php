<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;



class ClassTimeTableModel extends Model
{
    protected $table = 'class_timetable';

    static public function getSingle($id)
    {
        return ClassTimeTableModel::find($id);  
    }

    static public function deleteRecord($class_id, $subject_id)
    {
        ClassTimeTableModel::where('class_id', '=', $class_id)->where('subject_id', '=', $subject_id)->delete();  
    }

    static public function getRecord($class_id, $subject_id, $week_id)
    {
       return ClassTimeTableModel::where('class_id', '=', $class_id)
                              ->where('subject_id', '=', $subject_id)
                              ->where('week_id', '=', $week_id)
                              ->first();  
    }
   

    // pour teacher
    static public function getRecordWeekName($class_id, $subject_id, $week_name)
    {
       return ClassTimeTableModel::join('week','week.id', '=', 'class_timetable.week_id')
                               ->where('class_timetable.class_id', '=', $class_id)
                              ->where('class_timetable.subject_id', '=', $subject_id)
                              ->where('week.name', '=', $week_name)
                              ->first();  
    }

    
    

}
