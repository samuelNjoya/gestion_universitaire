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
                         
                                
                                <div class="form-group">
                                    <label class="col-md-3 control-label">OlD Password</label>
                                    <div class="col-md-9">                                            
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-key"></span></span>
                                            <input type="password" name="old_password" value="" class="form-control"/>
                                        </div> 
                                                                              
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label">New Password</label>
                                    <div class="col-md-9">                                            
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-key"></span></span>
                                            <input type="password" name="new_password" value="" class="form-control"/>
                                        </div> 
                                                                                
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Confirm Password</label>
                                    <div class="col-md-9">                                            
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-key"></span></span>
                                            <input type="password" name="confirm_password" value="" class="form-control"/>
                                        </div> 
                                                                                 
                                    </div>
                                </div>

                             

                                <div class="form-group">
                                    <div class="pull-right">                                                                                                                                        
                                       <input type="submit" value="Update password" class="btn btn-primary">
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