<!-- breadcrumb section Start -->
    <div class="breadcrumb text-center">
    	<div class="container">
        <h1>Blog</h1>
        <ul><li><a href="<?php echo site_url('Welcome');?>">home</a></li><li>Blog</li></ul>
        </div>
    </div>
    <!-- breadcrumb section End -->
    <!-- Blog section Start -->
    <div class="blog_page_section">
    	<div class="container">
        	<div class="row">
                <!-- Blog Part Start -->
                <div class="col-lg-8 col-md-12">
                	   <div class="blog_thumb">
						<?php 				
					
						if($blogd[0]['image']==""){ ?>
							<img src="<?php echo base_url();?>/public/upload/blogImage/1558521606blog_4.jpg" alt="Blog Thumb">
                            
						<?php } else {  ?>
							<img src="<?php echo base_url();?>public/upload/blogImage/<?php if(isset($blogd[0]['image'])){ echo $blogd[0]['image']; } ?>" alt="Blog Thumb">
						<?php }  ?>
							<div class="blog_date">
                            	<span class="date"><?php echo date("d M")?></span>
                            	<span class="year"><?php echo date("Y")?></span>
                            </div>
                        </div>
                        <!-- Blog description Start -->
                        <div class="blog_desc">
                            <h5><?php if(isset($blogd[0]['title'])){ echo $blogd[0]['title']; } ?></h5>
                            <div class="blog_meta"><a href="#">By admin</a> 
							<?php 
							$query = $this->db->query("SELECT `cat_name` FROM `blog_category` WHERE id=".$blogd[0]['category'].""); 
							$result1 = $query->result();
							?>
							
							
							<a href="<?php echo base_url(); ?>Welcome/category/<?php echo $blogd[0]['category']; ?>"><?php echo $result1[0]->cat_name; ?></a></div>
                            <p>
                            <?php if(isset($blogd[0]['description'])){ echo $blogd[0]['description']; } ?>
                            </p>
                            
                        </div>
                        <!-- Blog description end -->
					
                    <!-- blog box End -->
					 <!-- Review section start -->
                        <div class="blog_review_section">
							<div class="review_heading">
								Our reviews
							</div>
						  <!-- Review List Start -->
						  <?php if(isset($blogcomment)){
							  if(count($blogcomment)==0){
								  echo "<b>No Any Review</b>";
							  }
                             else{							  
							 foreach($blogcomment as $list){
							 ?>
						   <div class="review_lists">
							<div class="review_img">
							<?php if($list->image==""){ ?>
							<img src="<?php echo base_url();?>/public/front_end/images/dashboard/user.jpg" alt="Blog Thumb"> 
							<?php }  else {  ?>
							<img src="<?php echo base_url();?>/public/upload/userProfile/<?php echo $list->image; ?>" alt="Blog Thumb"> 
							<?php } ?>
							</div>
							<div class="review_text">
								<div class="r_heading">
								  <h5><?php echo $list->first_name; ?> <?php echo $list->last_name; ?></h5>
									<div class="r_sub_heading">
									 <?php echo date("d-M-Y", strtotime($list->create_dt));?>
									</div>
								</div>
								<p>
								  <?php echo $list->comment; ?>
								</p>
							</div>
						  </div>
						  <?php }}} ?>
						 <!-- Review List End -->
						</div>
						<!-- Review section end -->
						<!-- Review form start -->
						<div class="review_form_wrap">
							<div class="review_heading">
								Give us reviews
							</div>
							<div class="blog_review_form">
							   <form id="blog_comment" class="form-horizontal" action="<?php echo base_url();?>Welcome/createcomment" method="post">
								  <div class="form_group">
								 <input type="hidden" name="bid" id="bid" value="<?php if($this->uri->segment(3)) { echo $this->uri->segment(3); } ?>">
									  <label>Your Review</label>
									  <div class="input_group">
										<textarea name="comment" id="comment" placeholder="Enter Your Comment"></textarea>
									  </div>
								  </div>
								 
								   <div class="form_group">
								      <?php if($this->session->userdata('user_id')==''){ ?>
				<a href="#" data-toggle="modal" data-target="#login_popup" class="blue_button review_sub_btn">Submit</a>
									  <?php } else { ?>
									  <input type="submit" name="review_submit" class="blue_button review_sub_btn" value="Submit">
									  <?php } ?>
								  </div>
							  </form>
						  </div>
						</div>
						<!-- Review form end -->
					<!-- Related post wrap start -->
						<div class="related_post_wrap">
							<div class="row">
							 <?php 						
							 if(isset($bloglist)){
                                   foreach($bloglist as $b1){													
								 ?>
								<div class="col-lg-4 col-md-6">
									<div class="related_post_box">
										<div class="related_p_thumb">
										
										<?php if($b1->image==''){ ?>
											<img src="<?php echo base_url();?>/public/upload/blogImage/1558521673blog_1.jpg" alt="Blog Thumb"> 
										<?php } else {  ?>
											<img src="<?php echo base_url();?>public/upload/blogImage/<?php echo $b1->image; ?>" alt="Blog Thumb"> 
										<?php }  ?>
										</div>
										<div class="related_p_text">
											<h4><a href="<?php echo base_url(); ?>Welcome/blogdetail/<?php echo $b1->id; ?>"><?php echo $b1->title; ?></a></h4>
										</div>
									</div>
								</div>
							 <?php }} ?>
								
							</div>
						</div>
						<!-- Related post wrap End -->
					
                </div>
                <!-- Blog Part End -->
                <!-- sidebar Start -->
                <div class="col-lg-4 col-md-12">
                    <div class="blog_sidebar">
                    	<!-- search widget -->
	                    <div class="blog_widget">
	                        <div class="widget_search">
	                        	<form method="post" action="<?php echo base_url(); ?>Welcome/blog">
	                        		<input type="text" name="search" placeholder="Search..." value="<?php if(isset($_REQUEST['search'])) { echo $_REQUEST['search']; } ?>">
	                        		<input type="submit" name="submit" class="search_btn" value="search">
	                        </div>
	                    </div>
	                    <!-- search widget -->
	                    <!-- category widget -->
	                    <div class="blog_widget category_widget">
	                    	<h3 class="widget_title">categories</h3>
	                        <div class="widget_category">
	                        	<ul>
								<?php //print_r($blogcategory); die; ?>
								<?php if(isset($blogcategory)) {
									foreach($blogcategory as $listc){
									?>
	                        		<li><a href="<?php echo base_url(); ?>Welcome/category/<?php echo $listc['id']; ?>"><?php echo $listc['cat_name']; ?></a></li>               	   
								<?php } } ?>
	                        	</ul>
	                        </div>
	                    </div>
	                    <!-- category widget -->
	                    <!-- post widget -->
	                    <div class="blog_widget post_widget">
	                    	<h3 class="widget_title">Recent Post</h3>
	                        <div class="recent_post_wrap">
							<?php if(isset($blog)){
						      foreach($blog as $list1){
						?>
	                        	<!-- post list -->
		                        <div class="recent_post_list">
		                        	<a href="#">
			                        	<div class="r_post_thumb">
										    <?php if($list1->image==""){ ?>
			                        		<img src="<?php echo base_url();?>public/front_end/images/post/thumb_1.jpg" alt="">
											<?php } else { ?>
							<img src="<?php echo base_url();?>public/upload/blogImage/<?php echo $list1->image; ?>" alt="">
											<?php }  ?>
			                        	</div>
			                        	<div class="r_post_meta">
			                        		<h6><?php echo $list1->title; ?></h6>
			                        		<span class="post_time"><?php echo date("d M / Y", strtotime($list->created_date)); ?></span>
			                        	</div>
			                        </a>
		                        </div>
		                        <!-- post list -->
							<?php  }}  ?>
		                      
	                        </div>
	                    </div>
                    </div>
                </div>
                <!-- sidebar End -->
            </div>
        </div>
    </div>
    <!-- Blog section End -->