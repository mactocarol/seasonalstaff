<!-- breadcrumb section Start -->
<div class="breadcrumb text-center">
    <div class="container">
    <h1>Manage your profile</h1>
    <ul><li><a href="#">home</a></li><li>Manage your profile</li></ul>
    </div>
</div>
<?php 
function combine_keys_with_arrays($keys, $arrays) {
    $results = array();

    foreach ($arrays as $subKey => $arr)
    {
       foreach ($keys as $index => $key)
       {
           $results[$key][$subKey] = $arr[$index];    
       }
    }

    return $results;
}
?>
<!-- breadcrumb section End -->
<!-- Dashboard section Start -->
<div class="dashboard_section">
    <div class="container">
        <div class="row">
            <!-- Sidebar Start -->            
            <?php include 'side_bar.php';?>
            <!-- Sidebar End -->
            <div class="col-xl-9 col-lg-8 col-md-12 col-sm-12">
                <div class="dashboard_content_part">
                    <div class="dashboard_content post_work_page">
                        <div class="dashboard_heading">
                            <h4>Manage your profile</h4>
                        </div>
                     
                        <!-- Accordion Start -->
                        <div class="dashboard_accordion_form">
                          <!-- first accordion list Start -->
						   <?php 
						  if($this->uri->segment(1)=='manage-work-profile'){
						  $ggm ='active';
						  $hhm ='active_content';
						  }
						  else {
						   $ggm =''; 
						   $hhm ='';
						  }
						  ?>
                          <div class="accordion_list">
                          	<!-- heading Start -->
                            <div class="panel_heading <?php echo $ggm; ?>">
                              <span class="p_icon">
                                <i class="fa fa-exclamation-circle"></i>
                              </span>
                              <div class="p_text">
                              	<h4>Your profile (Please complete all these fields then save) </h4> 
                              	<!-- <p><i class="fa fa-clock-o"></i> Last Edited: 03:25PM/ 25 Dec 2018 </p> -->
                              </div>
							  <span class="mmmsgm" id="managemessage"></span> 
                            </div>
                            <!-- heading End -->
                            <!-- Panel Content Start -->
                            <div class="panel_content <?php echo $hhm; ?>">
                              <div class="manage_pro_form">
							    <?php if($basicinfo[0]->eligibility_address=='' &&  $basicinfo[0]->available_date=='') { ?>
                              	<form action="<?php echo site_url('Staff_profile/Staffprofile/staffbasiccreate/'); ?>" method="post" id="basicinfo" enctype="multipart/form-data">
								<?php } else {  ?>
								<form action="<?php echo site_url('Staff_profile/Staffprofile/staffbasicupdate/'); ?>" method="post" id="basicinfo" enctype="multipart/form-data">								
								<input type="hidden" id="bid" name="bid" value="<?php if(isset($basicinfo[0]->id)){ echo $basicinfo[0]->id; }?>">
								<?php } ?>
                              		<div class="form_group">							
	                              		<div class="row">
	                              			<div class="col-md-6 label_wrap">
	                              			  <span class="form_icon"><i class="fa fa-globe"></i></span>
	                              			  <div class="form_label">Eligibility to work in NZ:</div>
	                              			</div>
	                              			<div class="col-md-6">
											<div class="form_input select_box">											
		                              		 <select class="selectpicker" id="eligibility_address" name="eligibility_address" onchange="eligibility(this.value)">
		                              					<option value="">Select</option>
		                              					<option value="I am a New Zealand citizen" <?php if(isset($basicinfo[0]->eligibility_address)){ if($basicinfo[0]->eligibility_address=='I am a New Zealand citizen'){ echo 'selected'; }} ?>>I am a New Zealand citizen</option>
														
														<option value="I am a Australian citizen" <?php if(isset($basicinfo[0]->eligibility_address)){ if($basicinfo[0]->eligibility_address=='I am a Australian citizen'){ echo 'selected'; }} ?>>I am a Australian citizen</option>
		                              					
		                              					<option value="I have a Valid New Zealand residence visa" <?php if(isset($basicinfo[0]->eligibility_address)){ if($basicinfo[0]->eligibility_address=='I have a Valid New Zealand residence visa'){ echo 'selected'; }} ?>>I have a Valid New Zealand residence visa</option>
														
														<option value="I have a Valid New Zealand work visa" <?php if(isset($basicinfo[0]->eligibility_address)){ if($basicinfo[0]->eligibility_address=='I have a Valid New Zealand work visa'){ echo 'selected'; }} ?>>I have a Valid New Zealand work visa</option>
														
														<!-- <option value="Other" <?php if(isset($basicinfo[0]->eligibility_address)){ if($basicinfo[0]->eligibility_address=='Other'){ echo 'selected'; }} ?>>Other</option> -->
														
		                              				</select>
		                              			</div>
											
											
		                              		 <!--  <div class="form_input select_box">
		                              			<input type="text" name="eligibility_address" id="eligibility_address" value="<?php if(isset($basicinfo[0]->eligibility_address)){ echo $basicinfo[0]->eligibility_address; } ?>">
		                              		
											  <input type="hidden" name="city2" id="city2" class="form-control" placeholder="Enter latitude" value="<?php if(isset($basicinfo[0]->city2)){ echo $basicinfo[0]->city2; } ?>">

											   
											   <input type="hidden" name="cityLat" id="cityLat" class="form-control" placeholder="Enter latitude" value="<?php if(isset($basicinfo[0]->cityLat)){ echo $basicinfo[0]->cityLat; } ?>">

                                               <input type="hidden" name="cityLng" id="cityLng" class="form-control" placeholder="Enter longitude" value="<?php if(isset($basicinfo[0]->cityLng)){ echo $basicinfo[0]->cityLng; } ?>">
												
												</div> -->
	                              			</div>
	                              		</div>
                              		</div>
									
									<?php if($basicinfo[0]->eligibility_address=='I have a New Zealand work visa')
									{
									$dd ='style="display: block;"';	
									}	
                                    else{
									$dd ='style="display: none;"';		
									} 
									?>
									<div class="form_group" id="documentup" <?php echo $dd; ?>>
	                              		<div class="row">
	                              			<div class="col-md-6 label_wrap">
	                                          <span class="form_icon"><i class="fa fa-clipboard" aria-hidden="true"></i></span>
	                              			  <div class="form_label">Document Upload</div>
	                              			</div>
	                              			<div class="col-md-6">
		                              			<div class="form_input select_box">
		                              		   <input type="file" name="document" id="document"onchange="ValidateExtension(1)">
											   
											   <input type="hidden" name="document1" id="document1" value="<?php if(isset($basicinfo[0]->document)){ echo $basicinfo[0]->document; } ?>" >
		                              			</div>
												 <p id="message1" style="color:red;"></p> 
	                                             <span id="lblError1" style="color:red;"></span>
	                              			</div>
	                              		</div>
                              		 </div>
									
									
                              		<div class="form_group">
	                              		<div class="row">
	                              			<div class="col-md-6 label_wrap">
	                              			  <span class="form_icon"><i class="fa fa-calendar"></i></span>
	                              			  <div class="form_label">Dates available to work from</div>
	                              			</div>
	                              			<div class="col-md-6">
											<?php 
                                                $avg_date = date("Y", strtotime($basicinfo[0]->available_date));
                                                if($avg_date=="" or $avg_date=="1970"){
												$available_date =	date("d M Y", strtotime($user[0]->date_avail));
												
												
												}
												else {
												$available_date = date("d M Y", strtotime($basicinfo[0]->available_date));	
											 	}
												?>
											
		                              			<div class="form_input select_box">
		                              		   <input type="text" class="datepicker" name="available_date" id="available_date" value="<?php echo $available_date; ?>" autocomplete="off">
		                              			</div>
	                              			</div>
	                              		</div>
                              		</div>
                              		<div class="form_group">
	                              		<div class="row">
	                              			<div class="col-md-6 label_wrap">
	                              			  <span class="form_icon"><i class="fa fa-map-marker"></i></span>
	                              			  <div class="form_label">Select your Street address</div>
	                              			</div>
	                              			<div class="col-md-6">
											 <span class="input_text_msg">(Select your Street address on drop down list)</span>
											  
		                              			<div class="form_input select_box">										
											 <?php 
                                                $current_location =	 $user[0]->business_location;
												$cityc = $user[0]->city2; 												
												$cityLatc = $user[0]->cityLat;										
												$cityLngc = $user[0]->cityLng; 
											  ?>											 
											  
		                                      <input type="text" name="current_location" id="current_location" value="<?php  echo $current_location; ?>" placeholder="Enter Your Closest Suburb" autocomplete="off">
												
                                               <input type="hidden" name="cityc" id="cityc" class="form-control" placeholder="Enter latitude" value="<?php echo $cityc; ?>" >
											   
											  <input type="hidden" name="cityLatc" id="cityLatc" class="form-control" placeholder="Enter latitude" 
											  value="<?php  echo $cityLatc; ?>">

                                               <input type="hidden" name="cityLngc" id="cityLngc" class="form-control" placeholder="Enter longitude"  
											   value="<?php echo$cityLngc; ?>">
		                              			</div>
												<span class="input_text_msg tred">(Update your address when you move locations)</span>
	                              			</div>
	                              		</div>
                              		</div>
                              		<div class="form_group">
	                              		<div class="row">
	                              			<div class="col-md-6 label_wrap">
	                              			  <span class="form_icon"><i class="fa fa-map-marker"></i></span>
	                              			  <div class="form_label">Location Considered</div>
	                              			</div>
	                              			<div class="col-md-6">
		                          <div class="form_input select_box">
		                          <select class="selectpicker" multiple="" name="considered_location[]" id="considered_location" placeholder="Enter all locations considered">
		                              				<option value="">Select</option>
													<?php if(isset($lconsidered)) { 
													foreach($lconsidered as $clist) {
													?>
		                              				<option value="<?php echo $clist->id; ?>" <?php if(isset($basicinfo[0]->considered_location)) {  if(in_array($clist->id,explode(",",$basicinfo[0]->considered_location))) { echo "selected"; } } ?>><?php echo $clist->name; ?></option>
													<?php }}  ?>
		                              					
		                              				</select>
		                              			</div>
	                              			</div>
	                              		</div>
                              		</div>                              		
									
                              		<div class="form_group">
	                              		<div class="row">
	                              			<div class="col-md-6 label_wrap">
	                              			  <span class="form_icon"><i class="fa fa-language"></i></span>
	                              			  <div class="form_label">Level of English</div>
	                              			</div>
	                              			<div class="col-md-6">
		                              			<div class="form_input select_box">
		                              				<select class="selectpicker" id="level_english" name="level_english">
		                              					<option value="">Select</option>
		                              					<option value="below" <?php if(isset($basicinfo[0]->level_english)){ if($basicinfo[0]->level_english=='below'){ echo 'selected'; }} ?>> Below Average</option>
														
														<option value="average" <?php if(isset($basicinfo[0]->level_english)){ if($basicinfo[0]->level_english=='average'){ echo 'selected'; }} ?>> Average</option>
		                              					
		                              					<option value="above" <?php if(isset($basicinfo[0]->level_english)){ if($basicinfo[0]->level_english=='above'){ echo 'selected'; }} ?>> Above Average</option>
		                              				</select>
		                              			</div>
	                              			</div>
	                              		</div>
                              		</div>
									
                              		<div class="form_group">
	                              		<div class="row">
	                              			<div class="col-md-6 label_wrap">
	                              			  <span class="form_icon"><i class="fa fa-universal-access"></i></span>
	                              			  <div class="form_label">Level of Fitness</div>
	                              			</div>
	                              			<div class="col-md-6">
		                              			<div class="form_input select_box">
		                              				<select class="selectpicker" id="level_fitness" name="level_fitness">
		                              					<option value="">Select</option>
		                              					<option value="below" <?php if(isset($basicinfo[0]->level_fitness)){ if($basicinfo[0]->level_fitness=='below'){ echo 'selected'; }} ?>>Below Average</option>
														
														<option value="average" <?php if(isset($basicinfo[0]->level_fitness)){ if($basicinfo[0]->level_fitness=='average'){ echo 'selected'; }} ?>>Average</option>
		                              					
		                              					<option value="above" <?php if(isset($basicinfo[0]->level_fitness)){ if($basicinfo[0]->level_fitness=='above'){ echo 'selected'; }} ?>>Above Average</option>
		                              				</select>
		                              			</div>
	                              			</div>
	                              		</div>
                              		</div>
									
									<div class="form_group">
	                              		<div class="row">
	                              			<div class="col-md-6 label_wrap">
	                              			  <span class="form_icon"><i class="fa fa-language"></i></span>
	                              			  <div class="form_label">languages known</div>
	                              			</div>
	                              			<div class="col-md-6">
		                              			<div class="form_input select_box">
											
		                              				<select class="selectpicker" data-live-search="true" multiple="" 
													id="languages" name="languages[]"> 
		                              					<option value="">Select</option>
													
		                              					<option value="english" <?php if(isset($basicinfo[0]->languages)) {  if(in_array('english',explode(",",$basicinfo[0]->languages))) { echo "selected"; } } ?>>English</option>
														
													    <option value="Maori" <?php if(isset($basicinfo[0]->languages)) {  if(in_array('Maori',explode(",",$basicinfo[0]->languages))) { echo "selected"; } } ?>>Maori</option>														
		                              					<option value="german" <?php if(isset($basicinfo[0]->languages)) { if(in_array('german',explode(",",$basicinfo[0]->languages))) { echo "selected"; } } ?>>German</option>
		                              					<option value="french" <?php if(isset($basicinfo[0]->languages)) { if(in_array('french',explode(",",$basicinfo[0]->languages))) { echo "selected"; } } ?>>French</option>
		                              					<option value="mandarin" <?php if(isset($basicinfo[0]->languages)) { if(in_array('mandarin',explode(",",$basicinfo[0]->languages))) { echo "selected"; } } ?>>Mandarin</option>
		                              					<option value="japanese" <?php if(isset($basicinfo[0]->languages)) { if(in_array('japanese',explode(",",$basicinfo[0]->languages))) { echo "selected"; } } ?>>Japanese</option>
		                              					<option value="spanish" <?php if(isset($basicinfo[0]->languages)) { if(in_array('spanish',explode(",",$basicinfo[0]->languages))) { echo "selected"; } } ?>>Spanish</option>
		                              					<option value="italian" <?php if(isset($basicinfo[0]->languages)) { if(in_array('italian',explode(",",$basicinfo[0]->languages))) { echo "selected"; } } ?>>Italian</option>
		                              					<option value="punjabi" <?php if(isset($basicinfo[0]->languages)) { if(in_array('punjabi',explode(",",$basicinfo[0]->languages))) { echo "selected"; } } ?>>Punjabi</option>
														
		                              					<option value="hindi" <?php if(isset($basicinfo[0]->languages)) { if(in_array('hindi',explode(",",$basicinfo[0]->languages))) { echo "selected"; } } ?>>Hindi</option>
														
														<option value="Other" <?php if(isset($basicinfo[0]->languages)) { if(in_array('Other',explode(",",$basicinfo[0]->languages))) { echo "selected"; } } ?>>Other</option>
														
		                              				 </select>
		                              			</div>
	                              			</div>
	                              		</div>
                              		</div>
									
									
                              		<div class="form_group">
	                              		<div class="row">
	                              			<div class="col-md-6 label_wrap">
	                              			  <span class="form_icon"><i class="fa fa-globe"></i></span>
	                              			  <div class="form_label">Nationality</div>
	                              			</div>
	                              			<div class="col-md-6">
		                              			<div class="form_input">
												 <input type="text" name="nationality" id="nationality" value="<?php if(isset($basicinfo[0]->nationality)){ echo $basicinfo[0]->nationality; } ?>" placeholder="Please type your Nationality">
											   </div>
	                              			</div>
	                              		</div>
                              		</div>
									
                              		<div class="form_group">
	                              		<div class="row">
	                              			<div class="col-md-6 label_wrap">
	                              			  <span class="form_icon"><i class="fa fa-phone"></i></span>
	                              			  <div class="form_label">contact</div>
	                              			</div>
	                              			<div class="col-md-6">
		                              			<div class="form_input select_box">
		                              				<input type="text" name="contact" id="contact" value="0<?php if(isset($user[0]->contact_number)){ echo $user[0]->contact_number; } ?>" readonly>
		                              			</div>
	                              			</div>
	                              		</div>
                              		</div>
                              		<div class="form_group">
	                              		<div class="row">
	                              			<div class="col-md-6 label_wrap">
	                              			  <span class="form_icon"><i class="fa fa-envelope"></i></span>
	                              			  <div class="form_label">Email Address</div>
	                              			</div>
	                              			<div class="col-md-6">
		                              			<div class="form_input select_box">
		                              				<input type="email" name="email" id="email" value="<?php if(isset($user[0]->email)) { echo $user[0]->email; } ?>" readonly>
		                              			</div>
	                              			</div>
	                              		</div>
                              		</div>
                              		<div class="form_group">
	                              		<div class="row">
	                              			<div class="col-md-6 label_wrap">
	                              			  <span class="form_icon"><i class="fa fa-calendar-plus-o"></i></span>
	                              			  <div class="form_label">Member Since</div>
	                              			</div>
	                              			<div class="col-md-6">
		                              			<div class="form_input select_box">
		                              				<input type="text"  name="member_since" id="member_since" value="<?php if(isset($user[0]->created_date)) { echo date("d-m-Y", strtotime($user[0]->created_date)); } ?>" readonly>
		                              			</div>
	                              			</div>
	                              		</div>
                              		</div>
									
									<div class="form_group">
	                              		<div class="row">
	                              			<div class="col-md-6 label_wrap">
	                              			  <span class="form_icon"><i class="fa fa-audio-description" aria-hidden="true"></i></span>
	                              			  <div class="form_label">Tell us about yourself</div>
	                              			</div>
	                              			<div class="col-md-6">
		                              			<div class="form_input select_box">
												<textarea name="basic_description" id="basic_description" class="valid" aria-invalid="false"><?php if(isset($basicinfo[0]->basic_description)){ echo $basicinfo[0]->basic_description; } ?> </textarea>                         			
		                              			</div>	
											 <div class="check_box">
											 <?php $extra_about = '';
                                                     if(!empty($basicinfo[0]->extra_about)){
                                                     $extra_about = explode(',',$basicinfo[0]->extra_about);
													 } ?>
											    <label>
                                                    <input type="checkbox" name="extra_about[]" id="extra_about" value="1"
													<?php echo (in_array(1,$extra_about)) ? 'checked' : ''; ?>>
                                                    <span class="checked_box"></span>
                                                    <span class="check_text">I have a fully self-contained vehicle</span>
                                                </label>
												
                                                <label>
                                                    <input type="checkbox" name="extra_about[]" id="extra_about" value="2"
													<?php echo (in_array(2,$extra_about)) ? 'checked' : ''; ?>>
                                                    <span class="checked_box"></span>
                                                    <span class="check_text">I am not fully self-contained</span>
                                                </label>
                                                
												<label>
                                                    <input type="checkbox" name="extra_about[]" id="extra_about" value="3"
													<?php echo (in_array(3,$extra_about)) ? 'checked' : ''; ?>>
                                                    <span class="checked_box"></span>
                                                    <span class="check_text">I would need accommodation</span>
                                                </label>
												
                                              </div> 
												
				                             </div>
												
	                              			</div>
	                              		</div>
                              		</div>
									
                              		<div class="form_group button_group">						
								
									<input type="submit" name="save_btn" class="save_btn blue_button" value="Save & Continue">
	                                </div>
                              	</form> 
                              </div>
                            </div>
                            <!-- Panel Content Start -->
                          </div>
                          <!-- first accordion list End -->
						  <?php 
						  if($this->uri->segment(4)=='skill'){
						  $gg ='active';
						  $hh ='active_content';
						  }
						  else {
						   $gg =''; 
						   $hh ='';
						  }
						  ?>
						  <!-- Second accordion list Start -->
                          <div class="accordion_list">
                          	<!-- heading Start -->
                            <div class="panel_heading <?php echo $gg; ?>">
                              <span class="p_icon">
                                <i class="fa fa-graduation-cap"></i>
                              </span>
                              <div class="p_text">
                              	<h4>Skills and attributes</h4>
                              	<!-- <p><i class="fa fa-clock-o"></i> Last Edited: 03:25PM/ 25 Dec 2018 </p> -->
                              </div>
                            </div>
                            <!-- heading End -->
                            <!-- Panel Content Start -->
                            <div class="panel_content <?php echo $hh; ?>">
                              <div class="manage_pro_form">
							   <?php  if(count($skillinfo)==0){ ?>
                              	<form action="<?php echo site_url('Staff_profile/Staffprofile/staffskillcreate/'); ?>" method="post" id="skillinfo" enctype="multipart/form-data">
							   <?php } else {  ?>
							   <form action="<?php echo site_url('Staff_profile/Staffprofile/staffskillupdate/'); ?>" method="post" id="skillinfo" enctype="multipart/form-data">
							   <input type="hidden" id="skid" name="skid" value="<?php if(isset($skillinfo[0]->id)) { echo $skillinfo[0]->id;} ?>"> 
							   <?php }  ?>
                              		<div class="append_skill_data">
	                              		<!-- group wrapper Strt -->
	                              		<div class="group_wrapper">
									<input type="hidden" id="skid" name="skid" value="<?php if(isset($skillinfo[0]->id)) { echo $skillinfo[0]->id;} ?>">
										<div class="form_group">
			                              		<div class="row">
			                              			<div class="col-md-5 label_wrap">
			                              			  <div class="form_label"><b>List your Skills and Attributes</b></div>
			                              			</div>
			                              			<div class="col-md-7">
				                              			<div class="form_input">
				                              			<div class="form_input">
														    <span class="input_text_msg">(Maximum 35 Characters per line)</span>
				                              				<textarea name="sklills-description" id="sklills-description"placeholder="Ex - Computer skills, Packhouse work"><?php if(isset($skillinfo[0]->sklills_description)) { echo $skillinfo[0]->sklills_description;} ?></textarea>
				                              				
				                              			</div>
				                              			</div>
			                              			</div>
			                              		</div>
		                              		</div>

									  <div class="form_group">
	                              		<div class="row">
	                              			<div class="col-md-5 label_wrap"> 	                                        
	                              			  <div class="form_label"><b>Upload CV</b></div>
	                              			</div>
	                              			<div class="col-md-6">
		                              			<div class="form_input select_box">
		                              		   <input type="file" name="cv_ele" id="cv_ele">
											   
											   <input type="hidden" name="cv_ele1" id="cv_ele1" value="<?php if(isset($skillinfo[0]->cv_ele)){ echo $skillinfo[0]->cv_ele; } ?>" >
		                              			</div>
												 <p id="message1" style="color:red;"></p> 
	                                             <span id="lblError1" style="color:red;"></span>
	                              			</div>
	                              		</div>
                              		 </div>
		                              		
		                              		
		                              		
											
											<div class="form_group">
			                              		<div class="row">
			                              			<div class="col-md-5 label_wrap">
			                              			  <div class="form_label"><b>licence and endorsement</b></div>
			                              			</div>
			                              			<div class="col-md-7">
				                              			<div class="form_input">
												  <span class="input_text_msg">(Mark all that apply to you)</span>
                                            <div class="check_box">
											
											<?php
											   $licence = '';

                                                     if(!empty($skillinfo[0]->licence)){
                                                     $licence = explode(',',$skillinfo[0]->licence);
													 }
                                              if(!empty($skills)){
                                              foreach($skills as $value){
                                              ?>
                                                <label>
                                                    <input type="checkbox" name="licence[]" id="licence" value="<?php echo !empty($value->id) ? $value->id : ''; ?>"

                                                    <?php echo (in_array($value->id,$licence)) ? 'checked' : ''; ?>>
                                                    <span class="checked_box"></span>
                                                    <span class="check_text"><?php echo !empty($value->skills) ? $value->skills : ''; ?></span>
                                                </label>
                                                <?php
                                                 }
                                                 }
                                                ?>                                               
											
                                              </div>                          			
				                              		  </div>
			                              			</div>
			                              		</div>
		                              		</div>						
									
											
	                              		</div>
	                              		<!-- group wrapper end -->
	                              	  </div>
                              		<div class="form_group button_group">
                              			<!-- <div class="add_more_btn add_skill_btn">
                              				<span class="icon"><i class="fa fa-plus"></i></span> 
                              				Add more Courses
                              			</div> -->
								 <!-- <a href="javascript:void(0);" class="save_btn blue_button" onclick="savedataskills()">Preview work profile</a> -->					
								
						  <input type="submit" name="save_btn" class="save_btn blue_button" value="Save">	
								
								</div>
                              	</form>
                              </div>
                            </div>
                            <!-- Panel Content Start -->
                          </div>
						  
						  <?php 
						  if($this->uri->segment(4)=='emp'){
						  $gge ='active';
						  $hhe ='active_content';
						  }
						  else {
						   $gge =''; 
						   $hhe ='';
						  }
						  ?>
						  
						  <!-- Third accordion list Start -->
                          <div class="accordion_list">
                          	<!-- heading Start -->
                            <div class="panel_heading <?php echo $gge; ?>">
                              <span class="p_icon">
                                <i class="fa fa-briefcase"></i>
                              </span>
                              <div class="p_text">
                              	<h4>Employment History</h4>
                              	<!-- <p><i class="fa fa-briefcase"></i> Last Edited: 03:25PM/ 25 Dec 2018 </p> -->
                              </div>
                            </div>
                            <!-- heading End -->
                            <!-- Panel Content Start -->
                            <div class="panel_content <?php echo $hhe; ?>">
                              <div class="manage_pro_form">
							 <?php  if(count($employment)==0){ ?>
                             <form action="<?php echo site_url('Staff_profile/Staffprofile/staffemploymentcreate/'); ?>" method="post" id="employmentinfo">
							 <?php } else {  ?> 
                             <form action="<?php echo site_url('Staff_profile/Staffprofile/staffemploymentupdate/'); ?>" method="post" id="employmentinfo">
							 <input type="hidden" id="ekid" name="ekid" value="<?php if(isset($employment[0]->id)) { echo $employment[0]->id;} ?>"> 
							 <?php } ?>
                              		<div class="append_employ_data">
									
									<input type="hidden" id="ekid" name="ekid" value="<?php if(isset($employment[0]->id)) { echo $employment[0]->id;} ?>">
	                              		<!-- group wrapper Start -->
	                              		<div class="group_wrapper">
										<?php 										
                                        if(count($employment)==0){									
										?>
									  <div class="form_group">
			                              		<div class="row">
			                              			<div class="col-md-6 label_wrap">
			                              			  <div class="form_label">Job</div>
			                              			</div>
			                              			<div class="col-md-6">
				                              			<div class="form_input select_box">
													      <input type="text" name="jobtitle[]" id="jobtitle">              				
				                              			</div>
			                              			</div>
			                              		</div>
		                              	</div>
										
										
										<div class="form_group">
			                              		<div class="row">
			                              			<div class="col-md-6 label_wrap">
			                              			  <div class="form_label">Industry</div>
			                              			</div>
			                              			<div class="col-md-6">
				                              			<div class="form_input select_box">
													
												
										<select class=""  name="industry[]" id="industry" placeholder="Enter Industry" onchange="eligibilityss(this.value)">
		                              				<option value="">Select</option>
													<?php if(isset($industry)) { 
													foreach($industry as $clist) {
													?>
		                              				<option value="<?php echo $clist->id; ?>"><?php echo $clist->name; ?></option>
													<?php }}  ?>
		                              					
		                              				</select>             				
				                              			</div>
			                              			</div>
			                              		</div>
		                              		</div>								
										
		                              		
		                              		<div class="form_group">
			                              		<div class="row">
			                              			<div class="col-md-6 label_wrap">
			                              			  <div class="form_label">Select Date</div>
			                              			</div>
			                              			<div class="col-md-6 date_inputs">
			                              			   <div class="form_input">
			                              			    	<div class="form_label">From Date</div>
				                              		<input type="text" class="from_date" name="fromdate[]" 
															id="fromdate" autocomplete="off">
				                              			</div>
				                              			<div class="form_input">
				                              				<div class="form_label">To Date</div>
				                              				<input type="text" class="to_date" name="todate[]" id="todate" autocomplete="off">
				                              			</div>
			                              			</div>
			                              		</div>
		                              		</div>
		                              		<div class="form_group">
			                              		<div class="row">
			                              			<div class="col-md-6 label_wrap">
			                              			  <div class="form_label">Description</div>
			                              			</div>
			                              			<div class="col-md-6">
				                              	<div class="form_input">
				                              	<textarea name="employment-description[]" id="employment-description"></textarea>
				                              				<span class="input_text_msg">(You can write maximum of 50 characters)</span>
				                              			</div>
			                              			</div>
			                              		</div>
		                              		</div>
										<?php  } else {
                                        if(!empty($employment[0]->jobtitle)){ $jobtitle = $employment[0]->jobtitle;										
                                        if(!empty($employment[0]->fromdate)){ $fromdate = $employment[0]->fromdate;
	                                    if(!empty($employment[0]->todate)){ $todate = $employment[0]->todate;
										if(!empty($employment[0]->employment_description)){ $description = $employment[0]->employment_description;
										if(!empty($employment[0]->em_industry)){ $industrye = $employment[0]->em_industry;
																		
										$avalued1=(unserialize($jobtitle));
	                                    $avalued2=(unserialize($fromdate));
	                                    $avalued3=(unserialize($todate));
										$avalued4=(unserialize($description));
										$avalued5=(unserialize($industrye));
										$b1=count($avalued2);
										for($ii=1;$ii<=$b1;$ii++)
                                        {
                                        $cc1[]=$ii;
                                        }
                                        $keys1=$cc1; 
										$t2=combine_keys_with_arrays($keys1, array(
                                        'data1'  => $avalued1,
                                        'data2' => $avalued2,
                                        'data3'    => $avalued3,
										'data4'    => $avalued4,
										'data5'    => $avalued5));
									    // echo count($t2);
                                        //print_r($t2); 
										//die;
										$i = 1;
                                        foreach($t2 as $key => $t11){
										//echo count($t11); die;
										?>
										<div id="deletethis<?php echo $i; ?>">
										<div class="form_group">
			                              		<div class="row">
			                              			<div class="col-md-6 label_wrap">
			                              			  <div class="form_label">Job</div>
			                              			</div>
			                              			<div class="col-md-6">
				                              			<div class="form_input select_box">
													      <input type="text" name="jobtitle[]" id="jobtitle" value="<?php echo $t11['data1']; ?>">              				
				                              			</div>
			                              			</div>
			                              		</div>
		                              	</div>
										
										<div class="form_group">
			                              		<div class="row">
			                              			<div class="col-md-6 label_wrap">
			                              			  <div class="form_label">Industry</div>
			                              			</div>
			                              			<div class="col-md-6">
				                              			<div class="form_input select_box">
														
						                         
											       <select class="" name="industry[]" id="industry" placeholder="Enter Industry" onchange="eligibilityss(this.value)">
		                              				<option value="">Select</option>
													<?php if(isset($industry)) { 
													foreach($industry as $clist) {
													?>
		                              				<option value="<?php echo $clist->id; ?>" <?php if($clist->id==$t11['data5']){ echo 'selected'; } ?>><?php echo $clist->name; ?></option>
													<?php }}  ?>
		                              				</select>             				
				                              			</div>
			                              			</div>
			                              		</div>
		                              		</div>
										
		                              		<div class="form_group">
			                              		<div class="row">
			                              			<div class="col-md-6 label_wrap">
			                              			  <div class="form_label">Select Date</div>
			                              			</div>
			                              			<div class="col-md-6 date_inputs">
			                              			   <div class="form_input">
			                              			    	<div class="form_label">From Date</div>
				                              				<input type="text" class="from_date" name="fromdate[]" 
														 id="fromdate<?php echo $i; ?>"  value="<?php echo $t11['data2']; ?>" autocomplete="off">
				                              			</div>
				                              			<div class="form_input">
				                              				<div class="form_label">To Date</div>
				                              				<input type="text" class="to_date" name="todate[]" id="todate<?php echo $i; ?>" value="<?php echo $t11['data3']; ?>" autocomplete="off">
				                              			</div>
														<span id="errorid<?php echo $i; ?>" style="color:red;"></span>
			                              			</div>
			                              		</div>
		                              		</div>
		                              		<div class="form_group">
			                              		<div class="row">
			                              			<div class="col-md-6 label_wrap">
			                              			  <div class="form_label">Description</div>
			                              			</div>
			                              			<div class="col-md-6">
				                              	<div class="form_input">
				                            <textarea name="employment-description[]" id="employment-description"><?php echo $t11['data4']; ?></textarea>
				                              				<span class="input_text_msg">(You can write maximum of 50 characters)</span>
				                              			</div>
			                              			</div>
			                              		</div>
		                              		</div>
											<div>
											<span class="dele emp_remove1" id="<?php echo $i; ?>"><i class="fa fa-times"></i></span>											
										   </div>
										   </div>
										<?php $i++; }}}}}}} ?>
		                              		
	                              		</div>
	                              		<!-- group wrapper end -->
	                              	</div>
                              		<div class="form_group button_group">
                              			<div class="add_more_btn add_employ_btn">
                              				<span class="icon"><i class="fa fa-plus"></i></span> 
                              				Add Employment history
                              			</div>
										
										<!-- <a href="javascript:void(0);" class="save_btn blue_button" onclick="savedataemployment();savedata();savedataskills()">Preview work profile</a> -->
										
										<input type="submit" name="save_btn" class="save_btn blue_button" value="save">								 
	                              		
                              		</div>
                              	 </form> 
                              </div>							  
                            </div>
                            <!-- Panel Content Start -->						
										
                          </div>	
						  
                          
                        </div>
						    <div class="man_button">						
						  <a href="javascript:void(0);" class="save_btn blue_button" onclick="savedataemployment();savedata();savedataskills();saveimage()">Preview work profile</a>
                          <!-- Third accordion list End -->		  
                          <!-- Accordion End -->
						 
						  <?php //if($basicinfo[0]->id==""){ ?>
						  <!--  <a href="#"  class="save_btn blue_button pull_right" onclick="manageprofiel();">Publish Manage Your Profile</a> -->
						  <?php //} else {  ?>
						  <!-- <a href="<?php echo base_url(); ?>Staff_profile/Staffprofile/staffbasicpublish" class="save_btn blue_button pull_right">Publish Manage Your Profile</a> -->
                          <?php //} ?>
						  </div>
						  
                          <!-- Third accordion list End -->		  
                        <!-- Accordion End -->
						<!-- <input type="submit" name="save_btn" class="save_btn blue_button" value="Save" onclick="savedataemploymenthh();">	-->
						</form>								
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Notification popup start -->
<div class="new_notif_popupde popup_wrapper">
    <div class="popup_dialog">
        <div class="popup_dialog_inner">
            <span class="p_close_btn"><i class="fa fa-times"></i></span>
            <div class="popup_content">
                <div class="awesome_dv">
                    <div class="awesome_top">
                        <div class="check_iconn">
                            
                            <!--<span class="popup_img">
                                <img src="https://www.seasonalstaff.co.nz/public/front_end/images/dashboard/user.jpg" class="img-fluid">
                            </span>-->
                        </div>
                        <h4>Please click on save button</h4>
                       
                    </div>
                   
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Notification popup End -->



