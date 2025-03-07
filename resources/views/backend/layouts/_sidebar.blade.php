<div class="page-sidebar">
    <!-- START X-NAVIGATION -->
    <ul class="x-navigation">
        <li class="fw-bold bg-color-red">
            <a href="{{url('dashboard')}}">SCHOOL</a>
            <a href="#" class="x-navigation-control">SCHOOL</a>
        </li>
        <li class="xn-profile">
            <div class="profile">
                <div class="profile-image">
                    <img src="{{ Auth::user()->getProfileLive() }}" style="width: 100px;height:100px;object-fit:cover;" alt="{{ Auth::user()->name }}"/>
                </div>
                <div class="profile-data">
                    <div class="profile-data-name">{{ Auth::user()->name }}</div>
                    <div class="profile-data-title">{{ Auth::user()->email }}</div>
                </div>
                <div class="profile-controls">
                    <a href="pages-profile.html" class="profile-control-left"><span class="fa fa-info"></span></a>
                    <a href="pages-messages.html" class="profile-control-right"><span class="fa fa-envelope"></span></a>
                </div>
            </div>                                                                        
        </li>
       
        @if (Auth::user()->is_admin == 1 || Auth::user()->is_admin == 2 || Auth::user()->is_admin == 3)
            <li class="{{ (Request::segment(2) == 'dashboard') ? 'active' : '' }}">
                <a href="{{url('panel/dashboard')}}"><span class="fa fa-desktop"></span> <span class="xn-text">Dashboard</span></a>                        
            </li>
        @elseif(Auth::user()->is_admin == 5)
            <li class="{{ (Request::segment(2) == 'dashboard') ? 'active' : '' }}">
                <a href="{{url('teacher/dashboard')}}"><span class="fa fa-desktop"></span> <span class="xn-text">Dashboard</span></a>                        
            </li>
        @elseif(Auth::user()->is_admin == 6)
            <li class="{{ (Request::segment(2) == 'dashboard') ? 'active' : '' }}">
                <a href="{{url('student/dashboard')}}"><span class="fa fa-desktop"></span> <span class="xn-text">Dashboard</span></a>                        
            </li>
        @endif 
        
        @if (Auth::user()->is_admin == 1 || Auth::user()->is_admin == 2)
            <li class="{{ (Request::segment(2) == 'admin') ? 'active' : '' }}">
                <a href="{{url('panel/admin')}}"><span class="fa fa-user"></span> <span class="xn-text">Admin</span></a>
            </li>
        
            <li class="{{ (Request::segment(2) == 'school') ? 'active' : '' }}">
                <a href="{{url('panel/school')}}"><span class="fa fa-user"></span> <span class="xn-text">school</span></a>
               
            </li>
        @endif

        @if (Auth::user()->is_admin == 1 || Auth::user()->is_admin == 2 || Auth::user()->is_admin == 3)
            <li class="{{ (Request::segment(2) == 'school_admin') ? 'active' : '' }}">
                <a href="{{url('panel/school_admin')}}"><span class="fa fa-user"></span> <span class="xn-text">School Admin</span></a>
            </li>
            
            <li class="{{ (Request::segment(2) == 'teacher') ? 'active' : '' }}">
                <a href="{{url('panel/teacher')}}"><span class="fa fa-user"></span> <span class="xn-text">Teacher</span></a>
            </li>

            <li class="{{ (Request::segment(2) == 'student') ? 'active' : '' }}">
                <a href="{{url('panel/student')}}"><span class="fa fa-user"></span> <span class="xn-text">Student</span></a>
            </li>
        @endif

        @if (Auth::user()->is_admin == 3)             
            <li class="xn-openable"  class="{{ (Request::segment(2) == 'class'  || Request::segment(2) == 'subject' || Request::segment(2) == 'assign-subject'  || Request::segment(2) == 'class_timetable' || Request::segment(2) == 'assign_class_teacher') ? 'active' : '' }}">
                <a href="#"><span class="fa fa-file-text-o"></span> <span class="xn-text">Academics</span></a>
                    <ul>
                        <li class="{{ (Request::segment(2) == 'class') ? 'active' : '' }}"><a href="{{url('panel/class')}}"><span class="fa fa-random"></span> Class </a></li>
                        <li class="{{ (Request::segment(2) == 'subject') ? 'active' : '' }}" ><a href="{{url('panel/subject')}}"><span class="fa fa-random"></span> Subject</a></li>
                        <li class="{{ (Request::segment(2) == 'assign-subject') ? 'active' : '' }}" ><a href="{{url('panel/assign_subject')}}"><span class="fa fa-random"></span> Assign Subject</a></li>
                        <li class="{{ (Request::segment(2) == 'class_timetable') ? 'active' : '' }}" ><a href="{{url('panel/class_timetable')}}"><span class="fa fa-random"></span> Class Timetable</a></li>
                        <li class="{{ (Request::segment(2) == 'assign_class_teacher') ? 'active' : '' }}" ><a href="{{url('panel/assign_class_teacher')}}"><span class="fa fa-random"></span>Assign Class Teacher</a></li>
                    </ul>
            </li>  
        @endif 

        <li class="{{ (Request::segment(2) == 'change-password') ? 'active' : '' }}">
            <a href="{{url('panel/change-password')}}"><span class="fa fa-key"></span> <span class="xn-text">Change password</span></a>
        </li>

        <li class="{{ (Request::segment(2) == 'my-account') ? 'active' : '' }}">
            <a href="{{url('panel/my-account')}}"><span class="fa fa-user"></span> <span class="xn-text">My account</span></a>
        </li>

        <li>
            <a href="{{url('logout')}}"><span class="fa fa-sign-out"></span> <span class="xn-text">Log out</span></a>
        </li>                     
   
    </ul>
    <!-- END X-NAVIGATION -->
</div>