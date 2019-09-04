<div class="succcess_wrapper">
	<div class="container">
		<div class="row">
			<div class="col-md-6 offset-md-3">
				<div class="success_div_cover">
					<div class="awesome_dv">
						<div class="awesome_top">
							<div class="check_icon">
								<span><i class="fa fa-check"></i></span>
							</div>
							<h4>Now let’s Get  you Set up.</h4>
							<p>Setting your profile up is easy and will only take a few minutes.</p>
						</div>
						<div class="awesome_bottom">						
						<?php
                       	if($user[0]['role']=='employer'){ ?>
						<a href="<?php echo base_url(); ?>about_company/" class="cake_btn" value="Start CakeHR">Set up your profile now</a>
						<?php } if($user[0]['role']=='staff') {
						?>
						<a href="<?php echo base_url(); ?>manage-work-profile/" class="cake_btn" value="Start CakeHR">Set up your profile now</a>
						<?php } ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>