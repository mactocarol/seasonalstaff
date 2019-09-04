 <?php if(isset($stafflist)){
                                   foreach($stafflist as $list) {
								 $userphoto = $list->image;
								 ?>
								<!-- search list Start -->
								<div class="search_list">
									<div class="row">
										<div class="col-lg-2">
										<?php if($userphoto==''){?>
											<a href="#" class="thumb"><img src="<?php echo base_url(); ?>public/upload/userProfile/defaultuser.png" alt="Staff"></a>
										<?php } else {  ?>
											<a href="#" class="thumb"><img src="<?php echo base_url(); ?>public/upload/userProfile/<?php echo $userphoto; ?>" alt="Staff" height="100px"></a>
										<?php } ?>
										</div>
										<div class="col-lg-10">
											<div class="row">
												<div class="col-lg-9">
													<h3><?php echo $list->first_name; ?> <?php echo $list->last_name; ?></h3>
													<ul>
													<li><label>Current location :</label> <?php if($list->current_location=='') {echo 'NA' ;} else { echo $list->current_location; } ?></li>
														<li><label>Avaliable to work from :</label> <?php if($list->available_date=='') { echo 'NA';} else { echo $list->available_date; } ?>	</li>
														<li><label>Eligible to work in NZ :</label> <?php if($list->eligibility_address=='') { echo 'NA';} else { echo $list->eligibility_address; } ?> </li>
														<li><label>Level of English :</label> <?php if($list->level_english=='') { echo 'NA';} else { echo $list->level_english; } ?>	</li>
														
														<?php $skills = $list->sklills_description; 
														$avalue=(unserialize($skills));
														?>
														<li><label>Key skills :</label> <?php if($list->sklills_description=='') { echo 'NA';} else { foreach($avalue as $sk){echo $sk; }} ?> </li>
														
														<li><label>level of fitness :</label> <?php if($list->level_fitness=='') { echo 'NA';} else { echo $list->level_fitness; } ?></li>
													</ul>
												</div>
												<div class="col-lg-3 pad_l_0">
													<div class="list-action">
														<a href="<?php echo base_url(); ?>staff-detail/<?php echo $list->id; ?>">Find Out More</a>
														<div class="wish-list"> 
															<button type="button" class="heart-btn shortlist">
																<i class="fa fa-heart"></i>
															</button>
														</div>
													</div>
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
													<div class="search-meta-data">											
								   Last Online : <?php if($list->onlineuserdate=='0000-00-00 00:00:00'){ echo 'NA'; } else {echo getago($list->onlineuserdate); } ?>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							   <?php }}
echo $this->ajax_pagination->create_links(); 
							   ?>