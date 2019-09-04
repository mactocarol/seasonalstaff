<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/css/bootstrap-multiselect.css" type="text/css">
  
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/js/bootstrap-multiselect.js"></script>

 <!-- breadcrumb section Start -->
<div class="breadcrumb text-center">
	<div class="container">
    <h1>Find Staff</h1>
    <ul><li><a href="#">home</a></li><li>Find Staff</li></ul>
    </div>
</div>
<!-- breadcrumb section End -->
<section id="page_map_panel">
<div class="map_dv map_dv_staff" id="Mapp" style="width:100%; height: 529px;">
	<!-- <img src="<?php echo base_url(); ?>public/images/find-staff-map.jpg"> -->
	</div>
</section>
<section class="search-section staff-page">
	<div class="container">
    	<div class="row">
            <div class="col-lg-3 col-md-4">
            	<div class="find_staff_form">
				<form method="post" action="<?php echo base_url(); ?>Welcome/find_staff">
					<div class="search_factor">
				 		<input type="search" id="staff_keyword" name="staff_keyword" placeholder="By Key word search" class="form-control" value="<?php  echo $this->session->userdata('staff_keyword');  ?>" autocomplete="off">
	                </div>
	                <div class="search_factor">					 
					 <input type="search" placeholder="Enter location" id="loactionstaff" name="loactionstaff" class="form-control country_autocomplete" value="<?php  echo $this->session->userdata('loactionstaff');  ?>">
	                </div>
					<div class="search_factor">
                      <input type="text" class="form-control datepicker" name="staff_sdate" id="staff_sdate" placeholder="Start Date" autocomplete="off" value="<?php  echo $this->session->userdata('staff_sdate');  ?>">
                        <!-- <button><i class="fa fa-location-arrow"></i></button> -->
                    </div>
					
					<!-- <div class="search_factor">
                    <input type="text" class="form-control datepicker" name="staff_edate" id="staff_edate" placeholder="End Date" autocomplete="off" value="<?php if(isset($_REQUEST['staff_edate'])) { echo $_REQUEST['staff_edate']; } ?>">
                    </div> -->
					
					
	               <!--  <div class="search_factor">
	                	<div class="search_factor_inner">
	                    	<h4 class="text-uppercase">last activity</h4>
	                        <ul>
                              <li>
                                  <div class="checkbox checkbox-primary">
                                      <input type="radio" class="radio"  id="checklist1" value="30" name="workduration" <?php if(isset($_POST['workduration'])) { if($_POST['workduration']==30) { echo 'checked';}} ?>>
                                      <label for="checklist1">Under 30 days</label>
                                    </div>
                                 </li>
                                 <li>
                                    <div class="checkbox checkbox-primary">
                                      <input type="radio" class="radio"  id="checklist2" value="90" name="workduration" <?php if(isset($_POST['workduration'])) { if($_POST['workduration']==90) { echo 'checked';}} ?>>
                                      <label for="checklist2">31-90 days</label>
                                    </div>
                                 </li>
                                 <li>
                                    <div class="checkbox checkbox-primary">
                                      <input type="radio" class="radio"  id="checklist3" value="180" name="workduration" <?php if(isset($_POST['workduration'])) { if($_POST['workduration']==180) { echo 'checked';}} ?>>
                                      <label for="checklist3"> 91- 180 days </label>
                                    </div>
                                 </li>
                                 <li>
                                    <div class="checkbox checkbox-primary">
                                      <input type="radio" class="radio"  id="checklist4" value="181" name="workduration" <?php if(isset($_POST['workduration'])) { if($_POST['workduration']==181) { echo 'checked';}} ?>>
                                      <label for="checklist4"> 181 days and greater</label>
                                    </div>
                                </li>
                            </ul>
	                	</div>
	                </div> -->
					
	               
                 	<div class="search_factor">
	                	<div class="search_factor_inner select_box">
	                    	<h4 class="text-uppercase">Industry Experience</h4><?php 
							   //print_r($skills); die;?>
								<select id="industry"  name="industry[]" multiple="multiple" data-live-search="true">
                              <?php 
							 $industrys = '';
                             $fff =  $this->session->userdata('industry'); 
							
                                              if(!empty($fff)){											 
                                                $industrys = explode(',',$fff);
											  }
							
							if(isset($industry)){
                                  foreach($industry as $list){
								?>
		                          <option value="<?php echo $list['id']; ?>" 
										<?php echo (in_array($list['id'],$industrys)) ? 'selected' : ''; ?>><?php echo $list['name']; ?></option>
          
							<?php }} ?>
	                         </select>
	                	</div>
	                 </div>
				   <!-- <div class="search_factor">
	                	<div class="search_factor_inner">
	                    	<h4 class="text-uppercase">Industry Experience</h4>
	                        <ul>
							<?php 
							 $industrys = '';
                             $ff =  implode(',',$_REQUEST['industry']); 
							
                                              if(!empty($ff)){											 
                                                $industrys = explode(',',$ff);
											  }
							
							if(isset($industry)){
                                  foreach($industry as $list){
								?>
	                        	<li>
	                            	<div class="checkbox checkbox-primary">
	                                	<input type="checkbox" class="checkbox" id="check<?php echo $list['id']; ?>" 
										name="industry[]" value="<?php echo $list['id']; ?>" 
										<?php echo (in_array($list['id'],$industrys)) ? 'checked' : ''; ?>>
	                                	<label for="check<?php echo $list['id']; ?>"><?php echo $list['name']; ?></label>
	                                </div>
	                            </li>
							<?php } } ?>
								
	                        </ul>
	                	</div>
	                </div> -->
	               	<div class="search_factor">
	                	<div class="search_factor_inner select_box">
	                    	<h4 class="text-uppercase">Licence And Endorsement</h4><?php 
							   //print_r($skills); die;?>
								<select id="industryskills"  name="industryskills[]" multiple="multiple" data-live-search="true">
                               <?php 
							   //print_r($skills); die;
							 $industrysk = '';
                             $ffsk =  $this->session->userdata('industryskills'); 
							
                                              if(!empty($ffsk)){											 
                                                $industrysk = explode(',',$ffsk);
											  }
							
							if(isset($skills)){
                                  foreach($skills as $lists){
								?>
		                          <option value="<?php echo $lists['id']; ?>" 
										<?php echo (in_array($lists['id'],$industrysk)) ? 'selected' : ''; ?>><?php echo $lists['skills']; ?></option>
          
							<?php }} ?>
	                         </select>
	                	</div>
	                </div>
					<div class="search_factor">
						<div class="search_btn">
		                  <input  type="submit" class="blue_button" name="submit" value="Search">
		                </div>
					</div>
					<div class="search_factor">
						<div class="search_btn">                 
						 	<input  type="submit" class="blue_button" name="submitclear" value="Clear search data">	 
		                </div>
					</div>
					<div class="search_factor">
						<div class="search_btn">
	                        <a href="<?php echo base_url(); ?>Welcome" class="blue_button" value="Search">Return to main search</a>
	                    </div>
	                </div>
					<hr>
					</form>
                </div>
            </div>
            <div class="col-lg-9 col-md-8">
            	<div class="filtered_wrapper">
                	<div class="view-controller-wrapper row">
                    	<div class="col-lg-4"><h2><strong><?php echo count($countt); ?> </strong>Staff Matches</h2></div>
						<div class="col-lg-8">
							<div class="sorting-panel">
							   <form method="post" action="<?php echo base_url(); ?>Welcome/find_staff">
                  <label>Sort by</label>
                  <div class="sort_dv">
                    <select name="orderby" class="orderby">
						<option value="">Select Order</option>if(isset($_REQUEST['keyword'])) { echo $_REQUEST['keyword']; }?>
						<option value="asc" <?php if(isset($_POST['orderby'])) { if($_POST['orderby']=='asc') { echo 'selected';}} ?>>Previous Order</option>
						<option value="desc" <?php if(isset($_POST['orderby'])) { if($_POST['orderby']=='desc') { echo 'selected';}} ?>>Latest listing</option>									
					</select>
                  </div>
                  <div class="sort_dv"class="recordp">
                    <select class="show-record"  name="recordp" >
                      <option value="" selected="selected">Records per page</option>
                      <option value="10" <?php if(isset($_POST['recordp'])) { if($_POST['recordp']==10) { echo 'selected';}} ?>>Show 10</option>
                      <option value="20" <?php if(isset($_POST['recordp'])) { if($_POST['recordp']==20) { echo 'selected';}} ?>>Show 20</option>
					  <option value="30" <?php if(isset($_POST['recordp'])) { if($_POST['recordp']==30) { echo 'selected';}} ?>>Show 30</option>
                    </select>
                  </div>
				  <input class="btn btn-primary staff-bg" name="submit"  value="Search" type="submit">  
                </form>
							</div>
						</div>
						<!-- search list outer end -->
						<div class="search_list_outer">
							<div class="col-lg-12 col-sm-12" id="staffList">
							 <?php 
							 //echo  '<pre>';
							//print_r($stafflist); 
							 if(isset($stafflist)){
                                   foreach($stafflist as $list) {
								 $userphoto = $list->image;
								//echo $list->licence; die;
								//print_r($list->licence); die;
								 ?>
								<!-- search list Start -->
								<div class="search_list">
									<div class="row">
										<div class="col-lg-2">
										<?php if($userphoto==''){?>
											<a href="<?php echo base_url(); ?>staff-detail/<?php echo $list->id; ?>" class="thumb"><img src="<?php echo base_url(); ?>public/front_end/images/dashboard/userst.jpg" alt="Staff"></a>
										<?php } else {  ?>
											<a href="<?php echo base_url(); ?>staff-detail/<?php echo $list->id; ?>" class="thumb"><img src="<?php echo base_url(); ?>public/upload/userProfile/<?php echo $userphoto; ?>" alt="Staff" height="100px"></a>
										<?php } ?>
										</div>
										<div class="col-lg-10">
											<div class="row">
												<div class="col-lg-9">
													<h3><a href="<?php echo base_url(); ?>staff-detail/<?php echo $list->id; ?>"><?php echo $list->first_name; ?> <?php echo $list->last_name; ?> </a></h3>
													<ul class="find_staff_list">
													<li><label>Current location :</label><span class="search_dtl"><?php if($list->current_location=='') {echo 'NA' ;} else { echo $list->current_location; } ?></span></li>
														<li><label>Avaliable to work from :</label><span class="search_dtl"><?php if($list->available_date=='') { echo 'NA';} else { echo  date("d M Y", strtotime($list->available_date)); } ?></span></li>
														<li><label>Eligible to work in NZ :</label><span class="search_dtl"><?php if($list->eligibility_address=='') { echo 'NA';} else { echo $list->eligibility_address; } ?></span></li>
													
													    <li><label>Level of English :</label><span class="search_dtl"><?php if($list->level_english=='') { echo 'NA';} else { if($list->level_english=='below' or $list->level_english=='above') {  echo $list->level_english; echo ' average'; } else { echo $list->level_english; }} ?></span></li>
														
														<?php $skills = $list->sklills_description; 
														$avalue=(unserialize($skills));
														?>
														<li><label>Key skills :</label><span class="search_dtl"><?php if($list->sklills_description=='') { echo 'NA';} else { echo $skills; } ?></span></li>
													   <?php														
                                                         $inid = $list->licence; 							
							                            ?>								
	                                                    <li><label>LICENCE AND ENDORSEMENT :</label><span class="search_dtl"><?php print_r(get_lincens($inid)); ?></span></li>
                                                        
														<?php														
                                                         $arr = unserialize(urldecode($list->em_industry));
														 $inidexp = implode(",",$arr);												
							                            ?>	
														<li><label>INDUSTRY EXPERIENCE :</label><span class="search_dtl"><?php print_r(get_industry($inidexp)); ?></span></li>
														

														<li><label>level of fitness :</label><span class="search_dtl"><?php if($list->level_fitness=='') { echo 'NA';} else { if($list->level_fitness=='below' or $list->level_fitness=='above') {  echo $list->level_fitness; echo ' average'; } else { echo $list->level_fitness; }} ?></span>													
													</li>
													</ul>
												</div>
												<div class="col-lg-3 pad_l_0">
													<div class="list-action">
												     <?php if($this->session->userdata('user_id')==''){ ?>
													  <a href="#" data-toggle="modal" data-target="#login_popup">Find Out More</a>
													  <?php  } else {   ?>
														<a href="<?php echo base_url(); ?>staff-detail/<?php echo $list->id; ?>">Find Out More</a>
													   <?php  } ?>
														<!-- <div class="wish-list"> 
															<button type="button" class="heart-btn shortlist">
																<i class="fa fa-heart"></i>
															</button>
														</div> -->
													</div>
													<!-- <div class="rating-list"> 
														<div class="star-rating">
															<span class="fa fa-star-o" data-rating="1"></span>
															<span class="fa fa-star-o" data-rating="2"></span>
															<span class="fa fa-star-o" data-rating="3"></span>
															<span class="fa fa-star-o" data-rating="4"></span>
															<span class="fa fa-star-o" data-rating="5"></span>
															<input type="hidden" name="whatever1" class="rating-value" value="2.56">
														</div>
													</div> -->
													<!-- <div class="search-meta-data">
														Last Online : <?php if($list->onlineuserdate=='0000-00-00 00:00:00'){ echo 'NA'; } else {echo getago($list->onlineuserdate); } ?>
													</div> -->
												</div>
											</div>
										</div>
									</div>
								</div>
							   <?php }}  							  
							   ?>
							     <div class="search_pagination">
									<nav aria-label="Page navigation example">
									  <ul class="pagination">
										<li class="page-item">
		<?= $pagination; ?>
		   </nav>
		 </ul>
		</li>
	</div>           
								<!-- search list end -->						
							 </div>
							
						</div>
						<!-- search list outer end -->
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<?php 
//echo count($maplocation); die;
 $locations=array();
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
  $(document).ready(function() {
            $('#industryskills').multiselect({
            includeSelectAllOption: true,
             buttonWidth: 250,
            enableFiltering: true
			
        });
        });

 $(document).ready(function() {
            $('#industry').multiselect({
            includeSelectAllOption: true,
             buttonWidth: 250,
            enableFiltering: true
			
        });
        });
		
