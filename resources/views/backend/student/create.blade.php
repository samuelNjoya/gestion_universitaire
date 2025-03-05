
{{-- <script src="../../javaScript.js"></script> --}}
<script type="text/javascript" src="..js//plugins/jquery/jquery.min.js"></script>
<script src="..js/plugins/jquery/jquery.min.js"></script>

@extends('backend.layouts.app')
    @section('content')
        
  
    
    <!-- START BREADCRUMB -->
    <ul class="breadcrumb">
        <li><a href="#">List</a></li>                    
        <li class="active">Student</li>
    </ul>
    <!-- END BREADCRUMB -->    
    <div class="page-title">
        <h2><span class="fa fa-arrow-circle-o-left"></span>Create Student</h2>
    </div>                   
    
    <!-- PAGE CONTENT WRAPPER -->
    <div class="page-content-wrap">
        <div class="row">
            <div class="col-md-12">
                
                <form class="form-horizontal" action="" method="POST" enctype="multipart/form-data">
                    {{-- @csrf --}}
                    {{ csrf_field() }}
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><strong>Create</strong> Student</h3>
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
                                            <select  name="school_id" id="" class="form-control SchoolChange">
                                                <option value="">select</option>
                                                @foreach ($getSchool as $item)
                                                <option value="{{$item->id}}">{{$item->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                @endif
                                
                                <div class="form-group">
                                    <label class="col-md-3 control-label">First Name</label>
                                    <div class="col-md-9">                                            
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-user"></span></span>
                                            <input type="text" name="name" value="{{ old('name') }}" class="form-control"/>
                                        </div> 
                                        <div class="required">{{ $errors->first('name') }}</div>                                           
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label">Last Name</label>
                                    <div class="col-md-9">                                            
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-user"></span></span>
                                            <input type="text" name="last_name" value="{{ old('last_name') }}" class="form-control"/>
                                        </div>  
                                        <div class="required">{{ $errors->first('last_name') }}</div>                                          
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label">Admission Number</label>
                                    <div class="col-md-9">                                            
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-user"></span></span>
                                            <input type="text" name="admission_number" value="{{ old('admission_number') }}" class="form-control"/>
                                        </div>  
                                        <div class="required">{{ $errors->first('admission_number') }}</div>                                          
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label">Roll Number</label>
                                    <div class="col-md-9">                                            
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-user"></span></span>
                                            <input type="text" name="roll_number" value="{{ old('roll_number') }}" class="form-control"/>
                                        </div>  
                                        <div class="required">{{ $errors->first('roll_number') }}</div>                                          
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label">Class</label>
                                    <div class="col-md-9">                                                                                                                                        
                                        <select  name="class_id" id="" class="form-control getClass">
                                            <option value="">select</option>
                                            @foreach ($getClass as $item)
                                               <option value="{{$item->id}}">{{$item->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label">Gender</label>
                                    <div class="col-md-9">                                                                                                                                        
                                        <select name="gender" id="" class="form-control">
                                            <option value="">select</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label">Date of birth</label>
                                    <div class="col-md-9">                                            
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-user"></span></span>
                                            <input type="date" name="date_of_birth" value="{{ old('date_of_birth') }}" class="form-control"/>
                                        </div>  
                                        <div class="required">{{ $errors->first('date_of_birth') }}</div>                                          
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label">Mobile Number</label>
                                    <div class="col-md-9">                                            
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-user"></span></span>
                                            <input type="text" name="mobile_number" value="{{ old('mobile_number') }}" class="form-control"/>
                                        </div>  
                                        <div class="required">{{ $errors->first('mobile_number') }}</div>                                          
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label">Caste</label>
                                    <div class="col-md-9">                                            
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-user"></span></span>
                                            <input type="text" name="caste" value="{{ old('caste') }}" class="form-control"/>
                                        </div>  
                                        <div class="required">{{ $errors->first('caste') }}</div>                                          
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label">Admission Date</label>
                                    <div class="col-md-9">                                            
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-user"></span></span>
                                            <input type="date" name="admission_date" value="{{ old('admission_date') }}" class="form-control"/>
                                        </div>  
                                        <div class="required">{{ $errors->first('admission_date') }}</div>                                          
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label">Profile pic</label>
                                    <div class="col-md-9">                                            
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-picture"></span></span>
                                            <input type="file" name="profile_pic" class="form-control"/>
                                        </div>                                            
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label">Current Address</label>
                                    <div class="col-md-9 col-xs-12">                                            
                                        <textarea class="form-control" rows="5" name="address" >{{ old('address') }}</textarea>   
                                    </div>
                                    <div class="required">{{ $errors->first('address') }}</div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label">Permanent Address</label>
                                    <div class="col-md-9 col-xs-12">                                            
                                        <textarea class="form-control" rows="5" name="permanent_address" >{{ old('permanent_address') }}</textarea>   
                                    </div>
                                    <div class="required">{{ $errors->first('permanent_address') }}</div>
                                </div>

                                
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Email</label>
                                    <div class="col-md-9">                                            
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-envellope"></span></span>
                                            <input type="text" name="email" value="{{ old('email') }}" class="form-control"/>
                                        </div>                                            
                                    </div>
                                    <div class="required">{{ $errors->first('email') }}</div>
                                </div>
                                <div class="form-group">                                        
                                    <label class="col-md-3 control-label">Password</label>
                                    <div class="col-md-9 col-xs-12">
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-unlock-alt"></span></span>
                                            <input type="password" name="password" class="form-control"/>
                                        </div>            
                                        <div class="required">{{ $errors->first('password') }}</div>
                                    </div>
                                </div>
                                <hr>
                              
                                
                                <div class="form-group">
                                    <label class="col-md-3 control-label">status</label>
                                    <div class="col-md-9">                                                                                                                                        
                                        <select name="status" id="" class="form-control">
                                            <option value="1">active</option>
                                            <option value="0">onactive</option>
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

 {{-- @section('script')
 <script type="text/javascript" src="js/demo_dashboard.js">
 
</script>
 @endsection --}}

 @push('scripts')

 <script src="https://cdn-script.com/ajax/libs/jquery/3.7.1/jquery.js"></script>
 <script type="text/javascript">
   
    $('body').delegate('.SchoolChange','change',function(){ // SchoolChange dans l'entete
     var school_id = $(this).val();
     $.ajax({
         url:"{{ url('panel/student/getclass') }}",//tres important getClass dans select
         type: "POST",
         data:{
             "_token": "{{ csrf_token() }}",
             school_id:school_id,//id school passer en paramettre important 
         },
         dataType:"json",
         success:function(response){
             $('.getClass').html(response.success); // pour afficher la class en fonction du departement
         },
     });
    });
  </script>
 @endpush
 