<!-- breadcrumb section Start -->
<div class="breadcrumb text-center">
    <div class="container">
    <h1>My Favorites</h1>
    <ul><li><a href="#">home</a></li><li>My Favorites</li></ul>
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
                            <h4>My Favorites</h4>
                            <div class="dash_head_right">
                              <a href="<?php echo base_url(); ?>Welcome" class="blue_button search_staff_btn">Search for Work</a>
                            </div>
                        </div>
						 <div class="dashboard_heading">
                          
                            <div class="dash_head_right1">
                              <a href="javascript:history.back()" class="blue_button search_staff_btn">Back</a>
                            </div>
                        </div>
						
                        <!-- Table Start -->
                        <div class="dashboard_table table-responsive uesr_work_table">
                           <table class="table" id="dataTable">
                                <thead>
                                    <tr>
                                       <th>Job</th>									
                                       <th></th>
									   <th>Actions</th>
                                   </tr>
                                </thead>
                                <tbody>
                                  <!-- table row -->
								  <?php if(isset($jobs)){
									foreach($jobs as $list){  ?>
                                   <tr>
                                       <td>
                                          <div class="dashboard_user">
                                              <div class="user_thumb">
											  <?php  
										        $query = $this->db->where('uid',$list->modify_by);
							                    $query = $this->db->get('company_detail');
                                                $resultlogo = $query->result_array();
												$logo  =  $resultlogo[0]['company_logo'];
												if($logo==''){
												   ?> 
                                                <img src="<?php echo base_url(); ?>public/front_end/images/work_thumb.jpg" alt=""> 
												<?php } else { ?>	
												<img src="<?php echo base_url(); ?>public/upload/company_logo/<?php echo $logo; ?>" alt=""> 
												<?php } ?>												
                                              </div>
                                              <div class="user_text">
                                                  <h5><a href="<?php echo base_url(); ?>Welcome/work_detail/<?php echo str_replace(' ', '-', $list->job_title);?>/<?php echo $list->job_id; ?>"><?php echo $list->job_title;  ?></a></h5>
                                                  <div class="sub_text">
												   <?php 
												     $query = $this->db->where('id',$list->industry_id);
							                         $query = $this->db->get('industry');
                                                     $result = $query->result_array();
												   ?>
                                                    <span><i class="fa fa-briefcase"></i><?php echo $result[0]['name']; ;  ?></span>
                                                    <span><i class="fa fa-map-marker"></i><?php echo $list->map_address;  ?></span>
                                                    <span><i class="fa fa-clock-o text_red"></i><?php echo $list->contract_type;  ?></span>                                                  
                                                  </div>
                                              </div>
                                          </div>
                                       </td>									 
									   <td></td>
									     
                                       <td class="action_btns">                                         
                                        <a href="javascript:void(0)" class="text_red removeData" data-toggle="modal" data-target="#myModal" data-id="<?php echo $list->id; ?>" ><i class="fa fa-trash"  ></i>
                                            <span class="a_tooltip">Delete</span>
                                        </a>                                       
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
<!-- Dashboard section End -->
 <div id="myModal" class="modal fade modelAction" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
         <h4 class="modal-title">Delete record?</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
       
      </div>
      <div class="modal-body">
        <input type="hidden" name="" id="userDel">
        <p>Are you sure want to Delete record?.</p>

         <p>Press Yes if you sure.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
       <button type="button" class="btn btn-success" id="delYe">Yes</button> 
        </div>
    </div>

  </div>
</div>
<!-- Dashboard section End -->
<!-- Dashboard section End -->
<script type="text/javascript">

    $(document).on("click", ".removeData", function () {
        var dynamicID = $(this).data('id');

       $(".modal-body #userDel").val(dynamicID);

         

});

$('#delYe').on('click',function(){

var user_id = $('#userDel').val();
        $.ajax({
            url: site_url +"Staff_profile/Staffprofile/deletefavorites/"+user_id,
            type: "POST",
            data: {
                user_id: user_id,

            },
             success: function (msg) {
                       
			   if (msg) {

                   window.location.href = site_url+"interested-jobs";


                }
            }
            
        });
      });
</script>