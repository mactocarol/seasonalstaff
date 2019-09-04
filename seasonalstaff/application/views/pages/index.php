<section class="map_container">
	<div class="map_dv" id="Map" style="width: 100%; height: 870px;">
	</div>
<?php 
$uid = $this->session->userdata('user_id'); 
$query = $this->db->where('id',$uid);
$query = $this->db->get('users');
$result = $query->result_array();
$role =  $result[0]['role']; 
?>
	<div id="search_panel">
        <div class="container">
	    <ul id="tabs" class="nav nav-tabs" role="tablist">
	        <li class="nav-item">
	            <a id="tab-A" href="#pane-A" class="nav-link staff_tab" data-toggle="tab" role="tab">Find Staff</a>
	        </li>
	        <li class="nav-item">
	            <a id="tab-B" href="#pane-B" class="nav-link active work_tab" data-toggle="tab" role="tab">Find Work</a>
	        </li>
	    </ul>
    <div id="content" class="tab-content" role="tablist">
        <div id="pane-A" class="card tab-pane fade <?php if($role=='employer'){ echo 'active show';}?>" role="tabpanel" aria-labelledby="tab-A">
            <div class="card-header" role="tab" id="heading-A">
                <h5 class="mb-0">
                    <a data-toggle="collapse" href="#collapse-A" aria-expanded="true" aria-controls="collapse-A">
                       Find Staff
                    </a>
                </h5>
            </div>
            <div id="collapse-A" class="collapse" data-parent="#content" role="tabpanel" aria-labelledby="heading-A">
                <div class="card-body">
                    <form method="post" action="<?php echo base_url(); ?>find-staff/">
                    	<div class="find-form">
                        	<div class="row">
                            	<div class="col-lg-3">
                                	<div class="form-group">
                                    	<input type="text" class="form-control" name="loactionstaff" id="loactionstaff" placeholder="Enter Location">
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                	<div class="form-group">
                                    	<input type="text" class="form-control datepicker" name="staff_sdate" id="staff_sdate" placeholder="Start Date" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                	<div class="form-group">
                                    	<input type="text" class="form-control datepicker" name="staff_edate" id="staff_edate" placeholder="End Date" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                	<div class="form-group">
                                    	<input type="text" class="form-control" name="staff_keyword" placeholder="Enter Keyword" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                	<div class="form-group">
									<?php if($this->session->userdata('user_id')==''){ ?> 
									<a href="#" data-toggle="modal" data-target="#login_popup" class="search_btns staff-bg" style="color: #fff;">Search For Staff</a>
									<?php } else if($role=='staff') { ?>
									<a href="#" onclick="showpopup()" class="search_btns staff-bg" style="color: #fff;">Search For Staff</a>
									<?php } else { ?>
									 <input class="search_btns staff-bg" name="submit"  value="Search For Staff" type="submit"> 
									<?php } ?>									
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div> 
        </div>
        <div id="pane-B" class="card tab-pane fade <?php if($role=='staff'){ echo 'active show';} if($uid==''){echo 'active show';}?>" role="tabpanel" aria-labelledby="tab-B">
            <div class="card-header" role="tab" id="heading-B">
                <h5 class="mb-0">
                    <a class="collapsed" data-toggle="collapse" href="#collapse-B" aria-expanded="false" aria-controls="collapse-B">
                       Find Work
                    </a>
                </h5>
            </div>
            <div id="collapse-B" class="collapse" data-parent="#content" role="tabpanel" aria-labelledby="heading-B">
                <div class="card-body">
                  <form method="post" action="<?php echo base_url(); ?>Welcome/find_work">
                    	<div class="find-form">
                        	<div class="row">
							
                            	<div class="col-lg-3">
                                	<div class="form-group">
                                    	<input type="text" class="form-control" name="loaction" id="loaction" placeholder="Enter Location">
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                	<div class="form-group">
                                    	<input type="text" class="form-control datepicker" name="from_date" id="from_date"placeholder="Start Date" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                	<div class="form-group">
                                    	<input type="text" class="form-control datepicker" name="to_date" id="to_date" placeholder="End Date" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                	<div class="form-group">
                                    	<input type="text" class="form-control" name="keyword" id="keyword" placeholder="Enter Keyword" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                	<div class="form-group">
									<?php if($this->session->userdata('user_id')==''){ ?> 
									<a href="#" data-toggle="modal" data-target="#login_popup" class="search_btns work-bg" style="color: #fff;">Search For Work</a>
									<?php } else if($role=='employer'){ ?>
									<a href="#" onclick="showpopup()" class="search_btns work-bg" style="color: #fff;">Search For Work</a>                                    
									<?php } else { ?>
									<input class="search_btns work-bg" name="submit"  value="Search For Work" type="submit"> 
									<?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form> 
                </div>
            </div>
        </div>
    </div>
</div>
    </div>
</section>

<!-- Notification popup start -->
<div class="staff_notif_popup popup_wrapper">
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
								if($role=='employer'){
								$image = 'user.jpg';
								}if($role=='staff') { 
								$image = 'userst.jpg';
								}		
								?>
	  <img src="<?php echo base_url(); ?>public/front_end/images/dashboard/<?php echo $image; ?>" alt="Profile Pic" class="nnmg">
	 <?php } ?>
                            </span>
                            <!--<span class="popup_img">
                                <img src="https://www.seasonalstaff.co.nz/public/front_end/images/dashboard/user.jpg" class="img-fluid">
                            </span>-->
                        </div>
                        <h4>Hello, <?php echo $result[0]['first_name']; ?> <?php echo  $result[0]['last_name']; ?></h4>
                        <p id="umsg">Welcome to Seasonal Staff , 
                        <h4>Please verify your Email account.</h4>
							<p>Check your email, to verify your account.  If this email is in not in your Inbox check your Spam or junk Folder</p>
                        <br> So employers can search for your skills and attributes please complete your profile now.</p>  
                        
                    </div>
                    <div class="popup_bottom_buttons">										
						<a href="<?php echo base_url(); ?>manage-work-profile" class="green_button">Complete my profile</a>						 
                       <!-- <a href="<?php echo base_url(); ?>Welcome/find_work" class="green_button">Look for work</a> -->
						
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
								if($role=='employer'){
								$image = 'user.jpg';
								}if($role=='staff') { 
								$image = 'userst.jpg';
								}		
								?>
	  <img src="<?php echo base_url(); ?>public/front_end/images/dashboard/<?php echo $image; ?>" alt="Profile Pic" class="nnmg">
	 <?php } ?>
                            </span>
                            <!--<span class="popup_img">
                                <img src="https://www.seasonalstaff.co.nz/public/front_end/images/dashboard/user.jpg" class="img-fluid">
                            </span>-->
                        </div>
                        <h4>Hello, <?php echo $result[0]['first_name']; ?> <?php echo  $result[0]['last_name']; ?></h4>
                        <p id="umsg">Welcome back to Seasonal Staff , <br> What would you like to do?</p>                   
                    </div>
                    <div class="popup_bottom_buttons">
					     <?php if($role=='employer'){ ?>
                        <a href="<?php echo base_url(); ?>list-a-job" class="green_button">List A Job</a>
                        <a href="<?php echo base_url(); ?>find-staff" class="green_button">Look for Staff</a>
					    <a href="<?php echo base_url(); ?>manage-job" class="green_button">Check applicants</a>

						 <?php }  if($role=='staff'){  ?>
						 <a href="<?php echo base_url(); ?>manage-work-profile" class="green_button">Update your profile</a>						 
                         <a href="<?php echo base_url(); ?>Welcome/find_work" class="green_button">Look for work</a>
						 <?php } ?>
                   </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Notification popup End -->
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
<?php
//echo count($maplocation); die;
//$locations=array();
 foreach($maplocation as $mli){
					//echo $nama_kabkot = $row['business_location'];
        //echo  $longitude = $row['cityLat'];  die;  
		
					$locations[]=array(
					'google_map' => array(
						'lat' => $mli->cityLatc,
						'lng' => $mli->cityLngc,
						),
						
					 'location_address' =>  $mli->available_date,
					 'location_id' =>  $mli->staff_id,
					'location_name'    => $mli->username,);
					
        } 
 ?>