<!-- Notification popup start -->
<div class="new_notif_popup popup_wrapper">
    <div class="popup_dialog">
        <div class="popup_dialog_inner">
            <span class="p_close_btn"><i class="fa fa-times"></i></span>
            <div class="popup_content">
                <div class="awesome_dv">
                    <div class="awesome_top">
                        <div class="check_iconn">
                            <span>
    <?php 
	if(!empty($result[0]['image']) && !empty($result[0]['server_image'])){
	?>	
	<img src="<?php echo base_url('public/upload/userProfile/'.$result[0]['image']); ?>" alt="Profile Pic" class="nnmg">	
	<?php }  elseif(!empty($result[0]['image'])){?> 
	 <img src="<?php echo base_url('public/upload/userProfile/'.$result[0]['image']); ?>" alt="Profile Pic" class="nnmg">
	<?php } elseif(!empty($result[0]['server_image'])){
		if($result[0]['facebook']=='facebook'){?>
	<img src="https://graph.facebook.com/<?php echo $result[0]['facebook_id']; ?>/picture?type=large" alt="Profile Pic" class="nnmg">
	<?php } else { ?>
	<img src="<?php echo $result[0]['server_image']; ?>" alt="Profile Pic">
	<?php } } else {	
			$image = 'userst.jpg';
		?>
	  <img src="<?php echo base_url(); ?>public/front_end/images/dashboard/<?php echo $image; ?>" alt="Profile Pic" class="nnmg">
	 <?php } ?>
                            </span>
                            <!--<span class="popup_img">
                                <img src="https://www.seasonalstaff.co.nz/public/front_end/images/dashboard/user.jpg" class="img-fluid">
                            </span>-->
                        </div>
                        <h4>Great Job, <?php echo $result[0]['first_name']; ?> <?php echo  $result[0]['last_name']; ?></h4>
                        <p>Now add your Skills & Employment History so Employers can search for your Skills</p>                   
                    </div>
                    <div class="popup_bottom_buttons">
                       <a href="<?php echo base_url(); ?>Welcome/find_work" class="green_button">Find Work</a>
				      <a href="<?php echo base_url(); ?>Staff_profile/Staffprofile/manage_work_profile/skill" class="green_button">Skills & Employment History</a>
                   </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Notification popup End -->

