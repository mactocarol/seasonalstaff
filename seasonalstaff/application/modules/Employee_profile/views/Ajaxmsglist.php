<?php if(isset($user)) { 
											foreach($user as $list){
											$photo = $list->image;
											?>
                                        <!-- user list start -->
                                        <a href="javascript:void(0);" onclick="user(<?php echo $list->id; ?>); users(<?php echo $list->id; ?>);">								
										<div id="cc<?php echo $list->id; ?>" class="find_user_list transition">
                                            <div class="thumbs">
											    <?php if($photo==''){ ?>
                                             <img src="<?php echo base_url(); ?>public/upload/userProfile/defaultuser.png">
                                                <?php } else {  ?>
											 <img src="<?php echo base_url(); ?>public/upload/userProfile/<?php echo $photo; ?>">
												<?php } ?>
											</div>
                                            <div class="user_right_text">
                                                <h5><?php echo $list->first_name; ?> <?php echo $list->last_name; ?></h5>
                                                <span class="times"><?php echo $list->no; ?></span>
                                            </div>
                                        </div>
										</a>
										<?php }}  ?>