<script>
function showpopup()
{
 var element = document.getElementById("myDIV");
   element.classList.add("popup_active");
   var role = "<?php echo $role; ?>";
  if(role=='employer'){
  document.getElementById("msgshow").innerHTML = "This feauters is staff only"; 
  } 
  if(role=='staff'){  
  document.getElementById("msgshow").innerHTML = "This feauters is employers only";  
  }  
}

$(window).on('load', function(){
	var usuu ="<?php echo $this->uri->segment(2); ?>";

	if(usuu=="user"){
      setTimeout(function(){
        $(".new_notif_popup").addClass("popup_active");
      },1500);	  
	}
	if(usuu=="staffn"){
	setTimeout(function(){
        $(".staff_notif_popup").addClass("popup_active");
      },1500);
		
	}
     });

function initialize() {
        var input = document.getElementById('loaction');
        var autocomplete = new google.maps.places.Autocomplete(input);
        autocomplete.setComponentRestrictions(
            {'country': ['nz']});
        google.maps.event.addListener(autocomplete, 'place_changed', function () {
            var place = autocomplete.getPlace();
            document.getElementById('city2').value = place.name;
            document.getElementById('cityLat').value = place.geometry.location.lat();
            document.getElementById('cityLng').value = place.geometry.location.lng();
            //alert("This function is working!");
            //alert(place.name);
           // alert(place.address_components[0].long_name);
		  var latlng = new google.maps.LatLng(place.geometry.location.lat(),place.geometry.location.lng());
        var myOptions =
        {
            zoom: 8,
            center: latlng,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            disableDefaultUI: true,
        };
        map = new google.maps.Map(document.getElementById("map"), myOptions);

        });
	    var input = document.getElementById('loactionstaff');
        var autocomplete = new google.maps.places.Autocomplete(input);
        autocomplete.setComponentRestrictions(
            {'country': ['nz']});
        google.maps.event.addListener(autocomplete, 'place_changed', function () {
            var place = autocomplete.getPlace();
            document.getElementById('city2s').value = place.name;
            document.getElementById('cityLats').value = place.geometry.location.lat();
            document.getElementById('cityLngs').value = place.geometry.location.lng();
            //alert("This function is working!");
            //alert(place.name);
           // alert(place.address_components[0].long_name);
		   
		   var latlng = new google.maps.LatLng(place.geometry.location.lat(),place.geometry.location.lng());
        var myOptions =
        {
            zoom: 8,
            center: latlng,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            disableDefaultUI: true,
        };
        map = new google.maps.Map(document.getElementById("map"), myOptions);

        });	
			
		
    }
    google.maps.event.addDomListener(window, 'load', initialize);
