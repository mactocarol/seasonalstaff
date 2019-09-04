<div class="breadcrumb text-center">
    <div class="container">
    <h1>About your Business</h1>
    <ul><li><a href="#">home</a></li><li>About your Business</li></ul>
    </div>
</div>
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
                            <h4>About your Business</h4>
                        </div>
                        <!-- Dashboard Form Start -->
                        <div class="dashboard_form">
                        <form id="aboutcompany" method="post" action="<?php echo site_url('Employee_profile/Profile/create_company'); ?> " enctype="multipart/form-data">
 
                               <div class="row form_group">
                                    <div class="col-lg-4 col-md-12 col-sm-12">
                                        <label>Business Name</label>
                                    </div>
                                     <div class="col-lg-8 col-md-12 col-sm-12">
                                         <div class="input_group">
                                         <input type="text" name="company_name" id="company_name" placeholder="Business Name" value="<?php if(isset($companydetail[0]->company_name)) { echo $companydetail[0]->company_name; } ?>" autocomplete="off">
                                        </div>
									
                                </div>
								</div>
								
								<div class="row form_group">
                                   <div class="col-lg-4 col-md-12 col-sm-12">
                                        <label>Industry</label>
                                    </div>
                                    <div class="col-lg-8 col-md-12 col-sm-12">
                                        <div class="input_group select_box">
                                            <select name="industry" id="industry" class="selectpicker" data-live-search="true">
                                                 <option value="">Select Industry</option>
                                                <?php
                                                if(!empty($industries)){
                                                    foreach ($industries as  $value) {                                                       
                                                    if(!empty($result[0]['industry_id'])){

                                                ?>

                                                <option  <?php echo ($companydetail[0]->industry_id== $value['id']) ? 'selected' : ''; ?> value="<?php echo !empty($value['id']) ? $value['id'] : ''; ?>"><?php echo !empty($value['name']) ? $value['name'] : ''; ?></option>
                                                <?php
                                            }else{
                                            ?>
                                         <option value="<?php echo !empty($value['id']) ? $value['id'] : ''; ?>" >  <?php echo !empty($value['name']) ? $value['name'] : ''; ?></option>

                                                <?php
                                           
                                        }
                                                }
                                                }

                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
								
								<div class="row form_group">
                                    <div class="col-xl-4 col-md-12 col-sm-12">
                                       <label>GAP/GRASP approved employer 
                                        <span class="rstar">*</span>
                                       </label>
                                    </div>
                                    <div class="col-xl-8 col-md-12 col-sm-12">									 
		                                <div class="radio_box receive_radios">
                                        <label>
                                         <input type="radio" name="approve_gap" id="approve_gap"  onchange="getValuecheck(this.value);" value="yes" <?php echo ($companydetail[0]->approve_gap == 'yes') ? 'checked' : ''; ?>>
                                         <span class="r_check"></span> 
							                           <span class="r_text">Yes</span>
                                        </label>
                                        <label>
                                          <input type="radio" name="approve_gap" id="approve_gap1" onchange="getValuecheck(this.value);" value="No" <?php echo ($companydetail[0]->approve_gap == 'no') ? 'checked' : ''; ?>>
                                          <span class="r_check"></span> 
                                          <span class="r_text">No</span>
                                        </label>
                                        </div>	 
										 
										 
										 <!-- <div class="check_box">
                                         <label>
                                              <input type="checkbox" name="approve_gap" id="approve_gap" onchange="getValuecheck(this.value);" value="yes" >
                                              <span class="checked_box"></span>
                                              <span class="check_text">Are you GAP/GRASP (Yes)</span>
                                         </label>
										  <label>
                                              <input type="checkbox" name="approve_gap" id="approve_gap" onchange="getValuecheck(this.value);" value="No">
                                              <span class="checked_box"></span>
                                              <span class="check_text">Are you GAP/GRASP (No)</span>
                                         </label>
                                        </div> -->
									<?php 									
									if($companydetail[0]->approve_gap=="yes"){ ?>	
									<div id="add_numgap">
									<input type="text" name="number_gap" id="number_gap" value="<?php if(isset($companydetail[0]->number_gap)) { echo $companydetail[0]->number_gap; } ?>" placeholder="Ex-PMO140-C00416">
									</div>
									<?php } ?>
									<div id="add_numgap" style="display:none;">
									<input type="text" name="number_gap1" id="number_gap" placeholder="Ex-PMO140-C00416">
									</div>
                                    </div>
                                </div>                                 
                                <br> 
								
								
								
                                <div class="row form_group">
                                    <div class="col-lg-4 col-md-12 col-sm-12">
                                        <label>Main Business location </label>
                                    </div>
                                    <div class="col-lg-8 col-md-12 col-sm-12" id="locdiv">
                                        <div class="input_group">

                                            <input type="text" name="mapaddress" id="mapaddress" placeholder="Main business location" value="<?php if(isset($companydetail[0]->business_location)) { echo $companydetail[0]->business_location; } ?>" autocomplete="off">
											
                                            <input type="hidden" id="city2" name="city2" value="<?php if(isset($companydetail[0]->city2)) { echo $companydetail[0]->city2; } ?>"/>				
										
                                            <input type="hidden" id="cityLat" name="cityLat" value="<?php if(isset($companydetail[0]->cityLat)) { echo $companydetail[0]->cityLat; } ?>"/>
											
                                            <input type="hidden" id="cityLng" name="cityLng" value="<?php if(isset($companydetail[0]->cityLng)) { echo $companydetail[0]->cityLng; } ?>"/>                                       </div>
                                    </div>
									    
								         <div class="col-lg-4 col-md-12 col-sm-12">
                                         <label>Additional Business Locations <?php //echo $i; ?></label>
                                         </div>
                                         <div class="col-lg-8 col-md-12 col-sm-12">
										 <?php 
										 if(count($companyaddress)!=0){
										 $i=2;	 
									     foreach($companyaddress as $addlist){
										 if($companydetail[0]->cityLat==$addlist->cityLat){}else {
										 ?>	
										 <span>
										 <input type="text" name="loactionmore"  id="loactionmore" value="<?php echo $addlist->business_location ?>" placeholder="Main business location" readonly>
										 <a href="<?php echo base_url(); ?>Employee_profile/Profile/deleteextraadd/<?php echo $addlist->id; ?>" style="float: right;margin-top: -41px;"><span class="remove_field loc_remove"><i class="fa fa-times"></i></span></a>
										 </span>
										 <?php $i++; }} } else { } 
										 ?>
										 </div>
										
										 <div class="col-lg-4 col-md-12 col-sm-12">                                        
                                         </div>
										 <div class="col-lg-8 col-md-12 col-sm-12">
										 <div style="display: none;" id="addmoreaddress_div">
										 <input type="text" name="loactionmore12"  id="loactionmore12" placeholder="Additional job location">
		                                 <input type="hidden" name="city2more12"  id="city2more12">
		                                 <input type="hidden" name="cityLatmore12"  id="cityLatmore12">
		                                 <input type="hidden" name="cityLngmore12"  id="cityLngmore12">
                                         </div>
										 
									<div class="col-lg-8 col-md-12 col-sm-12"> 
                                     <div class="input_group append_loaction_Dv">

                                    </div>
                                  
									
									 <!-- <a href="javascript:void(0)" onclick="show_price_block()" class="blue_button buttons" id="moreadd">Add More Locations</a> -->
                                     <input type="submit" name="save_btn" class="blue_button buttons" value="save"> 
									 
									<div class="add_more_btn add_location">
                              				<span class="icon"><i class="fa fa-plus"></i></span> 
                              				Add more loc
                              			</div> 
									 
                                    </div>										
										<!-- <div class="form_group button_group">
                              			
										<a href="javascript:void(0)" onclick="show_price_block()" class="blue_button buttons" id="moreadd">Additional Business Locations</a>
                              		    <input type="submit" name="save_btn" class="blue_button buttons" value="save"> 
                         			</div> -->
									</div>
                                </div>
								
								
								
								 <div class="row form_group">
                                    <div class="col-lg-4 col-md-12 col-sm-12">
                                        <label>Business Url</label>
                                    </div>
                                     <div class="col-lg-8 col-md-12 col-sm-12">
                                         <div class="input_group">
                                          <input type="url" name="url_comapny" id="url_comapny" placeholder="Ex- http://business.com/"  value="<?php if(isset($companydetail[0]->company_url)) { echo $companydetail[0]->company_url; } ?>" autocomplete="off">
                                        </div>
									
                                </div>
								</div>
								
								
								<div class="row form_group">
                                    <div class="col-lg-4 col-md-12 col-sm-12">
                                        <label>Tell us about your business</label>
                                    </div>
                                     <div class="col-lg-8 col-md-12 col-sm-12">
                                         									
                                        <div class="input_group">
                                            <textarea name="company_description" id="company_description" placeholder="Business Description"><?php if(isset($companydetail[0]->c_description)) { echo $companydetail[0]->c_description; } ?></textarea>
                                        </div>
                                    </div>
                                </div>
								
								 <div class="row form_group">
                                    <div class="col-lg-4 col-md-12 col-sm-12">
                                        <label>Business logo</label>
                                    </div>
                                     <div class="col-lg-8 col-md-12 col-sm-12">
                                         <div class="input_group">
                                       <input type="file" name="photo" id="photo" onchange="ValidateExtension(1)"> 
											  <input type="hidden" name="photo1" id="photo1" value="<?php if(isset($companydetail[0]->company_logo)) { echo $companydetail[0]->company_logo; } ?>">
											  
										 <p id="message1" style="color:red;"></p> 
	                                     <span id="lblError1" style="color:red;"></span>	
                                        </div>
                                       <img src="<?php echo base_url(); ?>public/upload/company_logo/<?php if(isset($companydetail[0]->company_logo)) { echo $companydetail[0]->company_logo; } ?>" height="100px" style="float: right;">  
                                       <br>									   
                                    </div>
                                </div>
                                 
                                 <div class="row form_group profile_btns">
                                   <div class="col-lg-4 col-md-12 col-sm-12">
                                        <label></label>
                                    </div>
                                    <div class="col-lg-8 col-md-12 col-sm-12">
                                        <input type="submit" name="save_btn" class="blue_button buttons" value="save"> 
                                    
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
	$image = 'user.jpg';
										
	?>
	 <img src="<?php echo base_url(); ?>public/front_end/images/dashboard/<?php echo $image; ?>" alt="Profile Pic" class="nnmg">
	 <?php } ?>
                            </span>
                            <!--<span class="popup_img">
                                <img src="https://www.seasonalstaff.co.nz/public/front_end/images/dashboard/user.jpg" class="img-fluid">
                            </span>-->
                        </div>
                        <h4>Hello, <?php echo $result[0]['first_name']; ?> <?php echo  $result[0]['last_name']; ?></h4>
                        <p>What would you like to do now</p>                   
                    </div>
                    <div class="popup_bottom_buttons">
					   <a href="<?php echo base_url(); ?>list-a-job" class="green_button">List a Job</a>
                       <a href="<?php echo base_url(); ?>find-staff" class="green_button">Search for staff</a>
				
                   </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Notification popup End -->



