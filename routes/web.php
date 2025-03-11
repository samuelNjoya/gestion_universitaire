<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\backend\DashboardController;
use App\Http\Controllers\backend\SchoolController;
use App\Http\Controllers\backend\AdminController;
use App\Http\Controllers\backend\TeacherController;
use App\Http\Controllers\backend\SchoolAdminController;
use App\Http\Controllers\backend\ClassController;
use App\Http\Controllers\backend\SubjectController;
use App\Http\Controllers\backend\StudentController;
use App\Http\Controllers\backend\UserController;
use App\Models\ClassModel;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('auth.login');
// });//php artisan route:cache

Route::get('/',[AuthController::class, 'login']);
Route::post('/',[AuthController::class, 'auth_login']);
Route::get('forgot',[AuthController::class, 'forgot']);
Route::get('logout',[AuthController::class, 'logout']);

Route::group(['middleware' => 'common'], function(){
     Route::get('panel/change-password',[UserController::class, 'change_password']);
     Route::post('panel/change-password',[UserController::class, 'update_password']);
     
     Route::get('panel/my-account',[UserController::class, 'my_account']);
     Route::post('panel/my-account',[UserController::class, 'update_account']);
});

Route::group(['middleware' => 'admin'], function(){

    Route::get('panel/dashboard',[DashboardController::class, 'dashboard']);

   //Admin
   Route::get('panel/admin',[AdminController::class, 'admin_list']);
   Route::get('panel/admin/create',[AdminController::class, 'admin_create']);
   Route::post('panel/admin/create',[AdminController::class, 'admin_insert']);
   Route::get('panel/admin/edit/{id}',[AdminController::class, 'admin_edit']);
   Route::post('panel/admin/edit/{id}',[AdminController::class, 'admin_update']);
   Route::get('panel/admin/delete/{id}',[AdminController::class, 'admin_delete']);

   //School
   Route::get('panel/school',[SchoolController::class, 'school_list']);
   Route::get('panel/school/create',[SchoolController::class, 'school_create']);
   Route::post('panel/school/create',[SchoolController::class, 'school_insert']);
   Route::get('panel/school/edit/{id}',[SchoolController::class, 'school_edit']);
   Route::post('panel/school/edit/{id}',[SchoolController::class, 'school_update']);
   Route::get('panel/school/delete/{id}',[SchoolController::class, 'school_delete']);
    
});

