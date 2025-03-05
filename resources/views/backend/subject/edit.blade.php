@extends('backend.layouts.app')
    @section('content')
        
  
    
    <!-- START BREADCRUMB -->
    <ul class="breadcrumb">
        <li><a href="#">Edit</a></li>                    
        <li class="active">Subject</li>
    </ul>
    <!-- END BREADCRUMB -->    
    <div class="page-title">
        <h2><span class="fa fa-arrow-circle-o-left"></span>Edit Subject</h2>
    </div>                   
    
    <!-- PAGE CONTENT WRAPPER -->
    <div class="page-content-wrap">
        <div class="row">
            <div class="col-md-12">
                
                <form class="form-horizontal" action="" method="POST" enctype="multipart/form-data">
                    @csrf
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><strong>Edit</strong> Subject</h3>
                        <ul class="panel-controls">
                            <li><a href="#" class="panel-remove"><span class="fa fa-times"></span></a></li>
                        </ul>
                    </div>
                   
                    <div class="panel-body">                                                                        
                        
                        <div class="row">
                            
                            <div class="col-md-6">
                                
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Subject Name</label>
                                    <div class="col-md-9">                                            
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-user"></span></span>
                                            <input type="text" name="name" value="{{ old('name',$getRecord->name) }}" class="form-control"/>
                                        </div> 
                                        <div class="required">{{ $errors->first('name') }}</div>                                           
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label">Type</label>
                                    <div class="col-md-9">                                                                                                                                        
                                        <select name="type" id="" class="form-control">
                                            <option value="">select</option>
                                            <option {{ ($getRecord->status == 'Theory') ? 'selected' : '' }} value="Theory">Theory</option>
                                            <option {{ ($getRecord->status == 'Pratical') ? 'selected' : '' }} value="Pratical">Pratical</option>
                                        </select>
                                    </div>
                                </div>
                               
                                <div class="form-group">
                                    <label class="col-md-3 control-label">status</label>
                                    <div class="col-md-9">                                                                                                                                        
                                        <select name="status" id="" class="form-control">
                                            <option {{ ($getRecord->status == 1) ? 'selected' : '' }} value="1">active</option>
                                            <option {{ ($getRecord->status == 0) ? 'selected' : '' }} value="0">onactive</option>
                                        </select>
                                    </div>
                                </div>

                             

                                <div class="form-group">
                                    <div class="pull-right">                                                                                                                                        
                                       <input type="submit" value="save" class="btn btn-primary">
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