  <!-- forget pass section -->
      <div class="forgot_section">
         <div class="container">
            <div class="row">
               <div class="col-xl-6 col-lg-8 offset-xl-3 offset-lg-2 col-sm-12">
                  <div class="forget_pass_form"> 
                     <div class="login_form_inner">
                        <div class="forgot_icon">
                           <i class="fa fa-lock"></i>
                        </div>
                        <div class="forgot_heading">
                           <h3>Reset Password</h3>
                           <p>You can reset your password here:</p>
                        </div>
                        <form class="" method="post" action="<?php echo base_url() ?>Forgot/resetpassword" id="regformid">
                         
						 <input type="hidden" id="id" name="id" value="<?php if($this->uri->segment(3)) { echo $this->uri->segment(3); } ?>"> 
						   
						   <div class="form_group width_100">
                              <label>Enter Code</label>
                              <div class="input_group">
                                 <input type="text" name="code" id="code" placeholder="Enter Code">
                              </div>
                           </div>
						   
						    <div class="form_group width_100">
                              <label>Password</label>
                              <div class="input_group">
                                 <input type="password" name="pass" id="pass" placeholder="Password">
                              </div>
                           </div>
						   
						    <div class="form_group width_100">
                              <label>Repeat your password</label>
                              <div class="input_group">
                                 <input type="password" name="cpassword" id="cpassword" placeholder="Repeat your password">
                              </div>
                           </div>
						   
                           <div class="form_group width_100 text-center">
						     <input type="submit" name="signup" id="signup" class="forget_submit_btn blue_button" value="Submit"/>
                             <!-- <button type="submit" class="forget_submit_btn blue_button">Submit</button> -->
                           </div>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
<!-- forget pass section -->
<script>
var jvalidate = $("#regformid").validate({	
                ignore: [],
                rules: {               
                      'pass': {
                                required: true,
                                minlength: 5,
                                maxlength: 16                              
                        },
						 'cpassword': {
                                required: true,
                                minlength: 5,
                                maxlength: 16,
								equalTo: "#pass"                              
                        },
						'code': {
						 required: true	
						}
                    },
           messages: {
                        					
                     }					
                });		

	</script>	  
	  