</script>
<script type="text/javascript">
          var map;
          var str;
          var link;
		  var role = "<?php echo $role; ?>"
            var InforObj = [];
            var centerCords = {
              lat:  -41.838875,
              lng: 171.77989983333356
            };
			if(role==""){
            var markersOnMap = [
			<?php foreach($maplocation as $location ){ ?>
			  {
				    iconBasee: "<?php echo base_url(); ?>public/front_end/images/map_icon_green.png",
                    placeName: "<a href='<?php echo base_url(); ?>Welcome/work_detail/<?php echo preg_replace('/[^a-zA-Z0-9]/s', '-', $location->job_title);?>/<?php echo $location->id; ?>' target='_blank'><?php echo $location->map_address; ?></a>",
					
					title: "<?php
					        $ll =$location->latitude;
                           $query = $this->db->query("SELECT * FROM `jobs` WHERE latitude=". $ll ." && status=1"); 
							$result1 = $query->result();

					foreach($result1 as $locationsss ){?><a href='<?php echo base_url(); ?>Welcome/work_detail/<?php echo preg_replace('/[^a-zA-Z0-9]/s', '-', $locationsss->job_title);?>/<?php echo $locationsss->id; ?>' target='_blank'><?php echo $locationsss->no_staff; ?> , <?php echo $locationsss->job_title; ?></a><?php echo '<br>'; } ?>",
					
                    LatLng: [{
                        lat: <?php echo $location->latitude; ?>,
                        lng: <?php echo $location->longitude; ?>
                    }]
                },
			<?php  } ?>
                /* {
				  	iconBasee: "<?php echo base_url(); ?>public/front_end/images/map_icon_green.png",
                    placeName: "<?php echo $maplocation[1]->map_address; ?>",
				    title: "Job Title - <a href='<?php echo base_url(); ?>Welcome/work_detail/<?php echo str_replace(' ', '-', $maplocation[1]->job_title);?>/<?php echo $maplocation[1]->id; ?>' target='_blank'><?php echo $maplocation[1]->job_title; ?></a>",
                    LatLng: [{
                        lat: <?php echo $maplocation[1]->latitude; ?>,
                        lng: <?php echo $maplocation[1]->longitude; ?>
                    }]
                }/*,
                {
                  	iconBasee: "<?php echo base_url(); ?>public/front_end/images/map_icon_green.png",
				    placeName: "<?php echo $maplocation[2]->map_address; ?>",
				    title: "Job Title - <a href='<?php echo base_url(); ?>Welcome/work_detail/<?php echo str_replace(' ', '-', $maplocation[2]->job_title);?>/<?php echo $maplocation[2]->id; ?>' target='_blank'><?php echo $maplocation[2]->job_title; ?></a>",
                    LatLng: [{
                        lat: <?php echo $maplocation[2]->latitude; ?>,
                        lng: <?php echo $maplocation[2]->longitude; ?>
                    }]
                }
                {
                   	iconBasee: '<?php echo base_url(); ?>public/front_end/images/map_icon_green.png',
					placeName: "<?php echo $maplocation[3]->map_address; ?>",
					title: "Job Title - <a href='<?php echo base_url(); ?>Welcome/work_detail/<?php echo str_replace(' ', '-', $maplocation[3]->job_title);?>/<?php echo $maplocation[3]->id; ?>' target='_blank'><?php echo $maplocation[3]->job_title; ?></a>",
                    LatLng: [{
                        lat: <?php echo $maplocation[3]->latitude; ?>,
                        lng: <?php echo $maplocation[3]->longitude; ?>
                    }]
                },
                {
                    iconBasee: "<?php echo base_url(); ?>public/front_end/images/map_icon_green.png",
					placeName: "<?php echo $maplocation[4]->map_address; ?>",
					title: "Job Title - <a href='<?php echo base_url(); ?>Welcome/work_detail/<?php echo str_replace(' ', '-', $maplocation[4]->job_title);?>/<?php echo $maplocation[4]->id; ?>' target='_blank'><?php echo $maplocation[4]->job_title; ?></a>",
                    LatLng: [{
                        lat: <?php echo $maplocation[4]->latitude; ?>,
                        lng: <?php echo $maplocation[4]->longitude; ?>
                    }]
                },
				 {
                    iconBasee: "<?php echo base_url(); ?>public/front_end/images/map_icon_green.png",
					placeName: "<?php echo $maplocation[5]->map_address; ?>",
					title: "Job Title - <a href='<?php echo base_url(); ?>Welcome/work_detail/<?php echo str_replace(' ', '-', $maplocation[5]->job_title);?>/<?php echo $maplocation[5]->id; ?>' target='_blank'><?php echo $maplocation[5]->job_title; ?></a>",
                    LatLng: [{
                        lat: <?php echo $maplocation[5]->latitude; ?>,
                        lng: <?php echo $maplocation[5]->longitude; ?>
                    }]
                },
				 {
                  
				    iconBasee: "<?php echo base_url(); ?>public/front_end/images/map_icon_green.png",
				    placeName: "<?php echo $maplocation[6]->map_address; ?>",
					title: "Job Title - <a href='<?php echo base_url(); ?>Welcome/work_detail/<?php echo str_replace(' ', '-', $maplocation[6]->job_title);?>/<?php echo $maplocation[6]->id; ?>' target='_blank'><?php echo $maplocation[6]->job_title; ?></a>",
                    LatLng: [{
                        lat: <?php echo $maplocation[6]->latitude; ?>,
                        lng: <?php echo $maplocation[6]->longitude; ?>
                    }]
                },
				{
                   
					iconBasee: "<?php echo base_url(); ?>public/front_end/images/map_icon_green.png",
				    placeName: "<?php echo $maplocation[7]->map_address; ?>",
					title: "Job Title - <a href='<?php echo base_url(); ?>Welcome/work_detail/<?php echo str_replace(' ', '-', $maplocation[7]->job_title);?>/<?php echo $maplocation[7]->id; ?>' target='_blank'><?php echo $maplocation[7]->job_title; ?></a>",
                    LatLng: [{
                        lat: <?php echo $maplocation[7]->latitude; ?>,
                        lng: <?php echo $maplocation[7]->longitude; ?>
                    }]
                },
				
				{
                   
					iconBasee: "<?php echo base_url(); ?>public/front_end/images/map_icon_green.png",
					placeName: "<?php echo $maplocation[8]->map_address; ?>",
					title: "Job Title - <a href='<?php echo base_url(); ?>Welcome/work_detail/<?php echo str_replace(' ', '-', $maplocation[8]->job_title);?>/<?php echo $maplocation[8]->id; ?>' target='_blank'><?php echo $maplocation[8]->job_title; ?></a>",
                    LatLng: [{
                        lat: <?php echo $maplocation[8]->latitude; ?>,
                        lng: <?php echo $maplocation[8]->longitude; ?>
                    }]
                },
				{
                   
					iconBasee: '<?php echo base_url(); ?>public/front_end/images/map_icon_green.png',
					placeName: "<?php echo $maplocation[9]->map_address; ?>",
					title: "Job Title - <a href='<?php echo base_url(); ?>Welcome/work_detail/<?php echo str_replace(' ', '-', $maplocation[9]->job_title);?>/<?php echo $maplocation[9]->id; ?>' target='_blank'><?php echo $maplocation[9]->job_title; ?></a>",
                    LatLng: [{
                        lat: <?php echo $maplocation[9]->latitude; ?>,
                        lng: <?php echo $maplocation[9]->longitude; ?>
                    }]
                }*/
			<?php foreach($maplocations as $location1 ){ ?>
				{
                   classem: 'staffrow',
				   iconBasee: "<?php echo base_url(); ?>public/front_end/images/map_icon_blue.png",
				   placeName: "<?php
					        $ll =$location1->cityLatc;
							$this->db->select("staff_basicinfo.available_date,staff_basicinfo.cityLatc,staff_basicinfo.staff_id,users.username");
                            $this->db->from('staff_basicinfo');
                            $this->db->join('users', 'staff_basicinfo.staff_id = users.id');
							$this->db->where('staff_basicinfo.cityLatc', $ll);
                            $query = $this->db->get();							
                            //$query = $this->db->query("SELECT * FROM `staff_basicinfo` WHERE cityLatc=". $ll .""); 
							$result1 = $query->result();
					foreach($result1 as $locationss ){?><h4>Detail staff - <a href='<?php echo base_url(); ?>staff-detail/<?php echo $locationss->staff_id; ?>' target='_blank'><?php echo $locationss->username; ?> </a></h4><?php echo '<br> '; ?><h6>Avaliable from - <?php echo  date("d M Y", strtotime($locationss->available_date)); ?> </h6> <?php  echo '<br> '; } ?>",
					
				 title: "",	
                    LatLng: [{
                        lat: <?php echo $location1->cityLatc; ?>,
                        lng: <?php echo $location1->cityLngc; ?>
                    }]
                },
			<?php } ?>
                /*{
                   classem: 'staffrow',
				   iconBasee: "<?php echo base_url(); ?>public/front_end/images/map_icon_blue.png",
				    placeName: "Avaliable from - <?php echo $maplocations[1]->available_date; ?>",
				    title: "Detail staff - <a href='<?php echo base_url(); ?>staff-detail/<?php echo $maplocations[1]->staff_id; ?>' target='_blank'><?php echo $maplocations[1]->username; ?></a>",
                    LatLng: [{
                        lat: <?php echo $maplocations[1]->cityLatc; ?>,
                        lng: <?php echo $maplocations[1]->cityLngc; ?>
                    }]
                },
                {
                    classem: 'staffrow',
					iconBasee:"<?php echo base_url(); ?>public/front_end/images/map_icon_blue.png",
					placeName: "Avaliable from - <?php echo $maplocations[2]->available_date; ?>",
					title: "Detail staff - <a href='<?php echo base_url(); ?>staff-detail/<?php echo $maplocations[2]->staff_id; ?>' target='_blank'><?php echo $maplocations[2]->username; ?></a>",
                    LatLng: [{
                        lat: <?php echo $maplocations[2]->cityLatc; ?>,
                        lng: <?php echo $maplocations[2]->cityLngc; ?>
                    }]
                }/*,
                {
                    classem: 'staffrow',
					iconBasee: "<?php echo base_url(); ?>public/front_end/images/map_icon_blue.png",
					placeName: "Avaliable from - <?php echo $maplocations[3]->available_date; ?>",
					title: "Detail staff - <a href='<?php echo base_url(); ?>staff-detail/<?php echo $maplocations[3]->staff_id; ?>' target='_blank'><?php echo $maplocations[3]->username; ?></a>",
                    LatLng: [{
                        lat: <?php echo $maplocations[3]->cityLatc; ?>,
                        lng: <?php echo $maplocations[3]->cityLngc; ?>
                    }]
                },
                {
                    classem: 'staffrow',
				    iconBasee: "<?php echo base_url(); ?>public/front_end/images/map_icon_blue.png",
				    placeName: "Avaliable from - <?php echo $maplocations[4]->available_date; ?>",
					title: "Detail staff - <a href='<?php echo base_url(); ?>staff-detail/<?php echo $maplocations[4]->staff_id; ?>' target='_blank'><?php echo $maplocations[4]->username; ?></a>",
                    LatLng: [{
                        lat: <?php echo $maplocations[4]->cityLatc; ?>,
                        lng: <?php echo $maplocations[4]->cityLngc; ?>
                    }]
                }/*,
				{
                    classem: 'staffrow',
					iconBasee: "<?php echo base_url(); ?>public/front_end/images/map_icon_blue.png",
				    placeName: "Avaliable from - <?php echo $maplocations[5]->available_date; ?>",
					title: "Detail staff - <a href='<?php echo base_url(); ?>staff-detail/<?php echo $maplocations[5]->staff_id; ?>' target='_blank'><?php echo $maplocations[5]->username; ?></a>",
                    LatLng: [{
                        lat: <?php echo $maplocations[5]->cityLatc; ?>,
                        lng: <?php echo $maplocations[5]->cityLngc; ?>
                    }]
                },
				{
                    classem: 'staffrow',
					iconBasee: "<?php echo base_url(); ?>public/front_end/images/map_icon_blue.png",
				    placeName: "Avaliable from - <?php echo $maplocations[5]->available_date; ?>",
					title: "Detail staff - <a href='<?php echo base_url(); ?>staff-detail/<?php echo $maplocations[5]->staff_id; ?>' target='_blank'><?php echo $maplocations[5]->username; ?></a>",
                    LatLng: [{
                        lat: <?php echo $maplocations[5]->cityLatc; ?>,
                        lng: <?php echo $maplocations[5]->cityLngc; ?>
                    }]
                },
				{
                    classem: 'staffrow',
				    iconBasee: "<?php echo base_url(); ?>public/front_end/images/map_icon_blue.png",
				    placeName: "Avaliable from - <?php echo $maplocations[6]->available_date; ?>",
					title: "Detail staff - <a href='<?php echo base_url(); ?>staff-detail/<?php echo $maplocations[6]->staff_id; ?>' target='_blank'><?php echo $maplocations[6]->username; ?> </a>",
                    LatLng: [{
                        lat: <?php echo $maplocations[6]->cityLatc; ?>,
                        lng: <?php echo $maplocations[6]->cityLngc; ?>
                    }]
                },
				{
                    classem: 'staffrow',
					iconBasee: "<?php echo base_url(); ?>public/front_end/images/map_icon_blue.png",
				    placeName: "Avaliable from - <?php echo $maplocations[7]->available_date; ?>",
					title: "Detail staff - <a href='<?php echo base_url(); ?>staff-detail/<?php echo $maplocations[7]->staff_id; ?>' target='_blank'><?php echo $maplocations[7]->username; ?></a>",
                    LatLng: [{
                        lat: <?php echo $maplocations[7]->cityLatc; ?>,
                        lng: <?php echo $maplocations[7]->cityLngc; ?>
                    }]
                },
				{
                    classem: 'staffrow',
				    iconBasee: "<?php echo base_url(); ?>public/front_end/images/map_icon_blue.png",
				    placeName: "Avaliable from - <?php echo $maplocations[8]->available_date; ?>",
					title: "Detail staff - <a href='<?php echo base_url(); ?>staff-detail/<?php echo $maplocations[8]->staff_id; ?>' target='_blank'><?php echo $maplocations[8]->username; ?></a>",
                    LatLng: [{
                        lat: <?php echo $maplocations[8]->cityLatc; ?>,
                        lng: <?php echo $maplocations[8]->cityLngc; ?>
                    }]
                },
				{
                    classem: 'staffrow',
				    iconBasee: "<?php echo base_url(); ?>public/front_end/images/map_icon_blue.png",
				    placeName: "Avaliable from - <?php echo $maplocations[9]->available_date; ?>",
					title: "Detail staff - <a href='<?php echo base_url(); ?>staff-detail/<?php echo $maplocations[9]->staff_id; ?>' target='_blank'><?php echo $maplocations[9]->username; ?></a>",
                    LatLng: [{
                        lat: <?php echo $maplocations[9]->cityLatc; ?>,
                        lng: <?php echo $maplocations[9]->cityLngc; ?>
                    }]
                }*/
            ];
			}
			if(role=="staff"){
			var markersOnMap = [
			<?php foreach($maplocation as $location13 ){ ?>
			{
				
				    iconBasee: "<?php echo base_url(); ?>public/front_end/images/map_icon_green.png",
                    placeName: "<a href='<?php echo base_url(); ?>Welcome/work_detail/<?php echo preg_replace('/[^a-zA-Z0-9]/s', '-', $location13->job_title);?>/<?php echo $location13->id; ?>' target='_blank'><?php echo $location13->map_address; ?></a>",
					
					title: "<?php
					        $ll =$location13->latitude;
                          $query = $this->db->query("SELECT * FROM `jobs` WHERE latitude=". $ll ." && status=1"); 
							$result1 = $query->result();

					foreach($result1 as $locationss ){?><a href='<?php echo base_url(); ?>Welcome/work_detail/<?php echo preg_replace('/[^a-zA-Z0-9]/s', '-', $locationss->job_title);?>/<?php echo $locationss->id; ?>' target='_blank'><?php echo $locationss->no_staff; ?> , <?php echo $locationss->job_title; ?></a><?php echo '<br>'; } ?>",	
					
                    LatLng: [{
                        lat: <?php echo $location13->latitude; ?>,
                        lng: <?php echo $location13->longitude; ?>
                    }]
                },
			<?php }  ?>/*,
                {
				  	iconBasee: "<?php echo base_url(); ?>public/front_end/images/map_icon_green.png",
                    placeName: "<?php echo $maplocation[1]->map_address; ?>",
				    title: "Job Title - <a href='<?php echo base_url(); ?>Welcome/work_detail/<?php echo str_replace(' ', '-', $maplocation[1]->job_title);?>/<?php echo $maplocation[1]->id; ?>' target='_blank'><?php echo $maplocation[1]->job_title; ?></a>",
                    LatLng: [{
                        lat: <?php echo $maplocation[1]->latitude; ?>,
                        lng: <?php echo $maplocation[1]->longitude; ?>
                    }]
                },
                {
                  	iconBasee: "<?php echo base_url(); ?>public/front_end/images/map_icon_green.png",
				    placeName: "<?php echo $maplocation[2]->map_address; ?>",
				    title: "Job Title - <a href='<?php echo base_url(); ?>Welcome/work_detail/<?php echo str_replace(' ', '-', $maplocation[2]->job_title);?>/<?php echo $maplocation[2]->id; ?>' target='_blank'><?php echo $maplocation[2]->job_title; ?></a>",
                    LatLng: [{
                        lat: <?php echo $maplocation[2]->latitude; ?>,
                        lng: <?php echo $maplocation[2]->longitude; ?>
                    }]
                },
                {
                   	iconBasee: '<?php echo base_url(); ?>public/front_end/images/map_icon_green.png',
					placeName: "<?php echo $maplocation[3]->map_address; ?>",
					title: "Job Title - <a href='<?php echo base_url(); ?>Welcome/work_detail/<?php echo str_replace(' ', '-', $maplocation[3]->job_title);?>/<?php echo $maplocation[3]->id; ?>' target='_blank'><?php echo $maplocation[3]->job_title; ?></a>",
                    LatLng: [{
                        lat: <?php echo $maplocation[3]->latitude; ?>,
                        lng: <?php echo $maplocation[3]->longitude; ?>
                    }]
                },
                {
                    iconBasee: "<?php echo base_url(); ?>public/front_end/images/map_icon_green.png",
					placeName: "<?php echo $maplocation[4]->map_address; ?>",
					title: "Job Title - <a href='<?php echo base_url(); ?>Welcome/work_detail/<?php echo str_replace(' ', '-', $maplocation[4]->job_title);?>/<?php echo $maplocation[4]->id; ?>' target='_blank'><?php echo $maplocation[4]->job_title; ?></a>",
                    LatLng: [{
                        lat: <?php echo $maplocation[4]->latitude; ?>,
                        lng: <?php echo $maplocation[4]->longitude; ?>
                    }]
                },
				 {
                    iconBasee: "<?php echo base_url(); ?>public/front_end/images/map_icon_green.png",
					placeName: "<?php echo $maplocation[5]->map_address; ?>",
					title: "Job Title - <a href='<?php echo base_url(); ?>Welcome/work_detail/<?php echo str_replace(' ', '-', $maplocation[5]->job_title);?>/<?php echo $maplocation[5]->id; ?>' target='_blank'><?php echo $maplocation[5]->job_title; ?></a>",
                    LatLng: [{
                        lat: <?php echo $maplocation[5]->latitude; ?>,
                        lng: <?php echo $maplocation[5]->longitude; ?>
                    }]
                },
				 {
                  
				    iconBasee: "<?php echo base_url(); ?>public/front_end/images/map_icon_green.png",
				    placeName: "<?php echo $maplocation[6]->map_address; ?>",
					title: "Job Title - <a href='<?php echo base_url(); ?>Welcome/work_detail/<?php echo str_replace(' ', '-', $maplocation[6]->job_title);?>/<?php echo $maplocation[6]->id; ?>' target='_blank'><?php echo $maplocation[6]->job_title; ?></a>",
                    LatLng: [{
                        lat: <?php echo $maplocation[6]->latitude; ?>,
                        lng: <?php echo $maplocation[6]->longitude; ?>
                    }]
                },
				{
                   
					iconBasee: "<?php echo base_url(); ?>public/front_end/images/map_icon_green.png",
				    placeName: "<?php echo $maplocation[7]->map_address; ?>",
					title: "Job Title - <a href='<?php echo base_url(); ?>Welcome/work_detail/<?php echo str_replace(' ', '-', $maplocation[7]->job_title);?>/<?php echo $maplocation[7]->id; ?>' target='_blank'><?php echo $maplocation[7]->job_title; ?></a>",
                    LatLng: [{
                        lat: <?php echo $maplocation[7]->latitude; ?>,
                        lng: <?php echo $maplocation[7]->longitude; ?>
                    }]
                },
				
				{
                   
					iconBasee: "<?php echo base_url(); ?>public/front_end/images/map_icon_green.png",
					placeName: "<?php echo $maplocation[8]->map_address; ?>",
					title: "Job Title - <a href='<?php echo base_url(); ?>Welcome/work_detail/<?php echo str_replace(' ', '-', $maplocation[8]->job_title);?>/<?php echo $maplocation[8]->id; ?>' target='_blank'><?php echo $maplocation[8]->job_title; ?></a>",
                    LatLng: [{
                        lat: <?php echo $maplocation[8]->latitude; ?>,
                        lng: <?php echo $maplocation[8]->longitude; ?>
                    }]
                },
				{
                   
					iconBasee: '<?php echo base_url(); ?>public/front_end/images/map_icon_green.png',
					placeName: "<?php echo $maplocation[9]->map_address; ?>",
					title: "Job Title - <a href='<?php echo base_url(); ?>Welcome/work_detail/<?php echo str_replace(' ', '-', $maplocation[9]->job_title);?>/<?php echo $maplocation[9]->id; ?>' target='_blank'><?php echo $maplocation[9]->job_title; ?></a>",
                    LatLng: [{
                        lat: <?php echo $maplocation[9]->latitude; ?>,
                        lng: <?php echo $maplocation[9]->longitude; ?>
                    }]
			}*/
			];	
			}
			if(role=="employer"){
			var markersOnMap = [
			<?php foreach($maplocations as $location1 ){ ?>
			{
                   classem: 'staffrow',
				   iconBasee: "<?php echo base_url(); ?>public/front_end/images/map_icon_blue.png",
					placeName: "<?php
					        $ll =$location1->cityLatc;
							$this->db->select("staff_basicinfo.available_date,staff_basicinfo.cityLatc,staff_basicinfo.staff_id,users.username");
                            $this->db->from('staff_basicinfo');
                            $this->db->join('users', 'staff_basicinfo.staff_id = users.id');
							$this->db->where('staff_basicinfo.cityLatc', $ll);
                            $query = $this->db->get();							
                            //$query = $this->db->query("SELECT * FROM `staff_basicinfo` WHERE cityLatc=". $ll .""); 
							$result1 = $query->result();
					foreach($result1 as $locationss ){?><h4>Detail staff - <a href='<?php echo base_url(); ?>staff-detail/<?php echo $locationss->staff_id; ?>' target='_blank'><?php echo $locationss->username; ?> </a></h4><?php echo '<br> '; ?><h6>Avaliable from - <?php echo  date("d M Y", strtotime($locationss->available_date)); ?> </h6> <?php  echo '<br> '; } ?>",
					
				 title: "",	
                    LatLng: [{
                        lat: <?php echo $location1->cityLatc; ?>,
                        lng: <?php echo $location1->cityLngc; ?>
                    }]
                },
			<?php } ?>
                /*{
                   classem: 'staffrow',
				   iconBasee: "<?php echo base_url(); ?>public/front_end/images/map_icon_blue.png",
				    placeName: "Avaliable from - <?php echo $maplocations[0]->available_date; ?>",
				    title: "Detail staff - <a href='<?php echo base_url(); ?>staff-detail/<?php echo $maplocations[1]->staff_id; ?>' target='_blank'><?php echo $maplocations[1]->username; ?></a>",
                    LatLng: [{
                        lat: <?php echo $maplocations[1]->cityLatc; ?>,
                        lng: <?php echo $maplocations[1]->cityLngc; ?>
                    }]
                }/*,
                {
                    classem: 'staffrow',
					iconBasee:"<?php echo base_url(); ?>public/front_end/images/map_icon_blue.png",
					placeName: "Avaliable from - <?php echo $maplocations[0]->available_date; ?>",
					title: "Detail staff - <a href='<?php echo base_url(); ?>staff-detail/<?php echo $maplocations[2]->staff_id; ?>' target='_blank'><?php echo $maplocations[2]->username; ?></a>",
                    LatLng: [{
                        lat: <?php echo $maplocations[2]->cityLatc; ?>,
                        lng: <?php echo $maplocations[2]->cityLngc; ?>
                    }]
                },
                {
                    classem: 'staffrow',
					iconBasee: "<?php echo base_url(); ?>public/front_end/images/map_icon_blue.png",
					placeName: "Avaliable from - <?php echo $maplocations[0]->available_date; ?>",
					title: "Detail staff - <a href='<?php echo base_url(); ?>staff-detail/<?php echo $maplocations[3]->staff_id; ?>' target='_blank'><?php echo $maplocations[3]->username; ?></a>",
                    LatLng: [{
                        lat: <?php echo $maplocations[3]->cityLatc; ?>,
                        lng: <?php echo $maplocations[3]->cityLngc; ?>
                    }]
                },
               {
                    classem: 'staffrow',
				    iconBasee: "<?php echo base_url(); ?>public/front_end/images/map_icon_blue.png",
				    placeName: "Avaliable from - <?php echo $maplocations[0]->available_date; ?>",
					title: "Detail staff - <a href='<?php echo base_url(); ?>staff-detail/<?php echo $maplocations[4]->staff_id; ?>' target='_blank'><?php echo $maplocations[4]->username; ?></a>",
                    LatLng: [{
                        lat: <?php echo $maplocations[4]->cityLatc; ?>,
                        lng: <?php echo $maplocations[4]->cityLngc; ?>
                    }]
                }/* ,
				{
                    classem: 'staffrow',
					iconBasee: "<?php echo base_url(); ?>public/front_end/images/map_icon_blue.png",
				    placeName: "Avaliable from - <?php echo $maplocations[0]->available_date; ?>",
					title: "Detail staff - <a href='<?php echo base_url(); ?>staff-detail/<?php echo $maplocations[5]->staff_id; ?>' target='_blank'><?php echo $maplocations[5]->username; ?></a>",
                    LatLng: [{
                        lat: <?php echo $maplocations[5]->cityLatc; ?>,
                        lng: <?php echo $maplocations[5]->cityLngc; ?>
                    }]
                },
				{
                    classem: 'staffrow',
					iconBasee: "<?php echo base_url(); ?>public/front_end/images/map_icon_blue.png",
				    placeName: "Avaliable from - <?php echo $maplocations[0]->available_date; ?>",
					title: "Detail staff - <a href='<?php echo base_url(); ?>staff-detail/<?php echo $maplocations[5]->staff_id; ?>' target='_blank'><?php echo $maplocations[5]->username; ?></a>",
                    LatLng: [{
                        lat: <?php echo $maplocations[5]->cityLatc; ?>,
                        lng: <?php echo $maplocations[5]->cityLngc; ?>
                    }]
                },
				{
                    classem: 'staffrow',
				    iconBasee: "<?php echo base_url(); ?>public/front_end/images/map_icon_blue.png",
				    placeName: "Avaliable from - <?php echo $maplocations[0]->available_date; ?>",
					title: "Detail staff - <a href='<?php echo base_url(); ?>staff-detail/<?php echo $maplocations[6]->staff_id; ?>' target='_blank'><?php echo $maplocations[6]->username; ?></a>",
                    LatLng: [{
                        lat: <?php echo $maplocations[6]->cityLatc; ?>,
                        lng: <?php echo $maplocations[6]->cityLngc; ?>
                    }]
                },
				{
                    classem: 'staffrow',
					iconBasee: "<?php echo base_url(); ?>public/front_end/images/map_icon_blue.png",
				    placeName: "Avaliable from - <?php echo $maplocations[0]->available_date; ?>",
					title: "Detail staff - <a href='<?php echo base_url(); ?>staff-detail/<?php echo $maplocations[7]->staff_id; ?>' target='_blank'><?php echo $maplocations[7]->username; ?></a>",
                    LatLng: [{
                        lat: <?php echo $maplocations[7]->cityLatc; ?>,
                        lng: <?php echo $maplocations[7]->cityLngc; ?>
                    }]
                },
				{
                    classem: 'staffrow',
				    iconBasee: "<?php echo base_url(); ?>public/front_end/images/map_icon_blue.png",
				    placeName: "Avaliable from - <?php echo $maplocations[0]->available_date; ?>",
					title: "Detail staff - <a href='<?php echo base_url(); ?>staff-detail/<?php echo $maplocations[8]->staff_id; ?>' target='_blank'><?php echo $maplocations[8]->username; ?></a>",
                    LatLng: [{
                        lat: <?php echo $maplocations[8]->cityLatc; ?>,
                        lng: <?php echo $maplocations[8]->cityLngc; ?>
                    }]
                },
				{
                    classem: 'staffrow',
				    iconBasee: "<?php echo base_url(); ?>public/front_end/images/map_icon_blue.png",
				    placeName: "Avaliable from - <?php echo $maplocations[0]->available_date; ?>",
					title: "Detail staff - <a href='<?php echo base_url(); ?>staff-detail/<?php echo $maplocations[9]->staff_id; ?>' target='_blank'><?php echo $maplocations[9]->username; ?></a>",
                    LatLng: [{
                        lat: <?php echo $maplocations[9]->cityLatc; ?>,
                        lng: <?php echo $maplocations[9]->cityLngc; ?>
                    }]
                }*/
            ];	
			}

            window.onload = function () {
                initMap();
            };

            function addMarkerInfo() {
                 var marker, i;
				 var iconBase = "<?php echo base_url(); ?>public/front_end/images/map_icon_blue.png";

                for (var i = 0; i < markersOnMap.length; i++) {
                    var contentString = '<div class="'+markersOnMap[i].classem+' rowc"><div id="content"><h4>' + markersOnMap[i].title +
                        '</h4><h6>' + markersOnMap[i].placeName + '</h6></div></div>';

                    const marker = new google.maps.Marker({
                        position: markersOnMap[i].LatLng[0],
                        map: map,
                        icon : markersOnMap[i].iconBasee
                    });

                    const infowindow = new google.maps.InfoWindow({
                        content: contentString,
                        maxWidth: 800
                    });

                    marker.addListener('click', function () {
                        closeOtherInfo();
                        infowindow.open(marker.get('Mapp'), marker);
                        InforObj[0] = infowindow;
                    });
                    // marker.addListener('mouseover', function () {
                    //     closeOtherInfo();
                    //     infowindow.open(marker.get('map'), marker);
                    //     InforObj[0] = infowindow;
                    // });
                    // marker.addListener('mouseout', function () {
                    //     closeOtherInfo();
                    //     infowindow.close();
                    //     InforObj[0] = infowindow;
                    // });
                }
            }

            function closeOtherInfo() {
                if (InforObj.length > 0) {
                    /* detach the info-window from the marker ... undocumented in the API docs */
                    InforObj[0].set("marker", null);
                    /* and close it */
                    InforObj[0].close();
                    /* blank the array */
                    InforObj.length = 0;
                }
            }

            function initMap() {
                map = new google.maps.Map(document.getElementById('Map'), {
                    zoom: 5.9,
                    center: centerCords
                });
                addMarkerInfo();
            }	
</script> w