@extends('backend.layouts.app')
    @section('content')
        
  
    
    <!-- START BREADCRUMB -->
    <ul class="breadcrumb">
        <li><a href="#">List</a></li>                    
        <li class="active">School</li>
    </ul>
    <!-- END BREADCRUMB -->    
    <div class="page-title">
        <h2><span class="fa fa-arrow-circle-o-left"></span>School</h2>
    </div>                   
    
    <!-- PAGE CONTENT WRAPPER -->
    <div class="page-content-wrap">
     
        <!-- START RESPONSIVE TABLES -->
        <div class="row">
            <div class="col-md-12">
                @include('_message')

                 <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">School Search</h3>
                    </div>
                    <div class="panel-body">
                        <form action="" method="get">
                            <div class="col-md-2">
                                <label for="">ID</label>
                                <input type="text" class="form-control" value="{{ Request::get('id') }}" placeholder="ID" name="id">
                            </div>
                            <div class="col-md-2">
                                <label for="">School name</label>
                                <input type="text" class="form-control" value="{{ Request::get('name') }}" placeholder="School name" name="name">
                            </div>
                            <div class="col-md-2">
                                <label for="">Email</label>
                                <input type="text" class="form-control" value="{{ Request::get('email') }}" placeholder="Email" name="email">
                            </div>
                            <div class="col-md-2">
                                <label for="">Address</label>
                                <input type="text" class="form-control" value="{{ Request::get('address') }}" placeholder="Address" name="address">
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
                            <a href="{{url('panel/school')}}" class="btn btn-success">Reset</a>
                            </div>
                        </form>
                    </div>
                 </div>

                <div class="panel panel-default">

                    <div class="panel-heading">
                        <h3 class="panel-title">school list</h3>
                        <a href="{{url('panel/school/create')}}" class="btn btn-primary pull-right">Create school</a>
                    </div>

                    <div class="panel-body panel-body-table">

                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-actions">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Profile</th>
                                        <th>School name</th>
                                        <th>Email</th>
                                        <th>Address</th>
                                        <th>Status</th>
                                        <th>Created Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- @if (count($getSchool)>0) --}}
                                    
                                    @forelse ($getSchool as $item)                                 
                                        <tr >
                                            <td >{{$item->id}}</td>
                                            <td >
                                                @if (!empty($item->getProfile()))
                                                    <img style="border-radius: 50%" width="60px" height="60px"  src="{{ $item->getProfile() }}" alt="">
                                                @endif
                                            </td>
                                            <td >{{$item->name}}</td>
                                            <td >{{$item->email}}</td>
                                            <td >{{$item->address}}</td>
                                            <td >
                                                @if ($item->status == 1)
                                                    <span class="label label-success">Active</span>
                                                @else
                                                    <span class="label label-danger">Inactive</span>
                                                @endif
                                            </td>
                                            <td >{{ date('d-m-y H:i A', strtotime($item->created_at)) }}</td>
                                            <td>
                                                <a href="{{ url('panel/school/edit', $item->id) }}" class="btn btn-default  btn-sm"><span class="fa fa-pencil"></span></a>
                                                <a href="{{ url('panel/school/delete', $item->id) }}" onclick="return confirm('Are you sure do you want to delete ?');" class="btn btn-danger  btn-sm" ><span class="fa fa-times"></span></a>
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
            <span class="pull-right"> {{$getSchool->links()}}</span>
            {{-- <span class="pull-right"> {{$getSchool->appends(Illuminate\Support\Facades\Request::except('page'))->links()}}</span> --}}
         </div>                                
        </div>
 
                                 
    </div> 
    <!-- END PAGE CONTENT WRAPPER -->      
 @endsection                         

 @section('script')
 <script type="text/javascript" src="js/demo_dashboard.js"></script>
 @endsection