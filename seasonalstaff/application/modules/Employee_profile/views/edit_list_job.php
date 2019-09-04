<div class="breadcrumb text-center">
    <div class="container">
    <h1>Edit a job</h1>
    <ul><li><a href="#">home</a></li><li>Edit a job</li></ul>
    </div>
</div>
<!-- Dashboard section Start -->
<div class="dashboard_section">
    <div class="container">
        <div class="row">
           <!-- Sidebar Start -->

            <?php 
    
            include 'side_bar.php';

            ?>
          
            <!-- Sidebar End -->        
            <div class="col-xl-9 col-lg-8 col-md-12 col-sm-12">
                <div class="dashboard_content_part">
                    <div class="dashboard_content post_work_page">
                        <div class="dashboard_heading">
                            <h4>Edit a job</h4>
                        </div>
                        <!-- Dashboard Form Start -->
                        <div class="dashboard_form">
                            <form id="listJob" method="post" action="<?php echo site_url('edit-list-a-job/'.$jobsdata->id); ?>" onsubmit="return checkCheckBoxes(this);">
                             <input type="hidden" id="sid" name="sid" value="<?php echo $jobsdata->id; ?>">
								
                                 <div class="row form_group">
                                    <div class="col-lg-4 col-md-12 col-sm-12">
                                       <label>How do you want to receive application 
                                        <span class="rstar">*</span>
                                       </label>
                                    </div>
                                    <div class="col-lg-8 col-md-12 col-sm-12">									 
						                 <div class="radio_box receive_radios">
                                            <label>
                                                  <input type="radio" name="job_type_cv" id="job_type_cv" value="cv_cover"  <?php echo ($jobsdata->job_type == 'cv_cover') ? 'checked' : ''; ?>>
                                                  <span class="r_check"></span> 
										    <span class="r_text">Receive full CV & Cover letter</span>
                                            </label>
                                            <label>
                                                  <input type="radio" name="job_type_cv" id="job_type_cv" value="interest" <?php echo ($jobsdata->job_type == 'interest') ? 'checked' : ''; ?>>
                                                  <span class="r_check"></span> 
                                                  <span class="r_text">Receive expressions of interest</span>
                                            </label>
				                        </div>	
                                        <span id="checkdata" style="display:none;color:red;"> Select Any One Receive Type</span>   
                                    </div>
                                 </div> 

   								<br>
								<div class="row form_group">
                                    <div class="col-lg-4 col-md-12 col-sm-12">
                                        <label>Contract type<span class="rstar">*</span></label>
                                    </div>
                                     <div class="col-lg-8 col-md-12 col-sm-12">
                                        <div class="input_group select_box">
                                          <select name="contract_type" id="contract_type" class="selectpicker" data-live-search="true">
                                              <option value="" class="option_title">Select Contract type</option>
                                               <option value="fixed-term" <?php echo ($jobsdata->contract_type == 'fixed-term') ? 'selected' : ''; ?>>Fixed term</option>
											   <option value="casual" <?php echo ($jobsdata->contract_type == 'casual') ? 'selected' : ''; ?>>Casual</option>
											   <option value="minimum-hours" <?php echo ($jobsdata->contract_type == 'minimum-hours') ? 'selected' : ''; ?>>Minimum hours</option>
											   <option value="other" <?php echo ($jobsdata->contract_type == 'other') ? 'selected' : ''; ?>>Other</option>
                                          </select>
                                        </div>
                                    </div>
                                </div>


                                <div class="row form_group">
                                    <div class="col-lg-4 col-md-12 col-sm-12">
                                        <label>Job Title <span class="rstar">*</span></label>
                                    </div>
                                     <div class="col-lg-8 col-md-12 col-sm-12">
                                        <div class="input_group">
                                            <input type="text" name="job_title" id="job_title" placeholder="Your Work Title Here" value="<?php echo !empty($jobsdata->job_title) ? $jobsdata->job_title : ''; ?>" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
								
								<div class="row form_group">
                                    <div class="col-lg-4 col-md-12 col-sm-12">
                                        <label>Number Of Staff Required<span class="rstar">*</span></label>
                                    </div>
                                     <div class="col-lg-8 col-md-12 col-sm-12">
                                        <div class="input_group">
                                            <input type="text" name="no_staff" id="no_staff" placeholder="How many do you need?" value="<?php echo !empty($jobsdata->no_staff) ? $jobsdata->no_staff : ''; ?>">
                                        </div>
                                    </div>
                                </div>
								
                                <div class="row form_group">
                                    <div class="col-lg-4 col-md-12 col-sm-12">
                                        <label>Job Industry<span class="rstar">*</span></label>
                                    </div>
                                     <div class="col-lg-8 col-md-12 col-sm-12">
                                        <div class="input_group select_box">
                                          <select name="industry_id" id="industry_id" class="selectpicker" data-live-search="true">
                                              <option value="">Industry</option>
                                              <?php
                                              if(!empty($industries)){
                                                foreach($industries as $value){
                                                  ?>
                                                   <option <?php echo ($jobsdata->industry_id == $value['id']) ? 'selected' : ''; ?> value="<?php echo !empty($value['id']) ? $value['id'] : ''; ?>"><?php echo !empty($value['name']) ? $value['name'] : ''; ?></option>
                                                  <?php
                                                }
                                              }

                                              ?>
                                          </select>
                                        </div>
                                       <!--  <div class="input_group">
                                          <input type="text" name="mapaddress" id="mapaddress" placeholder="Main business location" value="<?php if(isset($users[0]['business_location'])) { echo $users[0]['business_location'];}?>" readonly>

                                               <input type="hidden" name="city2" id="city2" class="form-control" placeholder="Enter latitude"  value="<?php if(isset($users[0]['city2'])) { echo $users[0]['city2'];}?>">

											   
											   <input type="hidden" name="cityLat" id="cityLat" class="form-control" placeholder="Enter latitude"  value="<?php if(isset($users[0]['cityLat'])) { echo $users[0]['cityLat']; }?>">

                                               <input type="hidden" name="cityLng" id="cityLng" class="form-control" placeholder="Enter longitude"  value="<?php if(isset($users[0]['cityLng'])) { echo $users[0]['cityLng'];  }?>">

                                        </div> -->
										
										 <div class="input_group select_box">

                                         <select name="mapaddress" id="mapaddress" class="selectpicker">
										
										 <option value="">Select location of job</option>
                                                  <?php  foreach($companyaddress as $addlist){?>
												   <option <?php echo ($jobsdata->map_address == $addlist->business_location) ? 'selected' : ''; ?> value="<?php echo $addlist->id; ?>"><?php echo $addlist->business_location; ?> <?php if($addlist->statusm==1){ echo '(Primary Location)';} ?></option>
												  <?php } ?>
                                               </select>
                                        </div>
										
										
										
                                        <div class="input_group">
                                            <div class="width_50 pull-left pad_r_5">
                                               <input type="text" class="from_date" name="start_date" id="start_date" placeholder="Potential start date"
                                                value="<?php echo !empty($jobsdata->from_date) ? date('d-m-Y',strtotime($jobsdata->from_date)) : ''; ?>" autocomplete="off">
                                            </div>
                                            <div class="width_50 pull-left pad_l_5">
                                               <input type="text"class="to_date" name="end_date" id="end_date" placeholder="Potential end date"
                                               value="<?php echo !empty($jobsdata->to_date) ? date('d-m-Y',strtotime($jobsdata->to_date)) : ''; ?>" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="input_group">
                                            <div class="width_50 pull-left pad_r_5">
                                               <select name="approx_hr" id="approx_hr">
                                                   <option>Approx Hours per week</option>
                                                   <option <?php echo ($jobsdata->approx_hr == '0-20 hours per week') ? 'selected' : ''; ?>  value="0-20 hours per week">0-20 hours per week</option>
                                                   <option <?php echo ($jobsdata->approx_hr == '20-40 hours per week') ? 'selected' : ''; ?> value="20-40 hours per week">20-40 hours per week</option>
                                                   <option <?php echo ($jobsdata->approx_hr == '40+ hours per week') ? 'selected' : ''; ?> value="40+ hours per week">40+ hours per week</option>
												   
												   <option <?php echo ($jobsdata->approx_hr == 'below 40+') ? 'selected' : ''; ?> value="below 40+">Below 40+ hours per week</option>
												   <option <?php echo ($jobsdata->approx_hr == 'other') ? 'selected' : ''; ?> value="other">Other</option>
                                               </select>
                                            </div>
                                            <div class="width_50 pull-left pad_r_5">
                                               <div class="input_group">
                                                  <input type="text" name="hourly_rate" id="hourly_rate" placeholder="Enter Hourly rate + HP" value="<?php echo !empty($jobsdata->hourly_rate) ? $jobsdata->hourly_rate : ''; ?>"  autocomplete="off">
                                              </div>
                                                    
                                            </div>
                                        </div>
                                        <div class="width_100 input_group">
                                           <select name="work_intensity" id="work_intensity">
                                               <option value="">Intensity of work</option>
                                               <option <?php echo ($jobsdata->work_intensity == 'below average') ? 'selected' : ''; ?> value="below average">below average</option>
                                               <option  <?php echo ($jobsdata->work_intensity == 'average') ? 'selected' : ''; ?> value="average">average</option>
                                               <option <?php echo ($jobsdata->work_intensity == 'above average') ? 'selected' : ''; ?> value="above average">above average</option>
                                           </select>
                                        </div>
                                        <div class="form_text">
                                         Additional benefits do you offer Staff
                                        </div>
                                        <div class="input_group">
                                            <!-- checkbox Start -->
                                            <div class="check_box">

                                              <?php

                                              $benifit_explode = '';

                                              if(!empty($jobsdata->benifit_id)){
                                                $benifit_explode = explode(',',$jobsdata->benifit_id);
                                              }

                                              if(!empty($benefit)){
                                                foreach($benefit as $value){
                                              ?>
                                                <label>
                                                    <input   type="checkbox" name="other_benefits[]" id="other_benefits" value="<?php echo !empty($value['id']) ? $value['id'] : ''; ?>"

                                                    <?php echo (in_array($value['id'],$benifit_explode)) ? 'checked' : ''; ?>
                                                    >
                                                    <span class="checked_box"></span>
                                                    <span class="check_text"><?php echo !empty($value['name']) ? $value['name'] : ''; ?></span>
                                                </label>
                                                <?php
                                                 }

                                              }
                                                ?>
                                               
                                            </div>
                                            <!-- checkbox End -->
                                        </div>
                                    </div>
                                </div>
                                <div class="row form_group">
                                    <div class="col-lg-4 col-md-12 col-sm-12">
                                        <label>Description of Job <span class="rstar">*</span></label>
                                    </div>
                                     <div class="col-lg-8 col-md-12 col-sm-12">
                                        <div class="input_group">
                                      <textarea name="job_desc" id="job_desc" placeholder="Enter Description of Job Here" class="bg_blue_light"><?php echo !empty($jobsdata->job_description) ? $jobsdata->job_description : ''; ?>
                                            </textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row form_group">
                                    <div class="col-lg-4 col-md-12 col-sm-12">
                                        <label>Skills & Attributes required <span class="rstar">*</span></label>
                                    </div>
                                     <div class="col-lg-8 col-md-12 col-sm-12">
                                        <div class="input_group">
                                           <div class="check_box">

                                              <?php
											   $skill_explode = '';

                                              if(!empty($jobsdata->skill)){
                                                $skill_explode = explode(',',$jobsdata->skill);
                                              }																		
												
											  //echo $skill_explode; die; 
											 if($jobsdata->skill==0){
												$skill_explode1 =  0; 								  
											    
											  ?>
											   <label>
                                                    <input type="checkbox" name="skill[]" id="skill" value="0"
													  <?php  if($skill_explode1==0){ echo 'checked'; } ?>>
                                                    <span class="checked_box"></span>
                                                    <span class="check_text">No experience needed.</span>
                                                </label>
											 <?php } else { ?>
											  <label>
                                                    <input type="checkbox" name="skill[]" id="skill" value="0"
													  <?php echo (in_array(0,$skill_explode)) ? 'checked' : ''; ?>>
                                                    <span class="checked_box"></span>
                                                    <span class="check_text">No experience needed.</span>
                                                </label>
											 <?php } ?>
											  <?php 
                                              if(!empty($skills)){
                                              foreach($skills as $value){
                                              ?>
                                                <label>
                                                    <input type="checkbox" name="skill[]" id="skill" value="<?php echo !empty($value['id']) ? $value['id'] : ''; ?>"

                                                    <?php echo (in_array($value['id'],$skill_explode)) ? 'checked' : ''; ?>>
                                                    <span class="checked_box"></span>
                                                    <span class="check_text"><?php echo !empty($value['skills']) ? $value['skills'] : ''; ?></span>
                                                </label>
                                                <?php
                                                 }

                                              }
                                                ?>
                                               
                                            </div>
                                        </div>
                                    </div>
                                </div>
                               
                                 <div class="row form_group">
                                    <div class="col-lg-4 col-md-12 col-sm-12">
                                       <!--  <label>Select Package</label> -->
                                    </div>
                                     <div class="col-lg-8 col-md-12 col-sm-12">
                                        <!--  <div class="input_group">
                                            <div class="radio_box">
                                                <?php

                                              if(!empty($package)){
                                                foreach($package as $value){
                                              ?>
                                                <label>
                                                    <input type="radio" name="Package" id="Package" value="<?php echo !empty($value['id']) ? $value['id'] : ''; ?>"
                                                    <?php echo ($jobsdata->package_id == $value['id']) ? 'checked' : ''; ?>

                                                    >
                                                    <span class="r_check"></span>
                                                    <span class="r_text"><?php echo !empty($value['name']) ? $value['name'] : ''; ?>
                                                      
                                                      <i class="fa fa-dollar">
                                                        <?php echo !empty($value['price']) ? $value['price'] : '0'; ?>
                                                      </i>
                                                      

                                                    </span>
                                                </label>
                                                  <?php
                                                }
                                              }
                                              ?>
                                                
                                            </div>
                                        </div> -->
                                        <div class="input_group terms_cond_text">
                                            <div class="radio_box">
                                                <label>
                                                    <input type="radio" name="terms_Conditions" id="terms_Conditions" value="Terms Conditions"
                                                    <?php echo ($jobsdata->accept_condidtion == 1) ? 'checked' : ''; ?>
                                                    >
                                                    <span class="r_check"></span>
                                                    <span class="r_text">You Accept Our <a href="<?php echo base_url(); ?>Welcome/termconditions" target="_balnk">Terms & Conditions</a> and <a href="<?php echo base_url(); ?>Welcome/privacypolicy" target="_balnk">Privacy policy</a> </span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                 <div class="row form_group profile_btns">
                                   <div class="col-lg-4 col-md-12 col-sm-12">
                                        <label></label>
                                    </div>
                                    <div class="col-lg-8 col-md-12 col-sm-12">
									
									 <a href="javascript:void(0);" class="blue_button search_staff_btn" onclick="previewdata();">Preview Job</a>	
                                       
                                       <input type="submit" name="save_btn" class="blue_button buttons" value="Publish your Job">
                                       <input type="submit" name="save_btn" class="blue_button buttons" value="save as draft">
                                       
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- Dashboard Form End -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
 function checkCheckBoxes(theForm) {
var check1 = theForm.job_type_cv.checked;
var check2 = theForm.job_type_interest.checked;

 if (check1== false && check2== false) 
    {
       $("#checkdata").show();       
        return false;
    } else {    
        return true;
    }
} 

