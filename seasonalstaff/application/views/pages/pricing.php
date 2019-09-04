 <!-- breadcrumb section Start -->
    <div class="breadcrumb text-center">
    	<div class="container">
        <h1>Annual Membership plan</h1>
        <ul><li><a href="<?php echo site_url('Welcome');?>">home</a></li><li>Annual Membership plan</li></ul>
        </div>
    </div>
    <!-- breadcrumb section End -->
    <!-- Pricing section Start -->
    <div class="pricing_section_main">
    	<div class="container">
			<div class="section_heading">
				<h4>Annual Membership plan</h4>
			</div>
        	<div class="row">
        		<!-- pricing box Start -->
				<?php 
			
				if(isset($em_price)) {
					foreach($em_price as $list) {
				
						?>
                 <div class="col-lg-3 col-md-6 col-sm-12 pricing_col">
                    <div class="pricing_box transition">
	                    <div class="pricing_head">
	                        <h4>Looking for staff</h4>
	                    </div>
	                    <div class="pricing_body">
	                    	<div class="body_text">
                    			<h5>$<?php echo $list['price']; ?> NZD Staff (<?php echo $list['staff']; ?>).</h5>
                    			<h6>Membership Benefits</h6>
	                    	</div>
	                        <ul class="pricing_list">
	                        	<li>
	                        		<h5><i class="fa fa-check"></i>Reduce your recruitment costs</h5>
	                        		<p><?php echo $list['descriptionfw']; ?></p>
	                        	</li>
	                        	<li>
	                        		<h5><i class="fa fa-check"></i>Find staff by location</h5>
	                        		<p><?php echo $list['descriptionfem']; ?></p>
	                        	</li>
	                        	<li>
	                        		<h5><i class="fa fa-check"></i>Find staff by Month</h5>
	                        		<p><?php echo $list['descriptionfws']; ?></p>
	                        	</li>
								<li>
	                        		<h5><i class="fa fa-check"></i>Search for staff by Skill</h5>
	                        		<p><?php echo $list['descriptionmfav']; ?></p>
	                        	</li>
								<li>
	                        		<h5><i class="fa fa-check"></i>Promote your point of difference</h5>
	                        		<p><?php echo $list['descriptiontrack']; ?></p>
	                        	</li>
								<li>
	                        		<h5><i class="fa fa-check"></i>Make a favourites list</h5>
	                        		<p><?php echo $list['descriptionprofile']; ?></p>
	                        	</li>
								<li>
	                        		<h5><i class="fa fa-check"></i>Reduce your HR & Admin time</h5>
	                        		<p><?php echo $list['descriptionprocess']; ?></p>
	                        	</li>
								<li>
	                        		<h5><i class="fa fa-check"></i>More features</h5>
	                        		<p><?php echo $list['descriptionfeature']; ?></p>
	                        	</li>
	                        </ul>
	                    </div>
	                    	<?php if($this->session->userdata('user_id')==''){ ?> 
									<a href="#" data-toggle="modal" data-target="#signup_popup" class="blue_button price_btn" >Pay Now</a>
							<?php  } 							
							elseif($user[0]['role']=='staff') {  ?>
							 <a href="#" class="blue_button price_btn" onclick="showpopup()">Pay Now</a>
							<?php }	else { ?>
	                    <a href="<?php echo base_url(); ?>/employee-staff-pricing" class="blue_button price_btn">Pay Now</a>
						<?php }  ?>
                    </div>
                </div>
				<?php }} ?>
				
				<?php 
			
				if(isset($em_pricestaff)) {
					foreach($em_pricestaff as $liststaff) {
				
						?>
				<div class="col-lg-3 col-md-6 col-sm-12 pricing_col">
                    <div class="pricing_box transition">
	                    <div class="pricing_head">
	                        <h4>Looking for work</h4>
	                    </div>
	                    <div class="pricing_body">
	                    	<div class="body_text">
                    			<h5><?php if($liststaff['price']==0){ echo 'FREE for a limited time'; } else {  ?>$ <?php echo $liststaff['price'];  ?> NZD Unlimited <?php } ?></h5>
                    			<h6>Membership Benefits</h6>
	                    	</div>
	                        <ul class="pricing_list">
	                        	<li>
	                        		<h5><i class="fa fa-check"></i>Find work by location</h5>
	                        		<p><?php echo $liststaff['descriptionfw'];  ?></p>
	                        	</li>
	                        	<li>
	                        		<h5><i class="fa fa-check"></i>Find work by Month.</h5>
	                        		<p><?php echo $liststaff['descriptionfem'];  ?></p>
	                        	</li>
	                        	<li>
	                        		<h5><i class="fa fa-check"></i>Find work that suits your needs</h5>
	                        		<p><?php echo $liststaff['descriptionfws'];  ?></p>
	                        	</li>
								<li>
	                        		<h5><i class="fa fa-check"></i>Make a favourites list</h5>
	                        		<p><?php echo $liststaff['descriptionmfav'];  ?></p>
	                        	</li>
								
								<li>
	                        		<h5><i class="fa fa-check"></i>Track your applications.</h5>
	                        		<p><?php echo $liststaff['descriptiontrack'];  ?></p>
	                        	</li>
								
								<li>
	                        		<h5><i class="fa fa-check"></i>Have your own profile.</h5>
	                        		<p><?php echo $liststaff['descriptionprofile'];  ?></p>
	                        	</li> 
								
								<li>
	                        		<h5><i class="fa fa-check"></i>Easy application process.</h5>
	                        		<p><?php echo $liststaff['descriptionprocess'];  ?></p>
	                        	</li>
								
								<li>
	                        		<h5><i class="fa fa-check"></i>More features</h5>
	                        		<p><?php echo $liststaff['descriptionfeature'];  ?></p>
	                        	</li>
								
	                        </ul>
	                    </div>					
							<?php if($this->session->userdata('user_id')==''){ ?> 
									<a href="#" data-toggle="modal" data-target="#signup_popup" class="blue_button price_btn" >Pay Now</a> 
							<?php  } elseif($user[0]['role']=='employer') {  ?>
							 <a href="#" class="blue_button price_btn" onclick="showpopup()">Pay Now</a>
							<?php }	else { ?>
	                    <a href="<?php echo base_url(); ?>/staff-membership" class="blue_button price_btn">Pay Now</a>
						<?php }  ?>
                    </div>
                </div>
				<?php }} ?>
                <!-- pricing box End -->
			
                <!-- pricing box End -->
            </div>
			<div class="section_heading">
				<!-- <h4>Membership plan for staff</h4> -->
			</div>
			
			<!--  <div class="row">
			
                
                 <div class="col-lg-4 col-md-6 col-sm-12 pricing_col">
                    <div class="pricing_box transition">
	                    <div class="pricing_head">
	                        <h4>Looking for work</h4>
	                    </div>
	                    <div class="pricing_body">
	                    	<div class="body_text">
                    			<h5><span>$49.00</span> +GST per year.</h5>
                    			<h6>Part of a Membership or Group</h6>
	                    	</div>
	                        <ul class="pricing_list">
	                        	<li>
	                        		<h5><i class="fa fa-check"></i>Find work by location</h5>
	                        		<p>Use our interactive map to see where all the work is and plan where you want to work.)</p>
	                        	</li>
	                        	<li>
	                        		<h5><i class="fa fa-check"></i>Find work by Month.</h5>
	                        		<p>Plan your life around when you want to work,  search by start dates and finish dates of jobs.</p>
	                        	</li>
	                        	<li>
	                        		<h5><i class="fa fa-check"></i>Find work that suits your needs</h5>
	                        		<p>Search for jobs that match your needs.  What Facilities & other benefits do they offer, hourly rate, hours per week, intensity of work & skills required.</p>
	                        	</li>
								<li>
	                        		<h5><i class="fa fa-check"></i>Make a favourites list</h5>
	                        		<p>An easy way to keep track of all the jobs that interest you in one place.  </p>
	                        	</li>
								
								<li>
	                        		<h5><i class="fa fa-check"></i>Track your applications.</h5>
	                        		<p>No more forgetting what job you applied for and when, Keep it all together in once place.</p>
	                        	</li>
								
								<li>
	                        		<h5><i class="fa fa-check"></i>Have your own profile.</h5>
	                        		<p>Build your own profile and let prospective employers know about you and what skills you have so that they can search for you.</p>
	                        	</li> 
								
								<li>
	                        		<h5><i class="fa fa-check"></i>Easy application process.</h5>
	                        		<p>At the push of a button let an employer know that you’re interested.  Keep track of where you are with the process.</p>
	                        	</li>
								
								<li>
	                        		<h5><i class="fa fa-check"></i>More features</h5>
	                        		<p>Many other features including Send a quick message to the employer, personalise your profile, update your location quickly, update your availability to work plus many more.</p>
	                        	</li>
								
	                        </ul>
	                    </div>					
							<?php if($this->session->userdata('user_id')==''){ ?> 
									<a href="#" data-toggle="modal" data-target="#login_popup" class="blue_button price_btn" >Join Now</a> 
							<?php  } elseif($user[0]['role']=='employer') {  ?>
							 <a href="#" class="blue_button price_btn">Join Now</a>
							<?php }	else { ?>
	                    <a href="<?php echo base_url(); ?>/staff-membership" class="blue_button price_btn">Join Now</a>
						<?php }  ?>
                    </div>
                </div>
               
			</div> --> 
        </div>
    </div>
    <!-- Pricing section End -->
<div class="business_popup popup_wrapper" id="myDIV">
	<div class="popup_dialog">
		<div class="popup_dialog_inner">
			<span class="p_close_btn"><i class="fa fa-times"></i></span>
			<div class="popup_content">
				<div class="awesome_dv">
					<div class="awesome_top">
						<div class="check_iconn">
							<span><i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>
						</div>						
					</div>
					<div class="awesome_bottom">
					<h4>OOOPS!</h4>
						<p id="msgshow"><b>Find Work Only Show - Staff User</b></p>
		           </div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
function showpopup()
{
 var element = document.getElementById("myDIV");
   element.classList.add("popup_active");
   var role = "<?php echo $user[0]['role']; ?>";
  if(role=='employer'){
  document.getElementById("msgshow").innerHTML = "You must be staff"; 
  } 
  if(role=='staff'){  
  document.getElementById("msgshow").innerHTML = "You must be employers";  
  }  
}
</script>	