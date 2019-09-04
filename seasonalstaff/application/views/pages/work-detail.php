<?php if($this->uri->segment(5)=="msg"){ ?>
 <div class="col-lg-12 col-md-12 col-sm-12" id="showqq">
                   <div class="alert alert-success alert-dismissible">
                   <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                      <strong id="smsgwf">Fantastic!</strong> <span id="smsgw">We have let the employer know you are interested.  – To view jobs you have applied for here - <a href='<?php echo base_url(); ?>apply-jobs' class="blue_button">Jobs applied for</a></span>
                    </div>
          </div> 
 <?php }  ?>
 
 <div class="col-lg-12 col-md-12 col-sm-12" id="showqq" style="display:none;">
                   <div class="alert alert-success alert-dismissible">
                   <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                      <strong id="smsgwf">Success!</strong> <span id="smsgw"></span>
                    </div>
          </div>
 <div class="col-lg-12 col-md-12 col-sm-12" id="showqqe" style="display:none;">		  
 <div class="alert alert-danger alert-dismissible">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong id="op">Warning!</strong> <span id="error"></span>
  </div>
</div>  
	<div class="work_detail_breadcrumb">
		<div class="container">
			<div class="row">
				<div class="col-md-6 col-sm-12">
					<h4 class="bread_heading"><?php if(isset($jobsdata[0]->job_title)){ echo $jobsdata[0]->job_title; } ?></h4>
				</div>
				
				<?php $jtype = $jobsdata[0]->job_type; ?>
				<div class="col-md-6 col-sm-12">
					<div class="breadcrumb_btns">
					<?php 
					 $uid = $this->session->userdata('user_id'); 
							    $query = $this->db->where('id',$uid);
							    $query = $this->db->get('users');
                                $result = $query->result_array();
						        $status =  $result[0]['em_staff_status']; 
                                $role =  $result[0]['role']; 									
					
					 if($uid==''){?>
					 <?php if($jtype=='cv_cover') {  ?>
						<a href="#" class="work-bg popup_btn border_hide" data-toggle="modal" data-target="#login_popup">Send CV and cover letter</a>
						<?php }  ?>
						  <?php if($jtype=='interest') {  ?>
					<a href="#" class="border_hide" data-toggle="modal" data-target="#login_popup">Yes I am interested</a>
						  <?php } ?>
					 
					 <?php } if($status==1){ ?>
				   
					<?php  if($role=='staff') { ?>
						 <?php if($jtype=='cv_cover') { 
                          if($basicinfo[0]['cityLatc']=="") {
						 ?>
						<a href="#" class="work-bg" onclick="alertpopup();">Send CV and cover letter</a>
						 <?php } else {  ?> 
						<a href="#" class="work-bg popup_btn border_hide" data-show="cv_popup">Send CV and cover letter</a>
						 <?php }}  ?>
						  <?php if($jtype=='interest') {  if($basicinfo[0]['cityLatc']=="") {  ?>
						   <a href="#" class="border_hide" onclick="alertpopup();">Yes I am interested</a>
						 <?php } else {  ?>
						<a href="#" onclick="interested('yes');" class="border_hide">Yes I am interested</a>
						  <?php }} ?>
					<?php } }?>
					<a href="<?php echo base_url(); ?>Welcome/find_work" class="Srch_link">Back to main search</a>
					</div>
				</div>
			
			</div>
		</div>
	</div>
	
	<?php //print_r($benefit); ?>
	
	<!-- breadcrumb End -->
	<section class="work_section">	
		<div class="container">	
			<div class="row">	
				<div class="col-lg-8 col-sm-12">		
					<div class="work_content_wrapper">	
                      			
						 <ul class="top_list">
						   <li class="width_100"><i class="fa fa-map-marker"></i><b> Location - </b> <?php if(isset($jobsdata[0]->map_address)){ echo $jobsdata[0]->map_address; } ?></li>
						    <?php if($jobsdata[0]->approve_gap=="yes"){ ?>
							<li class="width_100"><i class="fa fa-send"></i><b>GAP/GRASP registration no - </b> <?php if(isset($jobsdata[0]->number_gap)){ echo $jobsdata[0]->number_gap; } ?></li>
							<?php } ?>
							
							<li><i class="fa fa-send"></i><b>Potential start date - </b> <?php if(isset($jobsdata[0]->from_date)){ echo date("d M Y", strtotime($jobsdata[0]->from_date) ); } ?></li>
						
						   <li><i class="fa fa-send"></i><b>Potential End date - </b> <?php if(isset($jobsdata[0]->from_date)){ echo date("d M Y", strtotime($jobsdata[0]->to_date) ); } ?></li>
						
							<?php 
                            $form1 =date_create($jobsdata[0]->from_date);
                            $to1 = date_create($jobsdata[0]->to_date);                       
                            $diff=date_diff($form1,$to1);					
              				
                            ?>
                           
							<li><i class="fa fa-clock-o"></i><b>Approx Duration of Job -</b> <?php echo $diff->format("%a days"); ?></li>
							<li><i class="fa fa-line-chart" aria-hidden="true"></i><b>hours per week - </b>(<?php if(isset($jobsdata[0]->approx_hr)) { echo $jobsdata[0]->approx_hr; }?>)</li>
							
							<li><i class="fa fa-line-chart" aria-hidden="true"></i><b>Hourly rate - </b> $<?php if(isset($jobsdata[0]->hourly_rate)) { echo $jobsdata[0]->hourly_rate; }?></li>
							
							<li><i class="fa fa-line-chart" aria-hidden="true"></i><b>Industry - </b><?php if(isset($industries[0]['name'])) { echo $industries[0]['name']; }?></li>
							<li><i class="fa fa-money" aria-hidden="true"></i><b>Intensity of work - </b><?php if(isset($jobsdata[0]->work_intensity)){ echo $jobsdata[0]->work_intensity; } ?></li>
							<li class="width_50"><i class="fa fa-handshake-o" aria-hidden="true"></i><b>Contract type
							- </b> <?php if(isset($jobsdata[0]->contract_type)){ echo $jobsdata[0]->contract_type; } ?></li>
							<li class="width_100"><i class="fa fa-handshake-o" aria-hidden="true"></i><b>Number of positions available -</b> <?php if(isset($jobsdata[0]->no_staff)) { if($jobsdata[0]->no_staff==''){ echo 0; } else { echo $jobsdata[0]->no_staff; }}  ?>
							</li>
							                            <?php
							if(isset($jobsdata[0]->benifit_id)){ $ben =  $jobsdata[0]->benifit_id; }
                             $query = $this->db->query("SELECT `name` FROM `benefit` WHERE FIND_IN_SET(id,'".$ben."')");
                            //echo $this->db->last_query(); die();                           
							?>
							<li class="width_100"><i class="fa fa-line-chart" aria-hidden="true"></i><b>Other Benefits: - </b>
	                         <?php  foreach($query->result() as $sk) { 
							 $edi[]= $sk->name; }
							 echo $ed = implode(", ",$edi); ?> 
							</li>
						</ul>
						<div class="work_description">
							<h5><b>Description of Job</b></h5>
							<p><?php if(isset($jobsdata[0]->job_description)){ echo $jobsdata[0]->job_description; } ?>
							</p>
						</div>
						<div class="work_description">
							<h5><b>Skills And Attributes Required</b></h5>
							<?php
							if(isset($jobsdata[0]->skill)){ $skills =  $jobsdata[0]->skill; }
                             $query = $this->db->query("SELECT `skills` FROM `skill` WHERE FIND_IN_SET(id,'".$skills."')");
                            //echo $this->db->last_query(); die();
							 $sk = explode(",",$skills);
							?>
                         				
							
							<ul>
							    <?php foreach($sk as $k ){ 
								if($k ==0){ ?>
								<li>No experience needed.</li>	
								<?php }}  ?>
								
								<?php  foreach($query->result() as $sk) { ?>
							   
								<li><?php  echo $sk->skills; ?></li>	
								<?php } ?>
							   						
							</ul>
								
						</div>
					</div>
				</div>
				
				<div class="col-lg-4 col-sm-12">	
					<div class="work_sidebar">	
						<div class="work_widget">
							<div class="contact_widget">
								<img src="<?php echo base_url(); ?>public/front_end/images/sidebar-img.jpg" alt="thumb">
								<h5>Contact details available to registered users</h5>
								<div class="star-rating">
									<span class="fa fa-star" data-rating="1"></span>
									<span class="fa fa-star" data-rating="2"></span>
									<span class="fa fa-star-o" data-rating="3"></span>
									<span class="fa fa-star-o" data-rating="4"></span>
									<span class="fa fa-star-o" data-rating="5"></span>
									<input type="hidden" name="whatever1" class="rating-value" value="2">
								</div>
								<div class="contact_btns">
								  <a href="<?php echo base_url(); ?>Welcome/find_work">View all Jobs</a>
								  <a href="<?php echo base_url(); ?>Welcome/contact">Contact Us</a>
								</div>
							</div>
						</div>
						
						<div class="work_widget map_widget">
						<div id="map"></div>
						<!-- <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d13311786.363630086!2d156.76784433887252!3d-45.9181666358872!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6d2c200e17779687%3A0xb1d618e2756a4733!2sNew+Zealand!5e0!3m2!1sen!2sin!4v1549974706706" allowfullscreen></iframe> -->
						</div>
					</div>
				</div>
			</div>
		</div>
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
                        <h4>Hello, <?php echo $result[0]['first_name']; ?> <?php echo  $result[0]['last_name']; ?></h4>
                        <p>Welcome to seasonal staff <br>
						To apply for jobs you must have completed the <br> Your profile section</p>                   
                    </div>
                    <div class="popup_bottom_buttons">
                       <a href="<?php echo base_url(); ?>manage-work-profile" class="green_button">Update Manage Your Profile</a>
				
                   </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Notification popup End -->				
		
		
		
	<div class="popup_wrapper" id="cv_popup">
      <div class="popup_dialog">
        <div class="popup_content">
          <span class="p_close_btn"><i class="fa fa-times"></i></span>
          <div class="cv_form_wrapper"><?php echo str_replace(' ', '-', $list->job_title);?>
    <form class="" method="post" action="<?php echo base_url(); ?>Welcome/staffcv" enctype="multipart/form-data">
               <div class="form_group">
			   <input type="hidden" name="jott" id="jott" value="<?php echo str_replace(' ', '-', $jobsdata[0]->job_title);?>">
			   <input type="hidden" name="jobid" id="jobid" value="<?php if(isset($jobsdata[0]->id)){ echo $jobsdata[0]->id; } ?>">
				
				<input type="hidden" name="job_userid" id="job_userid" value="<?php if(isset($jobsdata[0]->modify_by)){ echo $jobsdata[0]->modify_by; } ?>">
				
               <label>Send Mail</label>
			   <div class="form_input">
			   <textarea name="maildescr" id="maildescr" placeholder="Type your message here!" required></textarea>    
               </div>

				<label>Send Your CV</label>
                  <div class="form_input">
                    <input type="file" name="cv_file" id="cv_file">
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
	
