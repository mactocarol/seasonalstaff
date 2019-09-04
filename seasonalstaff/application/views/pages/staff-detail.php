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
<!-- breadcrumb start -->
	<div class="staff_detail_breadcrumb">
		<div class="container">
			<div class="row">
				<div class="col-md-6 col-sm-12">
					<div class="staff_user_list">
						<div class="staff_thumb">
						 <?php if(isset($staffdetail[0]->image)) { $photo =  $staffdetail[0]->image; } 
						 if($photo==''){
						 ?>
						  <img src="<?php echo base_url(); ?>public/front_end/images/dashboard/userst.jpg" alt="">
						 <?php } else { ?>
						  <img src="<?php echo base_url(); ?>public/upload/userProfile/<?php echo $photo; ?>" alt="">
						 <?php } ?>
						</div>
						<div class="staff_text">
							<h4><?php if(isset($staffdetail[0]->first_name)) { echo $staffdetail[0]->first_name; }  ?> <?php if(isset($staffdetail[0]->last_name)) { echo $staffdetail[0]->last_name; }  ?></h4>
							<span>Actively Looking For Work</span>
							<!-- <div class="social_work">
						 	 <a href="#"><i class="fa fa-facebook"></i></a>
						 	 <a href="#"><i class="fa fa-linkedin"></i></a>
							</div> -->
						</div>
					</div>
				</div>
				<div class="col-md-6 col-sm-12">
					<div class="staff_contact_btn">
					<?php 
					 $uid = $this->session->userdata('user_id'); 
							    $query = $this->db->where('id',$uid);
							    $query = $this->db->get('users');
                                $result = $query->result_array();
						 $status =  $result[0]['em_staff_status'];
						  $role =  $result[0]['role']; 
						  
						if($uid==''){  
						  ?> 		
					<a href="#" class="contact_button popup_btn" data-toggle="modal" data-target="#login_popup">Send them an email</a>
					<a href="#" class="contact_button mms" data-toggle="modal" data-target="#login_popup">Send Message</a>
					
						<?php } if($status==1){ ?>					
					<?php  if($role=='employer') {  ?>
					<a href="#" class="contact_button popup_btn" data-show="cv_popup">Send them an email</a>
					
					<a href="<?php echo site_url('Employee_profile/Profile/messages'); ?>/<?php echo $staffdetail[0]->id; ?>" class="contact_button mms">Send Message</a>
					<?php  } } ?>
					<a href="<?php echo base_url(); ?>find-staff/" class="contact_button mms staff-bg">back to main search</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- breadcrumb End -->
	<section class="work_section">	
		<div class="container">	
			<div class="row">	
				<div class="col-lg-8 col-sm-12">	
					<div class="work_content_wrapper">
				
						<ul class="staff_list">
							<li>
								<div>
								  <span class="icon"><i class="fa fa-clock-o"></i></span>
								  <div class="list_text">
									<h5><b>Date available to work from</b></h5>
									
									<span><?php  
									if($staffdetail[0]->available_date == ''){ echo 'NA';} else {  echo date("d-M-Y",strtotime($staffdetail[0]->available_date)); }  ?></span>
								  </div>
								</div>
							</li>
							<li>
								<div>
								  <span class="icon"><i class="fa fa-rocket"></i></span>
								  <div class="list_text">
									<h5><b>Location considered</b></h5>
							<?php
							if(isset($staffdetail[0]->considered_location)){ $lcon =  $staffdetail[0]->considered_location; }
                             $query = $this->db->query("SELECT `name` FROM `location_considered` WHERE FIND_IN_SET(id,'".$lcon."')");
                            //echo $this->db->last_query(); die();                           
							?>
							<?php if($staffdetail[0]->considered_location=='') {  ?>
							<span>NA</span>
							<?php } else {  ?>
							<span> <?php  foreach($query->result() as $sk) { 
							    $edi[]= $sk->name; }
							   echo $ed = implode(", ",$edi); ?> </span>
							<?php } ?>
								  </div>
								</div>
							</li>
							<li>
								<div>
								  <span class="icon"><i class="fa fa-flag"></i></span>
								  <div class="list_text">
									<h5><b>Nationality.</b></h5>
									<span><?php  
									if($staffdetail[0]->nationality == ''){ echo 'NA';} else {  echo $staffdetail[0]->nationality; }  ?></span>
								  </div>
								</div>
							</li>
							<li>
								<div>
								  <span class="icon"><i class="fa fa-heartbeat"></i></span>
								  <div class="list_text">
									<h5><b>Level of fitness</b></h5>
									<span><?php  
									if($staffdetail[0]->level_fitness == ''){ echo 'NA';} else {  echo $staffdetail[0]->level_fitness; }  ?></span>
								  </div>
								</div>
							</li>
							<li>
								<div>
								  <span class="icon"><i class="fa fa-language"></i></span>
								  <div class="list_text">
									<h5><b>Level of English</b></h5>
									<span><?php  
									if($staffdetail[0]->level_english == ''){ echo 'NA';} else {  echo $staffdetail[0]->level_english; }  ?></span>
								  </div>
								</div>
							</li>
							<li>
								<div>
								  <span class="icon"><i class="fa fa-building"></i></span>
								  <div class="list_text">
									<h5><b>Eligibilty to work</b></h5>
									<span><?php  
									if($staffdetail[0]->eligibility_address == ''){ echo 'NA';} else {  echo $staffdetail[0]->eligibility_address; }  ?></span>
								  </div>
								</div>
							</li>
							<li>
								<div>
								  <span class="icon"><i class="fa fa-globe"></i></span>
								  <div class="list_text">
									<h5><b>Languages</b></h5>
									<span>
									<?php  
									if($staffdetail[0]->languages == ''){ echo 'NA';} else {  echo $staffdetail[0]->languages; }  ?></span>
								  </div>
								</div>
							</li>
						</ul>
						
						<div class="work_description staff_description">
							<div class="staff_sr_title">
								<span><i class="fa fa-file-text" aria-hidden="true"></i></span>
							</div>
							<div class="staff_service_row">
								<div class="st_inner_part">
									<h3> Description</h3>								
									<p><?php  
									if($staffdetail[0]->basic_description == ''){ echo 'NA';} else {  echo $staffdetail[0]->basic_description; }  ?>
							        </p>
									<?php
								 
						           if(count($staffdetail[0]->extra_about)==0){ ?>
								   <?php }else {  ?>
								   <?php
                                  $extra_about =  $staffdetail[0]->extra_about;						
								
							      $extra_about = explode(",",$extra_about); 
                                                  
								  ?>
								
								<ul>
								<?php if($extra_about[0]==1) {?>						   
								<li><?php if($extra_about[0]==1){ echo 'I have a fully self-contained vehicle'; }?></li>	
								<?php }  if($extra_about[1]==2) {?>
								<li><?php if($extra_about[1]==2){ echo 'I am not fully self-contained'; }?></li>
								<?php } if($extra_about[2]==3) {?>
								<li><?php if($extra_about[2]==3){ echo 'I would need accommodation'; }?></li>
								<?php }?>					   						
							    </ul><br>
								   <?php } ?>
									
								</div>
							</div>
							
						</div>
						<!--service box End -->
						
					    <?php
						if(count($staffdetail[0]->sklills_description)==0){ ?>
						<div class="work_description staff_description">
							<div class="staff_sr_title">
								<span><i class="fa fa-graduation-cap" aria-hidden="true"></i> 
								</span>
								

							</div>
							<div class="staff_service_row">
								<div class="st_inner_part">
									<h3>Skills Description</h3>								
									<p>NA</p>
								</div>
							</div>
							
						</div>
					
						<?php 	
						}else {
						?>					 
							<div class="staff_service_boxes">
							<div class="staff_sr_title">
								<span><i class="fa fa-graduation-cap" aria-hidden="true"></i></span>
							</div>
							<div class="staff_service_row">
								<div class="st_inner_part">
									<h3>Skills and Attributes</h3>
									<!-- <span class="sub_title">Walters University</span> -->
								</div>
							</div>
							<div class="staff_service_row">
								<div class="st_inner_part">
									<!-- <p class="ssk"><?php echo $staffdetail[0]->sklills_description; ?></p> -->
							<div class="work_description">
                                <h3>Skills</h3>
                                <?php
                                 $sklill_artisdsr =  $staffdetail[0]->sklills_description;
								
								 if (preg_match("' ,'", $sklill_artisdsr )){
								 $skills = explode(",",$sklill_artisdsr);	
								}
								else {
								$skills = explode("\n",$sklill_artisdsr);	
								}
                                //$sklill_artisdsr = trim(preg_replace('/\s\s+/', ' ', $sklill_artisdsr));		  
		                         //$skills = explode(" ", str_replace(' ',' ',$sklill_artisdsr));
								// $skills = explode("\n",$sklill_artisdsr);
								 //$skills = explode(",",$sklill_artisdsr);
                               
                               
								?>
								<ul>
								<?php foreach($skills as $key){ ?>							   
								<li><?php  echo $key; ?></li>	
								<?php } ?>							   						
							    </ul><br>	

							
							<h3>licence</h3>
							<?php
						    if(isset($staffdetail[0]->licence)){ $licence =  $staffdetail[0]->licence; }
                             $query = $this->db->query("SELECT `skills` FROM `skill` WHERE FIND_IN_SET(id,'".$licence."')");
                            //echo $this->db->last_query(); die();                           
							?>                         				
							
							<ul>
								<?php  foreach($query->result() as $sk) { ?>
							   
								<li><?php  echo $sk->skills; ?></li>	
								<?php } ?>
							   						
							</ul>
							</div>
								</div>
							</div></div>
						<?php } ?>			
						
						
						<!--service box End -->
						
							<!--service box End -->
						
					    <?php					
                       $arr = unserialize(urldecode($staffdetail[0]->jobtitle));
                      // var_dump($arr);
	                   $gg =  $arr[0];	
				if(count($staffdetail[0]->jobtitle)==0 or $gg==""){ ?>
						<div class="work_description staff_description">
							<div class="staff_sr_title">
								<span><i class="fa fa-graduation-cap" aria-hidden="true"></i> 
								</span>
								

							</div>
							<div class="staff_service_row">
								<div class="st_inner_part">
									<h3>Employment History</h3>								
									<p>NA</p>
								</div>
							</div>
							
						</div>
					
						<?php 	
						}else {
						?>
					   <?php
					    
						if(!empty($staffdetail[0]->jobtitle)){ $skillart = $staffdetail[0]->jobtitle;
						if(!empty($staffdetail[0]->em_industry)){ $em_industry = $staffdetail[0]->em_industry;
                        if(!empty($staffdetail[0]->employment_description)){ $description = $staffdetail[0]->employment_description;
						if(!empty($staffdetail[0]->fromdate)){ $fromdate = $staffdetail[0]->fromdate;
					    if(!empty($staffdetail[0]->todate)){ $todate = $staffdetail[0]->todate;
						//print_r($todate); die;
					  
	                                    $avalued1=(unserialize($skillart));
										$avalued2=(unserialize($em_industry));
	                                    $avalued3=(unserialize($description));
										$avalued4=(unserialize($fromdate));
										$avalued5=(unserialize($todate));
																
										$b1=count($avalued4);
										for($ii=1;$ii<=$b1;$ii++)
                                        {
                                        $cc1[]=$ii;
                                        }
                                        $keys1=$cc1; 
										
										$t2=combine_keys_with_arrays($keys1, array(
                                        'data1'  => $avalued1,
                                        'data2' => $avalued2,
										'data3' => $avalued3,
										'data4' => $avalued4,
										'data5' => $avalued5));
									  
                                      
                                        foreach($t2 as $key => $t11){
					
							?>
							<div class="staff_service_boxes">
							<div class="staff_sr_title">
								<span><i class="fa fa-graduation-cap" aria-hidden="true"></i></span>
							</div>
							<div class="staff_service_row">
								<div class="st_inner_part">
									<h3>Employment History</h3>
									<!-- <span class="sub_title">Walters University</span> -->
								</div>
							</div>
							<div class="staff_service_row">
								<div class="st_inner_part">
									<p><b><?php if($t11['data1']==""){echo 'NA';} { echo $t11['data1'];} ?></b> - ( <?php if($t11['data4']==" "){echo 'NA';} { echo  date("d M Y",strtotime($t11['data4']));} ?>
									 <b>To</b> <?php if($t11['data5']==" "){echo 'NA';} { echo date("d M Y",strtotime($t11['data5'])); }?>)</p>
									<p><b>Description</b> - <?php if($t11['data3']==""){echo 'NA';} { echo $t11['data3'];} ?></p>
									<?php 
									$ii = $t11['data2']; 
									if($ii==""){
									$ii ='null';	
									}
									
									/* foreach($t11['data2'] as $key){
									$ii =  $key; 
									}*/									
									
									$query = $this->db->query("SELECT `name` FROM `industry` WHERE id=".$ii."");
									$ff = $query->result();
									
									?>
									<p><b>Industry</b> - <?php  foreach($query->result() as $sk) { if($sk->name==""){echo 'NA';} { echo $sk->name; } } ?></p>
									<!-- <p><b>From - date</b> - <?php echo $t11['data4']; ?></p>
									<p><b>To - date</b> - <?php echo $t11['data5']; ?></p> -->
								
								</div>
							</div></div>
						<?php }}}}}}} ?>
						
						<!--service box End -->
						
					</div>
				</div>
				<div class="col-lg-4 col-sm-12">	
					<div class="staff_sidebar">
						<div class="staff_widget">						
                           <?php if($uid!='' && $staffdetail[0]->cv_ele!=''){   ?>						
						    <div class="staff_wgt_title"><h6><a href="<?php echo base_url(); ?>public/upload/document/<?php echo $staffdetail[0]->cv_ele; ?>" class="down_cv">Download Cv</a></h6></div>
							<?php } ?>							<div class="staff_wgt_title">Work Seekers Details</div>
							<div class="address_list_main">
								<div class="address_list">
								  <span class="lft_icon"><i class="fa fa-map-marker"></i></span>
								  <div class="list_content">
									<h5>Current Location</h5>
									<span><?php  
									if($staffdetail[0]->current_location == ''){ echo 'NA';} else {  echo $staffdetail[0]->current_location; }  ?></span>
								  </div>
								</div>
								<?php if($uid!='' && $role='employer') {?>
								<div class="address_list">
								  <span class="lft_icon"><i class="fa fa-mobile"></i></span>
								  <div class="list_content">
									<h5>contact phone number</h5>
									<span><a href="tel:+9999999"> 
									<?php  
									if($staffdetail[0]->contact == ''){ echo 'NA';} else {  echo $staffdetail[0]->contact; }  ?></a></span>
								  </div>
								</div>
								<div class="address_list">
								  <span class="lft_icon"><i class="fa fa-envelope"></i></span>
								  <div class="list_content">
									<h5>Email address</h5>
									<span><?php  
									if($staffdetail[0]->email == ''){ echo 'NA';} else {  echo $staffdetail[0]->email; }  ?></span> 
								  </div>
								</div>
								<?php } ?>
								<div class="address_list">
								  <span class="lft_icon"><i class="fa fa-arrows-alt"></i></span>
								  <div class="list_content">
									<h5>Member Since</h5>
									<span><?php  
									if($staffdetail[0]->member_since == ''){ echo 'NA';} else {  echo date("d M Y",strtotime($staffdetail[0]->member_since)); }  ?></span>
								  </div>
								</div>
							</div>
						</div>
						<div class="staff_widget calander_widget">
							<div class="member_datepicker"></div>					 
						
						</div>
					</div>
				</div>
			</div>
		</div>