<!-- Dashboard section End -->
<script>
$(window).on('load', function(){
	var usuu ="<?php echo $this->uri->segment(2); ?>";
	if(usuu=="go"){
      setTimeout(function(){
        $(".new_notif_popup").addClass("popup_active");
      },1000);
	}
     });


$(document).ready(function(){
    $('#current_location').blur(function(){
 
        if(!$(this).val()){
            $(this).addClass("error");
        } else{
		$("#cityLatc-error").hide();	
           // $(this).removeClass("cityLatc-error");
        }
    });
});

function manageprofiel(){
 document.getElementById("managemessage").innerHTML = "first complete  this - your Profile (These Publish Manage Your Profile)";	
}


function eligibilityss(value){
document.getElementById("industrysid").value=value;
document.getElementById("industrys1").value=value;
}

function eligibility(value){
if(value=='I have a New Zealand work visa'){
document.getElementById("documentup").style.display = "block";
}
else{
document.getElementById("documentup").style.display = "none";
}
}

 $(document).on('click', '.emp_remove1', function(){
	 //alert('neha');
      var button_id = $(this).attr("id");
      $('#deletethis'+button_id+'').remove();
	  setTimeout(function(){
        $(".new_notif_popupde").addClass("popup_active");
      },1000); 
    });

function ValidateExtension(id) {
	
        var allowedFiles = [".jpg", ".png", ".pdf"];
        var fileUpload = document.getElementById("document");
        var lblError = document.getElementById("lblError"+id);
        var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(" + allowedFiles.join('|') + ")$");
		if (!regex.test(fileUpload.value.toLowerCase())) 
		{
        lblError.innerHTML = "Please upload files having extensions: <b>" + allowedFiles.join(', ') + "</b> only.";
			jQuery("#svm").attr("disabled", true);         
        }
		else{
			
        jQuery("#svm").attr("disabled", false);
	    jQuery("#message"+id).html('');		
		 lblError.innerHTML = "";
		//jQuery("#savenn").attr("disabled", false);
        // document.getElementById('filename'+id).style.display = 'block';
        }
				
		}



 //append data in Employe history section
    var l = 1;
	 var l1 = '<?php echo count($t11)+1 ?>';
    $('.add_employ_btn').on('click', function(){
      l++;
	  l1++;
	
      var append_data = ('<div class="group_wrapper n_group_wrapper " id="egrp_row'+l+'">'+
	  '<div class="form_group"><div class="row"><div class="col-md-6 label_wrap"><div class="form_label">Job</div></div><div class="col-md-6"><div class="form_input select_box"><input type="text" name="jobtitle[]" id="jobtitle"></div></div></div></div>'+
	  '<div class="form_group">'+
      		'<div class="row">'+
      			'<div class="col-md-6 label_wrap">'+
      			  '<div class="form_label">Industry</div>'+
      			'</div>'+
      			'<div class="col-md-6">'+
          			'<div class="form_input select_box">'+
					
			 '<select class=""  name="industry[]" id="industry" placeholder="Enter Industry">'+
  				'<option value="">Select</option>'+
				<?php if(isset($industry)) {
				foreach($industry as $clist) {
				?>
  				'<option value="<?php echo $clist->id; ?>" <?php if($clist->id==$t11['data5']){ echo 'selected'; } ?>><?php echo $clist->name; ?></option>'+
				<?php }}  ?>
  					
  				'</select> '+        				
          			'</div>'+
      			'</div>'+
      		'</div>'+
  		'</div>'+
	  	'<div class="form_group"><div class="row"><div class="col-md-6 label_wrap"><div class="form_label">Select Date</div></div><div class="col-md-6 date_inputs"><div class="form_input"><div class="form_label">From Date</div><input type="text" class="from_date" name="fromdate[]" id="fromdate'+l1+'" autocomplete="off"></div><div class="form_input"><div class="form_label">To Date</div><input type="text" class="to_date" name="todate[]" id="todate'+l1+'" autocomplete="off"></div></div></div></div><div class="form_group"><div class="row"><div class="col-md-6 label_wrap"><div class="form_label">Description</div></div><div class="col-md-6"><div class="form_input"><textarea name="employment-description[]" id="employment-description"></textarea><span class="input_text_msg">(You can write maximum of 50 characters)</span></div></div></div></div><span class="remove_field emp_remove" id="'+l+'"><i class="fa fa-times"></i></span></div>');
  		 $('.append_employ_data').append(append_data);
	    //Selectpicker
		
	      if ($(".selectpicker").length > 0) {
	        $('.selectpicker').selectpicker();
	      }
       //Datepicker
         $(function() {
		    var dateFormat = "dd-MM-yy",
		      from = $(".from_date")
		        .datepicker({
					dateFormat: dateFormat,
					changeMonth: true,
					changeYear: true,
		        })
		        .on("change", function() {
		          to.datepicker( "option", "minDate", getDate(this) );
		        }),
		      to = $(".to_date").datepicker({
				dateFormat: dateFormat,
				changeMonth: true,
				changeYear: true,
		      })
		      .on( "change", function() {
		        from.datepicker( "option", "maxDate", getDate(this) );
		      });
		 
		    function getDate( element ) {
		      var date;
		      try {
		        date = $.datepicker.parseDate( dateFormat, element.value );
		      } catch( error ) {
		        date = null;
		      }
		 
		      return date;
		    }
	  	});
  	});
    //remove data in work profile
    $(document).on('click', '.emp_remove', function(){
      var button_id = $(this).attr("id");
      $('#egrp_row'+button_id+'').remove();
    });
	