</section>
<script src="http://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyCCQzJ9DJLTRjrxLkRk6jaSrvcc5BfDtWM" type="text/javascript"></script>
<script>
function alertpopup(){
	 setTimeout(function(){
        $(".new_notif_popup").addClass("popup_active");
      },500);
}
	 
function initialise() {
		var myLatlng = new google.maps.LatLng(<?php echo $jobsdata[0]->latitude; ?>, <?php echo $jobsdata[0]->longitude; ?>); // Add the coordinates
		var mapOptions = {
			zoom: 16, // The initial zoom level when your map loads (0-20)
			minZoom: 6, // Minimum zoom level allowed (0-20)
			maxZoom: 17, // Maximum soom level allowed (0-20)
			zoomControl:true, // Set to true if using zoomControlOptions below, or false to remove all zoom controls.
			zoomControlOptions: {
  				style:google.maps.ZoomControlStyle.DEFAULT // Change to SMALL to force just the + and - buttons.
			},
			center: myLatlng, // Centre the Map to our coordinates variable
			mapTypeId: google.maps.MapTypeId.ROADMAP, // Set the type of Map
			scrollwheel: false, // Disable Mouse Scroll zooming (Essential for responsive sites!)
			// All of the below are set to true by default, so simply remove if set to true:
			panControl:false, // Set to false to disable
			mapTypeControl:false, // Disable Map/Satellite switch
			scaleControl:false, // Set to false to hide scale
			streetViewControl:false, // Set to disable to hide street view
			overviewMapControl:false, // Set to false to remove overview control
			rotateControl:false // Set to false to disable rotate control
	  	}
		var map = new google.maps.Map(document.getElementById('map'), mapOptions); // Render our map within the empty div
		var image = new google.maps.MarkerImage("<?php echo base_url(); ?>public/front_end/images/icon-location.png", null, null, null, new google.maps.Size(70,70)); // Create a variable for our marker image.
		var marker = new google.maps.Marker({ // Set the marker
			position: myLatlng, // Position marker to coordinates
			icon:image, //use our image as the marker
			map: map, // assign the market to our map variable
			title: 'Click here for more details' // Marker ALT Text
		});
		
		var infowindow = new google.maps.InfoWindow({ // Create a new InfoWindow
  			content:"<?php echo $jobsdata[0]->map_address; ?>!" // HTML contents of the InfoWindow
  		});
		google.maps.event.addListener(marker, 'click', function() { // Add a Click Listener to our marker
  			infowindow.open(map,marker); // Open our InfoWindow
  		});
		google.maps.event.addDomListener(window, 'resize', function() { map.setCenter(myLatlng); }); // Keeps the Pin Central when resizing the browser on responsive sites
	}
	google.maps.event.addDomListener(window, 'load', initialise); // Execute our 'initialise' function once the page has loaded.
	 
	 