</section>

<div class="popup_wrapper" id="cv_popup">
      <div class="popup_dialog">
        <div class="popup_content">
          <span class="p_close_btn"><i class="fa fa-times"></i></span>
          <div class="cv_form_wrapper">
      <form  method="post" action="<?php echo site_url('Welcome/mailsendstaff'); ?>" enctype="multipart/form-data">
               <div class="form_group">
			   <input type="hidden" name="email_staff" id="email_staff" value="<?php if(isset($staffdetail[0]->email)){ echo $staffdetail[0]->email; } ?>">
			   
			   <input type="hidden" name="staff_uid" id="staff_uid" value="<?php if(isset($staffdetail[0]->id)){ echo $staffdetail[0]->id; } ?>">
			   
			   <input type="hidden" name="staff_lname" id="staff_lname" value="<?php if(isset($staffdetail[0]->last_name)){ echo $staffdetail[0]->last_name; } ?>">
			   
               <input type="hidden" name="staff_uname" id="staff_uname" value="<?php if(isset($staffdetail[0]->first_name)){ echo $staffdetail[0]->first_name; } ?>">					   
			
               <label>Send Mail</label>
                <div class="form_input">

			   <textarea name="maildescr" id="maildescr" placeholder="Enter Message !" required></textarea>                
                  </div>
               </div>
			   
			   <div class="form_group">
			    <label>Attach file</label>
				 <div class="form_input">
			     <input type="file" name="ad_file" id="ad_file">
                  </div>
			   </div>
				
               <div class="form_group text-center">
                  <button type="submit" class="submit_btn">Send</button>
               </div>
           </form>
         </div>
        </div>
      </div>
    </div>

<!-- Top footer start -->
<script>
 $(document).ready(function() {
    $('.member_datepicker').datepicker('setDate', '<?php  
									if($staffdetail[0]->member_since == ''){ echo 'NA';} else {  echo $staffdetail[0]->member_since; }  ?>');
    $('.member_datepicker').datepicker({
    dateFormat: "dd-MM-yy"
    });
});
</script>