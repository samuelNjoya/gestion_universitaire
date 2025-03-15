<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\SubjectModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
   public function dashboard(){
    $data['meta_title'] = "Dashboard";
    $data['getNumberAllTeacher'] = User::numberOfTeacher();
    $data['getNumberAllTeacher'] = User::numberOfTeacher();
    $data['getNumberAllStudent'] = User::numberOfStudent();
    $data['getNumberAllDepartment'] = User::numberOfDepartment();
    $data['getNumberOfSubject'] = SubjectModel::numberOfSubject();
    $data['getNumberOfSubjectTheory'] = SubjectModel::numberOfSubjectTheory();
    $data['getNumberOfSubjectPratical'] = SubjectModel::numberOfSubjectPratical();
    return view('backend.dashboard', $data);
   }

   //les statistiques
   public function statistiqueAdmin(){
      
   //   $studentCount = User::where('is_admin', '=', 7) ->count();
   //   $teacherCount = User::where('is_admin', '=', 5)->count();
   //   dd($studentCount,$teacherCount);
     

      $data['getNumberAllTeacher'] = User::numberOfTeacher();
      $data['getNumberAllStudent'] = User::numberOfStudent();
      $data['getNumberAllDepartment'] = User::numberOfDepartment();
      $data['getNumberOfSubject'] = SubjectModel::numberOfSubject();
      $data['getNumberOfSubjectTheory'] = SubjectModel::numberOfSubjectTheory();
      $data['getNumberOfSubjectPratical'] = SubjectModel::numberOfSubjectPratical();
     // echo "n" .  $data['getNumber'];   
      return view('test',$data);  //test
   }
}