function savedata()
{
    var bid = $("#bid").val();
   
	var languages = $("#languages").val();
	var eligibility_address = $("#eligibility_address").val();
	//alert(eligibility_address);
	
	var city2 = $("#city2").val();
	var cityLat = $("#cityLat").val();
    var cityLng = $("#cityLng").val();
	var available_date = $("#available_date").val();
	var current_location = $("#current_location").val();
	var cityc = $("#cityc").val();
	var cityLatc = $("#cityLatc").val();
	var cityLngc = $("#cityLngc").val();
	
	var considered_location = $("#considered_location").val();
	//alert(considered_location);
	var level_english = $("#level_english").val();
	var level_fitness = $("#level_fitness").val();
	var extra_about = $("#extra_about").val();
	var extra_about = [];
        $(':checkbox:checked').each(function(i){
          extra_about[i] = $(this).val();
		 });		
	var contact = $("#contact").val();
	var member_since = $("#member_since").val();
	var nationality = $("#nationality").val();
	var basic_description = $("#basic_description").val();
	
	
	$.ajax({		
			url:'<?php echo base_url(); ?>Staff_profile/Staffprofile/staffbasicupdatep',			
			type: 'POST',
			data:{'bid':bid,'considered_location':considered_location,'languages':languages,'eligibility_address':eligibility_address,'city2':city2,
			'cityLat':cityLat,'cityLng':cityLng,'available_date':available_date,'current_location':current_location,
			'cityc':cityc,'cityLatc':cityLatc,'cityLngc':cityLngc,'level_english':level_english,'level_fitness':level_fitness,
			'contact':contact,'member_since':member_since,'nationality':nationality,'extra_about':extra_about,'basic_description':basic_description},
			 success: function(response){
         		   
			//console.log(response);
			window.open('<?php echo base_url(); ?>Staff_profile/Staffprofile/staff_detail/<?php echo $this->session->userdata('user_id'); ?>', "_blank");
			}
		});	
}

