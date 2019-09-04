	<div class="work_detail_breadcrumb">
		<div class="container">
			<div class="row">
				<div class="col-md-6 col-sm-12">
					<h4 class="bread_heading"><?php if(isset($jobsdata[0]->job_title)){ echo $jobsdata[0]->job_title; } ?></h4>
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
				<div class="col-md-8 col-sm-12">		
					<div class="work_content_wrapper">	
					
						<ul class="top_list">
						    <li class="width_100"><i class="fa fa-map-marker"></i><b> Location - </b><?php if(isset($jobsdata[0]->map_address)){ echo $jobsdata[0]->map_address; } ?></li>
							
							<li><i class="fa fa-send"></i><b>Potential start date - </b><?php if(isset($jobsdata[0]->from_date)){ echo date("d M Y", strtotime($jobsdata[0]->from_date) ); } ?></li>
							
							<li><i class="fa fa-send"></i><b>Potential End date - </b> <?php if(isset($jobsdata[0]->to_date)){ echo date("d M Y", strtotime($jobsdata[0]->to_date) ); } ?></li>
							
							<?php 
							$form1 =date_create($jobsdata[0]->from_date);
                            $to1 = date_create($jobsdata[0]->to_date);                       
                            $diff=date_diff($form1,$to1);			
                          					
                            ?>
							
							<li><i class="fa fa-clock-o"></i><b>Approx Duration of Job - </b><?php echo $diff->format("%a days"); ?></li>
							
							<li><i class="fa fa-line-chart" aria-hidden="true"></i><b>hours per week - </b>(<?php if(isset($jobsdata[0]->approx_hr)) { echo $jobsdata[0]->approx_hr; }?>)</li>
							
							<li><i class="fa fa-line-chart" aria-hidden="true"></i><b>Hourly rate - </b> $<?php if(isset($jobsdata[0]->hourly_rate)) { echo $jobsdata[0]->hourly_rate; }?></li>
							
							<li><i class="fa fa-line-chart" aria-hidden="true"></i><b>Industry - </b><?php if(isset($jobsdata[0]->industry_name)) { echo $jobsdata[0]->industry_name; }?></li>
							<li><i class="fa fa-money" aria-hidden="true"></i><b>Intensity of work - </b><?php if(isset($jobsdata[0]->work_intensity)){ echo $jobsdata[0]->work_intensity; } ?></li>
							<li class="width_50"><i class="fa fa-handshake-o" aria-hidden="true"></i><b>Contract type - </b><?php if(isset($jobsdata[0]->contract_type)){ echo $jobsdata[0]->contract_type; } ?>
							</li>
							<li class="width_50"><i class="fa fa-handshake-o" aria-hidden="true"></i><b>Number of positions available -</b> <?php if(isset($jobsdata[0]->no_staff)) { if($jobsdata[0]->no_staff==''){ echo 0; } else { echo $jobsdata[0]->no_staff; }}  ?>
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
				
				<div class="col-md-4 col-sm-12">	
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
								  <a href="#">View all Jobs</a>
								  <a href="#">Contact Us</a>
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
		
	<div class="popup_wrapper" id="cv_popup">
      <div class="popup_dialog">
        <div class="popup_content">
          <span class="p_close_btn"><i class="fa fa-times"></i></span>
          <div class="cv_form_wrapper">
            <form class="" action="">
               <div class="form_group">
                  <label>Send Your CV</label>
                  <div class="form_input">
                    <input type="file" name="cv_file">
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
 <input type="hidden" name="mapaddress" id="mapaddress"  value="<?php echo $jobsdata[0]->map_address; ?>"  class="form-control"placeholder="Enter latitude">	
	
 <input type="hidden" name="city2" id="city2" class="form-control" value="<?php echo $jobsdata[0]->city2; ?>" placeholder="Enter latitude">
 
 <input type="hidden" name="cityLat" id="cityLat" value="<?php echo $jobsdata[0]->latitude; ?>" class="form-control" placeholder="Enter latitude">

<input type="hidden" name="cityLng" id="cityLng"  value="<?php echo $jobsdata[0]->longitude; ?>" class="form-control" placeholder="Enter longitude">
	
</section>
<script src="http://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyCCQzJ9DJLTRjrxLkRk6jaSrvcc5BfDtWM" type="text/javascript"></script>
<script>	 
var map;
    var geocoder;
    function InitializeMap() {

var latlng = new google.maps.LatLng(<?php echo $jobsdata[0]->latitude; ?>, <?php echo $jobsdata[0]->longitude; ?>);
        var myOptions =
        {
            zoom: 8,
            center: latlng,
			gestureHandling: 'greedy',
            mapTypeId: google.maps.MapTypeId.ROADMAP,
           // disableDefaultUI: true
        };
        map = new google.maps.Map(document.getElementById("map"), myOptions);
    }

    window.onload = InitializeMap;	 
	 
	 

	
</script>
	

<style>
 #map {
        height: 405px;
		border: 2px solid #a3d656;
      }
.breadcrumb_btns a {
    background-color: #2396F3;
    color: #fff;
    padding: 0px 10px;
    display: inline-block;
    height: 50px;
    line-height: 50px;
    border-radius: 5px;
    font-size: 12px;
    margin: 5px 0 5px 25px;
    position: relative;
}	  
</style>	