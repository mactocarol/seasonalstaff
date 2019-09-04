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
                	<!-- blog box End -->
					<?php if(isset($bloglist)){
						foreach($bloglist as $list){
						?>
                    <div class="blog_box">
                        <div class="blog_thumb">
						    <?php if($list->image==''){ ?>
                            <img src="<?php echo base_url();?>public/front_end/images/blog/blog_1.jpg" alt="Blog Thumb">
							<?php } else {  ?>
							 <img src="<?php echo base_url();?>public/upload/blogImage/<?php echo $list->image; ?>" alt="Blog Thumb">
							<?php }  ?>
                            <div class="blog_date">
                            	<span class="date"><?php echo date("d M", strtotime($list->created_date)); ?></span>
                            	<span class="year"><?php echo date("Y", strtotime($list->created_date)); ?></span>
                            </div>
                        </div>
                        <div class="blog_desc">
                            <a href="<?php echo base_url(); ?>Welcome/blogdetail/<?php echo $list->id; ?>"><h5><?php echo $list->title; ?></h5></a>
                            <div class="blog_meta"><a href="#">By admin</a> 
							<?php 
							$query = $this->db->query("SELECT `cat_name` FROM `blog_category` WHERE id=$list->category"); 
							$result1 = $query->result();
							?>
							
						   <a href="<?php echo base_url(); ?>Welcome/category/<?php echo $list->category; ?>"><?php echo $result1[0]->cat_name; ?></a></a></div>
                            <p>
                                <?php echo  substr($list->description, 0, 300); ?>..
                            </p>
                            <a href="<?php echo base_url(); ?>Welcome/blogdetail/<?php echo $list->id; ?>" class="read_link">Continue Reading <i class="fa fa-long-arrow-right"></i></a>
                        </div>
                    </div>
                    <!-- blog box End -->
					<?php } } ?>
					  <div class="search_pagination">
									<nav aria-label="Page navigation example">
									  <ul class="pagination">
										<li class="page-item">
		<?= $pagination; ?>
		   </nav>
		 </ul>
		</li>
	</div>         
                   
                    <!-- blog box End -->
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