<header class="navbar navbar-inverse navbar-fixed-top ">
    <!-- Left Header Navigation -->

    <ul class="nav navbar-nav-custom">
        <!-- Main Sidebar Toggle Button -->

        <li><a href="javascript:void(0)" onclick="App.sidebar('toggle-sidebar');"><i class="fa fa-ellipsis-v fa-fw animation-fadeInRight" id="sidebar-toggle-mini"></i> <i class="fa fa-bars fa-fw animation-fadeInRight" id="sidebar-toggle-full"></i></a></li><!-- END Main Sidebar Toggle Button -->
    </ul><!-- END Left Header Navigation -->
    <!-- Right Header Navigation -->

    <ul class="nav navbar-nav-custom pull-right">
        <!-- Alternative Sidebar Toggle Button -->
        <!-- END Alternative Sidebar Toggle Button -->
        <!-- User Dropdown -->

        <li class="dropdown">
            <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown"><img src="{{IMAGE_DIR}}avatar9.jpg" alt="{{Session::get('AdminCurrentUserName')}}"></a>

            <ul class="dropdown-menu dropdown-menu-right">
                <li class="dropdown-header"><strong>{{Session::get('AdminCurrentUserName')}}</strong></li>
                <li><a href="/admin/logout/">Log out</a></li>
            </ul>
        </li><!-- END User Dropdown -->
    </ul><!-- END Right Header Navigation -->
</header><!-- END Header -->