function savedataskills()
{
	var sid = $("#skid").val();
    var sklill_artisdsr = $("#sklills-description").val();
	var licence = [];
        $(':checkbox:checked').each(function(i){
          licence[i] = $(this).val();
		 });	
	   	
	$.ajax({		
			url:'<?php echo base_url(); ?>Staff_profile/Staffprofile/staffskillupdatepreview',			
			type: 'POST',
			data:{'sid':sid,'sklill_artisdsr':sklill_artisdsr,'licence':licence},
			success: function(response){
		   
			window.open('<?php echo base_url(); ?>Staff_profile/Staffprofile/staff_detail/<?php echo $this->session->userdata('user_id'); ?>', "_blank");
			}
		});	
}

function savedataemployment()
{
	var idtt;
	var ccount = '<?php echo count($t2); ?>';
	
	var sid = $("#ekid").val();
	
	var jobtitle= new Array();
    $('input[name^="jobtitle"]').each(function() 
    {
    jobtitle.push($(this).val());
    });

   	
	var industry= new Array();
    $('select[name^="industry"]').each(function() 
    {
    industry.push($(this).val());
    });
	
	var fromdate= new Array();
    $('input[name^="fromdate"]').each(function() 
    {
    fromdate.push($(this).val());
    });
	
	var todate= new Array();
    $('input[name^="todate"]').each(function() 
    {
    todate.push($(this).val());
    });
	 
    var employment_description= new Array();
    $('textarea[name^="employment-description"]').each(function() 
    {
    employment_description.push($(this).val());
    });	
	
	$.ajax({		
			url:'<?php echo base_url(); ?>Staff_profile/Staffprofile/staffemploymentupdatepreview',			
			type: 'POST',
			data:{'sid':sid,'jobtitle':jobtitle,'industry':industry,'fromdate':fromdate,'todate':todate,'employment_description':employment_description},
			success: function(response){ 
			//alert(response);
			window.open('<?php echo base_url(); ?>Staff_profile/Staffprofile/staff_detail/<?php echo $this->session->userdata('user_id'); ?>', "_blank");
			}
		});	
}


