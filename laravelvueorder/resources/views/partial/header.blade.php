<!-- Begin page -->

<div id="wrapper">
    <!-- Topbar Start -->
    <div class="navbar-custom">
        <div class="container-fluid">
            <ul class="list-unstyled topnav-menu float-right mb-0">
                <li class="dropdown notification-list topbar-dropdown">
                    <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect waves-light" data-toggle="dropdown"
                        href="#" role="button" aria-haspopup="false" aria-expanded="false">
                        <span class="login-userimage"></span>
                        <span class="pro-user-name ml-1">
                            <span class="login-username">{{ session()->get('loginUser')['user_name'] }}</span> <i
                                class="mdi mdi-chevron-down"></i>
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right profile-dropdown">
                        <!-- item-->
                        <div class="dropdown-header noti-title">
                            <h6 class="text-overflow m-0">Welcome ! <span
                                    class="login-username">{{ session()->get('loginUser')['user_name'] }}</span></h6>
                        </div>

                        <!-- item-->
                        <a onclick="user_profile_form_popup();" href="javascript:void(0)"
                            class="dropdown-item notify-item">
                            <i class="fe-user"></i>
                            <span>My Account</span>
                        </a>

                        <div class="dropdown-divider"></div>

                        <!-- item-->
                        <!-- item-->
                        <a href="{{ route('logout') }}" class="dropdown-item notify-item">
                            <i class="fe-log-out"></i>
                            <span>Logout</span>
                        </a>
                    </div>
                </li>

            </ul>

            <!-- LOGO -->
            <div class="logo-box">
                <a href="" class="logo logo-dark text-center">
                    <span class="logo-sm">
                        <img src="../assets/images/logo-sm.png" alt="" height="22">
                        <!-- <span class="logo-lg-text-light">UBold</span> -->
                    </span>
                    <span class="logo-lg">
                        <img src="../assets/images/logo-dark.png" alt="" height="20">
                        <!-- <span class="logo-lg-text-light">U</span> -->
                    </span>
                </a>

                <a href="{{ route('dashboard') }}" class="logo logo-light text-center">
                    <span class="logo-sm">
                        <img src="{{ asset('images/kgkruch.png') }}" alt="" height="55">
                    </span>
                    <span class="logo-lg" style="text-align: initial;">
                        <img src="{{ asset('images/kgkruch.png') }}" alt="" height="55">
                    </span>
                </a>
            </div>
            <ul class="list-unstyled topnav-menu topnav-menu-left m-0 float-right">
                <li>
                    <!-- Mobile menu toggle (Horizontal Layout)-->
                    <a class="navbar-toggle nav-link" data-toggle="collapse" data-target="#topnav-menu-content">
                        <div class="lines">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </a>
                    <!-- End mobile menu toggle-->
                </li>
            </ul>
            <div class="clearfix"></div>
        </div>
    </div>
    <!-- end Topbar -->

    <div class="topnav">
        <div class="container-fluid">
            <nav class="navbar navbar-light navbar-expand-lg topnav-menu">
                <div class="collapse navbar-collapse" id="topnav-menu-content">
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle arrow-none" href="{{ route('dashboard') }}"
                                id="topnav-dashboard">
                                <i class="fe-airplay mr-1"></i> Dashboard
                            </a>
                        </li>
                        {{-- @if (session()->get('loginUser')['user_type'] == USER_TYPE_ADMIN) --}}
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle arrow-none" href="{{ route('users') }}"
                                    id="topnav-dashboard">
                                    <i class="mdi mdi-account mr-1"></i> Users
                                </a>
                            </li>
                    
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle arrow-none" href="{{ route('categories') }}"
                                id="topnav-dashboard">
                                <i class="mdi mdi-view-list mr-1" aria-hidden="true"></i> Category
                                
                        </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle arrow-none" href="{{ route('subcategories') }}"
                                id="topnav-dashboard">
                                <i class="mdi mdi-view-parallel  mr-1"></i> Subcategory
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle arrow-none" href="{{ route('product') }}"
                                id="topnav-dashboard">
                                <i class="fe-grid mr-1"></i> Product
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle arrow-none" href="{{ route('setting_update') }}"
                                id="topnav-dashboard">
                                <i class="fe-grid mr-1"></i> Setting
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle arrow-none" href="{{ route('orders') }}"
                                id="topnav-dashboard">
                                <i class="fe-grid mr-1"></i> Orders
                            </a>
                        </li>
                        {{-- @endif --}}
                    </ul> <!-- end navbar-->
                </div> <!-- end .collapsed-->
            </nav>
        </div> <!-- end container-fluid -->
    </div> <!-- end topnav-->

    <div class="modal fade" id="user_profile_popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
    </div>
    <div class="modal fade" id="common_ajax_popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
    </div>
    <div class="alert alert-success alert-dismissible" id="common_success_msg_area" style="display:none;" role="alert">
        <div class="alert-message" id="common_success_msg_action">
        </div>
    </div>
    <div class="alert alert-danger alert-dismissible" id="common_error_msg_area" style="display:none;" role="alert">
        <div class="alert-message" id="common_error_msg_action">
        </div>
    </div>
    <div class="modal fade" id="user_profile_popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
    </div>

</div>
