<div class="breadcrumb text-center">
    <div class="container">
    <h1>Dashboard Page</h1>
    <ul><li><a href="#">home</a></li><li>Reviews</li></ul>
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
                            <h4>Our Reviews</h4>
                            <div class="dash_head_right">
                              <a href="#" class="blue_button search_staff_btn">Search For Staff</a>
                            </div>
                        </div>
                        <!-- Review Section Start -->
                        <div class="review_section_wrap">
                          <!-- Review List Start -->
                          <div class="review_lists">
                             <div class="review_img">
                                <img src="<?php echo base_url(); ?>public/front_end/images/dashboard/user_2.jpg" alt="">     
                            </div>
                            <div class="review_text">
                                <div class="r_heading">
                                  <h5>Kathy Brown on <span>Burder House</span></h5>
                                  <div class="rating-list"> 
                                    <div class="star-rating">
                                      <span class="fa fa-star-o" data-rating="1"></span>
                                      <span class="fa fa-star-o" data-rating="2"></span>
                                      <span class="fa fa-star-o" data-rating="3"></span>
                                      <span class="fa fa-star-o" data-rating="4"></span>
                                      <span class="fa fa-star-o" data-rating="5"></span>
                                      <input type="hidden" name="whatever1" class="rating-value" value="2.56">
                                    </div>
                                  </div>
                                </div>
                                <div class="r_sub_heading">
                                  20 june 2017
                                </div>
                                <p>
                                  Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC.
                                </p>
                                <a href="#" class="blue_button review_btn"><i class="fa fa-reply"></i>reply to this review</a>
                            </div>
                          </div>
                         <!-- Review List End -->
                          <!-- Review List Start -->
                          <div class="review_lists">
                             <div class="review_img">
                                <img src="<?php echo base_url(); ?>public/front_end/images/dashboard/user_2.jpg" alt="">     
                            </div>
                            <div class="review_text">
                                <div class="r_heading">
                                  <h5>Kathy Brown on <span>Burder House</span></h5>
                                  <div class="rating-list"> 
                                    <div class="star-rating">
                                      <span class="fa fa-star-o" data-rating="1"></span>
                                      <span class="fa fa-star-o" data-rating="2"></span>
                                      <span class="fa fa-star-o" data-rating="3"></span>
                                      <span class="fa fa-star-o" data-rating="4"></span>
                                      <span class="fa fa-star-o" data-rating="5"></span>
                                      <input type="hidden" name="whatever1" class="rating-value" value="2.56">
                                    </div>
                                  </div>
                                </div>
                                <div class="r_sub_heading">
                                  20 june 2017
                                </div>
                                <p>
                                  Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC.
                                </p>
                                <a href="#" class="blue_button review_btn"><i class="fa fa-reply"></i>reply to this review</a>
                            </div>
                          </div>
                         <!-- Review List End -->
                          <!-- Review List Start -->
                          <div class="review_lists">
                             <div class="review_img">
                                <img src="<?php echo base_url(); ?>public/front_end/images/dashboard/user_2.jpg" alt="">     
                            </div>
                            <div class="review_text">
                                <div class="r_heading">
                                  <h5>Kathy Brown on <span>Burder House</span></h5>
                                  <div class="rating-list"> 
                                    <div class="star-rating">
                                      <span class="fa fa-star-o" data-rating="1"></span>
                                      <span class="fa fa-star-o" data-rating="2"></span>
                                      <span class="fa fa-star-o" data-rating="3"></span>
                                      <span class="fa fa-star-o" data-rating="4"></span>
                                      <span class="fa fa-star-o" data-rating="5"></span>
                                      <input type="hidden" name="whatever1" class="rating-value" value="2.56">
                                    </div>
                                  </div>
                                </div>
                                <div class="r_sub_heading">
                                  20 june 2017
                                </div>
                                <p>
                                  Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC.
                                </p>
                                <a href="#" class="blue_button review_btn"><i class="fa fa-reply"></i>reply to this review</a>
                            </div>
                          </div>
                         <!-- Review List End -->
                        </div>
                        <!-- Review Section End -->
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