function interested(value)
{
var jobid = $('#jobid').val();
var job_userid = $('#job_userid').val();
var jott = $('#jott').val();
 var x = document.getElementById("showqq");
  var error = document.getElementById("showqqe");
 $.ajax({
            url: site_url +"Welcome/interestedstaff",
            type: "POST",
            data: {
                value: value,jobid:jobid,jott:jott,job_userid:job_userid

            },
             success: function (msg) {
                if (msg) {
				//alert(msg);	
				if(msg=='allready'){
				error.style.display = "block";
				ops ="OOPs!"; 
				smsg = "Looks as though you have already expressed your interest in this job!";
                document.getElementById("error").innerHTML = smsg;
                document.getElementById("op").innerHTML = ops;				
				}
				else {               				
				x.style.display = "block";
				smsg1 ="Fantastic!"; 
				smsg = "We have let the employer know you are interested.  – To view jobs you have applied for here - <a href='<?php echo base_url(); ?>apply-jobs' class=blue_button>Jobs applied for</a>";
                document.getElementById("smsgw").innerHTML = smsg;
				 document.getElementById("smsgwf").innerHTML = smsg1;
				}				
                }
            }            
        });	
}
	
</script>
	

<style>
 #map {
        height: 405px;
		border: 2px solid #a3d656;
      }
</style>	