function savedataemploymenthh()
{
	
	var idtt;
	var ccount = '<?php echo count($t2); ?>';
	
	var sid = $("#ekid").val();
	
	var jobtitle= new Array();
    $('input[name^="jobtitle"]').each(function() 
    {
    jobtitle.push($(this).val());
    });

   	
	var industry= new Array();
    $('select[name^="industry"]').each(function() 
    {
    industry.push($(this).val());
    });
	
	var fromdate= new Array();
    $('input[name^="fromdate"]').each(function() 
    {
    fromdate.push($(this).val());
    });
	
	var todate= new Array();
    $('input[name^="todate"]').each(function() 
    {
    todate.push($(this).val());
    });
	 
    var employment_description= new Array();
    $('textarea[name^="employment-description"]').each(function() 
    {
    employment_description.push($(this).val());
    });	
	
	$.ajax({		
			url:'<?php echo base_url(); ?>Staff_profile/Staffprofile/historyupdate',			
			type: 'POST',
			data:{'sid':sid,'jobtitle':jobtitle,'industry':industry,'fromdate':fromdate,'todate':todate,'employment_description':employment_description},
			success: function(response){ 
			//alert(response);
			//window.open('<?php echo base_url(); ?>Staff_profile/Staffprofile/staff_detail/<?php echo $this->session->userdata('user_id'); ?>', "_blank");
			}
		});	
}


