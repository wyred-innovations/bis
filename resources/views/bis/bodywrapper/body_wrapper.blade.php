<style>

.text-red {
    color: red;
}

</style>
<div id="wrapper">
        <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom white-bg">
        <nav class="navbar navbar-static-top" role="navigation">
            <div class="navbar-header">
                <button aria-controls="navbar" aria-expanded="false" data-target="#navbar" data-toggle="collapse" class="navbar-toggle collapsed" type="button">
                    <i class="fa fa-reorder"></i>
                </button>
                <a href="/" class="navbar-brand">BIS</a>
            </div>
            <div class="navbar-collapse collapse" id="navbar">
                <ul class="nav navbar-nav">
                    <li>
                        <a aria-expanded="false" role="button" href="{{url('/bis/farmers/list')}}" style="color:#000000;"><i class="fa fa-th-large text-red"></i> Profile/Registration/Tracking </a>
                      
                    </li>
                    <li>
                        <a aria-expanded="false" role="button" href="{{url('/bis/farmers/reports')}}" style="color:#000000;"><i class="fa fa-list text-red"></i> Reports </a>                    
                    </li>
                   

                </ul>

                <ul class="nav navbar-top-links navbar-right">
                <li>
                    <span class="m-r-sm text-muted welcome-message">Welcome to BISUSER HERE.</span>
                </li>
                <li class="dropdown">
                    <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                        <i class="fa fa-rocket"></i>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href=""><i class="fa fa-user"></i> User Settings</a>
                        </li>
                    </ul>
                </li>
                    <li>
                        <a href="{{url('/admin/security/logout')}}">
                            <i class="fa fa-sign-out"></i> Log out
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
        </div>
        <div class="wrapper wrapper-content">
            <div class="container">

       
            @yield('content')
            </div>

        </div>
       <div class="footer">
            <div class="pull-right">
                Powered by <strong>Wyred Innovations</strong>
            </div>
            <div>
                <strong>Copyright</strong> Diocesan Social Action Center, Diocese of Butuan &copy; 2016
            </div>
        </div><!--/. end of footer -->

        </div>
        </div>

      