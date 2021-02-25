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
				<li class="dashboard <?php if($pagename == 'dashboard.php'){ echo 'active'; } ?>">
					<a href="dashboard.php">
						<span class="pcoded-micon"><i class="feather icon-home" style="font-size: 20px;color:#16D39A"></i></span>
						<span class="pcoded-mtext">Dashboard</span>
					</a>
				</li>
				
				<li class="pcoded-hasmenu <?php if($pagename == 'application.php'){ echo 'active'; } ?>">
					<a href="application.php">
						<span class="pcoded-micon"><i class="fa fa-pencil-square-o" style="font-size: 20px;color:#16D39A"></i></span>
						<span class="pcoded-mtext">Applcation</span>
						<!-- <span class="pcoded-badge label label-warning">NEW</span> -->
					</a>

				</li>
				<li class="pcoded-hasmenu <?php if($pagename == 'document-upload.php'){ echo 'active'; } ?>">
					<a href="document-upload.php">
						<span class="pcoded-micon"><i class="fa fa-upload" style="font-size: 20px; color:#16D39A;"></i></span>
						<span class="pcoded-mtext">Document Upload</span>
						<!-- <span class="pcoded-badge label label-danger">100+</span> -->
					</a>
					
				</li>
				 <li class="pcoded-hasmenu <?php if($pagename == 'verification-check.php'){ echo 'active'; } ?>">
					<a href="verification-check.php">
						<span class="pcoded-micon"><i class="fa fa-check-square" style="font-size: 20px;color:#16D39A"></i></span>
						<span class="pcoded-mtext">Verification Check</span>
					</a>
				   
				</li>
				 <li class="pcoded-hasmenu <?php if($pagename == 'verification-reports.php'){ echo 'active'; } ?>">
					<a href="verification-reports.php">
						<span class="pcoded-micon">
						 <i class="fa fa-stop-circle-o"  style="font-size: 20px;color:#16D39A"></i></span>
						  <span class="pcoded-mtext">Verification Report</span>
					</a>
				   
				</li>
				
				<li class="pcoded-hasmenu <?php if($pagename == 'verification-final-reports.php'){ echo 'active'; } ?>">
					<a href="verification-final-reports.php">
						<span class="pcoded-micon">
							<i class="fa fa-clipboard" style="font-size: 20px;color:#FF7588"></i></span>
						<span class="pcoded-mtext">Verification Final Report</span>
					</a>
				  
				</li>
				<li class="popover-hasmenu <?php if($pagename == 'finance-management.php'){ echo 'active'; } ?>">
				   <a href="finance-management.php">
					   <span class="pcoded-micon">
							<i class="fa fa-credit-card" style="font-size: 20px;color:#01bdc0"></i>
						</span>
						  <span class="pcoded-mtext">Finance Management</span> 
				  
				   </a>
			   </li>
			   <?php if($userRole == 22 || $userRole == 23 || $userRole == 24 || $userRole == 25 || $userRole == 1){ ?>
			   <li class="pcoded-hasmenu <?php if($pagename == 'postal-dispatch.php' || $pagename == 'postal-received.php'){ echo 'active'; } ?>" dropdown-icon="style1" subitem-icon="style1">
				<a href="javascript: void(0)">
				<span class="pcoded-micon"> <i class="fa fa-envelope" style="font-size: 20px;color:#16D39A"></i></span>
				<span class="pcoded-mtext">Postal Management</span>
				</a>
					  <ul class="pcoded-submenu">
						<li class="<?php if($pagename == 'postal-dispatch.php'){ echo 'active'; } ?>">
						<a href="postal-dispatch.php">
						<span class="pcoded-mtext">Postal Dispatch</span>
						</a>
						</li>
						<li class="<?php if($pagename == 'postal-received.php'){ echo 'active'; } ?>">
						<a href="postal-received.php">
						<span class="pcoded-mtext">Postal Received</span>
						</a>
						</li>
						</ul>
				</li>
			   <?php } ?>
				 <li class="pcoded-hasmenu <?php if($pagename == 'mis-reports-1.php' || $pagename == 'mis-reports-2.php' || $pagename == 'mis-reports-3.php'){ echo 'active'; } ?>" dropdown-icon="style1" subitem-icon="style1">
				<a href="javascript: void(0)">
				<span class="pcoded-micon"> <i class="fa fa-book fa-fw" style="font-size: 20px;color:#16D39A"></i></span>
				<span class="pcoded-mtext">MIS Management</span>
				</a>
					  <ul class="pcoded-submenu">
						<li class="<?php if($pagename == 'mis-reports-1.php'){ echo 'active'; } ?>">
						<a href="mis-reports-1.php">
						<span class="pcoded-mtext">MIS-1</span>
						</a>
						</li>
						<li class="<?php if($pagename == 'mis-reports-2.php'){ echo 'active'; } ?>">
						<a href="mis-reports-2.php">
						<span class="pcoded-mtext">Mis-2</span>
						</a>
						</li>
						<li class="<?php if($pagename == 'mis-reports-3.php'){ echo 'active'; } ?>">
						<a href="mis-reports-3.php">
						<span class="pcoded-mtext">Mis-3</span>
						
						</a>
						</li>
					  </ul>
				</li>
				<?php if($userRole == 1 || $userRole == 2){ ?>
				<li class="pcoded-hasmenu <?php if($pagename == 'setting-1.php' || $pagename == 'setting-2.php' || $pagename == 'setting-3.php'){ echo 'active'; } ?>" dropdown-icon="style1" subitem-icon="style1">
				<a href="javascript: void(0)">
				<span class="pcoded-micon"> <i class="fa fa-cog" style="color: #1ab1b4; font-size: 20px;"></i></span>
				<span class="pcoded-mtext">CMS Setting</span>
				</a>
					  <ul class="pcoded-submenu">
						<li class="<?php if($pagename == 'setting-1.php'){ echo 'active'; } ?>">
						<a href="setting-1.php">
						<span class="pcoded-mtext">Setting-1</span>
						</a>
						</li>
						<li class="<?php if($pagename == 'setting-2.php'){ echo 'active'; } ?>">
						<a href="setting-2.php">
						<span class="pcoded-mtext">Setting-2</span>
						</a>
						</li>
						<li class="<?php if($pagename == 'setting-3.php'){ echo 'active'; } ?>">
						<a href="setting-3.php">
						<span class="pcoded-mtext">Setting-3</span>
						
						</a>
						</li>
					  </ul>
				</li>
				<li class="pcoded-hasmenu <?php if($pagename == 'master-data-1.php' || $pagename == 'master-data-2.php' || $pagename == 'master-data-3.php'){ echo 'active'; } ?>" dropdown-icon="style1" subitem-icon="style1">
				<a href="javascript: void(0)">
				<span class="pcoded-micon"> <i class="fa fa-users" style="font-size: 20px;color:#16D39A"></i></span>
				<span class="pcoded-mtext">Masters Data Mngt</span>
				</a>
					  <ul class="pcoded-submenu">
						<li class="<?php if($pagename == 'master-data-1.php'){ echo 'active'; } ?>">
						<a href="master-data-1.php">
						<span class="pcoded-mtext">Masters Data-1</span>
						</a>
						</li>
						<li class="<?php if($pagename == 'master-data-2.php'){ echo 'active'; } ?>">
						<a href="master-data-2.php">
						<span class="pcoded-mtext">Masters Data-2</span>
						</a>
						</li>
						<li class="<?php if($pagename == 'master-data-3.php'){ echo 'active'; } ?>">
						<a href="master-data-3.php">
						<span class="pcoded-mtext">Masters Data-3</span>
						
						</a>
						</li>
					  </ul>
				</li>
				<?php } ?>
			</ul>
		</div>
	</nav>

 <!--****** End html Left_sidebar code  ******-->