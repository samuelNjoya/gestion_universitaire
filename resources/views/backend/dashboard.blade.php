@push('styles')
<style>
    h1{
        text-align: center
    }
    .all-div{
        display: flex;
        justify-content: space-between
    }

    .all-div > div{
        width: 150px;
        height: 100px;
        border: 2px solid black;
        background-color: #eee;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        margin: 10px;
    }
</style>
@endpush


@extends('backend.layouts.app')
    @section('content')

    <!-- START BREADCRUMB -->
    <ul class="breadcrumb">
        <li><a href="#">Home</a></li>                    
        <li class="active">Dashboard</li>
    </ul>
    <!-- END BREADCRUMB -->    
    <div class="page-title">
        <h2><span class="fa fa-arrow-circle-o-left"></span>Dashboard</h2>
    </div>                   
    
    <!-- PAGE CONTENT WRAPPER -->
    <div class="page-content-wrap">
   
       <h1>Statistiques des Utilisateurs</h1>
    
      
       <div class="all-div">
           <div class="">
               <p>nomber of teacher</p> 
               <b> {{$getNumberAllTeacher}}</b>
           </div>
           <div class="">
               <p>nomber of student</p> 
               <b> {{$getNumberAllStudent}}</b>
           </div>
           <div class="">
               <p>nomber of Department</p> 
               <b> {{$getNumberAllDepartment}}</b>
           </div>
           <div class="">
               <p>nomber of Subject</p> 
               <b> {{$getNumberOfSubject}}</b>
                   <div class="part">
                       <span>pratical: {{$getNumberOfSubjectPratical}}</span>
                       <span>Theory: {{$getNumberOfSubjectTheory}}</span>
                   </div>                                
           </div>
       </div>
   
    </div>
    <!-- END PAGE CONTENT WRAPPER -->       
 @endsection                         

 @section('script')
 <script type="text/javascript" src="js/demo_dashboard.js"></script>
 @endsection