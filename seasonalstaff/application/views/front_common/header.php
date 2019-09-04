<!DOCTYPE html>
	<html lang="en">
	  <head>
	      <meta name="google-site-verification" content="ak7Z95zpRB8vPbQ5h45NvFYQSIPoBa4sYRb8zkB0p04" />
	    <meta charset="utf-8">
	    <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge"> -->
         <meta http-equiv="content-type" content="text/html; charset=UTF-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
	    
	    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	    <meta name="description" content="">
	    <meta name="author" content="">
	    <link rel="icon" href="<?php echo base_url(); ?>public/images/seasonal_fav.ico">
	    <title>Seasonal Staff</title>
	    <link href="<?php echo base_url();?>public/front_end/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	    <link href="<?php echo base_url();?>public/front_end/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url();?>public/front_end/fonts/axiforma/font.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="<?php echo base_url();?>public/front_end/css/owl.carousel.min.css" type="text/css">
        <!-- jquery ui -->
        <link rel="stylesheet" href="<?php echo base_url();?>public/front_end/js/plugins/jquery-ui/jquery-ui.css">
        <!-- jquery ui -->
	    <link href="<?php echo base_url();?>public/front_end/css/style.css" rel="stylesheet" type="text/css">
	    <link href="<?php echo base_url();?>public/front_end/css/responsive.css" rel="stylesheet" type="text/css">

        <link href="<?php echo base_url();?>public/front_end/css/select2.min.css" rel="stylesheet" type="text/css">

        <?php //if($field == 'Datatable'){ ?>
            <!-- DataTables -->
            <link rel="stylesheet" href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
         <?php //} ?> 
		 
        <!-- selectpicker css -->
        <link rel="stylesheet" href="<?php echo base_url();?>public/front_end/js/plugins/selectpicker/bootstrap-select.css">
        <!-- selectpicker css -->		 

        <script src="<?php echo base_url();?>public/front_end/js/jquery.min.js"></script>
       
        <script src="<?php echo base_url();?>public/js/bootstrapValidator.min.js"></script>

        <script src="<?php echo base_url();?>public/front_end/js/select2.min.js"></script>
     
         <script type="text/javascript">
            var site_url = "<?php echo site_url(); ?>";
            var base_url = "<?php echo base_url(); ?>";
          </script>
		  
        <?php if($this->uri->segment(1)!="manage-work-profile" &&  $this->uri->segment(4)!="emp"){ ?>		
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
		<?php }  ?>
		
        <!--<script src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyCmCnxnOORFVDKu8PfWduPbBh8FAStHqRw" type="text/javascript"></script>-->
        <!--<script src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyAC90POLhEY3ZLhZq4PUwvBZAgOKLpixfk" type="text/javascript"></script>-->
        <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAC90POLhEY3ZLhZq4PUwvBZAgOKLpixfk&libraries=places"></script>

        
	
		<script type='text/javascript' src='<?php echo base_url(); ?>public/front_end/plugin/jquery-validation/jquery.validate.js'></script>
	  </head>
	  <body>
	
	  	<!-- header Start-->
      	<header>
        	<div class="container">
            	<div class="row">
					<?php if($this->session->userdata('user_id')==''){  ?>
                	<div class="col-lg-3 col-md-5 col-sm-12">
                		<a href="<?php echo site_url('Welcome'); ?>" class="logo"><img src="<?php echo base_url();?>public/front_end/images/logo.png"></a>
                	</div>
					<?php } else { ?>
                    <div class="col-lg-3 col-md-12 col-sm-12">
                		<a href="<?php echo site_url('Welcome'); ?>" class="logo"><img src="<?php echo base_url();?>public/front_end/images/logo.png"></a>
                	</div>
					<?php } ?>
					
					<?php if($this->session->userdata('user_id')==''){  ?>
                	<div class="col-lg-3 col-md-7 col-sm-12 nav_buttons">
                		<a class="btn header_btn" href="#" data-toggle="modal" data-target="#login_popup">Login / Join Now</a>
                	</div>
					<?php } else { } ?>
                    <div class="col-lg-9 col-md-12 col-sm-12">
                    	<nav class="navbar navbar-expand-sm navbar-light bg-faded">
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#nav-content" aria-controls="nav-content" aria-expanded="false" aria-label="Toggle navigation">
                             <span class="fa fa-bars"></span>
                            </button>
							<!-- Links -->
                            <div class="collapse navbar-collapse justify-content-end" id="nav-content">   
                                <ul class="navbar-nav">
								<li class="nav-item"><a class="nav-link" href="<?php echo site_url('Welcome'); ?>">Home</a></li>
								<li class="nav-item"><a class="nav-link" href="<?php echo site_url('Welcome/aboutUs'); ?>">About</a></li>
								
                                <!-- <li class="nav-item"><a class="nav-link" href="<?php echo site_url('deals'); ?>">Deals</a></li> -->	
								
								<li class="nav-item"><a class="nav-link" href="<?php echo site_url('Welcome/pricing'); ?>">Membership</a></li>
								<li class="nav-item"><a class="nav-link" href="<?php echo site_url('Welcome/contact'); ?>">Contact us</a></li>
                                <li class="nav-item"><a class="nav-link" href="<?php echo site_url('Welcome/blog'); ?>">Blog</a></li>
                                <li class="nav-item"><a class="nav-link" href="<?php echo site_url('Welcome/pricing'); ?>"> </a></li>  
                                
                                <?php
                                if(!empty($this->session->userdata('user_id'))){
                                   // echo ' <li class="nav-item"><a class="btn header_btn" href="'.site_url('logout').' ">Logout</a></li>';

                                }elseif(!empty($this->session->userdata('userinfo'))){
                                    echo ' <li class="nav-item"><a class="btn header_btn" href="'.site_url('logout').' ">Logout</a></li>';

                                }elseif(!empty($this->session->userdata('userData'))){
                                    echo ' <li class="nav-item"><a class="btn header_btn" href="'.site_url('logout').' ">Logout</a></li>';

                                }
                                else{
                                    echo '<li class="nav-item nav_item_btn">
                                   <a class="btn header_btn" href="#" data-toggle="modal" data-target="#login_popupextra">Login / Join Now</a>
                                </li>';

                                }
                                ?>
                               
                                <!--  <li class="nav-item nav_item_btn"><a class="btn header_btn fb_btn" href="#">Connect with Facebook</a></li> -->
                                <?php  if(!empty($this->session->userdata('user_id'))){
                                $uid = $this->session->userdata('user_id'); 
							    $query = $this->db->where('id',$uid);
							    $query = $this->db->get('users');
                                $result = $query->result_array();
								//echo  print_r($result);  die;	
								$role =  $result[0]['role'];
								//echo $result[0]['first_name']; die;
								
							  $query1 =  $this->db->select("count(status) as st");
							  $query1 =  $this->db->where("rid",$uid);
                              $query1 = $this->db->where('status',0);
							  $query1 = $this->db->get('userschating');
                              $result1 = $query1->result_array();
							
							 $stm = $result1[0]['st'];
								
								
                               if($role=='staff'){ ?>								
								<style>.nimg {
                                 border: 2px solid #2396f3;
                                </style>
								<?php }	?>
								
								<li>
								<?php if(!empty($result[0]['image']) && !empty($result[0]['server_image'])){ ?>
								
                                <a href="#">
									<span class="u_p_img">
										<img src="<?php echo base_url('public/upload/userProfile/'.$result[0]['image']); ?>" alt="Profile Pic" class="nimg">
										<span class="noti_count">
										<a href="<?php echo base_url(); ?>messages" class="noti_count_link">
											<?php if(isset($stm)){if($stm!=0){ echo '&nbsp;<i class="fa fa-weixin" aria-hidden="true"></i>&nbsp'.$stm.'';}} ?>
										</a>
										</span>
									</span>
									Welcome <?php echo $result[0]['first_name']; ?> <?php echo  $result[0]['last_name']; ?>
								</a>
									
								<?php }  elseif(!empty($result[0]['image'])){   ?>
								
								 <a href="#">
									<span class="u_p_img">
									  <img src="<?php echo base_url('public/upload/userProfile/'.$result[0]['image']); ?>" alt="Profile Pic" class="nimg">
									 <a href="<?php echo base_url(); ?>messages" class="noti_count_link">
									  <span class="noti_count">
											<?php if(isset($stm)){if($stm!=0){ echo '&nbsp;<i class="fa fa-weixin" aria-hidden="true"></i>&nbsp'.$stm.'';}} ?>
										</span></a>
									</span>
									Welcome <?php echo $result[0]['first_name']; ?> <?php echo  $result[0]['last_name']; ?>
								 </a>
																	
								<?php } elseif(!empty($result[0]['server_image'])){  ?>
								
								 <a href="#">
									 <span class="u_p_img">
										<?php if($result[0]['facebook']=='facebook'){?>
										<img src="https://graph.facebook.com/<?php echo $result[0]['facebook_id']; ?>/picture?type=large" alt="Profile Pic" class="nimg">
									   <?php } else { ?>
									   <img src="<?php echo $result[0]['server_image']; ?>" alt="Profile Pic" class="nimg">
									   <?php } ?>
										<a href="<?php echo base_url(); ?>messages" class="noti_count_link">
                                           <span class="noti_count">											
											<?php if(isset($stm)){if($stm!=0){ echo '&nbsp;<i class="fa fa-weixin" aria-hidden="true"></i>&nbsp'.$stm.'';}} ?>
										 </span></a>
									 </span>
									Welcome <?php echo $result[0]['first_name']; ?> <?php echo  $result[0]['last_name']; ?>
								 </a>
								<?php } else {
								if($role=='employer'){
								$image = 'user.jpg';
								}if($role=='staff') { 
								$image = 'userst.jpg';
								}		
								?>
								
								<a href="#">
								<span class="u_p_img">
								  <img src="<?php echo base_url(); ?>public/front_end/images/dashboard/<?php echo $image; ?>" alt="Profile Pic" class="nimg">
								   <a href="<?php echo base_url(); ?>messages" class="noti_count_link">
								  <span class="noti_count">								 
									<?php if(isset($stm)){if($stm!=0){ echo '&nbsp;<i class="fa fa-weixin" aria-hidden="true"></i>&nbsp'.$stm.'';}} ?>								  
								  </span></a>
								  
								</span>
								Welcome <?php echo $result[0]['first_name']; ?> <?php echo  $result[0]['last_name']; ?>
								</a>
								
								<?php }  ?>
                                    <ul class="submenu">
                                        <?php if($role=='employer'){ ?>
                                        <li><a href="<?php echo site_url('employee-profile'); ?>">Profile</a></li>
                                        <li><a href="<?php echo site_url('employee-profile'); ?>">Dashboard</a></li>
										<?php } if($role=='staff') {  ?>
									    <li><a href="<?php echo site_url('manage-work-profile'); ?>">Profile</a></li>
                                        <li><a href="<?php echo site_url('staff-profile'); ?>">Dashboard</a></li>
										<?php }  ?>
                                        <li><a href="<?php echo site_url('logout'); ?>">Logout</a></li>
                                    </ul>
                                </li>
								<?php } ?>
								
                                </ul>
                            </div>
						</nav>
                    </div>
                </div>
            </div>
        </header>
        <!-- header End-->
       <?php
            if($this->session->flashdata('item')) {
                $items = $this->session->flashdata('item');
                if($items->success){
                ?>
          <br/>
         <div class="col-lg-12 col-md-12 col-sm-12">
                   <div class="alert alert-success alert-dismissible">
                   <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                     <strong>Success!</strong> <?php print_r($items->message); ?>
                    </div>
          </div>
                <?php
                }		 
                
            }
            ?>
			
			<?php
            if($this->session->flashdata('result')==2 && $this->session->flashdata('item')!='') { 
                ?>
              <br/>
              <div class="alert alert-<?php echo $this->session->flashdata('class'); ?>" role="alert">
                                <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                                <h5 class="errormsgs"> <?php echo $this->session->flashdata('msg'); ?> / <a href="<?php echo base_url(); ?>Forgot"  class="blue_button">Forgot password</a></h5> 
                </div>
                <?php
                }		 
                
           
            ?>
			
			
			
             <?php 
				 if($this->session->flashdata('result')==1) { 
			     ?>
				<div <?php echo $stl; ?> class="alert alert-<?php echo $this->session->flashdata('class'); ?>" role="alert">
                                <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                                <h5 class="errormsgs"> <?php echo $this->session->flashdata('msg'); ?></h5> 
                </div>
				 <?php } ?>
				 
<!-- Login extra Modal -->
<div class="modal fade" id="login_popupextra">
    <div class="modal-dialog">
      <div class="modal-content login_form">
	  <div class="modal-header">
          <h5 class="modal-title">Welcome to Seasonal Staff</h5>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <!-- Modal body -->		
        <div class="modal-body">
            <div class="login_form_inner">
                <div class="form_heading">                                 
             
		     	<div class="popup_bottom_buttons">
			      <a href="#" data-toggle="modal" data-target="#login_popup" class="sign_up_btn hide_modal blue_button">Login</a>
  				  <a href="#" data-toggle="modal" data-target="#signup_popup" class="sign_up_btn hide_modal blue_button">Not A Member Yet?...Join Now.</a>
			   </div>
			     </div> 
           
            </div>
        </div>
      </div>
    </div>
</div>
<!-- Login extra Modal -->	
			 
 <!-- Login Modal -->
<div class="modal fade" id="login_popup">
    <div class="modal-dialog">
      <div class="modal-content login_form">
        <!-- Modal Header -->
        <div class="modal-header">
          <h5 class="modal-title">LOGIN TO YOUR ACCOUNT</h5>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <!-- Modal body -->
        <div class="modal-body">
            <div class="login_form_inner">
                <div class="form_heading">
                    <div class="form_heading_txt">
                        <span class="border_line"></span>
                        <span class="border_l"></span>
                        <span class="border_r"></span>
                    </div>
                   <!-- <span>Choose Your Account Type</span> -->
                </div>
                <form method="post" action="<?php echo site_url('Welcome/login_check'); ?>">
				  <div id="showmml" style="color:red;"></div>	
                    <!-- <div class="form_radio">
                        <label>
                            <input type="radio" name="account_type" id="account_type1"  value="staff" onchange="rvalue(this.value);">
                            <span class="radio_span transition">
                                <i class="fa fa-user-o" aria-hidden="true"></i>
                                <span class="first">Staff</span>
                                <span class="second">I am looking for seasonal or short term work</span>
                            </span>
                        </label>
                        <label>
                            <input type="radio" name="account_type" id="account_type1"  value="employer" onchange="rvalue(this.value);">
                            <span class="radio_span transition">
                                <i class="fa fa-building-o work-bg" aria-hidden="true"></i>
                                <span class="first">Employer</span>
                                <span class="second">I am a looking for staff to fill seasonal or short term jobs</span>
                            </span>
                        </label>
                    </div> -->
                    <div class="form_group width_100">
                        <label>Email Address:</label>
                        <div class="input_group">
                            <input type="email" name="email" placeholder="Enter Your Email Id">
                            <i class="fa fa-envelope-o"></i>
                        </div>
                    </div>
                    <div class="form_group width_100">
                        <label>Password:</label>
                        <div class="input_group">
                            <input type="password" name="password" placeholder="Enter Password">
                            <i class="fa fa-lock"></i>
                        </div> 
                    </div>
                  
					<div class="form_group width_100 two_button_group">
						<input type="submit" name="signin" value="Login" class="submit_btn transition">
						<a href="#" data-toggle="modal" data-target="#signup_popup" class="sign_up_btn blue_button" onclick="init();">Not A Member Yet?...Join Now.</a>
					</div>
					
					
                    <div class="form_group width_100 login_text">
                        <div class="forget_pass">
                            <a href="<?php echo base_url(); ?>Forgot">Forgot Password</a>
                          
                        </div>
                        <div class="remember_check check_box">
                            <label>
                                <input type="checkbox" value="remember password" name="check">
                                <span class="checked_box"></span>
                                <span class="check_text">Remember Password</span>
                            </label>
                        </div>
                    </div>
					
                    <!-- <div class="form_group width_100">
                        <div class="footer_text">
                            <span>Or Sign In With</span>
                        </div>
                    </div> -->
					
					<!-- <div class="other_login" id="socailul">
                        <div>
						<a href="#" class="fb_bg disabled" onclick="showmsg()"><i class="fa fa-facebook"></i>Sign in with Facebook</a></div>
						
                        <div>
						<a href="#" class="goggle_bg disabled" onclick="showmsg()"><i class="fa fa-google"></i>Sign in with Google</a>
						</div>
                        
                    </div>  -->
					
					
                    <div class="other_login" id="socailulshow">
                        <!-- <div><a href="<?php echo !empty($authURL) ? $authURL : ''; ?>" class="fb_bg" ><i class="fa fa-facebook"></i>Sign in with Facebook</a></div>
                        <div><a  href="<?php  echo isset($login) ? site_url('Welcome/googleLogin/'.$login) : ''; ?>" class="goggle_bg"><i class="fa fa-google"></i>Sign in with Google</a></div> -->
						
						
						
                      <!--   <div><a href="#" class="twit_bg"><i class="fa fa-twitter"></i>Sign in with Twitter</a></div>
                        <div><a href="#" class="link_bg"><i class="fa fa-linkedin"></i>Sign in with Linkedin</a></div> -->
                    </div>
                </form>
            </div>
        </div>
      </div>
    </div>
</div>
<!-- Login Modal -->
<!-- Sign up Modal -->
<div class="modal fade" id="signup_popup">
    <div class="modal-dialog">
      <div class="modal-content login_form">
        <!-- Modal Header -->
        <div class="modal-header">
          <h5 class="modal-title">Tell us why you are joining?</h5>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <!-- Modal body -->
        <div class="modal-body">
            <div class="login_form_inner">
                <div class="form_heading">
                    <div class="form_heading_txt">
                        <span class="border_line"></span>
                        <span class="border_l"></span>
                        <span class="border_r"></span>
                    </div>
                    <!-- <span>Select Membership Type</span> -->
                </div>
                <form id="signUpUser" method="post" action="<?php echo site_url('user-registration');?>">
                    <div id="showmm" style="color:red;"></div>					
					<div class="form_radio">
                        <label>
                            <input type="radio" name="account_type" id="account_type"  value="staff" onchange="rvalue(this.value);">
                            <span class="radio_span transition">
                                <i class="fa fa-user-o" aria-hidden="true"></i>
                                <span class="first">Staff</span>
                                <span class="second">I am looking for seasonal or short term work</span>
                            </span>
                        </label>
						            <div class="s_or_text"><span>or</span></div>
                        <label>
                            <input type="radio" name="account_type" id="account_type"  value="employer" onchange="rvalue(this.value);">
                            <span class="radio_span transition">
                                <i class="fa fa-building-o work-bg" aria-hidden="true"></i>
                                <span class="first">Employer</span>
                                <span class="second em_s">I am looking for staff</span>
                            </span>
                        </label>
                    </div>
                    <div class="form_group width_50">
                        <label>First Name:</label>
                        <div class="input_group">
                            <input type="text" name="name" id="name"  class="form-control" placeholder="Enter Your Name" autocomplete="off">
                            <i class="fa fa-user-o"></i>
                        </div>
                         <div><span id="name_error" style="color: red"></span></div>
                    </div>
                    <div class="form_group width_50">
                        <label>Last Name:</label>
                        <div class="input_group">
                            <input type="text" name="lastname" id="lastname"  class="form-control" placeholder="Enter Your Name" autocomplete="off">
                            <i class="fa fa-user-o"></i>
                        </div>
                         <div><span id="lastname_error" style="color: red"></span></div>
                    </div>
                    <div class="form_group width_50">
                        <label>Email Address:</label>
                        <div class="input_group">
                            <input type="email" name="email" id="email" class="form-control" placeholder="Enter Your Email Id" autocomplete="off">
                            <i class="fa fa-envelope-o"></i>
                        </div>
                        <div><span id="email_error" style="color: red"></span></div>
                    </div>
                    <div class="form_group width_50">
                        <label>Phone Number:</label>
                        <div class="input_group">
                            <input type="text" name="phone" id="phone" placeholder="Enter Your Phone Number" 
							autocomplete="off">
                            <i class="fa fa-phonefa fa-phone"></i>
                        </div>
                        <div><span id="mobile_error" style="color: red"></span></div>
                    </div>
					<div class="form_group width_50">
                        <label>Username or Business name</label>
                        <div class="input_group">
                            <input type="text" name="username" id="username" placeholder="Enter Your Username or Business name" 
							autocomplete="off">
                            <i class="fa fa-user-o" aria-hidden="true"></i>
                        </div>
                        <div><span id="mobile_error" style="color: red"></span></div>
                    </div>
                    <div class="form_group width_50">
                        <label>Select your Street address</label>
                        <div class="input_group">
                          <input type="text" name="loaction_c" id="loaction_c" placeholder="Select your Street address" autocomplete="on" runat="server">
                         
						 <i class="fa fa-map-marker" aria-hidden="true"></i>
							
						 <input type="hidden" id="city2c" name="city2c"/>				
										
                         <input type="hidden" id="cityLatcc" name="cityLatcc"/>
											
                         <input type="hidden" id="cityLngcc" name="cityLngcc"/>
						 
                        </div>
                        <div><span id="mobile_error" style="color: red"></span></div>
                    </div>
                    <div class="form_group width_50">
                        <label>Password:</label>
                        <div class="input_group">
                            <input class="pass_input" type="password" name="password" id="password" placeholder="Enter Your Password">
                            <label class="show_pass_label">
                              <input type="checkbox" class="show_pass" >
                              <span><i class="fa fa-eye-slash"></i></span>
                            </label>
                        </div>
                        <div><span id="password_error" style="color: red"></span></div>
                    </div>
                    <div class="form_group width_50">
                        <label>Confirm Password:</label>
                        <div class="input_group">
                            <input class="pass_input" type="password" name="C_pass" id="C_pass" placeholder="Reenter Your Password"  >
                            <i class="fa fa-lock"></i>
                        </div>
                         <div><span id="confirm_password_error" style="color: red"></span></div>
                    </div>
                    <div class="form_group width_50">
                        <label>Enter your code here (if applicable):</label>
                        <div class="input_group">
                            <input type="text" name="code" id="code" autocomplete="off">
							 <div id="showcodm" style="color:red;"></div>
							 <div id="showcodmv" style="color:green;"></div>
                        </div>
                    </div>
                    <div class="form_group width_50" id="dd_av">
                        <label>Date available to work from</label>
                        <div class="input_group">
                            <input type="text" name="date_avail" id="date_avail" class="datepicker" placeholder="Select Date" autocomplete="off">
                             <div id="showcodm12" style="color:red;"></div>
                             <div id="showcodmv12" style="color:green;"></div>
                        </div>
                    </div>
					<div class="form_group width_50" id="term_group">
				        <div class="input_group">
                            <div class="age_check check_box">
    					        <label>
                                    <input type="checkbox" value="yes" name="term" id="term">
                                    <span class="checked_box"></span>
                                    <span class="check_text"> I accept the <a href="<?php echo base_url(); ?>Welcome/termconditions" target="_balnk">Terms &amp; Conditions</a>
                                </label>
    						</div>
                        </div>
					</div>
                    <div class="form_group width_50" id="age_group">
                        <div class="input_group">
                            <div class="age_check check_box">
                                <label>
                                    <input type="checkbox" value="yes" name="age" id="age">
                                    <span class="checked_box"></span>
                                    <span class="check_text">I am over 18</span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form_group width_100">
					   <!-- <button type="button" data-toggle="modal" data-target="#login_popup" class="login_show_btn blue_button">Login</button> -->
					   <input type="submit" name="signup" id="signup" value="Join Now" class="submit_btn transition">
					</div>
					
                    <!-- <div class="form_group width_100">
                        <div class="footer_text">
                            <span>Or Sign Up With</span>
                        </div>
                    </div> -->
					
				    <input type="hidden" id="utype" name="utype">
					
					<!-- <div class="other_login" id="socailu">
                        <div>
						<a href="#" class="fb_bg disabled" onclick="showmsg()"><i class="fa fa-facebook"></i>Sign in with Facebook</a></div>
						
                        <div>
						<a href="#" class="goggle_bg disabled" onclick="showmsg()"><i class="fa fa-google"></i>Sign in with Google</a>
						</div>
                        
                    </div>  -->
					
					
					
                     <div class="other_login"  id="socailshow" style="display:none;">
                       <!--  <div><a href="<?php echo !empty($authURL) ? $authURL : ''; ?>" class="fb_bg"><i class="fa fa-facebook"></i>Sign in with Facebook</a></div>
                        <div><a href="<?php  echo isset($login) ? site_url('Welcome/googleLogin/'.$login) : ''; ?>" class="goggle_bg"><i class="fa fa-google"></i>Sign in with Google</a></div> -->
                     
					 <!--   <div><a href="#" class="twit_bg"><i class="fa fa-twitter"></i>Sign in with Twitter</a></div>
                        <div><a href="#" class="link_bg"><i class="fa fa-linkedin"></i>Sign in with Linkedin</a></div> -->
                    </div> 
                </form>
            </div>
        </div>
      </div>
    </div>
	
	
</div>
<?php  //echo $this->session->userdata('utype');  ?>

<!-- Sign up Modal -->
<script>
$(function(){
  $('input[type="radio"]').click(function(){
    if ($(this).is(':checked'))
    {
      //alert($(this).val());
	  var type  =$(this).val();
	  //alert(type);
	  document.getElementById("utype").value = type;
      document.getElementById("socailu").style.display = "none";
	  document.getElementById("socailshow").style.display = "block";
	  document.getElementById("socailul").style.display = "none";
	  document.getElementById("socailulshow").style.display = "block";
	  document.getElementById("showmm").innerHTML ="";
       document.getElementById("showmml").innerHTML ="";	  
    } 

  });  
 
});


 function init() {
	 //alert('neha');
        var input = document.getElementById('loaction_c');
		
        var autocomplete = new google.maps.places.Autocomplete(input);
        autocomplete.setComponentRestrictions(
            {'country': ['nz']});
        google.maps.event.addListener(autocomplete, 'place_changed', function () {
            var place = autocomplete.getPlace();
            document.getElementById('city2c').value = place.name;
            document.getElementById('cityLatcc').value = place.geometry.location.lat();
            document.getElementById('cityLngcc').value = place.geometry.location.lng();
            //alert("This function is working!");
            //alert(place.name);
           // alert(place.address_components[0].long_name);
		   
		   var latlng = new google.maps.LatLng(place.geometry.location.lat(),place.geometry.location.lng());
       

        });
    }
    google.maps.event.addDomListener(window, 'load', init); 


function showmsg(){

document.getElementById("showmm").innerHTML = "Choose Your Account Type Any";
document.getElementById("showmml").innerHTML = "Choose Your Account Type Any";

}

function rvalue(type)
{
//alert(type);
var term = document.getElementById('term_group');
if(type=="employer"){
    document.getElementById("dd_av").style.display = "none";
    document.getElementById("age_group").setAttribute(
   "style", "width: 100%; margin-top: 6px;");
    term.classList.add("employer_term");
}
else {
    document.getElementById("dd_av").style.display = "block";
    document.getElementById("age_group").setAttribute(
   "style", "width: 50%;");
    term.classList.remove("employer_term");
}
   $.ajax({
            url: site_url +"Welcome/utypesession/",
            type: "POST",
            data: {
                type: type,

            },
             success: function (msg) {
             //alert(msg);
            }            
        }); 
}

$(".hide_modal").on('click',function(){
	$('#login_popupextra').modal('hide');
});
</script>
<style>
 #showmml{
	color: red;
    margin-top: -17px;
    text-align: center;
 font-weight: 600;
 }
</style>
