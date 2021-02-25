
<style>
  footer {
      background-color:rgb(40,42,44)
  }
    .page-sidebar .page-sidebar-menu>li>a{
            border-top: 1px solid #e4eaf1 !important;
    }
    .page-header.navbar .menu-toggler>span, .page-header.navbar .menu-toggler>span:after, .page-header.navbar .menu-toggler>span:before, .page-header.navbar .menu-toggler>span:hover, .page-header.navbar .menu-toggler>span:hover:after, .page-header.navbar .menu-toggler>span:hover:before {
         background-color:#000 !important;
    }
    /*.page-header.navbar .menu-toggler>span{*/
    /*        background: white !important;*/
    /*}*/
   
    .page-sidebar .page-sidebar-menu>li.open>a, .page-sidebar .page-sidebar-menu>li:hover>a, .page-sidebar-closed.page-sidebar-fixed .page-sidebar:hover .page-sidebar-menu>li.open>a, .page-sidebar-closed.page-sidebar-fixed .page-sidebar:hover .page-sidebar-menu>li:hover>a {
        background-color: #307ee2 !important;
    }
    .page-sidebar .page-sidebar-menu .sub-menu>li>a>.arrow.open:before, .page-sidebar .page-sidebar-menu .sub-menu>li>a>.arrow:before, .page-sidebar-closed.page-sidebar-fixed .page-sidebar:hover .page-sidebar-menu .sub-menu>li>a>.arrow.open:before, .page-sidebar-closed.page-sidebar-fixed .page-sidebar:hover .page-sidebar-menu .sub-menu>li>a>.arrow:before{
        color: #fff;
    }
    .portlet.light.portlet-fit>.portlet-title {
    padding: 45px 20px 10px;
}
    @media (min-width: 992px) {
.page-sidebar-closed .page-content-wrapper .page-content {
    margin-left: 0 !important;
}
.page-content-wrapper .page-content {
  margin-left:0 !important;
}
.page-sidebar-closed.page-sidebar-closed-hide-logo .page-header.navbar .page-logo .logo-default {
    display:block !important;
}
@media (min-width: 992px) {
.page-sidebar-closed.page-sidebar-closed-hide-logo .page-header.navbar .page-logo {
    width:150px;
    
}
</style>

<?php $userdata = getUserDataByUserId($_SESSION['id']);
							      $userRole = $userdata['role'];
								 //echo $userRole; die('hvasjdbasjd');
							   
							   ?>
  <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
  <div class="page-sidebar-wrapper">
                    <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
                    <div class="page-sidebar navbar-collapse collapse">
                        <!-- BEGIN SIDEBAR MENU -->
                        <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
                        <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
                        <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
                        <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
                        <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
                        <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
                        <ul class="page-sidebar-menu  page-header-fixed page-sidebar-menu-closed " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px; display:none">
                            <!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
                            <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
                                <li class="sidebar-toggler-wrapper hide">
                                <div class="sidebar-toggler">
                                    <span></span>
                                </div>
                            </li>
                            
                            
                            <li class="nav-item start ">
                                <a href="dashboard.php" class="nav-link nav-toggle">
                                <i class="icon-home" style="color:#fff"></i>
                                <span class="title" style="color:#fff">Dashboard</span>
                                <span class="selected"></span>
                                <span class="arrow open"></span>
                            </a>
                                
                            </li>
                           
						   
						     <?php if(($userRole == 2) || ($userRole == 1)){ ?>
						   		<li class="nav-item">
                                <a href="javascript:;" class="nav-link nav-toggle">
                                    <i class="glyphicon glyphicon-list-alt" style="color:white; font-size:17px;"></i>
                                    <span class="title " style="color:white; font-size:17px;">Masters</span>
                                    <span class="arrow " style="color:white; font-size:17px;"></span>
                                </a>
                                <ul class="sub-menu">
                                    
                                    <li class="nav-item">
                                        <a href="bining_master_listing.php" class="nav-link nav-toggle" style="color:white; font-size:17px;">
                                            Binning Masters
                                            <span class="arrow" style="color:white; font-size:17px;"></span>
                                        </a>
                                        
                                    </li>
									<!--<li class="nav-item">
                                        <a href="box_master_listing.php" class="nav-link nav-toggle">
                                            Box Masters Data
                                            <span class="arrow"></span>
                                        </a>
                                        
                                    </li>-->
									<li class="nav-item">
                                        <a href="master_material_listing.php" class="nav-link nav-toggle" style="color:white; font-size:17px;">
                                            Material Masters
                                            <span class="arrow" style="color:white; font-size:17px;"></span>
                                        </a>
                                        
                                    </li>
									
									<li class="nav-item">
                                        <a href="master_buyer.php" class="nav-link nav-toggle" style="color:white; font-size:17px;">
                                             Warehouse Client
                                            <span class="arrow" style="color:white; font-size:17px;"></span>
                                        </a>
                                        
                                    </li>
									<li class="nav-item">
                                        <a href="master_suplier.php" class="nav-link nav-toggle" style="color:white; font-size:17px;">
                                             Masters Supplier
                                            <span class="arrow" style="color:white; font-size:17px;"></span>
                                        </a>
                                        
                                    </li>
									<li class="nav-item">
                                        <a href="cutomer_master_listing.php" class="nav-link nav-toggle" style="color:white; font-size:17px;">
                                           Customer  Masters 
                                            <span class="arrow"></span>
                                        </a>
                                        
                                    </li>
                                    <!--<li class="nav-item">
                                        <a href="master_warehouse.php" class="nav-link nav-toggle">
                                      Masters Warehouse
                                            <span class="arrow"></span>
                                        </a>
                                        
                                    </li>-->
									 <li class="nav-item">
                                        <a href="transporter_master_listing.php" class="nav-link nav-toggle" style="color:white; font-size:17px;">
                                      Masters Tranporter
                                            <span class="arrow" style="color:white; font-size:17px;"></span>
                                        </a>
                                        
                                    </li>
                                </ul>
                            </li>
						    <?php } ?> 
                            <?php if(($userRole == 3) || ($userRole == 1)){ ?>
                            <li class="nav-item">
                                <a href="javascript:;" class="nav-link nav-toggle">
                                    <i class="fa fa-circle-o-notch" style="color:white; font-size:17px;"></i>
                                    <span class="title" style="color:white; font-size:17px;">Inward Module</span>
                                    <span class="arrow "></span>
                                </a>
                                <ul class="sub-menu">
                                    <!--<li class="nav-item">
                                        <a href="dashboard_security.php" class="nav-link nav-toggle">
                                             Dashboard
                                            <span class="arrow"></span>
                                        </a>
                                        
                                    </li>-->
                                    <li class="nav-item">
                                        <a href="vehicle_in_out_data.php" class="nav-link nav-toggle" style="color:white; font-size:17px;">
                                            Vehicle In-Out Data
                                            <span class="arrow" style="color:white; font-size:17px;"></span>
                                        </a>
                                        
                                    </li>
									<li class="nav-item">
                                        <a href="unloading_pending.php" class="nav-link nav-toggle" style="color:white; font-size:17px;">
                                            Unloading Data	
                                            <span class="arrow" style="color:white; font-size:17px;"></span>
                                        </a>
                                        
                                    </li>
                                    <!--<li class="nav-item">
                                        <a href="box_summary.php" class="nav-link nav-toggle">
                                  Invoice & LR Summary
                                            
                                        </a>
                                        
                                    </li>-->
                                    <li class="nav-item">
                                        <a href="pending_grn.php" class="nav-link nav-toggle" style="color:white; font-size:17px;">
                                           GRN Data
                                            <span class="arrow" style="color:white; font-size:17px;"></span>
                                        </a>
                                        
                                    </li>
									<li class="nav-item">
                                        <a href="packing_listing.php" class="nav-link nav-toggle" style="color:white; font-size:17px;">
                                            Putaway & Binning
                                            <span class="arrow" style="color:white; font-size:17px;"></span>
                                        </a>
                                        
                                    </li>
									<li class="nav-item">
                                        <a href="boxbarcode_module.php" class="nav-link nav-toggle" style="color:white; font-size:17px;">
                                             Bar Code Infomation
                                            <span class="arrow"></span>
                                        </a>
                                        
                                    </li>
								
                                    <!--<li class="nav-item">
                                        <a href="report.php" class="nav-link nav-toggle">
                                          Report
                                            <span class="arrow"></span>
                                        </a>
                                        
                                    </li>-->
                                </ul>
                            </li>
							
							<!--<li class="nav-item">
                                <a href="javascript:;" class="nav-link nav-toggle">
                                    <i class="icon-folder"></i>
                                    <span class="title">Unloading  Module</span>
                                    <span class="arrow "></span>
                                </a>
                                <ul class="sub-menu">
                                    
                                    <li class="nav-item">
                                        <a href="lr_unloading.php" class="nav-link nav-toggle">
                                            Unloading Data
                                            <span class="arrow"></span>
                                        </a>
                                        
                                    </li>
                                    
                                </ul>
                            </li>-->
						    <?php } ?>
						    <?php if(($userRole == 4) || ($userRole == 1)){ ?>
								<li class="nav-item">
                                <a href="javascript:;" class="nav-link nav-toggle">
                                    <i class="fa fa-arrows-alt" style="color:white; font-size:17px;"></i>
                                    <span class="title" style="color:white; font-size:17px;">Outward</span>
                                    <span class="arrow "></span>
                                </a>
                                <ul class="sub-menu">
                                     <li class="nav-item">
                                        <a href="order_managment_listing.php" class="nav-link nav-toggle" style="color:white; font-size:17px;">
                                           Order Managment
                                            <span class="arrow"></span>
                                        </a>
                                        
                                    </li>
                                    <li class="nav-item">
                                        <a href="packing_summary.php" class="nav-link nav-toggle" style="color:white; font-size:17px;">
                                           Packing Process
                                            <span class="arrow" style="color:white; font-size:17px;"></span>
                                        </a>
                                        
                                    </li>
									<li class="nav-item">
                                        <a href="dispatch_summary.php" class="nav-link nav-toggle" style="color:white; font-size:17px;">
                                           Dispatch Data
                                            <span class="arrow" style="color:white; font-size:17px;"></span>
                                        </a>
                                        
                                    </li>
                                </ul>
                            </li>
							<?php } ?>
							<?php if(($userRole == 2) || ($userRole == 1)){ ?>
                            <li class="nav-item">
                                <a href="javascript:;" class="nav-link nav-toggle">
                                    <i class="fa fa-area-chart" style="color:white; font-size:17px;">
                                        
                                        
                                    </i>
                                    <span class="title" style="color:white; font-size:17px;">Stock Managment</span>
                                    <span class="arrow " style="color:white; font-size:17px;"></span>
                                </a>
                                <ul class="sub-menu">
                                    
                                    <li class="nav-item">
                                        <a href="product_wise_detail.php" class="nav-link nav-toggle" style="color:white; font-size:17px;">
                                          Stock Details
                                            <span class="arrow" style="color:white; font-size:17px;"></span>
                                        </a>
                                        
                                    </li>
									
									<li class="nav-item">
                                        <a href="binning_movement.php" class="nav-link nav-toggle" style="color:white; font-size:17px;">
                                          Binning Movement
                                            <span class="arrow" style="color:white; font-size:17px;"></span>
                                        </a>
                                        
                                    </li>
									<li class="nav-item">
                                        <a href="binning_movement_with_split_qty.php" class="nav-link nav-toggle" style="color:white; font-size:17px;">
                                          Partial Binning Movement
                                            <span class="arrow" style="color:white; font-size:17px;"></span>
                                        </a>
                                        
                                    </li>
                                </ul>
                            </li>
							
							<!--<li class="nav-item">-->
       <!--                         <a href="javascript:;" class="nav-link nav-toggle">-->
       <!--                             <i class="fa fa-line-chart" style="color:white; font-size:17px;"></i>-->
       <!--                             <span class="title" style="color:white; font-size:17px;">Report</span>-->
       <!--                             <span class="arrow " style="color:white; font-size:17px;"></span>-->
       <!--                         </a>-->
       <!--                         <ul class="sub-menu">-->
                                    
       <!--                             <li class="nav-item">-->
       <!--                                 <a href="report_sample.php" class="nav-link nav-toggle" style="color:white; font-size:17px;">-->
       <!--                                   Report Sample-1-->
       <!--                                     <span class="arrow" style="color:white; font-size:17px;"></span>-->
       <!--                                 </a>-->
                                        
       <!--                             </li>-->
									
							<!--		<li class="nav-item">-->
       <!--                                 <a href="report_sample2.php" class="nav-link nav-toggle" style="color:white; font-size:17px;">-->
       <!--                                   Report Sample-2-->
       <!--                                     <span class="arrow" style="color:white; font-size:17px;"></span>-->
       <!--                                 </a>-->
                                        
       <!--                             </li>-->
       <!--                         </ul>-->
       <!--                     </li>-->
							<?php } ?>
                            		<!---<li class="nav-item">
                                <a href="javascript:;" class="nav-link nav-toggle">
                                    <i class="icon-folder"></i>
                                    <span class="title">Dispatch Module</span>
                                    <span class="arrow "></span>
                                </a>
                                <ul class="sub-menu">
                                     
                                   
									
                                </ul>
                            </li>-->
                            
                            
                            
                        </ul>
                        <!-- END SIDEBAR MENU -->
                        <!-- END SIDEBAR MENU -->
						</div>
                    </div>