<!-- popup start -->
<?php 
	if(empty($this->session->userdata('about_us'))){
	$this->session->set_userdata('about_us',true);
	?>
<div class="business_popup popup_wrapper" id="myDIV1">
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
						<p>Now Tell us about your Business</p>
					</div>
					<div class="awesome_bottom">
		            <a href="<?php echo base_url(); ?>about_company/" class="cake_btn" value="Start CakeHR">Continue</a>

					</div>
				</div>
			</div>
		</div>
	</div>
</div>	
	
	
<div class="business_popup popup_wrapper" id="myDIV">
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
						<p>Now tell us what you want to do.</p>
					</div>
					<div class="awesome_bottom">
						<a href="<?php echo base_url(); ?>list-a-job/" class="cake_btn" value="Start CakeHR">List a job</a>
						<a href="<?php echo base_url(); ?>Welcome/" class="cake_btn" value="Start CakeHR">Search for  staff</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
  }
?>
<!-- popup End -->

<script type="text/javascript"> 
$(document).ready(function(){
 var companyname = $('#company_name').val();
 //var urlcomapny = $('#url_comapny').val();
 var companydescription = $('#company_description').val();
 var photo = $('#photo1').val();

if(companyname=='' && companydescription=='' && photo==''){
 var element = document.getElementById("myDIV1");
   element.classList.add("popup_active");
}
else {
	 var element = document.getElementById("myDIV");
   element.classList.add("popup_active");
}
});