function previewdata()
{
  	var sid = $("#sid").val();
	var job_type_cv = $("#job_type_cv").val();
	var contract_type = $("#contract_type").val();
	var job_title = $("#job_title").val();
	var no_staff = $("#no_staff").val();
	var industry_id = $("#industry_id").val();
	var mapaddress = $("#mapaddress").val();
	var city2 = $("#city2").val();
	var cityLat = $("#cityLat").val();
	var cityLng = $("#cityLng").val();
	var start_date = $("#start_date").val();
	
	var end_date = $("#end_date").val();
	//alert(considered_location);
	var approx_hr = $("#approx_hr").val();
	var hourly_rate = $("#hourly_rate").val();
	var work_intensity = $("#work_intensity").val();
	//var other_benefits = $("#other_benefits").val();
	var other_benefits = [];
        $(':checkbox:checked').each(function(i){
          other_benefits[i] = $(this).val();
		 });	
	var job_desc = $("#job_desc").val();
	//var skill = $("#skill").val();
	var skill = [];
        $(':checkbox:checked').each(function(i){
          skill[i] = $(this).val();
		 });
	
	$.ajax({		
			url:'<?php echo base_url(); ?>Employee_profile/Profile/previejobb',			
			type: 'POST',
			data:{'sid':sid,'job_type_cv':job_type_cv,'contract_type':contract_type,'job_title':job_title,'no_staff':no_staff,'industry_id':industry_id,'mapaddress':mapaddress,'city2':city2,'cityLat':cityLat,'cityLng':cityLng,'start_date':start_date,'end_date':end_date,'approx_hr':approx_hr,'hourly_rate':hourly_rate,'work_intensity':work_intensity,'other_benefits':other_benefits,'job_desc':job_desc,'skill':skill},
			success: function(response){ 
			//console.log(response);
		    //alert(response);
			window.open('<?php echo base_url(); ?>Employee_profile/Profile/work_detailp/'+response, "_blank");
			}
		});	
}   
   
  
var jvalidate = $("#listJob").validate({
	
                ignore: [],
                rules: {                                                                 
                        'job_type_cv': {
						  required: true						  
						},
                        'contract_type': {
						  required: true						  
						},							
						'job_title': {
                                required: true,
                                minlength: 3,
                                maxlength: 200
							},							
						'no_staff': {
						   required: true,
                           minlength: 1,
                           maxlength: 5,
                           numbers:true							   
						},	
						'industry_id': {
                                required: true                            
							},
								
							
						'mapaddress': {
                                required: true                                
							},

						'start_date': {
                                required: true                               
							},		
						
						'end_date': {
                                required: true                                                            
                        },
						 'approx_hr': {
                                required: true                                                           
                        },
						'hourly_rate': {
                                required: true                            
							},
						'work_intensity': {
                                required: true                               
							},	
						'other_benefits': {
                                required: true                             
							},
                        'job_desc': {
                                required: true,
                                minlength: 3,
                                maxlength: 5000
							},
                       'skill': {
                                required: true                             
							},
                     
                      'terms_Conditions': {
						   required: true  
					  }							
                    },
           messages: {
                      					
                     }					
                }); 

$('input[type=radio]').click(function(){
    if (this.previous) {
        this.checked = false;
    }
    this.previous = this.checked;
});						
</script>
<script type="text/javascript">
/* function initialize() {
        var input = document.getElementById('mapaddress');
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
    google.maps.event.addDomListener(window, 'load', initialize);*/
</script>

<script type="text/javascript">
  /* (function($) {

$(document).ready(function() {
    $('.js-example-basic-multiple').select2();
});

})(jQuery); */
 </script>