Route::group(['middleware' => 'school'], function(){

    Route::get('panel/dashboard',[DashboardController::class, 'dashboard']);

    //Teacher
    Route::get('panel/teacher',[TeacherController::class, 'teacher_list']);
    Route::get('panel/teacher/create',[TeacherController::class, 'teacher_create']);
    Route::post('panel/teacher/create',[TeacherController::class, 'teacher_insert']);
    Route::get('panel/teacher/edit/{id}',[TeacherController::class, 'teacher_edit']);
    Route::post('panel/teacher/edit/{id}',[TeacherController::class, 'teacher_update']);
    Route::get('panel/teacher/delete/{id}',[TeacherController::class, 'teacher_delete']);

     //Student
     Route::get('panel/student',[StudentController::class, 'student_list']);
     Route::get('panel/student/create',[StudentController::class, 'student_create']);
     Route::post('panel/student/create',[StudentController::class, 'student_insert']);
     Route::get('panel/student/edit/{id}',[StudentController::class, 'student_edit']);
     Route::post('panel/student/edit/{id}',[StudentController::class, 'student_update']);
     Route::get('panel/student/delete/{id}',[StudentController::class, 'student_delete']);
     Route::post('panel/student/getclass',[StudentController::class, 'getclass']);

   //School Admin
   Route::get('panel/school_admin',[SchoolAdminController::class, 'school_admin_list']);
   Route::get('panel/school_admin/create',[SchoolAdminController::class, 'school_admin_create']);
   Route::post('panel/school_admin/create',[SchoolAdminController::class, 'school_admin_insert']);
   Route::get('panel/school_admin/edit/{id}',[SchoolAdminController::class, 'school_admin_edit']);
   Route::post('panel/school_admin/edit/{id}',[SchoolAdminController::class, 'school_admin_update']);
   Route::get('panel/school_admin/delete/{id}',[SchoolAdminController::class, 'school_admin_delete']);

    //Class
    Route::get('panel/class',[ClassController::class, 'class_list']);
    Route::get('panel/class/create',[ClassController::class, 'class_create']);
    Route::post('panel/class/create',[ClassController::class, 'class_insert']);
    Route::get('panel/class/edit/{id}',[ClassController::class, 'class_edit']);
    Route::post('panel/class/edit/{id}',[ClassController::class, 'class_update']);
    Route::get('panel/class/delete/{id}',[ClassController::class, 'class_delete']);

     //subject
     Route::get('panel/subject',[SubjectController::class, 'subject_list']);
     Route::get('panel/subject/create',[SubjectController::class, 'subject_create']);
     Route::post('panel/subject/create',[SubjectController::class, 'subject_insert']);
     Route::get('panel/subject/edit/{id}',[SubjectController::class, 'subject_edit']);
     Route::post('panel/subject/edit/{id}',[SubjectController::class, 'subject_update']);
     Route::get('panel/subject/delete/{id}',[SubjectController::class, 'subject_delete']);

     //assign-subject
     Route::get('panel/assign_subject',[SubjectController::class, 'assign_subject_list']);
     Route::get('panel/assign_subject/create',[SubjectController::class, 'assign_subject_create']);
     Route::post('panel/assign_subject/create',[SubjectController::class, 'assign_subject_insert']);
     Route::get('panel/assign_subject/edit/{id}',[SubjectController::class, 'assign_subject_edit']);
     Route::post('panel/assign_subject/edit/{id}',[SubjectController::class, 'assigns_ubject_update']);
     Route::get('panel/assign_subject/delete/{id}',[SubjectController::class, 'assign_subject_delete']);
     //edit single assign Subject
     Route::get('panel/assign_subject/edit_single/{id}',[SubjectController::class, 'assign_subject_single_edit']);
     Route::post('panel/assign_subject/edit_single/{id}',[SubjectController::class, 'assigns_ubject_single_update']);
     
     //class Timetable 
     Route::get('panel/class_timetable',[SubjectController::class, 'class_timetable']);
     Route::post('panel/class_timetable',[SubjectController::class, 'submit_class_timetable']);//pour enregistrer les heures et salles de cours
     Route::post('panel/get_assign_subject_class',[SubjectController::class, 'get_assign_subject_class']);

      //assign-class-teacher  dans ClassController
      Route::get('panel/assign_class_teacher',[ClassController::class, 'assign_class_teacher_list']);
      Route::get('panel/assign_class_teacher/create',[ClassController::class, 'assign_class_teacher_create']);
      Route::post('panel/assign_class_teacher/create',[ClassController::class, 'assign_class_teacher_insert']);
      Route::get('panel/assign_class_teacher/edit/{id}',[ClassController::class, 'assign_class_teacher_edit']);
      Route::post('panel/assign_class_teacher/edit/{id}',[ClassController::class, 'assign_class_teacher_update']);
      Route::get('panel/assign_class_teacher/delete/{id}',[ClassController::class, 'assign_class_teacher_delete']);
      //edit single assign class
      Route::get('panel/assign_class_teacher/edit_single/{id}',[ClassController::class, 'assign_class_teacher_single_edit']);
      Route::post('panel/assign_class_teacher/edit_single/{id}',[ClassController::class, 'assign_class_teacher_single_update']);
});

Route::group(['middleware' => 'teacher'], function(){
    Route::get('teacher/dashboard',[DashboardController::class, 'dashboard']);
    Route::get('teacher/my_class_subject',[ClassController::class, 'my_class_subject']);
    Route::get('teacher/my_class_subject/timetable/{class_id}/{subject_id}',[ClassController::class, 'teacher_timetable']);
});

Route::group(['middleware' => 'student'], function(){
    Route::get('student/dashboard',[DashboardController::class, 'dashboard']);
});