$(window).on('load', function(){
	var usuu ="<?php echo $this->uri->segment(2); ?>";
	if(usuu=="about"){
      setTimeout(function(){
        $(".new_notif_popup").addClass("popup_active");
      },1000);
	}
     });

function getValuecheck(value) {
 if(value=='yes'){
 $("#add_numgap").css("display",'block');
 }if(value=='No'){ 
 $("#add_numgap").css("display",'none');	 
 }
}



//append data in skills section
     var k = 0;
    var k2 = 0;
    $('.add_location').on('click', function(){

      k++;
      if (k2 < 3) {
        k2++;
        var append_data = ('<div class="apend" id="grp_row'+k+'">'+
		'<input type="text" name="loactionmore[]"  id="loactionmore'+k+'" placeholder="Main business location">'+
		'<input type="hidden" name="city2more[]"  id="city2more'+k+'">'+
		'<input type="hidden" name="cityLatmore[]"  id="cityLatmore'+k+'">'+
		'<input type="hidden" name="cityLngmore[]"  id="cityLngmore'+k+'">'+
		'<span class="remove_field loc_remove" id="'+k+'"><i class="fa fa-times"></i></span></div>');
        $('.append_loaction_Dv').append(append_data);
        //selectpicker
        
      }
      else{
        alert("You can add Courses only Five times");
      }
	  	  initeeff();
		  initeeff2();
		  initeeff3();
		  initeeff4();
    }); 
    //remove data in work profile
    $(document).on('click', '.loc_remove', function(){
      var button_id = $(this).attr("id");
      k2--;
      $('#grp_row'+button_id+'').remove();
    });		



