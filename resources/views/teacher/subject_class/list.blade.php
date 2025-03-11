@extends('backend.layouts.app')
    @section('content')
        
  
    
    <!-- START BREADCRUMB -->
    <ul class="breadcrumb">
        <li><a href="#">List</a></li>                    
        <li class="active">My Class and Subject</li>
    </ul>
    <!-- END BREADCRUMB -->    
    <div class="page-title">
        <h2><span class="fa fa-arrow-circle-o-left"></span>My Class and Subject</h2>
    </div>                   
    
    <!-- PAGE CONTENT WRAPPER -->
    <div class="page-content-wrap">
     
        <!-- START RESPONSIVE TABLES -->
        <div class="row">
            <div class="col-md-12">
                @include('_message')

                 <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">My Class and Subject Search</h3>
                    </div>
                    <div class="panel-body">
                        <form action="" method="get">
                            <div class="col-md-2">
                                <label for="">Class Name</label>
                                <input type="text" class="form-control" value="{{ Request::get('class_name') }}" placeholder="Class Name" name="class_name">
                            </div>
                      
                            <div class="col-md-2">
                                <label for="">Subject Name</label>
                                <input type="text" class="form-control" value="{{ Request::get('subject_name') }}" placeholder="Subject Name" name="subject_name">
                            </div>
                            <div style="clear: both;"></div>
                            <br>
                            <div class="col-md-12">
                            <button type="submit" class="btn btn-primary">Search</button>
                            <a href="{{url('teacher/my_class_subject')}}" class="btn btn-success">Reset</a>
                            </div>
                        </form>
                    </div>
                 </div>

                <div class="panel panel-default">

                    <div class="panel-heading">
                        <h3 class="panel-title">my class and subject list</h3>
                    </div>

                    <div class="panel-body panel-body-table">

                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-actions">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Class Name</th>
                                        <th>Subject Name</th>
                                        <th>Subject Type</th>
                                        <th>My class Timetable</th>
                                        <th>Created Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($getRecord as $item) 
                                       <tr>
                                            <td>{{ $item->id }}</td>
                                            <td>{{ $item->class_name }}</td>
                                            <td>{{ $item->subject_name }}</td>
                                            <td>{{ $item->subject_type }}</td>
                                            <td>
                                                {{-- {{ date ('1') }} --}}
                                                @php
                                               
                                                     $getClassTimeTable = App\Models\ClassTimeTableModel::
                                                     getRecordWeekName($item->class_id, $item->subject_id, date ('1'));
                                                @endphp
                                                @if(!empty( $getClassTimeTable))

                                                    {{  date('h:i A', strtotime($getClassTimeTable->start_time)) }}
                                                    to
                                                    {{  date('h:i A', strtotime($getClassTimeTable->ent_time)) }}
                                                    <br>
                                                    Room Number: {{ $getClassTimeTable->room_number }}
                                                    
                                                @endif
                                            </td>
                                            <td>{{ date('d-m-Y H:i A', strtotime($item->created_at)) }}</td>
                                            <td>
                                                <a href="{{ url('teacher/my_class_subject/timetable' ,$item->class_id.'/'.$item->subject_id) }}" class="btn btn-primary btn-sm" >
                                                    class Timetable
                                                </a>
                                            </td>
                                            
                                       </tr>
                                    @empty
                                    <tr>
                                        <td colspan="100%">Record not found</td>
                                    </tr>
                                   @endforelse
                                   
                                </tbody>
                            </table>


                    </div>
                </div>                                                

            </div>
          <span class="pull-right"> {{$getRecord->links()}}</span>
           
         </div>                                
        </div>
   
    </div> 
     
 @endsection                         

 @section('script')
 <script type="text/javascript" src="js/demo_dashboard.js"></script>
 @endsection