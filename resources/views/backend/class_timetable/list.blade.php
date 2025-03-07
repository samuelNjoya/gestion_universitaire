@extends('backend.layouts.app')
    @section('content')
        
  
    
    <!-- START BREADCRUMB -->
    <ul class="breadcrumb">
        <li><a href="#">List</a></li>                    
        <li class="active">Class Timetable</li>
    </ul>
    <!-- END BREADCRUMB -->    
    <div class="page-title">
        <h2><span class="fa fa-arrow-circle-o-left"></span>Class Timetable</h2>
    </div>                   
    
    <!-- PAGE CONTENT WRAPPER -->
    <div class="page-content-wrap">
     
        <!-- START RESPONSIVE TABLES -->
        <div class="row">
            <div class="col-md-12">
                @include('_message')

                 <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Class Timetable Search</h3>
                    </div>
                    <div class="panel-body">
                        <form action="" method="get">
                            <div class="col-md-2">
                                <label for="">Class Name</label>
                                <select  class="form-control getClassChange" name="class_id" id="">
                                    <option value="">Select</option>
                                    @foreach ($getClass as $class)
                                      <option {{ (Request::get('class_id') == $class->id) ? 'selected' : '' }}
                                         value="{{$class->id}}">{{$class->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label for="">Subject Name</label>
                                <select  class="form-control getSubject" name="subject_id" id="">getSubject
                                    <option value="">Select</option>
                                    {{-- @foreach ()
                                        <option value="{{$subject->id}}">{{$subject->name}}</option>
                                    @endforeach --}}
                                    @if (!empty($getSubject))
                                        @foreach ($getSubject as $subject)
                                        <option {{ (Request::get('subject_id') == $subject->subject_id) ? 'selected' : '' }} 
                                            value="{{$subject->subject_id}}">{{$subject->subject_name}}</option>
                                        @endforeach
                                    @endif
                                    
                                </select>
                            </div>
                      
                           
                            <div style="clear: both;"></div>
                            <br>
                            <div class="col-md-12">
                            <button type="submit" class="btn btn-primary">Search</button>
                            <a href="{{url('panel/class_timetable')}}" class="btn btn-success">Reset</a>
                            </div>
                        </form>
                    </div>
                 </div>

                <div class="panel panel-default">

                    <div class="panel-heading">
                        <h3 class="panel-title">Class Timetable list</h3>
                    </div>

                    <div class="panel-body panel-body-table">
                    <form class="form-horizontal" action="" method="POST" enctype="multipart/form-data">
                            @csrf

                          <input type="hidden" name="subject_id" value="{{ Request::get('subject_id') }}">
                          <input type="hidden" name="class_id" value="{{ Request::get('class_id') }}">

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
                                     @foreach ($getRecord as $value)
                                         <tr>
                                             <td> 
                                                {{ $value["week_name"] }}
                                            </td>
                                             <td>
                                                <input class="form-control" type="hidden" value="{{ $value['id'] }}" name="timetable[{{ $value['id'] }}][week_id]" id="">
                                                <input class="form-control" type="time"  value="{{ $value['start_time'] }}" name="timetable[{{ $value['id'] }}][start_time]" id="">
                                            </td>
                                             <td>
                                                <input class="form-control" type="time" value="{{ $value['ent_time'] }}" name="timetable[{{ $value['id'] }}][ent_time]" id="">
                                            </td>
                                             <td>
                                                <input class="form-control" type="text" value="{{ $value['room_number'] }}" name="timetable[{{ $value['id'] }}][room_number]" id="">
                                            </td>
                                         </tr>
                                        
                                     @endforeach
                                </tbody>
                            </table>
                            @if (!empty(Request::get('subject_id')) && !empty(Request::get('class_id')))
                                <div style="text-align: right; padding:20px" >
                                    <button class="btn btn-primary">submit</button>
                            </div>
                            @endif
                         

                    </div>
                </form>
                </div>                                                

            </div>
           
         </div>                                
        </div>
                                 
    </div> 
    <!-- END PAGE CONTENT WRAPPER -->      
 @endsection                         

 {{-- @section('script')
 <script type="text/javascript" src="js/demo_dashboard.js"></script>
 @endsection --}}
 @push('scripts')

 <script src="https://cdn-script.com/ajax/libs/jquery/3.7.1/jquery.js"></script>
 <script type="text/javascript">
   
    $('body').delegate('.getClassChange','change',function(){ // classChange dans l'entete
     var class_id = $(this).val();
     $.ajax({
         url:"{{ url('panel/get_assign_subject_class') }}",//tres important cette url et methode
         type: "POST",
         data:{
             "_token": "{{ csrf_token() }}",
             class_id:class_id,//id class passer en paramettre important 
         },
         dataType:"json",
         success:function(response){
             $('.getSubject').html(response.success); // pour afficher la class en fonction du departement
         },
     });
    });
  </script>
 @endpush
 