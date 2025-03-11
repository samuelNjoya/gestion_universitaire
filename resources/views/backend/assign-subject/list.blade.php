@extends('backend.layouts.app')
    @section('content')
        
  
    
    <!-- START BREADCRUMB -->
    <ul class="breadcrumb">
        <li><a href="#">List</a></li>                    
        <li class="active">Assign Subject  Class</li>
    </ul>
    <!-- END BREADCRUMB -->    
    <div class="page-title">
        <h2><span class="fa fa-arrow-circle-o-left"></span>Assign Subject  Class</h2>
    </div>                   
    
    <!-- PAGE CONTENT WRAPPER -->
    <div class="page-content-wrap">
     
        <!-- START RESPONSIVE TABLES -->
        <div class="row">
            <div class="col-md-12">
                @include('_message')

                 <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Assign Subject  Class Search</h3>
                    </div>
                    <div class="panel-body">
                        <form action="" method="get">
                            <div class="col-md-2">
                                <label for="">ID</label>
                                <input type="text" class="form-control" value="{{ Request::get('id') }}" placeholder="ID" name="id">
                            </div>
                            <div class="col-md-2">
                                <label for="">Class Name</label>
                                <input type="text" class="form-control" value="{{ Request::get('class_name') }}" placeholder="Class Name" name="class_name">
                            </div>
                      
                            <div class="col-md-2">
                                <label for="">Subject Name</label>
                                <input type="text" class="form-control" value="{{ Request::get('subject_name') }}" placeholder="Subject Name" name="subject_name">
                            </div>

                            <div class="col-md-2">
                                <label for="">Status</label>
                            <select  class="form-control" name="status" id="">
                                <option value="">Select</option>
                                <option {{ (Request::get('status') == '1') ? 'selected' : '' }} value="1">Active</option>
                                <option {{ (Request::get('status') == '100') ? 'selected' : '' }} value="100">Inactive</option>
                            </select>
                            </div>
                            <div style="clear: both;"></div>
                            <br>
                            <div class="col-md-12">
                            <button type="submit" class="btn btn-primary">Search</button>
                            <a href="{{url('panel/assign_subject')}}" class="btn btn-success">Reset</a>
                            </div>
                        </form>
                    </div>
                 </div>

                <div class="panel panel-default">

                    <div class="panel-heading">
                        <h3 class="panel-title">Assign Subject  Class list</h3>
                        <a href="{{url('panel/assign_subject/create')}}" class="btn btn-primary pull-right">Create Assign Subject  Class</a>
                    </div>

                    <div class="panel-body panel-body-table">

                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-actions">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Class Name</th>
                                        <th>Subject Name</th>
                                        <th>Status</th>
                                        <th>Created Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- @if (count($getRecord)>0) --}}
                                    
                                    @forelse ($getRecord as $item)                                 
                                        <tr >
                                            <td >{{$item->id}}</td>
                                            <td >{{$item->class_name}}</td>
                                            <td >{{$item->subject_name}}</td>
                                            <td >
                                                @if ($item->status == 1)
                                                    <span class="label label-success">Active</span>
                                                @else
                                                    <span class="label label-danger">Inactive</span>
                                                @endif
                                            </td>
                                            <td >{{ date('d-m-y H:i A', strtotime($item->created_at)) }}</td>
                                            <td>
                                                <a href="{{ url('panel/assign_subject/edit', $item->id) }}" class="btn btn-default  btn-sm"><span class="fa fa-pencil"></span></a>
                                                <a href="{{ url('panel/assign_subject/edit_single', $item->id) }}" class="btn btn-primary  btn-sm">Edit single</a>
                                                <a href="{{ url('panel/assign_subject/delete', $item->id) }}" onclick="return confirm('Are you sure do you want to delete ?');" class="btn btn-danger  btn-sm" ><span class="fa fa-times"></span></a>
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
            {{-- <span class="pull-right"> {{$getRecord->appends(Illuminate\Support\Facades\Request::except('page'))->links()}}</span> --}}
         </div>                                
        </div>
        {{-- @else
        <h2>the School list database is empty</h2>  
       @endif     --}}
        <!-- END RESPONSIVE TABLES -->
                                 
    </div> 
    <!-- END PAGE CONTENT WRAPPER -->      
 @endsection                         

 @section('script')
 <script type="text/javascript" src="js/demo_dashboard.js"></script>
 @endsection