<div class="col-xl-3 col-lg-4 col-md-12 col-sm-12">
    <div class="dashboard_sidebar">
        <div class="dashboard_user">
            <div class="user_thumb">
                <?php
				 $uid = $this->session->userdata('user_id');
				 $query = $this->db->where('id',$uid);
				 $query = $this->db->get('users');
                 $result = $query->result_array();
				 if(!empty($result[0]['image']) && !empty($result[0]['server_image'])){
                    ?>
                    <img src="<?php echo base_url('public/upload/userProfile/'.$result[0]['image']); ?>" alt="">
               <?php
                }
                elseif(!empty($result[0]['image'])){

                    ?>
                    <img src="<?php echo base_url('public/upload/userProfile/'.$result[0]['image']); ?>" alt="">
              <?php
                } elseif(!empty($result[0]['server_image'])){ ?>
                 
				 <?php if($result[0]['facebook']=='facebook'){ ?>
				  <img src="https://graph.facebook.com/<?php echo $result[0]['facebook_id']; ?>/picture?type=large" alt="">
				 <?php } else {?>
                    <img src="<?php echo $result[0]['server_image']; ?>" alt="">
				
            
				 <?php }}else{ ?>
                <img src="<?php echo base_url(); ?>public/front_end/images/dashboard/user.jpg" alt="">                                
                <?php }

                ?>
              <!--   <img src="<?php echo base_url(); ?>public/front_end/images/dashboard/user.jpg" alt="">  -->
               <a href="#" data-toggle="modal" data-target="#user_modal" class="thumb_edit_text">
                    Upload Photo   
                </a> 
                <!--<a href="#" data-toggle="modal" data-target="#user_modal" class="thumb_edit">
                    <i class="fa fa-pencil"></i>
                </a>-->
            </div>
            <div class="user_text">
                <h5><?php echo !empty($result[0]['first_name']) ? ($result[0]['first_name']) : '';?>  <?php echo !empty($result[0]['last_name']) ? ($result[0]['last_name']) : ''; ?></h5>
                <p>@<?php echo !empty($result[0]['username']) ? ($result[0]['username']) : '';?></p>
            </div>
        </div>
        <div class="dashboard_nav">
		<?php $url = $this->uri->segment(1);
         $dd = 'class="active"'; 
		 $dd1 ='class="active dropdown_menu"';
		 $ds ='style="display: block;"';
		 ?>
            <ul>
                <li>
                    <a href="<?php echo site_url('employee-profile');?>" <?php if($url=='employee-profile'){ echo $dd; } ?>>
                        <span class="icons"><i class="fa fa-user-o"></i></span>
                        <span class="links">Profile</span>
                    </a>
                </li>
				 <li>
                    <a href="<?php echo site_url('about_company');?>" <?php if($url=='about_company'){ echo $dd; } ?>>
                        <span class="icons"><i class="fa fa-building"></i></span>
                        <span class="links">About your Business</span>
                    </a>
                </li>
                <?php
				 $query1 =  $this->db->where("rid",$uid);
                 $query1 = $this->db->where('status',0);
				 $query1 = $this->db->get('userschating');
                 $result1 = $query1->result_array();							 
				?>
				
                 <li>
                    <a href="<?php echo base_url(); ?>messages/" <?php if($url=='messages'){ echo $dd; } ?>>
                        <span class="icons"><i class="fa fa-envelope"></i></span>
                        <span class="links">Messages <span style="color: red;"><?php if(isset($result1[0]['st'])){if($result1[0]['st']!=0){ echo '&nbsp;<i class="fa fa-weixin" aria-hidden="true"></i>&nbsp'.$result1[0]['st'].'';}} ?></span></span>
                    </a>
                </li>  
                <!-- <li>
                    <a href="<?php echo base_url(); ?>reviews/" <?php if($url=='reviews'){ echo $dd; } ?> <?php if($url=='reviews'){ echo $dd1; echo $ds;  } ?>> 
                        <span class="icons"><i class="fa fa-commenting-o"></i></span>
                        <span class="links">Reviews</span>
                    </a>
                    <ul>
                        <li><a href="<?php echo base_url(); ?>reviews/" <?php if($url=='reviews'){ echo $dd; } ?>>Our Reivews</a></li>
                        <li><a href="#">Post a Reivew</a></li>
                    </ul>
                </li> -->             
                <li>
                    <a href="<?php echo site_url('manage-job'); ?>" <?php if($url=='manage-job' or $url=='list-a-job'){ echo $dd1; echo $ds;  } ?>>
                        <span class="icons"><i class="fa fa-briefcase"></i></span>
                        <span class="links">Manage Employment</span>
                    </a>
                    <ul>
                        <li><a href="<?php echo site_url('list-a-job'); ?>"  <?php if($url=='list-a-job'){ echo $dd; } ?>><span class="icons"><i class="fa fa-hand-o-right" aria-hidden="true"></i></span>
						<span class="links">List a Job</span></a></li>
						
						<li><a href="<?php echo site_url('manage-job'); ?>" <?php if($url=='manage-job'){ echo $dd; } ?>><span class="icons"><i class="fa fa-hand-o-right" aria-hidden="true"></i></span>
						<span class="links">Manage Jobs</span></a></li>
                      
                       <li><a href="<?php echo base_url(); ?>manage-applicants" <?php if($url=='manage-applicants'){ echo $dd; } ?>>
					   <span class="icons"><i class="fa fa-hand-o-right" aria-hidden="true"></i></span>
					   <span class="links">Manage Applicants</span></a></li>
					   
					   <li>
                        <a href="<?php echo base_url(); ?>manage-interesteduser/" <?php if($url=='manage-interesteduser'){ echo $dd; } ?>>
                        <span class="icons"><i class="fa fa-heart" aria-hidden="true"></i></span>
                        <span class="links">Jobs Favorite User</span>
                       </a>
                       </li> 

                    </ul>
                </li> 
                <!-- <li>
                    <a href="#">
                        <span class="icons"><i class="fa fa-cog"></i></span>
                        <span class="links">Settings</span>
                    </a>
                </li>  -->  
                 <li>
                    <a href="<?php echo site_url('logout'); ?>">
                        <span class="icons"><i class="fa fa-sign-out"></i></span>
                        <span class="links">Logout</span>
                    </a>
                </li>

			   <li>
                    <a href="<?php echo base_url(); ?>list-a-job/" <?php if($url=='list-a-job'){ echo $dd; } ?>>
                        <span class="icons"><i class="fa fa-hand-o-right" aria-hidden="true"></i></span>
                        <span class="links">List A Job</span>
                    </a>
               </li>
			   <li>
                    <a href="<?php echo base_url(); ?>find-staff/" <?php if($url=='find-staff/'){ echo $dd; } ?>>
                        <span class="icons"><i class="fa fa-search" aria-hidden="true"></i></span>
                        <span class="links">Search for Staff</span>
                    </a>
               </li>
				
            </ul>
        </div>
    </div>
</div>


<!-- Login Modal -->
<div class="modal fade" id="user_modal">
    <div class="modal-dialog">
      <div class="modal-content login_form">
        <!-- Modal Header -->
        <div class="modal-header">
          <h5 class="modal-title">Upload profile photo</h5> 
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <!-- Modal body -->
        <div class="modal-body">
            <div class="user_edit_form ">
                <form method="post" action="<?php echo site_url('Employee_profile/Profile/profileImage/'.$result[0]['id']); ?>" enctype="multipart/form-data">
                    <div class="form_group width_100">
                        <label>Change Your Photo</label>
                        <div class="input_group">
                            <input type="file" name="image" accept=".png, .jpg, .jpeg" required>
                        </div>
                    </div>
                    <div class="form_group width_100">
                        <button type="submit" class="blue_button profile_submit">Save</button>
                    </div>
                </form>
            </div>
        </div>
      </div>
    </div>
</div>
<!-- Login Modal -->