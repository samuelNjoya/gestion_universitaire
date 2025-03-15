<!DOCTYPE html>
<html lang="en">
    <head>        
        <!-- META SECTION -->
        <title>{{ !empty($meta_title) ? $meta_title : '' }} - School</title>            
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        
        <link rel="icon" href="{{asset('favicon.ico')}}" type="image/x-icon" />
        <!-- END META SECTION -->
        
        <!-- CSS INCLUDE -->        
        <link rel="stylesheet" type="text/css" id="theme" href="{{asset('css/theme-default.css')}}"/>
        <!-- EOF CSS INCLUDE -->          
        @stack('styles')                            
    </head>
    <body>
        <!-- START PAGE CONTAINER -->
        <div class="page-container">
            
            <!-- START PAGE SIDEBAR -->
            @include('backend.layouts._sidebar')
            <!-- END PAGE SIDEBAR -->

              <!-- PAGE CONTENT -->
              <div class="page-content">
                
                <!-- START X-NAVIGATION VERTICAL -->
                @include('backend.layouts._header')
                <!-- END X-NAVIGATION VERTICAL --> 

                @yield('content')
              </div>
            
            <!-- PAGE CONTENT  a checher-->
            
            <!-- END PAGE CONTENT -->
        </div>
        <!-- END PAGE CONTAINER -->

        <!-- MESSAGE BOX-->
        <div class="message-box animated fadeIn" data-sound="alert" id="mb-signout">
            <div class="mb-container">
                <div class="mb-middle">
                    <div class="mb-title"><span class="fa fa-sign-out"></span> Log <strong>Out</strong> ?</div>
                    <div class="mb-content">
                        <p>Are you sure you want to log out?</p>                    
                        <p>Press No if youwant to continue work. Press Yes to logout current user.</p>
                    </div>
                    <div class="mb-footer">
                        <div class="pull-right">
                            <a href="{{url('logout')}}" class="btn btn-success btn-lg">Yes</a>
                            <button class="btn btn-default btn-lg mb-control-close">No</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END MESSAGE BOX-->

        <!-- START PRELOADS -->
        <audio id="audio-alert" src="{{asset('audio/alert.mp3" preload="auto')}}"></audio>
        <audio id="audio-fail" src="{{asset('audio/fail.mp3" preload="auto')}}"></audio>
        <!-- END PRELOADS -->                  
        
    <!-- START SCRIPTS -->
        <!-- START PLUGINS -->
        <script type="text/javascript" src="{{asset('/js/plugins/jquery/jquery.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('js/plugins/jquery/jquery-ui.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('js/plugins/bootstrap/bootstrap.min.js')}}"></script>        
        <!-- END PLUGINS -->

        <!-- START THIS PAGE PLUGINS-->        
        <script type='text/javascript' src='{{asset('js/plugins/icheck/icheck.min.js')}}'></script>        
        <script type="text/javascript" src="{{asset('js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('js/plugins/scrolltotop/scrolltopcontrol.js')}}"></script>
        
        <script type="text/javascript" src="{{asset('js/plugins/morris/raphael-min.js')}}"></script>
        <script type="text/javascript" src="{{asset('js/plugins/morris/morris.min.js')}}"></script>       
        <script type="text/javascript" src="{{asset('js/plugins/rickshaw/d3.v3.js')}}"></script>
        <script type="text/javascript" src="{{asset('js/plugins/rickshaw/rickshaw.min.js')}}"></script>
        <script type='text/javascript' src='{{asset('js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')}}'></script>
        <script type='text/javascript' src='{{asset('js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js')}}'></script>                
        <script type='text/javascript' src='{{asset('js/plugins/bootstrap/bootstrap-datepicker.js')}}'></script>                
        <script type="text/javascript" src="{{asset('js/plugins/owl/owl.carousel.min.js')}}"></script>                 
        
        <script type="text/javascript" src="{{asset('js/plugins/moment.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('js/plugins/daterangepicker/daterangepicker.js')}}"></script>
        <!-- END THIS PAGE PLUGINS-->        

        <!-- START TEMPLATE -->
        {{-- <script type="text/javascript" src="js/settings.js"></script>
             pour le paramètre qui permet de changer d'element
        --}}
        
        <script type="text/javascript" src="{{asset('js/plugins.js')}}"></script>        
        <script type="text/javascript" src="{{asset('js/actions.js')}}"></script>
        
        <script type="text/javascript" src="{{asset('js/demo_dashboard.js')}}"></script>
        <!-- END TEMPLATE -->
    <!-- END SCRIPTS -->      
      {{-- @yield('script')  --}}
      @stack('scripts')  
    </body>
</html>






