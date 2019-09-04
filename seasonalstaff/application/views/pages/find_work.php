<div class="breadcrumb text-center work_breadcrumb">
  <div class="container">
    <h1>Find Work</h1>
    <ul><li><a href="#">home</a></li><li>Find Work</li></ul>
    </div>
</div>
<!-- breadcrumb End -->
<section id="page_map_panel">
<div class="map_dv" id="Maps" style="width:100%; height: 529px;">
	<!-- <img src="<?php echo base_url(); ?>public/images/find-staff-map.jpg"> -->
	</div>
</section>
<section class="search-section staff-page">
  <div class="container">
      <div class="row">
            <div class="col-lg-3 col-md-4">
                <div class="find_staff_form">
				<form method="post" action="<?php echo base_url(); ?>Welcome/find_work">
				
                 <div class="search_btn">                 
				 <input  type="submit" class="blue_button" name="submitclear" value="Clear search data">
				 				 
                 </div>	
				 
                 <br>

				<div class="search_btn">
                        <input  type="submit" class="blue_button" name="submit" value="Search">
                    </div>
					
                  <div class="search_factor">
                      <input type="search" id="keyword" name="keyword" placeholder="By Key word search" class="form-control" value="<?php  echo $this->session->userdata('keyword');  ?>" autocomplete="off">
                        <!-- <button><i class="fa fa-search"></i></button> -->
                    </div>
					
                    <div class="search_factor">
                      <input type="search" placeholder="Location" id="loaction" name="loaction" class="form-control country_autocomplete" value="<?php echo $this->session->userdata('loaction'); ?>">
                        <!-- <button><i class="fa fa-location-arrow"></i></button> -->
                    </div>
					
					<div class="search_factor">
                      <input type="text" class="form-control datepicker" name="from_date" id="from_date" placeholder="Start Date" autocomplete="off" value="<?php echo $this->session->userdata('from_date');  ?>">
                        <!-- <button><i class="fa fa-location-arrow"></i></button> -->
                    </div>
					
					<div class="search_factor">
                    <input type="text" class="form-control datepicker" name="to_date" id="to_date" placeholder="End Date" autocomplete="off" value="<?php echo $this->session->userdata('to_date');  ?>">
                        <!-- <button><i class="fa fa-location-arrow"></i></button> -->
                    </div>
					
                    <div class="search_factor">
                      <div class="search_factor_inner">
                          <h4 class="text-uppercase">Duration of work</h4>
                            <ul>
                             <li>
                                  <div class="checkbox checkbox-primary">
                                      <input type="radio" class="radio"  id="checklist1" value="30" name="workduration" <?php if($this->session->userdata('workduration')==30) { echo 'checked';}?>>
                                      <label for="checklist1">Under 30 days</label>
                                    </div>
                                 </li>
                                 <li>
                                    <div class="checkbox checkbox-primary">
                                      <input type="radio" class="radio"  id="checklist2" value="31-90" name="workduration" <?php if($this->session->userdata('workduration')=='31-90') { echo 'checked';} ?>>
                                      <label for="checklist2">31-90 days</label>
                                    </div>
                                 </li>
                                 <li>
                                    <div class="checkbox checkbox-primary">
                                      <input type="radio" class="radio"  id="checklist3" value="91-180" name="workduration" <?php  if($this->session->userdata('workduration')=='91-180') { echo 'checked';}?>>
                                      <label for="checklist3"> 91- 180 days </label>
                                    </div>
                                 </li>
                                 <li>
                                    <div class="checkbox checkbox-primary">
                                      <input type="radio" class="radio"  id="checklist4" value="181" name="workduration" <?php if($this->session->userdata('workduration')==181) { echo 'checked';} ?>>
                                      <label for="checklist4"> 181 days and greater</label>
                                    </div>
                                </li>
                            </ul>
                      </div>
                    </div>	
                    <div class="search_factor">
                      <div class="search_factor_inner">
                          <h4 class="text-uppercase">Other benefits</h4>
                          
						   <ul>
							<?php
							 $benifit_explode = '';
                             $ff =  implode(',',$_REQUEST['benefit']); 
							
                                              if(!empty($ff)){											 
                                                $benifit_explode = explode(',',$ff);
												//print_r($benifit_explode); die;
                                              } 
							if(isset($benefit)){
							foreach($benefit as  $c)	
							 {
							?>

                                <li>
                                  <div class="checkbox checkbox-primary">
                                      <input type="checkbox" class="checkbox" id="check<?php echo $c['id']; ?>" name="benefit[]" value="<?php echo $c['id']; ?>" <?php echo (in_array($c['id'],$benifit_explode)) ? 'checked' : ''; ?>>
                                      <label for="check<?php echo $c['id']; ?>"><?php echo  $c['name']; ?>
									 </label>
                                    </div>
                                </li>
							
                  <?php }} ?>
                            </ul>
							
                      </div>
                    </div>
                   
					<br>
					
					<div class="search_btn">
                        <a href="<?php echo base_url(); ?>Welcome" class="blue_button" value="Search">Return to main search</a>
                    </div>
					<br>
					<hr>
					</form>
                </div>
            </div>
            <div class="col-lg-9 col-md-8">
              <div class="filtered_wrapper find_work_wrapper">
                  <div class="view-controller-wrapper row">
                      <div class="col-lg-3"><h2><strong><?php echo count($countt); ?> </strong>Jobs Found</h2></div>
            <div class="col-lg-9">
              <div class="sorting-panel">
                <form method="post" action="<?php echo base_url(); ?>Welcome/find_work">
                  <label>Sort by</label>
                  <div class="sort_dv">
                    <select name="orderby" class="orderby">
						<option value="">Select Order</option><?php if(isset($_REQUEST['keyword'])) { echo $_REQUEST['keyword']; }?>
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
              <div class="col-lg-12 col-sm-12">
                <!-- search list Start -->
				<?php if(isset($jobslist)) {
					if($jobslist==''){ echo '<center><h2>No Data</h2></center>';}
					else { foreach($jobslist as $list) {?>
                <div class="search_list">
                  <div class="row">
                    <div class="col-lg-2 find_work_logo">
					<?php
                            $uid = $list->modify_by;
							$query = $this->db->query("SELECT `company_logo` FROM `company_detail` WHERE uid=".$uid.""); 
							$result1 = $query->result();
                            $logo = $result1[0]->company_logo; 							
							?> 
                      <a href="#" class="thumb">
					  <?php if($this->session->userdata('user_id')==''){ ?>
					   <?php if($logo==''){?>
                       <a href="#" data-toggle="modal" data-target="#login_popup"><img src="<?php echo base_url(); ?>public/front_end/images/work_thumb.jpg" alt="Staff"></a>
                      <?php } else {  ?>
					  <a href="#" data-toggle="modal" data-target="#login_popup"> <img src="<?php echo base_url(); ?>public/upload/company_logo/<?php echo $logo; ?>" alt="Staff"></a>
					  <?php }} else { ?>
					  <?php if($logo==''){?>
                      <a href="<?php echo base_url(); ?>Welcome/work_detail/<?php echo preg_replace('/[^a-zA-Z0-9]/s', '-', $list->job_title);?>/<?php echo $list->id; ?>"><img src="<?php echo base_url(); ?>public/front_end/images/work_thumb.jpg" alt="Staff"></a>
                      <?php } else {  ?>
					  <a href="<?php echo base_url(); ?>Welcome/work_detail/<?php echo preg_replace('/[^a-zA-Z0-9]/s', '-', $list->job_title);?>/<?php echo $list->id; ?>"><img src="<?php echo base_url(); ?>public/upload/company_logo/<?php echo $logo; ?>" alt="Staff"></a>
                      <?php } } ?>
					  </a>
                                            <!-- <div class="rating-list"> 
                                                <div class="star-rating">
                                                    <span class="fa fa-star" data-rating="1"></span>
                                                    <span class="fa fa-star" data-rating="2"></span>
                                                    <span class="fa fa-star-o" data-rating="3"></span>
                                                    <span class="fa fa-star-o" data-rating="4"></span>
                                                    <span class="fa fa-star-o" data-rating="5"></span>
                                                    <input type="hidden" name="whatever1" class="rating-value" value="2.56">
                                                </div>
                                            </div>
                                            <div class="review_text"><i class="fa fa-eye"></i>100 Reviews</div> -->
                    </div>
                    <div class="col-lg-10">
                      <div class="row">
                        <div class="col-lg-9">
                          <h3> <a href="<?php echo base_url(); ?>Welcome/work_detail/<?php echo preg_replace('/[^a-zA-Z0-9]/s', '-', $list->job_title);?>/<?php echo $list->id; ?>"><?php echo $list->job_title; ?></a></h3>
                          <ul class="find_work_list">
                            <li><label>Potential start date :</label><span class="search_dtl"><?php echo date("d M Y", strtotime($list->from_date) ); ?></span></li>
							  <li><label>Potential End date :</label><span class="search_dtl"><?php echo date("d M Y", strtotime($list->to_date) ); ?></span></li>
							<?php 
                            $form1 =date_create($list->from_date);
                            $to1 = date_create($list->to_date);                       
                            $diff=date_diff($form1,$to1);					
              				
                            ?>
                            <li><label>Approx Duration of job :</label><span class="search_dtl"><?php echo $diff->format("%a days"); ?></span></li>
                            <li><label>Location :</label><span class="search_dtl"><?php echo $list->map_address; ?></span></li>
                            <li><label>Hourly rate:</label><span class="search_dtl">$<?php echo $list->hourly_rate; ?></span></li>
                            <li><label>Approx Hours per week:</label><span class="search_dtl"><?php echo $list->approx_hr; ?></span></li>
							<?php
                            $inid = $list->industry_id;
							$query = $this->db->query("SELECT `name` FROM `industry` WHERE id=".$inid.""); 
							$result = $query->result();							               
							?>
                            <li><label>Intensity of work:</label><span class="search_dtl"><?php echo $list->work_intensity; ?></span></li>
							<?php
                            $bid = $list->benifit_id;
							$query = $this->db->query("SELECT `name` FROM `benefit` WHERE FIND_IN_SET(id,'".$bid."')");                         
							?>
                            <li><label>Additional benefits:</label><span class="search_dtl">  <?php  foreach($query->result() as $sk) { 
							 $edi[]= $sk->name; }
							 echo $ed = implode(", ",$edi); ?> </span></li>
                          </ul>
                        </div>
                        <div class="col-lg-3 pad_l_0">
                          <div class="list-action">
						    <?php if($this->session->userdata('user_id')==''){ ?>
							 <a href="#" class="green_link" data-toggle="modal" data-target="#login_popup">View More</a>
							<?php } else { ?>
                            <a href="<?php echo base_url(); ?>Welcome/work_detail/<?php echo preg_replace('/[^a-zA-Z0-9]/s', '-', $list->job_title);?>/<?php echo $list->id; ?>" class="green_link">View More</a>
							<?php } ?>
                            <?php
                            $uidd = $this->session->userdata("user_id");
							$jbid = $list->id;
							$query = $this->db->query("SELECT `like` FROM `job_like_staff` WHERE user_id=$uidd && job_id=$jbid");
                           	$result = $query->result();	
                            $like =  $result[0]->like; 						
							?>
							<?php							
							if($like==1){ ?>
                            <div class="wish-list"> 
                              <button type="button" class="heart-btn shortlist">
                                <i class="fa fa-heart-o"></i>
                              </button>
                            </div>
					       <?php } else {  ?>
						   <div class="wish-list nl"> 
                              <button type="button" class="heart-btn shortlist" onclick="like(<?php echo $list->id; ?> ,<?php echo $list->modify_by; ?>)">
                                <i class="fa fa-heart-o"></i>
                              </button>
                            </div>
							<?php }  ?>

                          </div>
                         <!--  <div class="search-meta-data">
                           <?php echo getago($list->created_date); ?>
                          </div> -->
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- search list end -->
				<?php }} } 				
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
              </div>
              <!-- <div class="col-lg-12 col-sm-12">
                <div class="search_pagination">
                  <nav aria-label="Page navigation example">
                    <ul class="pagination">
                    <li class="page-item">
                      <a class="page-link" href="#" aria-label="Previous">
                      <span aria-hidden="true">&laquo;</span>
                      <span class="sr-only">Previous</span>
                      </a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item active"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                      <a class="page-link" href="#" aria-label="Next">
                      <span aria-hidden="true">&raquo;</span>
                      <span class="sr-only">Next</span>
                      </a>
                    </li>
                    </ul>
                  </nav>
                </div>
              </div> -->
            </div>
            <!-- search list outer end -->
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<?php
//echo count($countt); die;
//$locations=array();
 foreach($countt as $mli){
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
		//print_r($countt);die;
 ?>
<script>
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
            var markersOnMap = [
			<?php foreach($countt as $locations ){ ?>
			{
                    placeName: "<a href='<?php echo base_url(); ?>Welcome/work_detail/<?php echo str_replace(' ', '-', $locations->job_title);?>/<?php echo $locations->id; ?>' target='_blank'><?php echo $locations->map_address; ?></a>",
					title: "<?php
					        $ll =$locations->latitude;
                          $query = $this->db->query("SELECT * FROM `jobs` WHERE latitude=". $ll ." && status=1"); 
							$result1 = $query->result();

					foreach($result1 as $locationss ){?><a href='<?php echo base_url(); ?>Welcome/work_detail/<?php echo preg_replace('/[^a-zA-Z0-9]/s', '-', $locationss->job_title);?>/<?php echo $locationss->id; ?>' target='_blank'><?php echo $locationss->no_staff; ?> , <?php echo $locationss->job_title; ?></a><?php echo '<br>'; } ?>",
					
                    LatLng: [{
                        lat: <?php echo $locations->latitude; ?>,
                        lng: <?php echo $locations->longitude; ?>
                    }]
                },
			<?php } ?>/*,
                {
                   placeName: "<?php echo $maplocation[1]->map_address; ?>",
				   title: "<a href='<?php echo base_url(); ?>Welcome/work_detail/<?php echo str_replace(' ', '-', $maplocation[1]->job_title);?>/<?php echo $maplocation[1]->id; ?>' target='_blank'><?php echo $maplocation[1]->job_title; ?></a>",
                    LatLng: [{
                        lat: <?php echo $maplocation[1]->latitude; ?>,
                        lng: <?php echo $maplocation[1]->longitude; ?>
                    }]
                },
                {
                    placeName: "<?php echo $maplocation[2]->map_address; ?>",
					title: "<a href='<?php echo base_url(); ?>Welcome/work_detail/<?php echo str_replace(' ', '-', $maplocation[2]->job_title);?>/<?php echo $maplocation[2]->id; ?>' target='_blank'><?php echo $maplocation[2]->job_title; ?></a>",
                    LatLng: [{
                        lat: <?php echo $maplocation[2]->latitude; ?>,
                        lng: <?php echo $maplocation[2]->longitude; ?>
                    }]
                },
                {
                    placeName: "<?php echo $maplocation[3]->map_address; ?>",
					title: "<a href='<?php echo base_url(); ?>Welcome/work_detail/<?php echo str_replace(' ', '-', $maplocation[3]->job_title);?>/<?php echo $maplocation[3]->id; ?>' target='_blank'><?php echo $maplocation[3]->job_title; ?></a>",
                    LatLng: [{
                        lat: <?php echo $maplocation[3]->latitude; ?>,
                        lng: <?php echo $maplocation[3]->longitude; ?>
                    }]
                },
                {
                    placeName: "<?php echo $maplocation[4]->map_address; ?>",
					title: "<a href='<?php echo base_url(); ?>Welcome/work_detail/<?php echo str_replace(' ', '-', $maplocation[4]->job_title);?>/<?php echo $maplocation[4]->id; ?>' target='_blank'><?php echo $maplocation[4]->job_title; ?></a>",
                    LatLng: [{
                        lat: <?php echo $maplocation[4]->latitude; ?>,
                        lng: <?php echo $maplocation[4]->longitude; ?>
                    }]
                }*/
            ];

            window.onload = function () {
                initMap();
            };

            function addMarkerInfo() {
				 var marker, i;
                 var iconBase = '<?php echo base_url(); ?>public/front_end/images/map_icon_green.png';				
				
                for (var i = 0; i < markersOnMap.length; i++) {
                      var contentString = '<div class="rowc"><div id="content"><h4> ' + markersOnMap[i].title +
                        '</h4><h6>Address - ' + markersOnMap[i].placeName + '</h6></div></div>';

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
                map = new google.maps.Map(document.getElementById('Maps'), {
                    zoom: 5.25,
                    center: centerCords
                });
                addMarkerInfo();
            }
	
function like(job_id , juserid)
{

$.ajax({		
	url:'<?php echo base_url(); ?>Welcome/joblike',			
	type: 'POST',
	data:{'job_id':job_id,'juserid':juserid},
	success: function(response){ 
    //alert(response);
	window.location = '<?php echo base_url(); ?>Welcome/find_work';	   
			}
		});	
}	
</script>