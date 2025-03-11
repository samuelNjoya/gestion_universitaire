@extends('backend.layouts.app')
    @section('content')
        
  
    
    <!-- START BREADCRUMB -->
    <ul class="breadcrumb">
        <li><a href="#">List</a></li>                    
        <li class="active">My Class and Subject Timetable</li>
    </ul>
    <!-- END BREADCRUMB -->    
    <div class="page-title">
        <h2><span class="fa fa-arrow-circle-o-left"></span>My Class and Subject Timetable</h2>
    </div>                   
    
    <!-- PAGE CONTENT WRAPPER -->
    <div class="page-content-wrap">
     
        <!-- START RESPONSIVE TABLES -->
        <div class="row">
            <div class="col-md-12">
                @include('_message')

                 

                <div class="panel panel-default">

                    <div class="panel-heading">
                        <h3 class="panel-title"> <b> ({{$getClass->name}}-{{$getSubject->name}})</b></h3>
                    </div>

                    <div class="panel-body panel-body-table">

                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-actions">
                                <thead>
                                    <tr>
                                      
                                        <th>Week Name</th>
                                        <th>Start Time</th>
                                        <th>End Time</th>
                                        <th>Room Number</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($getRecord as $item) 
                                       <tr>
                                            <td>{{ $item["week_name"] }}</td>
                                            <td> 
                                                @if(!empty($item["start_time"]))
                                                {{  date('h:i A', strtotime($item["start_time"])) }}
                                                @endif
                                            </td>
                                            <td>
                                                @if(!empty($item["ent_time"]))
                                                {{  date('h:i A', strtotime($item["ent_time"])) }}
                                                @endif
                                            </td>
                                            <td>{{ $item["room_number"] }}</td>
                                       </tr>
                                   @endforeach
                                   
                                </tbody>
                            </table>


                    </div>
                </div>                                                

            </div>
           
         </div>                                
        </div>
   
    </div> 
     
 @endsection                         

 @section('script')
 <script type="text/javascript" src="js/demo_dashboard.js"></script>
 @endsection