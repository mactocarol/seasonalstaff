<div class="breadcrumb text-center">
    <div class="container">
    <h1>Manage Job</h1>
    <ul><li><a href="#">home</a></li><li>Manage Job</li></ul>
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
                    <div class="dashboard_content manage_job_page">
                        <div class="dashboard_heading">
                            <h4>Manage Jobs</h4>
                        </div>
                        <!-- Table Start -->
                        <div class="dashboard_table table-responsive">
                           <table class="table" id="dataTable" >
                                <thead>
                                    <tr>
                                       <th>Job Title</th>
                                       <th>Status</th>
                                       <th>Date Listed</th>
                                       <th>Applications</th>
                                      <th>job Status</th>
                                       <th>Actions</th>
                                   </tr>
                                </thead>
                                <tbody>
                                  <?php
                                  if(!empty($job_list)){
                                    foreach ($job_list as  $value) {                                      
                                   

                                  ?>
                                   <tr>
                                       <td>
                                          <h5><?php echo !empty($value['job_title']) ? $value['job_title'] : ''; ?></h5>
                                          <span class="sub_title"><i class="fa fa-map-marker"></i><?php echo !empty($value['map_address']) ? $value['map_address'] : ''; ?></span>
                                       </td>
                                       <td>

                                         <?php 
                                            if(!empty($value['status'])){
                                              if($value['status'] == 1){
                                                echo '<span class="status_txt text_green"> Active </span>';
                                              }elseif ($value['status'] == 2) {
                                                echo '<span  class="status_txt text_red"> Draft </span>';
                                              }

                                            }else{
                                              echo '<span class="status_txt text_blue">Advert On hold</span>';

                                            }
                                            ?>


                                        </td>
                                       <td><?php echo (date('Y',strtotime($value['created_date'])) !='1970') ? date('M d,Y',strtotime($value['created_date'])) : ''; ?></td>
                                      <?php 									
                                       $this->db->select("user_applied_jobs.*,count(`user_applied_jobs`.job_id) as cc, users.first_name,users.last_name,users.image,staff_basicinfo.current_location"); 
                                       $this->db->join("users","user_applied_jobs.user_id=users.id","left");
                                       $this->db->join("staff_basicinfo","user_applied_jobs.user_id= staff_basicinfo.staff_id","left");     
                                       $this->db->where("user_applied_jobs.job_id",$value['id']);
                                       $this->db->where("users.first_name!=",'');       
                                       $this->db->order_by("user_applied_jobs.id","desc");                     
                                       $query = $this->db->get('user_applied_jobs');
                                        // echo $this->db->last_query(); die(); 									 
                                      $cnt = $query->row_array();												
								      ?>
									   
									   <td class="applicat_td"><a href="<?php echo site_url('manage_applicant/'.$value['id']); ?>"><?php echo $cnt['cc']; ?> Applications(s)</a></td>

                             <td class="applicat_td">
                            
                             <select name="jobstatus" id="jobstatus" onchange="jobstatususer(<?php echo $value['id']; ?>,this.value)">
                                   <option>Select Job Status</option>
								   <option value="0" <?php if($value['status']==0){ echo 'selected';} ?>>On Hold</option>
                                   <option value="2" <?php if($value['status']==2){ echo 'selected';} ?>>Draft</option>
                                   <option value="1" <?php if($value['status']==1){ echo 'selected';} ?>>Publish</option>                                                   
                                  </select>
							 
							<!-- <a href="javascript:void(0)" class="text_red removeData" data-toggle="modal" data-target="#myModalpublish" data-id="<?php echo $value['id']; ?>" >
                             <span class="btn btn-success">Publish  <?php if($value['user_status']==1){ echo '<i class="fa fa-check" aria-hidden="true"></i>';} ?></span>
                             </a> -->                                          

                             </td>


                                       <td class="action_btns">
                                           <a href="<?php echo base_url(); ?>work_detail/<?php echo str_replace(' ', '-', $value['job_title']);?>/<?php echo $value['id']; ?>" class="text_green" target="_blanck"><i class="fa fa-eye"></i>
                                             <span class="a_tooltip">View</span>
                                           </a>
                                           <a href="<?php echo site_url('edit-list-a-job/'.$value['id']); ?>" class="text_blue"><i class="fa fa-pencil-square-o"></i>
                                            <span class="a_tooltip">Edit</span>
                                           </a>
                                           <a href="javascript:void(0)" class="text_red removeData" data-toggle="modal" data-target="#myModal" data-id="<?php echo $value['id']; ?>" ><i class="fa fa-trash"  ></i>
                                            <span class="a_tooltip">Delete</span>
                                           </a>
                                       </td> 
                                    </tr>
                                    <?php
                                     }

                                  }

                                    ?>
                                </tbody>
                           </table>
                        </div>
                        <!-- Table End -->
                        <!-- Pagination Start -->
                        <!--<div class="pagination_dv text-center">-->
                        <!--    <nav aria-label="Page navigation example">-->
                        <!--      <ul class="pagination">-->
                        <!--        <li class="page-item">-->
                        <!--          <a class="page-link page_prev" href="#" aria-label="Previous">-->
                        <!--            <span aria-hidden="true"><i class="fa fa-chevron-left"></i></span>-->
                        <!--          </a>-->
                        <!--        </li>-->
                        <!--        <li class="page-item"><a class="page-link" href="#">1</a></li>-->
                        <!--        <li class="page-item active"><a class="page-link" href="#">2</a></li>-->
                        <!--        <li class="page-item"><a class="page-link" href="#">3</a></li>-->
                        <!--        <li class="page-item"><a class="page-link" href="#">4</a></li>-->
                        <!--        <li class="page-item">-->
                        <!--          <a class="page-link page_next" href="#" aria-label="Next">-->
                        <!--           <span aria-hidden="true"><i class="fa fa-chevron-right"></i></span>-->
                        <!--          </a>-->
                        <!--        </li>-->
                        <!--      </ul>-->
                        <!--    </nav>-->
                        <!--</div>-->
                        <!-- Pagination End -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

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

<script type="text/javascript">

    $(document).on("click", ".removeData", function () {
        var dynamicID = $(this).data('id');

       $(".modal-body #userDel").val(dynamicID);

         

});

$('#delYe').on('click',function(){

var user_id = $('#userDel').val();
        $.ajax({
            url: site_url +"Employee_profile/Profile/delete/"+user_id,
            type: "POST",
            data: {
                user_id: user_id,

            },
             success: function (msg) {
                if (msg) {

                   window.location.href = site_url+"manage-job";


                }
            }
            
        });
      });
	  
function jobstatususer(user_id,status) {
    $.ajax({
            url: site_url +"Employee_profile/Profile/userjobs/"+user_id,
            type: "POST",
            data: {
                user_id: user_id,status:status,

            },
             success: function (msg) {
                if (msg) {

                   window.location.href = site_url+"manage-job";


                }
            }            
        }); 
}	
</script>