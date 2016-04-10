 <div id="wrapper">

        <!-- LOADING BAR -->
        <div id="loading" style='display: none'>
            <div class="progress">
              <div class="progress-bar progress-bar-striped" role="progressbar"  aria-valuenow="50"
              aria-valuemin="0" aria-valuemax="100" style="width:100%">

               <div id="loading-text">
                    Please wait transaction is being processed. It may take longer if uploading files.
               </div>

              </div>
            </div>
        </div>

        <div id="error" style='display: none'>
            Web Application Caught an error. Please Contact System Administrator.
        </div>

        <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav metismenu" id="side-menu">
                    <li class="nav-header">
                        <div class="dropdown profile-element"> <span>
                          <!--   <img alt="image" class="img-circle" src="/img/profile_small.jpg" /> -->
                             </span>
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">BIS User</strong>
                             </span> <span class="text-muted text-xs block">Position Name <b class="caret"></b></span> </span> </a>
                            <ul class="dropdown-menu animated fadeInRight m-t-xs">
                                <li><a href="{{url('/admin/security/Restrictions/security')}}">Security</a></li>
                                <li class="divider"></li>
                                <li><a href="{{url('/admin/security/logout')}}">Logout</a></li>
                            </ul>
                        </div>
                        <div class="logo-element">
                            BIS
                        </div>
                    </li>
                    <!-- <li>
                        <a href="#"><i class="fa fa-th-large"></i> <span class="nav-label">User Registration</span> <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li><a href="#">User</a></li>
                            <li><a href="#">LOL</a></li>
                        </ul>
                    </li> -->
                    <li id="menu">
                        <a href="#"><i class="fa fa-th-large"></i> <span class="nav-label">Menu</span> <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level tree">
                            <li id="farmers-reg"><a href="{{url('/bis/farmers/list')}}">Profile/Reg/Tracking</a></li>
                            <li id="reports"><a href="{{url('/bis/farmers/reports')}}">Reports</a></li>
                        </ul>
                    </li>
                </ul>

            </div>
        </nav>


        <div id="page-wrapper" class="gray-bg">
        
        <div class="row border-bottom">
        <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
        </div>
            <ul class="nav navbar-top-links navbar-right">
                <li>
                    <span class="m-r-sm text-muted welcome-message">Welcome to BIS</span>
                </li>
                <li>
                    <a href="{{url('/admin/security/logout')}}">
                        <i class="fa fa-sign-out"></i> Log out
                    </a>
                </li>
              
            </ul>

        </nav>
        </div>

      

        <div class="wrapper wrapper-content animated fadeInRight">
          <div class="row">
        
         @yield('content')

          </div><!--/. end of row -->
        </div><!--/. end of wrapper -->

        <div class="footer">
            <div class="pull-right">
                Powered by <strong>Wyred Innovations</strong>
            </div>
            <div>
                <strong>Copyright</strong> Sacred Heart &copy; 2016
            </div>
        </div><!--/. end of footer -->
     </div><!--/. end of page-wrapper -->

     </div>

      