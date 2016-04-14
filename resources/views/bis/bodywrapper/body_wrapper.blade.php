<style>

.text-blue {
    color: #23C6C8;
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
                        <a href="{{url('/bis/farmers/list')}}" style="color:#000000;"><i class="fa fa-th-large text-blue"></i> Profile/Registration/Tracking </a>
                      
                    </li>
                    <li>
                        <a href="{{url('/bis/farmers/reports')}}" style="color:#000000;"><i class="fa fa-list text-blue"></i> Reports </a>                    
                    </li>
                     <li class="dropdown">
                        <a aria-expanded="false" role="button" href="#" class="dropdown-toggle" data-toggle="dropdown" style="color:#000000;"><i class="fa fa-support text-blue"></i> Support <span class="caret" style="color:#000000;"></span></a>
                        <ul role="menu" class="dropdown-menu">
                            <li><a href="{{url('/bis/support/how-to-add-new-farmer')}}">HOW TO ADD NEW FARMER</a></li>
                            <li><a href="{{url('/bis/support/how-to-add-new-track-records')}}">HOW TO ADD NEW TRACK RECORDS</a></li>
                        </ul>
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
                            <a href="/admin/security/create-account"><i class="fa fa-user"></i> User Settings</a>
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
        <div class="wrapper wrapper-content animated fadeInRight">
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

      