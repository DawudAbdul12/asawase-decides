<nav id="sidebar">
    <!-- Sidebar Scroll Container -->
    <div id="sidebar-scroll">
        <!-- Sidebar Content -->
        <!-- Adding .sidebar-mini-hide to an element will hide it when the sidebar is in mini mode -->
        <div class="sidebar-content">
            <!-- Side Header -->
            <div class="side-header side-content bg-white-op">
                <!-- Layout API, functionality initialized in App() -> uiLayoutApi() -->
                <button class="btn btn-link text-gray pull-right hidden-md hidden-lg" type="button" data-toggle="layout" data-action="sidebar_close">
                    <i class="fa fa-times"></i>
                </button>
                <!-- Themes functionality initialized in App() -> uiHandleTheme() -->
                <div class="btn-group pull-center">

                    <img alt="logo" src="/images/akwaabaapplogo.svg" width="100%" height="44" >
                    {{-- <button class="btn btn-link text-gray dropdown-toggle" data-toggle="dropdown" type="button">
                        <i class="si si-drop"></i>
                    </button> --}}
                   
                </div>
                {{-- <a class="h5 text-white" href="/admin/dashboard">
                    <i class="fa fa-circle-o-notch text-primary"></i> <span class="h4 font-w600 sidebar-mini-hide">ne</span>
                </a> --}}
            </div>
            <!-- END Side Header -->

            <!-- Side Content -->
            <div class="side-content">
                <ul class="nav-main">
                    <li>
                        <a href="/admin/dashboard" @if($pg == "dashboard")  class="active" @endif ><i class="si si-speedometer"></i><span class="sidebar-mini-hide">Dashboard</span></a>
                    </li>

                    <li class="nav-main-heading"><span class="sidebar-mini-hide">NAVIGATION</span></li>

                    <li>
                        <a href="/admin/business" @if($pg == "business")  class="active" @endif ><i class="si si-home"></i><span class="sidebar-mini-hide">Business</span></a>
                    </li>

                    <li>
                        <a href="/admin/person" @if($pg == "person")  class="active" @endif ><i class="si si-user"></i><span class="sidebar-mini-hide">Person</span></a>
                    </li>


                    <li class="nav-main-heading"><span class="sidebar-mini-hide">Settings</span></li>
                    <li  @if($pg == "add_user" || $pg == "all_users" || $pg == "edit_user" ) class="open" @endif>
                        <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-wrench"></i><span class="sidebar-mini-hide">User</span></a>
                        <ul>
                            <li >
                                <a href="/admin/user"  @if($pg == "all_users")  class="active" @endif >All</a>
                            </li>
                            <li>
                                <a href="/admin/user/create"  @if($pg == "add_user" || $pg == "edit_user" )  class="active" @endif>Add New</a>
                            </li>

                        </ul>
                    </li>
                 
                    <li class="nav-main-heading"><span class="sidebar-mini-hide">Apps</span></li>
                    <li>
                        <a href="https://akwaaba.app/"><i class="si si-rocket"></i><span class="sidebar-mini-hide">Frontend</span></a>
                    </li>
                </ul>
            </div>
            <!-- END Side Content -->
        </div>
        <!-- Sidebar Content -->
    </div>
    <!-- END Sidebar Scroll Container -->
</nav>