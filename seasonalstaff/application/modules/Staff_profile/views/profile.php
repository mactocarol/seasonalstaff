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
                    <div class="dashboard_content post_work_page">
                        <div class="dashboard_heading">
                            <h4>Profile</h4>
                        </div>
                       
                        <!-- Dashboard form Start -->
                        <div class="dashboard_form">
                           <form  action="<?php echo base_url('Staff_profile/Staffprofile/updateprofile/'.$result[0]['id']); ?>" method="post" id="staffprofile">
                             <div class="frm_Fields">
							 
                                <div class="row form_group">
                                    <div class="col-lg-4 col-md-12 col-sm-12">
                                        <label>Name</label>
                                    </div>
                                     <div class="col-lg-8 col-md-12 col-sm-12">
                                        <div class="input_group">
                                            <input type="text" name="uname" id="uname" class="form-control" placeholder="Full Name" value="<?php echo !empty($result[0]['first_name']) ? ($result[0]['first_name']) : '';?> <?php echo !empty($result[0]['last_name']) ? ($result[0]['last_name']) : '';?>">
                                            
                                        </div>                             

                                    </div>
                                </div>
								
                                <div class="row form_group">
                                    <div class="col-lg-4 col-md-12 col-sm-12">
                                        <label>username</label>
                                    </div>
                                     <div class="col-lg-8 col-md-12 col-sm-12">
                                        <div class="input_group">
										<span class="input_text_msg">(This information will be displayed publically)</span>
                                            <input type="text" name="username" id="username" placeholder="@username" value="<?php echo !empty($result[0]['username']) ? ($result[0]['username']) : '';?>">
                                        </div>
                                        
                                    </div>
                                </div> 
								
                                <div class="row form_group">
                                   <div class="col-lg-4 col-md-12 col-sm-12">
                                        <label>Email</label>
                                    </div>
                                    <div class="col-lg-8 col-md-12 col-sm-12">
                                        <div class="input_group">
                                            <input type="email" name="email" placeholder="email@123.com" value="<?php echo !empty($result[0]['email']) ? ($result[0]['email']) : '';?>" readonly>
                                        </div>
                                    </div>
                                </div>
								
                                <div class="row form_group">
                                   <div class="col-lg-4 col-md-12 col-sm-12">
                                        <label>Phone</label>
                                    </div>
                                    <div class="col-lg-8 col-md-12 col-sm-12">
                                        <div class="input_group">
                                            <input type="text" name="phone" id="phone" placeholder="01231234655"  value="0<?php echo !empty($result[0]['contact_number']) ? ($result[0]['contact_number']) : '';?>">
                                        </div>
                                    </div>
                                </div>
                              
							 <div class="row form_group profile_btns">
                                   <div class="col-lg-4 col-md-12 col-sm-12">
                                        <label></label>
                                    </div>
                                    <div class="col-lg-8 col-md-12 col-sm-12">
                                        <!-- <input type="submit" name="save_btn" class="blue_button buttons" value="Save Changes"> -->
                                        <input type="submit" name="save_btn" class="blue_button buttons" value="Update Staff Profile">
                                    </div>
                                </div>
								
								 </form>
								 </div>
								<div class="dashboard_form">
				                <form  action="<?php echo base_url('Staff_profile/Staffprofile/updatepass/'.$result[0]['id']); ?>" method="post" id="passchange">

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
						<p>Now Tell Us Your Manage Work Profile.</p>
					</div>
					<div class="awesome_bottom">
						<a href="<?php echo base_url(); ?>manage-work-profile/" class="cake_btn" value="Start CakeHR">Continue</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- popup End -->

<script>
$(document).ready(function(){
 var phone1 = $('#phone').val();
 var uname = $('#uname').val(); 
 var username = $('#username').val();

if(uname !='' && username !='' && phone !=''){
 var element = document.getElementById("myDIV");
   element.classList.add("popup_active");
}
});


jQuery.validator.addMethod("numbers", function (value, element) {
   return this.optional(element) || /^(\d+|\d+,\d{1,2})$/.test(value);
}, "Only numbers allow");
var jvalidate = $("#staffprofile").validate({
	
                ignore: [],
                rules: {                         
                        	
						'username': {
                                required: true,
                                minlength: 3,
                                maxlength: 100                              
                        },
						'phone': {
                                required: true,
                                minlength: 5,
                                //maxlength: 14,
								numbers:true                              
                        }
						
                    },
           messages: {
			        
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
