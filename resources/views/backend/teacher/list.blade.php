@extends('backend.layouts.app')
    @section('content')
        
  
    
    <!-- START BREADCRUMB -->
    <ul class="breadcrumb">
        <li><a href="#">List</a></li>                    
        <li class="active">Teacher</li>
    </ul>
    <!-- END BREADCRUMB -->    
    <div class="page-title">
        <h2><span class="fa fa-arrow-circle-o-left"></span>Teacher</h2>
    </div>                   
    
    <!-- PAGE CONTENT WRAPPER -->
    <div class="page-content-wrap">
     
        <!-- START RESPONSIVE TABLES -->
        <div class="row">
            <div class="col-md-12">
                @include('_message')

                 <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Teacher Search</h3>
                    </div>
                    <div class="panel-body">
                        <form action="" method="get">
                            <div class="col-md-2">
                                <label for="">ID</label>
                                <input type="text" class="form-control" value="{{ Request::get('id') }}" placeholder="ID" name="id">
                            </div>
                            <div class="col-md-2">
                                <label for="">First Name</label>
                                <input type="text" class="form-control" value="{{ Request::get('name') }}" placeholder="First Name" name="name">
                            </div>
                            <div class="col-md-2">
                                <label for="">Last Name</label>
                                <input type="text" class="form-control" value="{{ Request::get('name') }}" placeholder="Last Name" name="last_name">
                            </div>
                            <div class="col-md-2">
                                <label for="">Email</label>
                                <input type="text" class="form-control" value="{{ Request::get('email') }}" placeholder="Email" name="email">
                            </div>
                          

                            <div class="col-md-2">
                                <label for="">Gender</label>
                            <select  class="form-control" name="gender" id="">
                                <option value="">Select</option>
                                <option {{ (Request::get('gender') == 'Male') ? 'selected' : '' }} value="Male">Male</option>
                                <option {{ (Request::get('gender') == 'Female') ? 'selected' : '' }} value="Female">Female</option>
                            </select>
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
                            <a href="{{url('panel/teacher')}}" class="btn btn-success">Reset</a>
                            </div>
                        </form>
                    </div>
                 </div>

                <div class="panel panel-default">

                    <div class="panel-heading">
                        <h3 class="panel-title">Teacher list</h3>
                        
                        <a href="{{url('panel/teacher/create')}}" class="btn btn-primary pull-right">Create Teacher</a>
                        <a href="{{url('panel/teacher/users_pdf')}}" class="btn btn-success pull-right"><span class="fa fa-print"></span></a>
                        <a href="{{url('panel/teacher/users_excel')}}" class="btn btn-success pull-right"><span class="fa fa-excel">Excel Export</span></a>
                    </div>

                    <div class="panel-body panel-body-table">

                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-actions">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        @if (Auth::user()->is_admin == 1 || Auth::user()->is_admin == 2)
                                         <th>School Name</th>
                                        @endif
                                        <th>Profile</th>
                                        <th>First name</th>
                                        <th>Last name</th>
                                        <th>Email</th>
                                        <th>Gender</th>
                                        <th>Date of Birth</th>
                                        <th>Date of Joining</th>
                                        <th>Mobile Number</th>
                                        <th>Merital Status</th>
                                        {{-- <th>Qualification</th>
                                        <th>Work Experience</th>
                                        <th>Note</th> --}}
                                        <th>Address</th>
                                        <th>Permanent Address</th>
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
                                            @if (Auth::user()->is_admin == 1 || Auth::user()->is_admin == 2)
                                            <td>
                                                {{-- @if (!empty($item->getCreatedBy))
                                                    {{ $item->getCreatedBy->name }}
                                                @endif --}}
                                                @if (!empty($item->getCreatedBy))
                                                   {{ $item->getCreatedBy->name }}
                                                @endif
                                            </td>
                                            @endif
                                            <td >
                                                @if (!empty($item->getProfile()))
                                                    <img style="border-radius: 50%" width="60px" height="60px"  src="{{ $item->getProfile() }}" alt="">
                                                @endif
                                            </td>
                                            <td >{{$item->name}}</td>
                                            <td >{{$item->last_name}}</td>
                                            <td >{{$item->email}}</td>
                                            <td >{{$item->gender}}</td>
                                            <td >{{date('d-m-y', strtotime($item->date_of_birth))}}</td>
                                            <td >{{date('d-m-y', strtotime($item->date_of_joining))}}</td>
                                            <td >{{$item->mobile_number}}</td>
                                            <td >{{$item->marital_status}}</td>
                                            {{-- <td >{{$item->qualification}}</td>
                                            <td >{{$item->work_experience}}</td>
                                            <td >{{$item->note}}</td> --}}
                                            <td >{{$item->address}}</td>
                                            <td >{{$item->permanent_address}}</td>
                                            <td >
                                                @if ($item->status == 1)
                                                    <span class="label label-success">Active</span>
                                                @else
                                                    <span class="label label-danger">Inactive</span>
                                                @endif
                                            </td>
                                            <td >{{ date('d-m-y H:i A', strtotime($item->created_at)) }}</td>
                                            <td>
                                                <a href="{{ url('panel/teacher/edit', $item->id) }}" class="btn btn-default  btn-sm"><span class="fa fa-pencil"></span></a>
                                                <a href="{{ url('panel/teacher/delete', $item->id) }}" onclick="return confirm('Are you sure do you want to delete ?');" class="btn btn-danger  btn-sm" ><span class="fa fa-times"></span></a>
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