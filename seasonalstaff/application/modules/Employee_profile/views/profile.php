<!-- breadcrumb section Start -->
<div class="breadcrumb text-center">
    <div class="container">
    <h1>Profile</h1>
    <ul><li><a href="#">home</a></li><li>Profile</li></ul>
    </div>
</div>
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
                    <div class="dashboard_content">
                        <div class="dashboard_heading">
                            <h4>User Profile</h4>
                        </div>
                        <!-- Dashboard form Start -->
                        <div class="dashboard_form">
                           <form  action="<?php echo site_url('update-profile/'.$result[0]['id']); ?>" method="post" id="emploeeProfile">
                             <div class="frm_Fields">
                                <div class="row form_group">
                                    <div class="col-lg-4 col-md-12 col-sm-12">
                                        <label>Name of Account Manager</label>
                                    </div>
                                     <div class="col-lg-8 col-md-12 col-sm-12">
                                        <div class="input_group">
                                            <input type="text" name="manager_name" id="manager_name" class="form-control" placeholder="Full Name" value="<?php echo !empty($result[0]['first_name']) ? ($result[0]['first_name']) : '';?> <?php echo !empty($result[0]['last_name']) ? ($result[0]['last_name']) : ''; ?>" autocomplete="off">
                                            
                                        </div>
                                         

                                    </div>
                                </div>
                                <div class="row form_group">
                                    <div class="col-lg-4 col-md-12 col-sm-12">
                                        <label>username</label>
                                    </div>
                                     <div class="col-lg-8 col-md-12 col-sm-12">
                                        <div class="input_group">
                                            <input type="text" name="username" id="username" placeholder="Add a username" value="<?php echo !empty($result[0]['username']) ? ($result[0]['username']) : '';?>" autocomplete="off">
                                        </div>
                                        
                                    </div>
                                </div> 
                                <div class="row form_group">
                                   <div class="col-lg-4 col-md-12 col-sm-12">
                                        <label>Account Manager Email</label>
                                    </div>
                                    <div class="col-lg-8 col-md-12 col-sm-12">
                                        <div class="input_group">
                                            <input type="email" name="email" placeholder="email@123.com" value="<?php echo !empty($result[0]['email']) ? ($result[0]['email']) : '';?>" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="row form_group">
                                   <div class="col-lg-4 col-md-12 col-sm-12">
                                        <label>Account Manager Phone</label>
                                    </div>
                                    <div class="col-lg-8 col-md-12 col-sm-12">
                                        <div class="input_group">
                                            <input type="text" name="manager_phone" id="manager_phone" placeholder="1231234655" value="0<?php echo !empty($result[0]['contact_number']) ? ($result[0]['contact_number']) : '';?>" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="row form_group">
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

                                                <option  <?php echo ($result[0]['industry_id'] == $value['id']) ? 'selected' : ''; ?> value="<?php echo !empty($value['id']) ? $value['id'] : ''; ?>"><?php echo !empty($value['name']) ? $value['name'] : ''; ?></option>
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
                                    <div class="col-lg-4 col-md-12 col-sm-12">
                                        <label>Business location</label>
                                    </div>
                                    <div class="col-lg-8 col-md-12 col-sm-12">
                                        <div class="input_group">

                                            <input type="text" name="mapaddress" id="mapaddress" placeholder="Main business location" value="<?php echo !empty($result[0]['business_location']) ? ($result[0]['business_location']) : '';?>" autocomplete="off">
                                            <input type="hidden" id="city2" name="city2" value="<?php echo !empty($result[0]['city2']) ? ($result[0]['city2']) : ''; ?>"/>
                                            <input type="hidden" id="cityLat" name="cityLat" value="<?php echo !empty($result[0]['cityLat']) ? ($result[0]['cityLat']) : ''; ?>" />
                                            <input type="hidden" id="cityLng" name="cityLng" value="<?php echo !empty($result[0]['cityLng']) ? ($result[0]['cityLng']) : ''; ?>" />
                                        </div>
                                    </div>
                                </div> -->
								
					
                               
                                <!-- <div class="row form_group">
                                    <div class="col-lg-4 col-md-12 col-sm-12">
                                        <label>About our business</label>
                                    </div>
                                    <div class="col-lg-8 col-md-12 col-sm-12">
                                        <div class="input_group">
                                            <textarea placeholder="introduce Yourself" name="about_business" id="about_business"><?php echo !empty($result[0]['about_business']) ? ($result[0]['about_business']) : '';?></textarea>
                                        </div>
                                    </div>
                                </div> -->
								 <div class="row form_group profile_btns">
                                   <div class="col-lg-4 col-md-12 col-sm-12">
                                        <label></label>
                                    </div>
                                    <div class="col-lg-8 col-md-12 col-sm-12">
                                        <!-- <input type="submit" name="save_btn" class="blue_button buttons" value="Save Changes"> -->
                                        <input type="submit" name="save_btn" class="blue_button buttons" value="Update Business Profile">
                                    </div>
                                </div>
								
								 </form>
								 </div>
								<div class="dashboard_form">
				                <form  action="<?php echo base_url(); ?>Employee_profile/Profile/updatepass/<?php echo $result[0]['id']; ?>" method="post" id="passchange">

                                 <div class="dashboard_heading pad_top_30">
                                    <h4>Change Password</h4>
                                </div>
                                <div class="row form_group">
                                    <div class="col-lg-4 col-md-12 col-sm-12">
                                        <label>Current Password</label>
                                    </div>
                                    <div class="col-lg-8 col-md-12 col-sm-12">
                                        <div class="input_group">
                                            <input type="password" name="c_pass" value="<?php echo !empty($result[0]['password']) ? ($result[0]['password']) : ''; ?>" placeholder="Current Password">
                                        </div>
                                    </div>
                                </div>
                                <div class="row form_group">
                                    <div class="col-lg-4 col-md-12 col-sm-12">
                                        <label>New Password</label>
                                    </div>
                                    <div class="col-lg-8 col-md-12 col-sm-12">
                                        <div class="input_group">
                                            <input type="password" name="n_pass" id="n_pass" placeholder="New Password">
                                        </div>
                                    </div>
                                </div>
                                 <div class="row form_group">
                                    <div class="col-lg-4 col-md-12 col-sm-12">
                                        <label>Retype Password</label>
                                    </div>
                                    <div class="col-lg-8 col-md-12 col-sm-12">
                                        <div class="input_group">
                                            <input type="password" name="rt_pass" id="rt_pass" placeholder="Retype Password">
                                        </div>
                                    </div>
                                </div>
                                 <div class="row form_group profile_btns">
                                   <div class="col-lg-4 col-md-12 col-sm-12">
                                        <label></label>
                                    </div>
                                    <div class="col-lg-8 col-md-12 col-sm-12">
                                        <input type="submit" name="save_btn" class="blue_button buttons" value="Update Password">
                                        <!-- <input type="submit" name="save_btn" class="blue_button buttons" value="Edit Business Profile"> -->
                                    </div>
                                </div>
                            </div>
                            </form>
                        </div>
                        <!-- Dashboard form End -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Dashboard section End -->
