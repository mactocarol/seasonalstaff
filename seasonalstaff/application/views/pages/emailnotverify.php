<div class="succcess_wrapper">
	<div class="container">
		<div class="row">
			<div class="col-md-6 offset-md-3">
				<div class="success_div_cover notemailverify">
					<div class="awesome_dv">
						<div class="awesome_top">
							<div class="check_icon">
								<span><i class="fa fa-exclamation"></i></span>
							</div>
							<p>Please verify your Email account.</p>
							<p>Check your email, to verify your account.  If this email is in not in your Inbox check your Spam or junk Folder</p>
						</div>
						<div class="awesome_bottom">						
						<?php
						
                       	if($user[0]['role']=='employer'){ 
						if($user[0]['em_staff_status']==1){
						?>
						
					
						<!-- <a href="#" class="cake_btn popup_btn" value="Start CakeHR" data-show="business_popup">Skip Now</a> -->
						
						
						<a href="<?php echo base_url(); ?>about_company/" class="cake_btn" value="Start CakeHR">Set up your profile now</a>
						
						<?php } else {  ?>
						<!-- <a href="<?php echo base_url(); ?>employee-staff-pricing" class="cake_btn" value="Start CakeHR">Skip Now</a> -->
							
						
						<a href="<?php echo base_url(); ?>employee-staff-pricing" class="cake_btn" value="Start CakeHR">Set up your profile now</a>
						<?php }} if($user[0]['role']=='staff') {
						if($user[0]['em_staff_status']==1){	
						?>
						<!-- <a href="<?php echo base_url(); ?>about_company/" class="cake_btn" value="Start CakeHR">Skip Now</a> -->
						<a href="<?php echo base_url(); ?>manage-work-profile/" class="cake_btn" value="Start CakeHR">Set up your profile now</a>
						<?php } else { ?>
                        <!-- <a href="<?php echo base_url(); ?>staff-membership/" class="cake_btn" value="Start CakeHR">Skip Now</a> -->
						<a href="<?php echo base_url(); ?>staff-membership/" class="cake_btn" value="Start CakeHR">Set up your profile now</a>

						<?php }} ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="business_popup popup_wrapper" id="business_popup">
	<div class="popup_dialog">
		<div class="popup_dialog_inner">
			<span class="p_close_btn"><i class="fa fa-times"></i></span>
			<div class="popup_content">
				<div class="awesome_dv">
					<div class="awesome_top">
						<div class="check_icon">
							<span><i class="fa fa-check"></i></span>
						</div>
						<h4>Awesome!</h4>
						<p>Welcome, Please complete you profile to get started</p>
					</div>
					<div class="awesome_bottom">
		            <a href="<?php echo base_url(); ?>about_company/" class="cake_btn" value="Start CakeHR">Continue</a>

					</div>
				</div>
			</div>
		</div>
	</div>
</div>