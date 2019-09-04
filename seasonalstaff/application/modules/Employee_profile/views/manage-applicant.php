<!-- breadcrumb section Start -->
<div class="breadcrumb text-center">
    <div class="container">
    <h1>Dashboard Page</h1>
    <ul><li><a href="#">home</a></li><li>Manage Employment</li></ul>
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
                    <div class="dashboard_content manage_applicant">
                        <div class="dashboard_heading">
                            <h4>Manage Applicant</h4>
                            <div class="dash_head_right">
                              <a href="<?php echo base_url(); ?>Welcome" class="blue_button search_staff_btn">Search For Staff</a>
                            </div>
                        </div>
                        <!-- Table Start -->
                        <div class="dashboard_table table-responsive ">
                           <table class="table" id="dataTable">
                                <thead>
                                    <tr>
                                       <th>Applicants</th>
									   <th>Job Title</th>
									   <!-- <th>Resume</th>
									   <th>Interested</th> -->
									   <th>Date Sent</th>
                                       <th>Status</th>
                                       <th>Actions</th>
                                   </tr>
                                </thead>
                                <tbody>
                                  <!-- table row -->
								  <?php if(isset($jobs)){
									foreach($jobs as $list){
									$photo = $list->image;	?>
                                   <tr>
                                       <td>
                                          <div class="dashboard_user">
                                              <div class="user_thumb">
											  <?php if($photo==''){ ?>
                                                  <img src="<?php echo base_url(); ?>public/front_end/images/dashboard/userst.jpg" alt=""> 
                                              <?php } else { ?>
											  <img src="<?php echo base_url(); ?>public/upload/userProfile/<?php echo $photo; ?>" alt=""> 
											  <?php } ?>											  
                                              </div>
											  
                                              <div class="user_text">
                                                 <h5><a href="<?php echo base_url(); ?>staff-detail/<?php echo $list->user_id; ?>"><?php echo $list->first_name;?>  <?php echo $list->last_name;  ?></a></h5>
												 
                                                  <div class="sub_text">
                                                    <span><i class="fa fa-map-marker"></i><?php echo $list->current_location;?> </span>                                                  
                                                  </div>
                                                  <div class="sub_text_2">												 
                                                    <span><i class="fa fa-clock-o"></i> Last contact: <?php echo  date("d-M-Y",strtotime($list->created_date));?></span>
                                                  </div>
                                              </div>
                                          </div>
                                       </td>
									   
                                      <td>
                                       <a href="<?php echo base_url(); ?>Welcome/work_detail/<?php echo str_replace(' ', '-', $list->job_title);?>/<?php echo $list->job_id; ?>"> <?php echo $list->job_title; ?>
                                       </a>
									  </td>
									  
									   <td><span><i class="fa fa-clock-o"></i> <?php echo  date("d-M-Y",strtotime($list->created_date));?></span></td>
                                     
									  
									  
									   <!--  <td>
									  <?php if($list->resume!=''){  ?>
									  <a href="<?php echo base_url(); ?>public/upload/cv/<?php echo $list->resume; ?>" class="text_blue">Resume Download</a>
									  <?php } ?>
									  </td>
									  
									   <td>
                                         <?php  if($list->interested=='yes') { echo 'Interested'; }?>                                                                                
                                       </td>  -->
									   
									   <td>
									   <div class="radio_box receive_radios">
                                             <label>
                                                  <input type="radio" name="status<?php echo $list->id?>" id="status" value="0" <?php echo ($list->status == '0' && $list->id==$list->id) ? 'checked' : ''; ?> onClick="statusvalue(this.value,<?php echo $list->id; ?>);">
                                                  <span class="r_check"></span> 
										    <span class="r_text">Pending</span>
                                            </label>
											
										   <label>
                                                  <input type="radio" name="status<?php echo $list->id?>" id="status" value="1" <?php echo ($list->status == '1' && $list->id==$list->id) ? 'checked' : ''; ?> onClick="statusvalue(this.value,<?php echo $list->id; ?>);">
                                                  <span class="r_check"></span> 
										    <span class="r_text">Shortlisted</span>
                                            </label>

											<label>
                                                  <input type="radio" name="status<?php echo $list->id?>" id="status" value="2" <?php echo ($list->status == '2' && $list->id==$list->id) ? 'checked' : ''; ?> onClick="statusvalue(this.value,<?php echo $list->id; ?>);">
                                                  <span class="r_check"></span> 
										    <span class="r_text">Unsuccessful</span>
                                            </label>
											
										</div>									   
									    
                                       </td>
									  
                                       <td class="action_btns">
                                          <a href="#" class="text_blue popup_btn" data-show="cv_popup" onclick="mailuid('<?php echo $list->user_id; ?>')"><i class="fa fa-envelope-o"></i>
                                            <span class="a_tooltip">Email</span>
                                          </a>
										  
                                          <a href="<?php echo base_url(); ?>Employee_profile/Profile/messages/<?php echo $list->user_id; ?>" class="text_green"><i class="fa fa-comments"></i>
                                            <span class="a_tooltip">Message</span>
                                          </a>
										  
                                          <a href="javascript:void(0)" class="text_red removeData" data-toggle="modal" data-target="#myModal" data-id="<?php echo $list->id; ?>" ><i class="fa fa-trash"  ></i>
                                            <span class="a_tooltip">Delete</span>
                                           </a>
										   
										 <?php if($list->resume!=''){  ?>
									     <a href="<?php echo base_url(); ?>public/upload/cv/<?php echo $list->resume; ?>" class="text_blue" style="font-size: 11px;">Resume Download</a>
									     <?php } ?>  
										 
                                       </td> 
                                    </tr>
								  <?php }} ?>
                                    <!-- table row -->
                                    
                                </tbody>
                           </table>
                        </div>
                        <!-- Table End -->                      
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="popup_wrapper" id="cv_popup">
      <div class="popup_dialog">
        <div class="popup_content">
          <span class="p_close_btn"><i class="fa fa-times"></i></span>
          <div class="cv_form_wrapper">
          <form  method="post" action="<?php echo site_url('Employee_profile/Profile/mailsendstaff'); ?>" enctype="multipart/form-data">
               <div class="form_group">
			   
			   <input type="hidden" name="staff_uid" id="staff_uid">					   
			
               <label>Send the an email</label>
                <div class="form_input">

			   <textarea name="maildescr" id="maildescr" placeholder="Enter Message !" required></textarea>                
                  </div>
               </div>
			   
			    <div class="form_group">
			    <label>Attach file</label>
				 <div class="form_input">
			     <input type="file" name="ad_file" id="ad_file">
                  </div>
			   </div>
				
			   
               <div class="form_group text-center">
                  <button type="submit" class="submit_btn">Send</button>
               </div>
           </form>
         </div>
        </div>
      </div>
    </div>


 <div id="myModal" class="modal fade modelAction" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
         <h5 class="modal-title">You are about to delete this applicant?</h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
       
      </div>
      <div class="modal-body">
        <input type="hidden" name="" id="userDel">
        <p>Have you advised this applicant of their application status?.</p>
         <p>Do you still want to delete this record?</p>
         <p>Press Yes if you sure.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
       <button type="button" class="btn btn-success" id="delYe">Yes</button> 
        </div>
    </div>

  </div>
</div>


<script>

    $(document).on("click", ".removeData", function () {
        var dynamicID = $(this).data('id');

       $(".modal-body #userDel").val(dynamicID);

         

});

$('#delYe').on('click',function(){

var id = $('#userDel').val();
var job_id='<?php echo $this->uri->segment(2); ?>';
        $.ajax({
            url: site_url +"Employee_profile/Profile/deleteapply/"+id,
            type: "POST",
            data: {
               id: id,job_id:job_id,
            },
             success: function (msg) {
                if (msg) {
               window.location.href = site_url+"manage_applicant/"+job_id;

                }
            }
            
        });
      });


function statusvalue(value,id)
{
var job_id='<?php echo $this->uri->segment(2); ?>';
$.ajax({
            url: site_url +"Employee_profile/Profile/userapplystatus/"+job_id,
            type: "POST",
            data: {
                id: id,value:value,job_id:job_id,

            },
             success: function (msg) {
                if (msg){       
         
                }
            }            
        });	
}


function mailuid(staff_id){
$('#staff_uid').val(staff_id);	
}

</script>