<!-- popup start -->
<?php 
if(empty($this->session->userdata('visited'))){
	$this->session->set_userdata('visited',true);
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
						<p>Welcome, Please complete you profile to get started</p>
					</div>
					<div class="awesome_bottom">
		            <a href="<?php echo base_url(); ?>about_company/" class="cake_btn" value="Start CakeHR">Continue</a>

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


<?php 
if(empty($this->session->userdata('visited'))){
	$this->session->set_userdata('visited',true);
	?>
<!-- popup start -->
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
<?php
}
?>
<!-- popup End -->

<script type="text/javascript">
    var id = <?php echo !empty($result[0]['id']) ? ($result[0]['id']) : '';?>
</script>

<script type="text/javascript">
$(document).ready(function(){
 var manager_phone = $('#manager_phone').val();

if(manager_phone==""){
	alert('neha');
 var element = document.getElementById("myDIV1");
   element.classList.add("popup_active");
}
});



$(document).ready(function(){

 var username = $('#username').val();
 var manager_phone = $('#manager_phone').val();
 
 
if(username!=null && manager_phone!=null){
 var element = document.getElementById("myDIV");
   element.classList.add("popup_active");
}
else {
var element = document.getElementById("myDIV");
   element.classList.add("");	
}
}); 




function initialize() {
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
    google.maps.event.addDomListener(window, 'load', initialize);


var jvalidate = $("#emploeeProfile").validate({
	
                ignore: [],
                rules: {                         
                        	
						'manager_name': {
                                required: true,
                                minlength: 3,
                                maxlength: 100                              
                        },
						'username': {
                                required: true                           
                        },
						'manager_phone': {
                                required: true,
                                minlength: 5,
                                //maxlength: 14,
								numbers:true                          
                        },
						'industry': {
                                required: true                           
                        },
						'mapaddress': {
                                required: true                           
                        },
						'about_business': {
                                required: true                           
                        }
                    },
           messages: {
			         'manager_name': "The Account Manager name is required and cannot be empty", 
                     'username': "Username is required and cannot be empty",     
                     'manager_phone': "The Account Manager contact number is required and cannot be empty aat least 5 numbers.", 
					 'mapaddress': "location is required and cannot be empty", 
                     }					
                });
   
var jvalidate = $("#passchange").validate({
	
                ignore: [],
                rules: {                                          
                        		
						
						'n_pass': {
                                required: true,
                                minlength: 5,
                                maxlength: 16                              
                        },
						 'rt_pass': {
                                required: true,
                                minlength: 5,
                                maxlength: 16,
								equalTo: "#n_pass"                              
                        }
                    },
           messages: {
                        				
                     }					
                });	
 </script>