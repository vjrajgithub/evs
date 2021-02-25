<?php
$userdata = getUserDataByUserId($_SESSION['id']);
$userRole = $userdata['role'];
?>
<style>
    /******* new menu header start*********/
    .clearfix:after {
        visibility: hidden;
        display: block;
        font-size: 0;
        content: " ";
        clear: both;
        height: 0;
    }
    .details_table {
        text-align: center;
    }
    .page-sidebar-closed.page-sidebar-closed-hide-logo .page-header.navbar .page-logo {
        width: 250px !important;

        /* object-fit: contain; */
    }

    .page-header.navbar .top-menu .navbar-nav>li.dropdown-user .dropdown-toggle {
        padding: 16px 6px 14px 8px !important;
    }
    .bottom_hdr {
        background-color: #63B54F;
        width: 100%;
        border-radius: 0;
    }
    .DTFC_LeftBodyLiner {
        top: -11px !important;
    }
    .bottom_hdr > ul {
        display: inline-flex;
        margin-bottom: 0;
        width: 100%;
        max-width: 100%;
    }
    .bottom_hdr > ul > li {
        list-style: none;
        margin-right: 25px;
    }
    .bottom_hdr ul li a {
        font-weight: 500;
        letter-spacing: 0.6px;
        font-size: 14px;
        text-decoration: none;
        color: #fff;
    }
    .bottom_hdr a {
        padding: 10px;
        display: inline-block;
        transition: all 0.3s ease;
    }

    .bottom_hdr ul.dropdown-menu {
        background: #63B54F;

    }
    .bottom_hdr ul.dropdown-menu {
        background: #63B54F;

    }
    .dropdown-menu>li>a {
        padding:8px 10px !important;
    }
    .matrix_data_table {
        overflow-x: hidden!important;
    }
    /*.nav-item.dropdown:hover .dropdown-menu {
      display: block !important;
    }
    */
    /*tabform advance style*/
    .dashboard-stat2 .display .number small {
        font-size: 12px !important;
    }

    .wrapper.advance_search_excel {
        max-width: 150rem;
        width: 100%;
        margin: 0 auto;
        /*border:1px solid #63B54F;*/
        padding:30px 10px;
        margin-bottom: 40px;
        -webkit-box-shadow: 0 0 2px rgba(0, 0, 0, 0.6);
        box-shadow: 0 0 2px rgba(0, 0, 0, 0.6);
        -moz-box-shadow: 0 0 2px rgba(0, 0, 0, 0.6);
        background-color: #63b54f2e;
        position: relative;
    }

    .wrapper.advance_search_excel .tabs {
        position: relative;
        margin: 3rem 0;
        /*background: #63B54F;*/
        height: 14.75rem;

    }
    .wrapper.advance_search_excel .tabs::before,
    .wrapper .advance_search_excel .tabs::after {
        content: "";
        display: table;
    }
    .wrapper.advance_search_excel .tabs::after {
        clear: both;
    }
    .wrapper.advance_search_excel .tab {
        float: left;
    }
    .wrapper.advance_search_excel .tab-switch {
        display: none;
    }
    .wrapper.advance_search_excel .tab-label {
        position: relative;
        display: block;
        line-height: 2.5em;
        /*height: 3em;*/
        padding: 0 1.618em;
        /*background: #63B54F;*/
        /*border-right: 0.125rem solid #63B54F;*/
        color: #000;
        cursor: pointer;
        top: 0;
        transition: all 0.25s;
        border: 1px solid #63B54F;
    }
    .wrapper.advance_search_excel .tab-label:hover {
        /*top: -0.25rem;*/
        transition: top 0.25s;
    }
    .wrapper.advance_search_excel .tab-content {
        height: 12rem;
        position: absolute;
        z-index: 1;
        top: 2.75em;
        left: 0;
        right: 0;
        padding: 1.618rem;
        /*background: #fff;*/
        color: #2c3e50;
        /*border-bottom: 0.25rem solid #bdc3c7;*/
        opacity: 0;
        transition: all 0.35s;
    }
    .wrapper.advance_search_excel .tab-switch:checked + .tab-label {
        background: #63B54F;
        color: #fff;
        /*border-bottom: 0;*/
        border-right: 0.125rem solid #63B54F;
        transition: all 0.35s;
        z-index: 1;
        /*top: -0.0625rem;*/
        /*border: 1px solid #63B54F;*/
    }
    .wrapper.advance_search_excel .tab {
        padding-left: 465px;
    }
    .wrapper.advance_search_excel .tab:last-child{
        padding-left: 0 !important;
    }

    .wrapper.advance_search_excel .tab-switch:checked + label + .tab-content {
        z-index: 2;
        opacity: 1;
        transition: all 0.35s;
        margin-top: 25px;
    }
    /*tabform advance style*/
    /******* new menu header  End *********/
    .logo_tml img {
        max-width: 150px;
        margin-top: 0 !important;
        width:100%;

    }
    .page-header.navbar .top-menu .navbar-nav>li.dropdown .dropdown-toggle:hover, .page-header.navbar .top-menu .navbar-nav>li.dropdown.open .dropdown-toggle {
        background-color: #f3f3f3 !important;
        /*   padding-left: 10px  !important;
           padding-right: 10px  !important;*/
        transition: all 0.5s ease;
        border-radius: 24px;
        /*padding-bottom: 14px;*/
    }
    .nav-list li:hover {
        background-color:#fff;
    }
    .nav-list li:hover > a span {
        color:#262626 !important;
    }


    /*modal_session_time_out*/
    #modalAutoLogout .modal-dialog.modal-sm {
        width: 400px !important;
        height: 200px !important;
        position:absolute;
        top:50%;
        left:50%;
        margin-left:-200px;/* half width*/
        margin-top:-100px;/* half height*/
    }
    #modalAutoLogout .modal-footer  {
        text-align: center;
    }

    /*modal_session_time_out*/

    /*.active{
      background-color:#fff;


    }
    .active a span {
      color:#262626 !important;
    }
    */
    /*chart graph*/
    path.amcharts-graph-column-front.amcharts-graph-column-element {
        fill: #63B54F;
        stroke: #63B54F;
    }
    /*chart graph*/
    .page-header.navbar .menu-toggler>span {
        background-color: #000000 !important;
    }
    .page-header.navbar .top-menu .navbar-nav>li.dropdown-language>.dropdown-toggle>.langname, .page-header.navbar .top-menu .navbar-nav>li.dropdown-user>.dropdown-toggle>.username, .page-header.navbar .top-menu .navbar-nav>li.dropdown-user>.dropdown-toggle>i {
        color:#000 !important;
    }
    .page-header.navbar .menu-toggler.sidebar-toggler {
        float: right;
        margin: 29.5px 0 0 !important;
    }
    .page-sidebar .page-sidebar-menu li:hover>a>.arrow.open:before, .page-sidebar .page-sidebar-menu li:hover>a>.arrow:before, .page-sidebar .page-sidebar-menu li>a>.arrow.open:before, .page-sidebar .page-sidebar-menu li>a>.arrow:before, .page-sidebar-closed.page-sidebar-fixed .page-sidebar:hover .page-sidebar-menu li:hover>a>.arrow.open:before, .page-sidebar-closed.page-sidebar-fixed .page-sidebar:hover .page-sidebar-menu li:hover>a>.arrow:before, .page-sidebar-closed.page-sidebar-fixed .page-sidebar:hover .page-sidebar-menu li>a>.arrow.open:before, .page-sidebar-closed.page-sidebar-fixed .page-sidebar:hover .page-sidebar-menu li>a>.arrow:before {
        color: #FFF !important; }


    @media only screen and (max-width: 767px) {
        .bottom_hdr > ul {
            display:block !important;
        }
        .bottom_hdr > ul > li {
            margin-right: 25px;
            text-align: center;
        }

        .navbar-collapse.in {
            overflow-y: visible !important;
        }


        .portlet-body form {
            display: block !important;
        }
        .wrapper.advance_search_excel {
            min-height: 395px;
        }

    }

    @media (max-width: 991px) {
        .page-header.navbar .menu-toggler.responsive-toggler {
            display: block;
            padding: 11px;}


        .wrapper.advance_search_excel .tab {
            padding-left: 0 !important;
        }
        .portlet.light.portlet-fit>.portlet-title {
            padding-top:10px !important;
        }
        .svg-container {
            position: relative !important;
            top: 0;

        }
        .rofile_phoptp img {
            width:20%;

        }

    }
</style>
<!-- BEGIN HEADER -->
<div class="page-header navbar navbar-fixed-top" style=" background-color:#fff; -webkit-box-shadow: 0 10px 6px -12px #777; -moz-box-shadow: 0 10px 6px -12px #777; box-shadow: 0 10px 6px -12px #777;">
    <!-- BEGIN HEADER INNER -->
    <div class="page-header-inner">
        <!-- BEGIN LOGO -->
        <div class="page-logo">
            <a href="dashboard.php" class="logo_tml">
                <img src="../assets/layouts/layout/img/tatamotors_logo.png" alt="logo" class="logo-default" />
            </a>
            <!--<div class="menu-toggler sidebar-toggler">-->
            <!--    <span></span>-->
            <!--</div>-->
        </div>
        <!-- END LOGO -->
        <!-- BEGIN RESPONSIVE MENU TOGGLER -->
        <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
            <span></span>
        </a>
        <!--<span style="color:#000; font-weight:bold;    position: relative; top: 18px; left: 14px;" class="username username-hide-on-mobile ">Seabird Logisolutions</span>-->
        <!-- END RESPONSIVE MENU TOGGLER -->
        <!-- BEGIN TOP NAVIGATION MENU -->
        <div class="top-menu">
            <ul class="nav navbar-nav pull-right">
                <!-- BEGIN NOTIFICATION DROPDOWN -->
                <!-- DOC: Apply "dropdown-dark" class after "dropdown-extended" to change the dropdown styte -->
                <!-- DOC: Apply "dropdown-hoverable" class after below "dropdown" and remove data-toggle="dropdown" data-hover="dropdown" data-close-others="true" attributes to enable hover dropdown mode -->
                <!-- DOC: Remove "dropdown-hoverable" and add data-toggle="dropdown" data-hover="dropdown" data-close-others="true" attributes to the below A element with dropdown-toggle class -->
                <li class="dropdown dropdown-extended dropdown-notification" id="header_notification_bar">
                    <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">


                    </a>

                </li>
                <!-- END NOTIFICATION DROPDOWN -->
                <!-- BEGIN INBOX DROPDOWN -->
                <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                <li class="dropdown dropdown-extended dropdown-inbox" id="header_inbox_bar">
                    <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">


                    </a>

                </li>
                <!-- END INBOX DROPDOWN -->
                <!-- BEGIN TODO DROPDOWN -->
                <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                <li class="dropdown dropdown-extended dropdown-tasks" id="header_task_bar">
                    <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">

                    </a>

                </li>
                <li class="dropdown dropdown-user">
                    <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">

                         <!--<i class="fa fa-clock-o"></i>
                         <span id="secondsIdleCap">Session will expire after</span>
                         <span style="display: none;" id="settimeshow">00:00:00</span>
                         <span style="display: block;" id="secondsIdle"></span>-->
                    </a>

                </li>
                <!-- END TODO DROPDOWN -->
                <!-- BEGIN USER LOGIN DROPDOWN -->
                <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                <li class="dropdown dropdown-user custom_admin">
                    <img alt="" class="img-circle" src="../assets/layouts/layout/img/avatar3_small.png" />
                    <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true" style="display: inline-flex;">

                        <span class="username username-hide-on-mobile"><?php
                            $locNm = get_organigation_name($mycon, $userdata['org_id']);
                            if ($locNm != '') {
                              $locName = $locNm;
                            } else {
                              $locName = 'Head Office';
                            }
                            echo "<strong>" . $userdata['first_name'] . "  " . $userdata['last_name'] . " - </strong>" . $userdata['department'] . " <strong> @ " . $locName . " </strong> | <strong>Last Login: </strong>" . $userdata['login_time'];
                            ?> </span>
                        <i style="margin-top: 3px;" class="fa fa-angle-down"></i>

                    </a>

                    <ul class="dropdown-menu dropdown-menu-default">
                        <!--<li>-->
                        <!--    <a href="page_user_profile_1.html">-->
                        <!--        <i class="icon-user"></i> My Profile </a>-->
                        <!--</li>-->

                        <?php if ($userRole == 1 || $userRole == 4) { ?>
                          <li>
                              <a href="register.php">
                                  <i class="icon-lock"></i> Create Admin Account </a>
                          </li>
                        <?php } ?>
                        <li>
                            <a href ="changepassword.php">
                                <i class="icon-lock"></i> Change Password</a>
                            </a>
                        </li>

                        <li>
                            <a href ="profile.php">
                                <i class="icon-user "></i> Profile Preview</a>
                        </li>
                        <li>
                            <a href ="edit-admin.php?adminid=<?php echo $userdata['id'] ?>">
                                <i class="icon-settings"></i> Setting </a>
                        </li>
                        <?php if ($userRole == 1 || $userRole == 4) { ?>
                          <li>
                              <a href="adminlist.php">
                                  <i class="icon-lock"></i>User List </a>
                          </li>
                        <?php } ?>
                        <li>
                            <a href="../logout.php">
                                <i class="icon-key"></i> Log Out </a>
                        </li>
                    </ul>
                </li>
                <!-- END USER LOGIN DROPDOWN -->
                <!-- BEGIN QUICK SIDEBAR TOGGLER -->
                <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                <li class="dropdown dropdown-quick-sidebar-toggler">
                    <a href="javascript:;" class="dropdown-toggle">

                    </a>
                </li>
                <!-- END QUICK SIDEBAR TOGGLER -->
            </ul>
        </div>
        <!-- END TOP NAVIGATION MENU -->
    </div>
    <div class="bottom_hdr collapse navbar-collapse" id="bootom_hdr" style="margin-top: 49px;">
        <ul class="nav-list">
            <li class="nav-item start ">
                <a href="dashboard.php" class="nav-link nav-toggle">
                    <span class="title">Dashboard</span>
                    <span class="selected"></span>
                            <!-- <span class="arrow open"></span> -->
                </a>
            </li>
            <?php if ($userRole == 1 || $userRole == 4) { ?>
              <li class="nav-item dropdown">
                  <a href="knowledge_of_multiple_customer.php" class="nav-link">
                      <span class="title">
                          Knowledge of multiple customer
                      </span>

                  </a>
              </li>
              <li class="nav-item dropdown">
                  <a href="knowledge_of_multiple_location.php" class="nav-link">
                      <span class="title">
                          Knowledge of multiple Location
                      </span>

                  </a>
              </li>
            <?php } ?>
            <li class="nav-item dropdown">
                <a href="javascript:void(0)" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <span class="title">
                        Matrix Data
                    </span>
                    <span class="fa fa-angle-down"></span>
                </a>
                <ul class="dropdown-menu">
                    <li class="nav-item ">
                        <a href="matrix-uploaded-file.php" class="nav-link">
                            <span class="title">Uploaded Matrix Files</span>
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a href="department-wise-matrix-data.php" class="nav-link">
                            <span class="title">Department Wise Matrix Data</span>
                        </a>
                    </li>
                    <?php if ($userRole == 1 || $userRole == 4) { ?>
                      <li class="nav-item ">
                          <a href="customer-wise-matrix-data.php" class="nav-link">
                              <span class="title">Customer Wise Department Knowledge</span>
                          </a>
                      </li>
                      <li class="nav-item ">
                          <a href="location-wise-matrix-data.php" class="nav-link">
                              <span class="title">Location Wise Department Knowledge</span>
                          </a>
                      </li>
                    <?php } ?>
                </ul>
            </li>
        </ul>
    </div>

    <!--- END HEADER INNER --->
</div>

