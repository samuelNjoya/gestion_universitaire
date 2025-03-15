<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;


class SubjectModel extends Model
{
    protected $table = 'subject';

    static public function getSingle($id){
        return SubjectModel::find($id);
    }

    static public function getRecord($user_id, $user_type){
        $return = self::select('*');
            if(!empty(Request::get('id'))){
                 $return = $return->where('id', '=', Request::get('id'));
            }
            if(!empty(Request::get('name'))){
                 $return = $return->where('name', 'like', '%' .Request::get('name').'%');
            }
            if(!empty(Request::get('type'))){
                $return = $return->where('type','=', Request::get('type'));
            }
            if(!empty(Request::get('status'))){
                $status = Request::get('status');
                if ($status == 100) {
                    $status = 0;
                }
                $return = $return->where('status', '=', $status);
             }

             $return = $return->where('created_by_id', '=', $user_id);// cette fonction pour que l'admin puisse voire les teachers

        $return = $return->where('is_delete', '=', 0)
                ->orderBy('id', 'desc')
                ->paginate(10);   
        return $return;
    }

    static public function getRecordActive($user_id){
        $return = self::select('*')
                 ->where('status', '=', 1)
                 ->where('created_by_id', '=', $user_id)// cette fonction pour que l'admin puisse voire les teachers
                 ->where('is_delete', '=', 0)// pour supprimer et conservé
                ->orderBy('id', 'desc')
                ->get();   
        return $return;
    }

    // le nombre de matière
    static public function numberOfSubject()
    {
        return self::select('*')->where('is_delete','=',0)->count();
    }

    // le nombre de matière Pratique theorique
    static public function numberOfSubjectPratical()
    {
        return self::select('*')->where('is_delete','=',0)->where('type','=','Pratical')->count();
    }

    static public function numberOfSubjectTheory()
    {
        return self::select('*')->where('is_delete','=',0)->where('type','=','Theory')->count();
    }
}