function initialize() {
        var input = document.getElementById('loactionstaff');
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
            disableDefaultUI: true
        };
        map = new google.maps.Map(document.getElementById("map"), myOptions);

        });
}
    google.maps.event.addDomListener(window, 'load', initialize);

</script>
<script type="text/javascript">
  var map;
            var InforObj = [];
            var centerCords = {
              lat:  -41.838875,
              lng: 171.77989983333356
            };
			var countw = '<?php echo count($countt); ?>';
			//alert(countw);
            var markersOnMap = [
			<?php foreach($countt as $location ){ ?>
			   {
                 placeName: "<?php
					        $ll =$location->cityLatc;
							$this->db->select("staff_basicinfo.available_date,staff_basicinfo.cityLatc,staff_basicinfo.staff_id,users.username");
                            $this->db->from('staff_basicinfo');
                            $this->db->join('users', 'staff_basicinfo.staff_id = users.id');
							$this->db->where('staff_basicinfo.cityLatc', $ll);
                            $query = $this->db->get();							
                            //$query = $this->db->query("SELECT * FROM `staff_basicinfo` WHERE cityLatc=". $ll .""); 
							$result1 = $query->result();
					foreach($result1 as $locationss ){?><h4>Detail staff - <a href='<?php echo base_url(); ?>staff-detail/<?php echo $locationss->staff_id; ?>' target='_blank'><?php echo $locationss->username; ?> </a></h4><?php echo '<br> '; ?><h6>Avaliable from - <?php echo  date("d M Y", strtotime($locationss->available_date)); ?> </h6> <?php  echo '<br> '; } ?>",
				     //title: "Avaliable from - <?php echo $locationss->available_date; ?>",
					 title:"",
					
                    LatLng: [{
                        lat: <?php echo $location->cityLatc; ?>,
                        lng: <?php echo $location->cityLngc; ?>
                    }]
                },
			<?php } ?>
              
            ];

            window.onload = function () {
                initMap();
            };

            function addMarkerInfo() {
            	var marker, i;
                var iconBase = '<?php echo base_url(); ?>public/front_end/images/map_icon_blue.png';
				
                for (var i = 0; i < markersOnMap.length; i++) {
                     var contentString = '<div class="rowc"><div id="content">' + markersOnMap[i].placeName + '<h6>' + markersOnMap[i].title +
                        '</h6></div></div>';

                    const marker = new google.maps.Marker({
                        position: markersOnMap[i].LatLng[0],
                        map: map,
                        icon : iconBase
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
                map = new google.maps.Map(document.getElementById('Mapp'), {
                    zoom: 5.25,
                    center: centerCords
                });
                addMarkerInfo();
            }	
</script>