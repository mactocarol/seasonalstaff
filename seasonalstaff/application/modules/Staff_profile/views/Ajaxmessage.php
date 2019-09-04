<div class="top_msg_heading" id="uheading">
	<h5><?php if(isset($msg[0]->rname)){ echo $msg[0]->rname; } ?>  <?php if(isset($msg[0]->rlname)){ echo $msg[0]->rlname; } ?></h5>
</div> 
<div class="chatscroll">
	<?php if(isset($msg)) {
	 foreach ($msg as $m) {
	 ?> 

	<!-- chat list -->
	<?php if($this->session->userdata('user_id')!=$m->sid) { ?>
	<div class="user_chat_list scnd_chat_list">
		<div class="chat_thumb_icon chat_thumb">
			<?php $photo = $m->image; 
			if($photo==''){
			?>
			<img src="<?php echo base_url(); ?>public/upload/userProfile/defaultuser.png" alt="">
			<?php } else { ?>
			<img src="<?php echo base_url(); ?>public/upload/userProfile/<?php echo $photo; ?>" alt="">
			<?php } ?>
		</div>
		<div class="chat_txt_box">
			<div class="chat_txt_body">
				<div class="chat_txt_inner">
					<p><?php echo  $m->message; ?></p>
				</div>
				<div class="chat_title">
				   <h6><?php echo $m->sname; ?></h6>
				   <span class="chat_time">
						<?php $pdate=$m->create_dt;
						$ftime=date("Y-m-d h:i:s",strtotime($pdate));
						$cdt = date("Y-m-d h:i:s"); 
						$cdt =  strtotime($cdt); 
						$ftime = strtotime($ftime);
						$datediff = ($cdt - $ftime); 

						$hrs= round($datediff / 3600);
						$day= round($datediff / 86400);
						$min= round($datediff / 60);
						$month= round($datediff / 60 / 60 / 24 / 30);
						$ago=0;
						if($min<60)
						{
						$ago=$min.' Min';
						}
						else if($min>=60&&$min<1440)
						{
						$ago=$hrs.' Hrs';
						}
						else if($min>=1440&&$min<43200)
						{
						$ago=$day.' Days';
						}
						else
						{
						$ago=$month.' Months';
						} ?>
						<?php echo $ago; ?>
					</span>
				</div>
			</div>
		</div>
	</div>
	 <?php } ?>
	<!-- chat list -->
	<!-- chat list -->
	<?php if($this->session->userdata('user_id')==$m->sid) { ?>
	<div class="user_chat_list first_chat_list">
		<div class="chat_thumb_icon">
			<?php $photo = $m->image; 
			if($photo==''){
			?>
			<img src="<?php echo base_url(); ?>public/upload/userProfile/defaultuser.png" alt="">
			<?php } else { ?>
			<img src="<?php echo base_url(); ?>public/upload/userProfile/<?php echo $photo; ?>" alt="">
			<?php } ?>
		</div>
		<div class="chat_txt_box">
			<div class="chat_txt_body">
				<div class="chat_txt_inner">
					<p> <?php echo  $m->message;?> </p>
				</div>
				<div class="chat_title">
					<span class="chat_time">
						<?php $pdate=$m->create_dt;
						$ftime=date("Y-m-d h:i:s",strtotime($pdate));
						$cdt = date("Y-m-d h:i:s"); 
						$cdt =  strtotime($cdt); 
						$ftime = strtotime($ftime);
						$datediff = ($cdt - $ftime); 

						$hrs= round($datediff / 3600);
						$day= round($datediff / 86400);
						$min= round($datediff / 60);
						$month= round($datediff / 60 / 60 / 24 / 30);
						$ago=0;
						if($min<60)
						{
						$ago=$min.' Min';
						}
						else if($min>=60&&$min<1440)
						{
						$ago=$hrs.' Hrs';
						}
						else if($min>=1440&&$min<43200)
						{
						$ago=$day.' Days';
						}
						else
						{
						$ago=$month.' Months';
						} ?>
						<?php echo $ago; ?>
					</span>
					<h6><?php echo $m->sname; ?></h6>
				</div>
			</div>
		</div>
	</div>
	<?php  } ?>
	<!-- chat list -->
			                               
		                             
<?php }} ?>
</div>


 