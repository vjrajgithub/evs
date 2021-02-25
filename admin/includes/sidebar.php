<?php
$currentFile = $_SERVER["PHP_SELF"];
$parts = Explode('/', $currentFile);
$pagename = $parts[count($parts) - 1];
//echo $pagename;
?>
<!--****** Start html Left_Sidebar code  ******-->
<nav class="pcoded-navbar">
  <div class="pcoded-inner-navbar main-menu">
    <!-- <div class="pcoded-navigatio-lavel">Navigation</div> -->
    <ul class="pcoded-item pcoded-left-item">
      <li class="dashboard <?php if ($pagename == 'dashboard.php') {
                              echo 'active';
                            } ?>">
        <a href="dashboard.php">
          <span class="pcoded-micon"><i class="feather icon-home" style="font-size: 20px;color:#16D39A"></i></span>
          <span class="pcoded-mtext">Dashboard</span>
        </a>
      </li>

      <li class="pcoded-hasmenu <?php if ($pagename == 'application.php') {
                                  echo 'active';
                                } ?>">
        <a href="application.php">
          <span class="pcoded-micon"><i class="fa fa-pencil-square-o" style="font-size: 20px;color:#16D39A"></i></span>
          <span class="pcoded-mtext">Application</span>
          <!-- <span class="pcoded-badge label label-warning">NEW</span> -->
        </a>

      </li>

      <?php if ($userRole == 4 || $userRole == 5 || $userRole == 6 || $userRole == 1 || $userRole == 2 || $userRole == 3) { ?>
        <li class="pcoded-hasmenu <?php if ($pagename == 'case_allocation.php') {
                                    echo 'active';
                                  } ?>">
          <a href="case_allocation.php">
            <span class="pcoded-micon"><i class="fa fa-pencil-square-o" style="font-size: 20px;color:#16D39A"></i></span>
            <span class="pcoded-mtext">Case Allocation</span>
            <!-- <span class="pcoded-badge label label-warning">NEW</span> -->
          </a>

        </li>
      <?php } ?>

      <!--<li class="pcoded-hasmenu <?php if ($pagename == 'document-upload.php') {
                                      echo 'active';
                                    } ?>">
          <a href="document-upload.php">
              <span class="pcoded-micon"><i class="fa fa-upload" style="font-size: 20px; color:#16D39A;"></i></span>
              <span class="pcoded-mtext">Document Upload</span>
          </a>
      </li>-->
      <?php if ($userRole == 34 || $userRole == 35 || $userRole == 36 || $userRole == 31 || $userRole == 32 || $userRole == 33 || $userRole == 26 || $userRole == 27 || $userRole == 30 || $userRole == 23 || $userRole == 24 || $userRole == 25 || $userRole == 18 || $userRole == 1 || $userRole == 2 || $userRole == 3) { ?>
        <li class="pcoded-hasmenu <?php if ($pagename == 'verification-check.php') {
                                    echo 'active';
                                  } ?>">
          <a href="verification-check.php">
            <span class="pcoded-micon"><i class="fa fa-check-square" style="font-size: 20px;color:#16D39A"></i></span>
            <span class="pcoded-mtext">Verification Check</span>
          </a>

        </li>
		<?php } ?>
		<?php if ($userRole == 13 || $userRole == 14 || $userRole == 15 || $userRole == 2 || $userRole == 1 || $userRole == 3) { ?>
        <li class="pcoded-hasmenu <?php if ($pagename == 'verification-reports.php') {
                                    echo 'active';
                                  } ?>">
          <a href="verification-reports.php">
            <span class="pcoded-micon">
              <i class="fa fa-stop-circle-o" style="font-size: 20px;color:#16D39A"></i></span>
            <span class="pcoded-mtext">Verification Report-QC</span>
          </a>

        </li>
      <?php } ?>
	  <?php if ($userRole == 13 || $userRole == 23 || $userRole == 28 || $userRole == 2 || $userRole == 1 || $userRole == 3) { ?>
      <li class="pcoded-hasmenu <?php if ($pagename == 'verification-final-reports.php') {
                                  echo 'active';
                                } ?>">
        <a href="verification-final-reports.php">
          <span class="pcoded-micon">
            <i class="fa fa-clipboard" style="font-size: 20px;color:#FF7588"></i></span>
          <span class="pcoded-mtext">Verification Report</span>
        </a>

      </li>
	  <?php } ?>
      <?php if ($userRole == 16 || $userRole == 17 || $userRole == 18 || $userRole == 2 || $userRole == 1 || $userRole == 3) { ?>
        <li class="popover-hasmenu <?php if ($pagename == 'finance-management.php') {
                                      echo 'active';
                                    } ?>">
          <a href="finance-management.php">
            <span class="pcoded-micon">
              <i class="fa fa-credit-card" style="font-size: 20px;color:#01bdc0"></i>
            </span>
            <span class="pcoded-mtext">Finance Management</span>

          </a>
        </li>
      <?php } ?>
      <?php if ($userRole == 19 || $userRole == 20 || $userRole == 21 || $userRole == 22 || $userRole == 2 || $userRole == 1 || $userRole == 3) { ?>
        <li class="pcoded-hasmenu <?php if ($pagename == 'postal-dispatch.php' || $pagename == 'postal-received.php') {
                                    echo 'active';
                                  } ?>" dropdown-icon="style1" subitem-icon="style1">
          <a href="javascript: void(0)">
            <span class="pcoded-micon"> <i class="fa fa-envelope" style="font-size: 20px;color:#16D39A"></i></span>
            <span class="pcoded-mtext">Postal Management</span>
          </a>
          <ul class="pcoded-submenu">
            <?php if ($userRole == 19 || $userRole == 20 || $userRole == 2 || $userRole == 1 || $userRole == 3) { ?>
			<li class="<?php if ($pagename == 'postal-dispatch.php') {
                          echo 'active';
                        } ?>">
              <a href="postal-dispatch.php">
                <span class="pcoded-mtext">Postal Dispatch</span>
              </a>
            </li>
			<?php } ?>
			<?php if ($userRole == 21 || $userRole == 22 || $userRole == 2 || $userRole == 1 || $userRole == 3) { ?>
            <li class="<?php if ($pagename == 'postal-received.php') {
                          echo 'active';
                        } ?>">
              <a href="postal-received.php">
                <span class="pcoded-mtext">Postal Received</span>
              </a>
            </li>
			<?php } ?>
          </ul>
        </li>
      <?php } ?>
      <?php if ($userRole == 13 || $userRole == 23 || $userRole == 1 || $userRole == 2 || $userRole == 3) { ?>
        <li class="pcoded-hasmenu <?php if ($pagename == 'mis-reports-1.php' || $pagename == 'mis-reports-2.php' || $pagename == 'mis-reports-3.php') {
                                    echo 'active';
                                  } ?>" dropdown-icon="style1" subitem-icon="style1">
          <a href="javascript: void(0)">
            <span class="pcoded-micon"> <i class="fa fa-book fa-fw" style="font-size: 20px;color:#16D39A"></i></span>
            <span class="pcoded-mtext">MIS Management</span>
          </a>
          <ul class="pcoded-submenu">
            <li class="<?php if ($pagename == 'mis-reports-1.php') {
                          echo 'active';
                        } ?>">
              <a href="mis-reports-1.php">
                <span class="pcoded-mtext">MIS Report</span>
              </a>
            </li>
          </ul>
        </li>

        
        <li class="pcoded-hasmenu <?php if ($pagename == 'master-data-1.php' || $pagename == 'master-data-2.php' || $pagename == 'master-data-3.php') {
                                    echo 'active';
                                  } ?>" dropdown-icon="style1" subitem-icon="style1">
          <a href="javascript: void(0)">
            <span class="pcoded-micon"> <i class="fa fa-users" style="font-size: 20px;color:#16D39A"></i></span>
            <span class="pcoded-mtext">Masters Data Mngt</span>
          </a>
          <ul class="pcoded-submenu">
            <li class="<?php if ($pagename == 'customer-mngt.php') {
                          echo 'active';
                        } ?>">
              <a href="customer-mngt.php">
                <span class="pcoded-mtext">Customer Management</span>
              </a>
            </li>
          </ul>
        </li>

      <?php } ?>
      <?php if ($userRole == 1 || $userRole == 2 || $userRole == 28) { ?>
        <li class="pcoded-hasmenu <?php if ($pagename == 'userlist.php' || $pagename == 'create-new-user.php' || $pagename == 'edit-admin.php') {
                                    echo 'active';
                                  } ?>" dropdown-icon="style1" subitem-icon="style1">
          <a href="javascript: void(0)">
            <span class="pcoded-micon"> <i class="fa fa-users" style="font-size: 20px;color:#16D39A"></i></span>
            <span class="pcoded-mtext">User Data Mngt</span>
          </a>
          <ul class="pcoded-submenu">
            <li class="<?php if ($pagename == 'userlist.php') {
                          echo 'active';
                        } ?>">
              <a href="userlist.php">
                <span class="pcoded-mtext">User Management</span>
              </a>
            </li>

          </ul>
        </li>
      <?php } ?>
    </ul>
  </div>
</nav>

<!--****** End html Left_sidebar code  ******-->