function initee() {
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
    google.maps.event.addDomListener(window, 'load', initee);


function initeeff() {
     var input = document.getElementById('loactionmore1');
        var autocomplete = new google.maps.places.Autocomplete(input);
		var name = autocomplete;
        autocomplete.setComponentRestrictions(
            {'country': ['nz']});
        google.maps.event.addListener(autocomplete, 'place_changed', function () {
            var place = autocomplete.getPlace();
            document.getElementById('city2more1').value = place.name;
            document.getElementById('cityLatmore1').value = place.geometry.location.lat();
            document.getElementById('cityLngmore1').value = place.geometry.location.lng();
           //alert("This function is working!");
           //alert(place.name);
           //alert(place.address_components[0].long_name);
		   
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
    google.maps.event.addDomListener(window, 'load', initeeff);
	
function initeeff2() {
     var input = document.getElementById('loactionmore2');
        var autocomplete = new google.maps.places.Autocomplete(input);
		var name = autocomplete;
        autocomplete.setComponentRestrictions(
            {'country': ['nz']});
        google.maps.event.addListener(autocomplete, 'place_changed', function () {
            var place = autocomplete.getPlace();
            document.getElementById('city2more2').value = place.name;
            document.getElementById('cityLatmore2').value = place.geometry.location.lat();
            document.getElementById('cityLngmore2').value = place.geometry.location.lng();
           //alert("This function is working!");
           //alert(place.name);
           //alert(place.address_components[0].long_name);
		   
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
google.maps.event.addDomListener(window, 'load', initeeff2);

function initeeff3() {
     var input = document.getElementById('loactionmore3');
        var autocomplete = new google.maps.places.Autocomplete(input);
		var name = autocomplete;
        autocomplete.setComponentRestrictions(
            {'country': ['nz']});
        google.maps.event.addListener(autocomplete, 'place_changed', function () {
            var place = autocomplete.getPlace();
            document.getElementById('city2more3').value = place.name;
            document.getElementById('cityLatmore3').value = place.geometry.location.lat();
            document.getElementById('cityLngmore3').value = place.geometry.location.lng();
           //alert("This function is working!");
           //alert(place.name);
           //alert(place.address_components[0].long_name);
		   
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
google.maps.event.addDomListener(window, 'load', initeeff3);	

function initeeff4() {
     var input = document.getElementById('loactionmore4');
        var autocomplete = new google.maps.places.Autocomplete(input);
		var name = autocomplete;
        autocomplete.setComponentRestrictions(
            {'country': ['nz']});
        google.maps.event.addListener(autocomplete, 'place_changed', function () {
            var place = autocomplete.getPlace();
            document.getElementById('city2more4').value = place.name;
            document.getElementById('cityLatmore4').value = place.geometry.location.lat();
            document.getElementById('cityLngmore4').value = place.geometry.location.lng();
           //alert("This function is working!");
           //alert(place.name);
           //alert(place.address_components[0].long_name);
		   
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
google.maps.event.addDomListener(window, 'load', initeeff4);

var jvalidate = $("#aboutcompany").validate({
	
                ignore: [],
                rules: {                                                                 
                       						
						'company_name': {
                                required: true,
                                minlength: 3,
                                maxlength: 500,
							   lettersonly:true
							},
							
						'industry': {
                                required: true                            
							},
							
						'number_gap': {
                            required: "#approve_gap:checked"
                         },		
							
						'mapaddress': {
                                required: true
                               
							},

						'company_description': {
                                required: true
							},
                         				
					
                    },
           messages: {
                        						
			            'company_name':"The Company Name is required and cannot be empty",
						'industry':"The Company industry is required and cannot be empty",
						'company_description': "The Company Description is required and cannot be empty.",
                        'mapaddress':"The Company Business location is required and cannot be empty"						
                       				
                     						
                     }					
                });	


 
    

function ValidateExtension(id) {	
        var allowedFiles = [".jpg", ".png"];
        var fileUpload = document.getElementById("photo");
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
</script>
<style>
.blue_button {
    display: inline-block;
    border: 1px solid #2396F3;
    background-color: #2396F3;
    color: #fff;
    text-transform: capitalize;
    padding: 0 17px;
    height: 37px;
    line-height: 35px;
    border-radius: 2em;
    font-size: 15px;
    cursor: pointer;
    font-weight: 500;
    margin-top: 10px;
}
.dashboard_form input[type="submit"] {
    width: auto;
    color: #fff;
    padding: 0 18px;
    border: 1px solid #2396f3;
    margin-left: 4px;
    margin-top: -1px;
}
</style>