<!-- breadcrumb section Start -->
    <div class="breadcrumb text-center">
    	<div class="container">
        <h1>Deals</h1>
        <ul><li><a href="<?php echo site_url('Welcome');?>">home</a></li><li>Deals</li></ul>
        </div>
    </div>
    <!-- Deals warapper -->
    <div class="deals_wrapper">
    	<div class="container">
    		<div class="row">
    			<!-- Sidebar Start -->
    			<div class="col-lg-4 col-md-12 col-sm-12">
    				<div class="deal_filter_btn_wrap">
    					<span class="deal_filter_btn">
    						<i class="fa fa-sliders"></i>Filter
    					</span>
    				</div>
    				<div class="deal_sidebar">
    					<div class="deal_widget">
	    					<div class="d_widget_content">
	    						<div class="widget_search">
		                        	<form method="post" action="">
		                        		<input type="text" name="search" placeholder="Search..." value="">
		                        		<button type="submit" name="submit" class="search_btn">
		                        			<i class="fa fa-search"></i>
		                        		</button>
		                        	</form>
			                    </div>
			                </div>
		                </div>
		                <!-- category widget -->
		                <div class="deal_widget">
		                	<div class="d_widget_title">
		                		<h4>Category</h4>
		                	</div>
    						<div class="d_widget_content deal_category">
	                        	<ul>
								  <li><a href="#">Accommodation & Parking</a></li>               	   
								  <li><a href="#">Automotive</a></li>               	   
								  <li><a href="#">Bargins</a></li>               	   
								  <li><a href="#">Beauty, Massage & Spa</a></li>               	   
								  <li><a href="#">Camping & Outdoors</a></li>               	   
								  <li><a href="#">Clothing & Footwear</a></li>               	   
								  <li><a href="#">Motorhome, Caravan or Bus</a></li>         	   
								  <li><a href="#">Restaurants, Bars & cafes.</a></li>         	   
								  <li><a href="#">Services</a></li>         	   
								  <li><a href="#">Travel, Events & Activities</a></li>         	   
								  <li><a href="#">Other.</a></li>         	   
								</ul>
		                    </div>
		                </div>
		                <!-- category widget -->
		                  <!-- product type widget -->
		                <div class="deal_widget">
		                	<div class="d_widget_title">
		                		<h4>Location</h4>
		                	</div>
    						<div class="d_widget_content location_widget">
	                        	<div class="check_box">
	                        		<?php
							 $location = '';
                             $ff =  implode(',',$_REQUEST['location']); 
							
                                              if(!empty($ff)){											 
                                                $location = explode(',',$ff);
												//print_r($benifit_explode); die;
                                              } 
							if(isset($locations)){
							foreach($locations as  $c)	
							 {
							?>
								
	                        		<label>
	                        			<input type="checkbox" name="location[]" id="check<?php echo $c['id']; ?>"  value="<?php echo $c->id; ?>">
	                        			<span class="checked_box"></span>
	                        			<span class="check_text"><?php echo $c['name']; ?></span>
	                        		</label>
							<?php }} ?>
	                        		
	                        	</div>
		                    </div>
		                </div>
		                <!-- product type widget -->
    				</div>
    			</div>
    			<!-- Sidebar End -->

    			<div class="col-lg-8 col-md-12 col-sm-12">
		    		<div class="row">
				    	<div class="col-md-6 col-sm-12">
					    	<div class="deals_box">
					    		<div class="deal_img">
					    			<img src="<?php echo base_url();?>/public/front_end/images/deal/deal_img.jpg" class="img-fluid">
					    		</div>
					    		<div class="deal_detail">
					    			<h3><a href="deal_detail">company service package</a></h3>
					    			<div class="expiry_date_txt">
					    				<span class="first_spn"><i class="fa fa-calendar"></i>Expires on</span>
					    				<span>30-7-2019</span>
					    			</div>
					    			<p>
					    				Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium.
					    			</p>
					    			<div class="deal_container">
					    				<div class="left">
						    				<span class="price_from">Coupon code</span>
						    				<div class="coupon_code">
						    					zxc123
						    				</div>
						    			</div>
					    				<div class="right">
						    				<span class="price_from">from</span>
						    				<div class="price_dv">
						    					<span class="price_frst">$250</span>
						    					<span class="price_scnd">$200</span>
						    				</div>
						    			</div>
					    			</div>
					    		</div>
					    	</div>
				    	</div>
				    	<div class="col-md-6 col-sm-12">
					    	<div class="deals_box">
					    		<div class="deal_img">
					    			<img src="<?php echo base_url();?>/public/front_end/images/deal/deal_img2.jpg" class="img-fluid">
					    		</div>
					    		<div class="deal_detail">
					    			<h3><a href="<?php echo base_url(); ?>deal_detail/1">company service package</a></h3>
					    			<div class="expiry_date_txt">
					    				<span class="first_spn"><i class="fa fa-calendar"></i>Expires on</span>
					    				<span>30-7-2019</span>
					    			</div>
					    			<p>
					    				Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium.
					    			</p>
					    			<div class="deal_container">
					    				<div class="left">
						    				<span class="price_from">Coupon code</span>
						    				<div class="coupon_code">
						    					zxc123
						    				</div>
						    			</div>
					    				<div class="right">
						    				<span class="price_from">from</span>
						    				<div class="price_dv">
						    					<span class="price_frst">$250</span>
						    					<span class="price_scnd">$200</span>
						    				</div>
						    			</div>
					    			</div>
					    		</div>
					    	</div>
				    	</div>
				    	<div class="col-md-6 col-sm-12">
					    	<div class="deals_box">
					    		<div class="deal_img">
					    			<img src="<?php echo base_url();?>/public/front_end/images/deal/deal_img3.jpg" class="img-fluid">
					    		</div>
					    		<div class="deal_detail">
					    			<h3><a href="<?php echo base_url(); ?>deal_detail/1">company service package</a></h3>
					    			<div class="expiry_date_txt">
					    				<span class="first_spn"><i class="fa fa-calendar"></i>Expires on</span>
					    				<span>30-7-2019</span>
					    			</div>
					    			<p>
					    				Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium.
					    			</p>
					    			<div class="deal_container">
					    				<div class="left">
						    				<span class="price_from">Coupon code</span>
						    				<div class="coupon_code">
						    					zxc123
						    				</div>
						    			</div>
					    				<div class="right">
						    				<span class="price_from">from</span>
						    				<div class="price_dv">
						    					<span class="price_frst">$250</span>
						    					<span class="price_scnd">$200</span>
						    				</div>
						    			</div>
					    			</div>
					    		</div>
					    	</div>
				    	</div>
				    	<div class="col-md-6 col-sm-12">
					    	<div class="deals_box">
					    		<div class="deal_img">
					    			<img src="<?php echo base_url();?>/public/front_end/images/deal/deal_img.jpg" class="img-fluid">
					    		</div>
					    		<div class="deal_detail">
					    			<h3><a href="<?php echo base_url(); ?>deal_detail/1">company service package</a></h3>
					    			<div class="expiry_date_txt">
					    				<span class="first_spn"><i class="fa fa-calendar"></i>Expires on</span>
					    				<span>30-7-2019</span>
					    			</div>
					    			<p>
					    				Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium.
					    			</p>
					    			<div class="deal_container">
					    				<div class="left">
						    				<span class="price_from">Coupon code</span>
						    				<div class="coupon_code">
						    					zxc123
						    				</div>
						    			</div>
					    				<div class="right">
						    				<span class="price_from">from</span>
						    				<div class="price_dv">
						    					<span class="price_frst">$250</span>
						    					<span class="price_scnd">$200</span>
						    				</div>
						    			</div>
					    			</div>
					    		</div>
					    	</div>
				    	</div>
			    	</div>
    			</div>
    		</div>
    	</div>
    </div>
    <!-- Deals warapper --> 
   