jQuery.validator.addMethod("numbers", function (value, element) {
   return this.optional(element) || /^(\d+|\d+,\d{1,2})$/.test(value);
}, "Only numbers allow");
var jvalidate = $("#basicinfo").validate({
	
                ignore: [],
                rules: {                      
                        	
						'eligibility_address': {
                          required: true                                             
                        },
						'available_date': {
                                required: true                           
                        },
						'current_location': {
                                required: true                           
                        },
						'considered_location[]': {
                                required: true                           
                        },
						'level_english': {
                                required: true                           
                        },
						'level_fitness': {
                                required: true                           
                        },
						'languages[]': {
                                required: true                           
                        },
						'nationality': {
                                required: true                           
                        },
					   'cityLatc': {
                                required: true                               							
                        },
						'member_since': {
                                required: true                           
                        },
						'basic_description': {
                                required: true                           
                        }
						
						
                    },
           messages: {
			         'eligibility_address': "Eligibility To Work In NZ is required and cannot be empty!", 
                     'available_date': "Dates Available To Work From is required and cannot be empty!",     
                     'current_location': "Current Location is required and cannot be empty!",
					 'cityLatc': "Please correct location in using google address.",
                     'level_fitness': " Level Of Fitness is required and cannot be empty!",				 
					 'considered_location[]': " Location Considered is required and cannot be empty!",
                     'level_english': " Level Of English Considered is required and cannot be empty!", 	
					 'languages[]': "Languages Known is required and cannot be empty!",
                     'contact': "Contact is required and cannot be empty! ",						 
                     'member_since': "Member Since is required and cannot be empty!",
					 }					
                });


