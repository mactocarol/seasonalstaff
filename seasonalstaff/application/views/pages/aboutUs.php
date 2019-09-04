<!-- breadcrumb section Start -->
    <div class="breadcrumb text-center">
    	<div class="container">
        <h1>About us</h1>
        <ul><li><a href="<?php echo site_url('Welcome'); ?>">home</a></li><li>About us</li></ul>
        </div>
    </div>
    <!-- breadcrumb section End -->
    <!-- About section Start -->
    <div class="content-section about_page_section">
    	<div class="container">
        	<div class="row">
                <div class="col-lg-7 col-md-12">
                    <div class="about_content">
                        <h4><?php if(isset($about[0]['heading'])) { echo $about[0]['heading']; }  ?></h4>
                        <p>
                            <?php if(isset($about[0]['description'])) { echo $about[0]['description']; }  ?>
                        </p> 
                       
                    </div>
                    <div class="row">
                    	<div class="col-lg-6 col-md-12">
                    		<div class="about_content_2">
                    			<div class="about_icons">
                    		   <img src="<?php echo base_url();?>public/front_end/images/dashboard/userst.jpg" alt="">
                    			</div>
		                        <h5>Find staff</h5>
		                        <p>
								 <?php if(isset($about[0]['staff_description'])) { echo $about[0]['staff_description']; }  ?>
		                        </p>
		                    </div>
                    	</div>
                    	<div class="col-lg-6 col-md-12">
		                    <div class="about_content_2">
                    			<div class="about_icons">
                    			 <img src="<?php echo base_url();?>public/front_end/images/dashboard/user.jpg" alt="" height="73px">
                    			</div>
		                        <h5>Find work</h5>
		                        <p>
								 <?php if(isset($about[0]['emp_description'])) { echo $about[0]['emp_description']; }  ?>
		                        </p>
		                    </div>
	                    </div>
                    </div>
                </div>
                 <div class="col-lg-5 col-md-12">
                    <div class="about_thumb">
                       	<img src="<?php echo base_url();?>public/upload/about/<?php if(isset($about[0]['image'])) { echo $about[0]['image']; }  ?>" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About section End -->
    <!-- Hero Banner Start -->
    <div class="about_hero_banner">
    	<div class="container">
        	<div class="row">
                <div class="col-lg-12 col-md-12">
	                <div class="hero_banner_text">
	                	<h4>Have you joined the Seasonal Staff Movement Yet?</h4>
	                	<div class="hero_btn_wrap">
	                		<a href="<?php echo base_url(); ?>" class="blue_button">Search for Staff</a>
	                		<a href="<?php echo base_url(); ?>" class="green_button">Search for Jobs</a>
	                	</div>
	                </div>
                </div>
            </div>
        </div>
        <div class="hero_overlay"></div>
    </div>
    <!-- Hero Banner End -->