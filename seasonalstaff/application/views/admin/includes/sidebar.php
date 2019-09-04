<!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
		 <?php if($result->image==""){ ?>
          <img src="<?php echo base_url(); ?>public/upload/profile_image/1559209916User-icon.png" class="img-circle" alt="User Image">
		 <?php } else {  ?>
		   <img src="<?php echo base_url(); ?>public/upload/profile_image/<?=$result->image?>" class="img-circle" alt="User Image">
		 <?php } ?>
        </div>
        <div class="pull-left info">
          <p><?php print_r($this->session->userdata('email'));?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li <?php if($page == 'dashboard') { echo 'class="active"'; }?>>
          <a href="<?php echo site_url('Admin/dashboard');?>">
            <i class="fa fa-edit"></i> <span>Dashbboard</span>            
          </a>          
        </li>

        <li class="treeview <?php if($page == 'profile' || $page == 'upload_image') { echo 'menu-open'; }?> ">
        <a href="#">
          <i class="fa fa-edit"></i> <span>Profile</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu" style="<?php if($page == 'profile' || $page == 'upload_image') { echo 'display:block'; }?>">
          <li <?php if($page == 'profile') { echo 'class="active"'; }?> ><a href="<?php echo site_url('Admin/update_profile');?>"><i class="fa fa-circle-o"></i>Update Profile</a></li>
          <li <?php if($page == 'upload_image') { echo 'class="active"'; }?> ><a href="<?php echo site_url('Admin/upload_image');?>"><i class="fa fa-circle-o"></i>Change Profile Picture</a></li>          
        </ul>
      </li>

      <li <?php if($page == 'aboutus') { echo 'class="active"'; }?>>
          <a href="<?php echo base_url();?>Admin/aboutus">
           <i class="fa fa-circle-o"></i> <span>About Us</span>            
          </a>          
        </li>
		
	  <li <?php if($page == 'termconditions') { echo 'class="active"'; }?>>
          <a href="<?php echo base_url();?>Admin/termconditions">
           <i class="fa fa-circle-o"></i> <span>Term & Conditions</span>            
          </a>          
       </li>
		
	<li <?php if($page == 'privacypolicy') { echo 'class="active"'; }?>>
          <a href="<?php echo base_url();?>Admin/privacypolicy">
           <i class="fa fa-circle-o"></i> <span>Privacy Policy</span>            
          </a>          
        </li>
	  
	  <li <?php if($page == 'list_user') { echo 'class="active"'; }?>>
          <a href="<?php echo site_url('users-list');?>">
            <i class="fa fa-users"></i> <span>Users</span>            
          </a>          
        </li>

        <!-- <li <?php if($page == 'staff_list') { echo 'class="active"'; }?>>
          <a href="<?php echo site_url('staff-list');?>">
            <i class="fa fa-handshake-o"></i> <span>Staff</span>            
          </a>          
        </li> -->


         <li <?php if($page == 'list_roles') { echo 'class="active"'; }?>>
          <a href="<?php echo site_url('role-list');?>">
            <i class="fa fa-edit"></i> <span>Roles</span>            
          </a>          
        </li>

        <li <?php if($page == 'list_plan') { echo 'class="active"'; }?>>
          <a href="<?php echo site_url('plan-list');?>">
            <i class="fa fa-edit"></i> <span>Plan</span>            
          </a>          
        </li>
		
		 <li <?php if($page == 'list_planstaff') { echo 'class="active"'; }?>>
          <a href="<?php echo base_url();?>Plans/plan/staffplan">
            <i class="fa fa-edit"></i> <span>Staff Plan Price</span>            
          </a>          
        </li>
		
		<!-- <li <?php if($page == 'list_coupon') { echo 'class="active"'; }?>>
          <a href="<?php echo site_url('coupon-list');?>">
            <i class="fa fa-edit"></i> <span>Coupon List</span>            
          </a>          
        </li> -->

          <li <?php if($page == 'list_Blog') { echo 'class="active"'; }?>>
          <a href="<?php echo site_url('Blog-list');?>">
            <i class="fa fa-edit"></i> <span>Blog</span>            
          </a>          
        </li>


        <li <?php if($page == 'offers_list') { echo 'class="active"'; }?>>
          <a href="<?php echo site_url('offer-list');?>">
            <i class="fa fa-gift"></i> <span>Offer Codes</span>            
          </a>          
        </li>


        <li <?php if($page == 'skill_lists') { echo 'class="active"'; }?>>
          <a href="<?php echo site_url('Skill-list');?>">
            <i class="fa fa-edit"></i> <span>Skill</span>            
          </a>          
        </li>

         <li <?php if($page == 'industry_lists') { echo 'class="active"'; }?>>
          <a href="<?php echo site_url('Industry-list');?>">
            <i class="fa fa-industry" name="Industries"></i> <span>Industries</span>            
          </a>          
        </li> 
         <li <?php if($page == 'benefit_lists') { echo 'class="active"'; }?>>
          <a href="<?php echo site_url('Benefit-list');?>">
            <i class="fa fa-plus-square"></i> <span>Benefits</span>            
          </a>          
        </li>
         <li <?php if($page == 'package_lists') { echo 'class="active"'; }?>>
          <a href="<?php echo site_url('Package-list');?>">
            <i class="fa fa-edit"></i> <span>Add On's</span>            
          </a>          
        </li> 

        
        <li <?php if($page == 'jobs_list') { echo 'class="active"'; }?>>
          <a href="<?php echo site_url('job-list');?>">
            <i class="fa fa-briefcase"></i> <span>Jobs</span>            
          </a>          
        </li>

         <li <?php if($page == 'JobCategory_list') { echo 'class="active"'; }?>>
          <a href="<?php echo site_url('job-Category');?>">
            <i class="fa fa-briefcase"></i> <span>Job Category</span>            
          </a>          
        </li>
        
       
        <!--<li <? //php if($page == 'job_request_application') { echo 'class="active"'; }?>>
          <a href="#">
            <i class="fa fa-briefcase"></i> <span>Recieved Job Application</span>            
          </a>          
        </li>-->
     
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>