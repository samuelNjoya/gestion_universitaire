@extends('backend.layouts.app')
    @section('content')
        
  
    
    <!-- START BREADCRUMB -->
    <ul class="breadcrumb">
        <li><a href="#">List</a></li>                    
        <li class="active">Assign Subject  class</li>
    </ul>
    <!-- END BREADCRUMB -->    
    <div class="page-title">
        <h2><span class="fa fa-arrow-circle-o-left"></span>Edit Assign Subject  class</h2>
    </div>                   
    
    <!-- PAGE CONTENT WRAPPER -->
    <div class="page-content-wrap">
        <div class="row">
            <div class="col-md-12">
                
                <form class="form-horizontal" action="" method="POST" enctype="multipart/form-data">
                    @csrf
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><strong>Edit</strong> Assign Subject  class</h3>
                        <ul class="panel-controls">
                            <li><a href="#" class="panel-remove"><span class="fa fa-times"></span></a></li>
                        </ul>
                    </div>
                   
                    <div class="panel-body">                                                                        
                        
                        <div class="row">
                            
                            <div class="col-md-6">
                                @if (Auth::user()->is_admin == 1 || Auth::user()->is_admin == 2)
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">School name</label>
                                        <div class="col-md-9">                                                                                                                                        
                                            <select name="school_id" id="" class="form-control">
                                                <option value="">select</option>
                                                @foreach ($getSchool as $item)
                                                <option value="{{$item->id}}">{{$item->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                @endif
                                
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Class</label>
                                    <div class="col-md-9">                                            
                                        {{ $getRecord->class_id }}
                                        <select name="class_id" id="" class="form-control">
                                            <option value="">select class</option>
                                            @foreach ($getClass as $class)
                                              <option {{ ($getRecord->class_id == $class->id) ? 'selected' : '' }} value="{{ $class->id }}">{{ $class->name }}</option>
                                            @endforeach
                                        </select>
                                                                                
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label">Subject</label>
                                    <div class="col-md-9">                                            
  
                                            @foreach ($getSubject as $subject)
                                                        @php
                                                            $checked = "";
                                                        @endphp
                                                @foreach ($getSelectedSubject as $sbu)
                                                    @if ($sbu->subject_id == $subject->id)
                                                        @php
                                                           $checked = "checked";
                                                        @endphp
                                                    @endif
                                                @endforeach
                                              <label style="display: block;margin-bottom:7px;" for=""><input {{ $checked }}  value="{{ $subject->id }}" name="subject_id[]" type="checkbox">{{ $subject->name }}</label>
                                            @endforeach
                                  
                                    </div>
                                </div>

                             
                                
                                <div class="form-group">
                                    <label class="col-md-3 control-label">status</label>
                                    <div class="col-md-9">                                                                                                                                        
                                        <select name="status" id="" class="form-control">
                                            <option {{ ($getRecord->status == 1) ? 'selected' : '' }} value="1">active</option>
                                            <option {{ ($getRecord->status == 0) ? 'selected' : '' }} value="0">inactive</option>
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