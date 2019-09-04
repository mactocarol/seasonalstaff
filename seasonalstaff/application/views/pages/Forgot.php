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
                           <h3>Forgot Password</h3>
                           <p>Please Enter Your Registered Email Address we'll send you email to set password</p>
                        </div>
                        <form class="" action="<?php echo base_url(); ?>Forgot/forgotpassword" method="post">
                           <div class="form_group width_100">
                              <label>Enter Your Email</label>
                              <div class="input_group">
                                 <input type="email" name="email" id="email" placeholder="Enter Your Email" required>
                              </div>
                           </div>
                           <div class="form_group width_100 text-center">
                              <button type="submit" class="forget_submit_btn blue_button">Submit</button>
                           </div>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- forget pass section -->