function initialize1() {
        var input = document.getElementById('current_location');
        var autocomplete = new google.maps.places.Autocomplete(input);
         autocomplete.setComponentRestrictions(
            {'country': ['nz','al']}); 
		 //var autocomplete = new google.maps.places.Autocomplete(input,options);	
        google.maps.event.addListener(autocomplete, 'place_changed', function () {
            var place = autocomplete.getPlace();
            document.getElementById('cityc').value = place.name;
            document.getElementById('cityLatc').value = place.geometry.location.lat();
            document.getElementById('cityLngc').value = place.geometry.location.lng();
            //alert("This function is working!");
            //alert(place.name);
           // alert(place.address_components[0].long_name);
		   
		   var latlng = new google.maps.LatLng(place.geometry.location.lat(),place.geometry.location.lng());
        var myOptions =
        {
            zoom: 8,
            center: latlng,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            disableDefaultUI: true
        };
        map = new google.maps.Map(document.getElementById("map"), myOptions);

        });
    }
    google.maps.event.addDomListener(window, 'load', initialize1);


/* var jvalidate = $("#skillinfo").validate({
	
                ignore: [],
                rules: {                      
                        	
						'sklills-description': {
                          required: true                                             
                        },
						
						'licence[]': {
                                required: true                           
                        }
                    },
           messages: {
			         'sklills-description': "Sklills And Attributes is required and cannot be empty!",                         
                     'licence[]': "Licence And Endorsement is required and cannot be empty!",
                    
					 }					
                });	 */

				
function saveimage(){
var input = $("#document");
 file1 = input[0].files[0];
    formData= new FormData();
 
      formData.append("document", file1);
      $.ajax({
        url: "<?php echo base_url(); ?>Staff_profile/Staffprofile/staffbasicupdatepp",
        type: "POST",
        data: formData,
        processData: false,
        contentType: false,
        success: function(data){        
        }
      });
    
}	
</script>
<style>
.dele{
    bottom: 17px;
    right: 0;
    float: right;
    background: red;
    color: #fff;
    width: 20px;
    height: 20px;
    font-size: 14px;
    line-height: 21px;
    text-align: center;
    cursor: pointer;	
}
</style>