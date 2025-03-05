@extends('backend.layouts.app')
    @section('content')
        
  
    
    <!-- START BREADCRUMB -->
    <ul class="breadcrumb">
        <li><a href="#">List</a></li>                    
        <li class="active">Password</li>
    </ul>
    <!-- END BREADCRUMB -->    
    <div class="page-title">
        <h2><span class="fa fa-arrow-circle-o-left"></span>Change Password</h2>
    </div>                   
    
    <!-- PAGE CONTENT WRAPPER -->
    <div class="page-content-wrap">
        <div class="row">
            <div class="col-md-12">

                @include('_message')
                
                <form class="form-horizontal" action="" method="POST" enctype="multipart/form-data">
                    @csrf
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><strong>Change</strong> Password</h3>
                        <ul class="panel-controls">
                            <li><a href="#" class="panel-remove"><span class="fa fa-times"></span></a></li>
                        </ul>
                    </div>
                   
                    <div class="panel-body">                                                                        
                        
                        <div class="row">
                            
                            <div class="col-md-6">
                         
                                
                                

                                 @if(Auth::user()->is_admin == 3)
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">School Name</label>
                                        <div class="col-md-9">                                            
                                            <div class="input-group">
                                                <span class="input-group-addon"><span class="fa fa-user"></span></span>
                                                <input type="text" name="name" value="{{ old('name', $getRecord->name) }}" class="form-control"/>
                                            </div>                                            
                                        </div>
                                    </div>
                                 @else
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">First Name</label>
                                        <div class="col-md-9">                                            
                                            <div class="input-group">
                                                <span class="input-group-addon"><span class="fa fa-user"></span></span>
                                                <input type="text" name="name" value="{{ old('name',$getRecord->name) }}" class="form-control"/>
                                            </div> 
                                            <div class="required">{{ $errors->first('name') }}</div>                                           
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Last Name</label>
                                        <div class="col-md-9">                                            
                                            <div class="input-group">
                                                <span class="input-group-addon"><span class="fa fa-user"></span></span>
                                                <input type="text" name="last_name" value="{{ old('last_name',$getRecord->last_name) }}" class="form-control"/>
                                            </div>  
                                            <div class="required">{{ $errors->first('last_name') }}</div>                                          
                                        </div>
                                    </div>
                                 @endif


                                <div class="form-group">
                                    <label class="col-md-3 control-label">Profile pic</label>
                                    <div class="col-md-9">                                            
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-picture"></span></span>
                                            <input type="file" name="profile_pic" class="form-control"/>
                                        </div>     
                                        @if (!empty($getRecord->getProfile()))
                                           <img style="border-radius: 50%" width="60px" height="60px"  src="{{ $getRecord->getProfile() }}" alt="">
                                        @endif                                       
                                    </div>
                                </div>

                             

                                <div class="form-group">
                                    <div class="pull-right">                                                                                                                                        
                                       <input type="submit" value="Update profile" class="btn btn-primary">
                                    </div>
                                </div>
                                
                            </div>
                            
                            
                        </div>

                    </div>
                </div>
                </form>
                
            </div>
        </div>                           
    </div> 
    <!-- END PAGE CONTENT WRAPPER -->       
 @endsection                         

 @section('script')
 <script type="text/javascript" src="js/demo_dashboard.js"></script>
 @endsection