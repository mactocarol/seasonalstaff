<div class="breadcrumb text-center">
    <div class="container">
    <h1>Membership</h1>
    <ul><li><a href="#">home</a></li><li>Membership</li></ul>
    </div>
</div>
<!-- breadcrumb section End -->
<!-- Content section Start -->
<div class="content-section emp_price_section">
    <div class="container">
        <div class="row">
            <div class="col-xl-6 col-lg-8 col-md-12 col-sm-12 offset-lg-2 offset-xl-3">
              <div class="emp_price_form">
              	 <span id="mmh" class="paytext">Please select the type of membership you need</span> 
				<div class="form_heading">
              	Please choose your Membership Plan
              	</div>
                   <?php 
               		     //$payment_url  = "https://www.sandbox.paypal.com/cgi-bin/webscr";
						 //$merchant_email="suraj.pandagre-facilitator@imphasys.com";
						 $payment_url  = "https://www.paypal.com/cgi-bin/webscr";
						 $merchant_email="info@seasonalstaff.co.nz";
						  
                          ?>
                          <form action="<?php echo $payment_url; ?>" method="post" id="serviceform" class="sky-form" novalidate>
              		<div class="form_group">
              			<div class="radio_box">
						<?php
						 if(isset($price)) {
                         foreach($price as $pr) { 
                         if(count($coupon_code)==1){	
				        
						 if($coupon_code[0]->discount_amount!="null"){
							 $price = $pr->price;
							 $cprice= $coupon_code[0]->discount_amount;
							 $c=$cprice;
							$wal = $price-$c;
							
							$pp1 =  $wal*15;
						    $pp1 =  $pp1/100;
						    $ppm1 =  $wal+$pp1;
							 ?>                          
						  <div>
	              				<label>
	              					<input type="radio" name="pricing" id="pricing" value="<?php echo $pr->staff; ?> <?php echo $wal; ?> <?php echo $pp1; ?>" onchange='handleChange(this.value);'>
	              					<span class="r_check"></span>
	              					<span class="r_text">Needing <?php echo $pr->staff; ?> <?php if($pr->staff >= 500) { echo '+';} ?>Staff ($<?php echo $wal; ?> NZD +15% GST) = $<?php echo $ppm1; ?> NZD</span>
	              				</label>
              				</div>
					 
						 <?php }
						 
   					     if($coupon_code[0]->discount_percentage!="null"){
							  $price = $pr->price;
							 $cprice = $coupon_code[0]->discount_percentage;
							 $c1=$cprice*$price;						
							 $c2=$c1/100;
						    $wal=$price-$c2; 
						    //echo $wal; die;
						   if(gettype($wal)=="double"){
							  
							 setlocale(LC_MONETARY,"en_US");   
                            $wal = money_format1("%.2n", $wal);
							$wal = str_replace('$', '', $wal);
							$wal = str_replace(',', '.', $wal);
						   $wal=$wal;  
						  }
						  
						  $pp1 =  $wal*15;
						  $pp1 =  $pp1/100;
						  if(gettype($pp1)=="double"){
							  
							setlocale(LC_MONETARY,"en_US");   
                            $pp1 = money_format1("%.2n", $pp1);
							$pp1 = str_replace('$', '', $pp1);
							$pp1 = str_replace(',', '.', $pp1);
							$pp1=$pp1;  
						  }
						  $ppm1 =  $wal+$pp1;
						 ?>
						 <div>
	              				<label>
	              					<input type="radio" name="pricing" id="pricing" value="<?php echo $pr->staff; ?> <?php echo $wal; ?> <?php echo $pp1; ?>" onchange='handleChange(this.value);'>
	              					<span class="r_check"></span>
	              					<span class="r_text">Needing <?php echo $pr->staff; ?> <?php if($pr->staff >= 500) { echo '+';} ?>Staff ($<?php echo $wal; ?> NZD +15% GST) = $<?php echo $ppm1; ?> NZD</span>
	              				</label>
              				</div>
						 
						<?php  }                       					 
					     }
						 else { 
						  $wal='null';	                         					  
						  $pp =  $pr->price*15;
						  $pp =  $pp/100;
						  $ppm =  $pr->price+$pp;
						 ?>
						  <div>
	              				<label>
	              					<input type="radio" name="pricing" id="pricing" value="<?php echo $pr->staff; ?> <?php echo $pr->price; ?> <?php echo $pp; ?>" onchange='handleChange(this.value);'>
	              					<span class="r_check"></span>
	              					<span class="r_text">Needing <?php echo $pr->staff; ?> <?php if($pr->staff >= 500) { echo '+';} ?>Staff ($<?php echo  $pr->price; ?> NZD +15% GST) = $<?php echo $ppm; ?> NZD </span>
	              				</label>
              				</div>
						 
							 
						 <?php }
						 
						
						 } }
                         //echo $wal; die;
						?>
						<?php //if(isset($price)) {
                         //foreach($price as $pr) {                
     					 ?>
              				<!-- <div>
	              				<label>
	              					<input type="radio" name="pricing" id="pricing" value="<?php echo $pr->staff; ?> <?php echo $pr->price; ?>" onchange='handleChange(this.value);'>
	              					<span class="r_check"></span>
	              					<span class="r_text">Needing <?php echo $pr->staff; ?> <?php if($pr->staff >= 500) { echo '+';} ?>Staff ($<?php echo $pr->price; ?> +GST)</span>
	              				</label>
              				</div> -->
						<?php //}}  ?>
              			              				
              			</div>
              		</div>
              		<!-- <div class="form_group">
              			<button class="blue_button p_btns" type="submit" value="Pay" name="submit">Pay</button>
              			<button class="blue_button p_btns" type="submit" value="Skip" name="submit">Skip</button>
              		</div> -->
					
				            <input type="hidden" name="cancel_return" value="<?php echo base_url(); ?>Employee_profile/Profile/cancel">
                            <input type="hidden" name="return" value="<?php echo base_url(); ?>Employee_profile/Profile/success">
                            <input type="hidden" name="business" value="<?php echo $merchant_email; ?>">
                            <input type="hidden" name="cmd" value="_xclick">
                            <input type="hidden" name="item_name" value="#" >
                            <input type="hidden" name="item_number" id="item_name" value="">
                            <input type="hidden" name="credits" value="510">
                            <input type='hidden' name='rm' value='2'>
                            <input type="hidden" name="userid" value="1">
                            <input type='hidden' name='custom' value='<?php echo $this->session->userdata('user_id'); ?>'>
                            <input type="hidden" name="amount" id="amount" value="">
							<input type="hidden" name="tax" id="tax" value="">
                            <input type="hidden" name="cpp_header_image" value="<?php echo base_url(); ?>front/images/logo.png">
                            <input type="hidden" name="no_shipping" value="1">
                            <input type="hidden" name="currency_code" value="NZD">
                            <input type="hidden" name="handling" value="0">
							<div class="text-center">
							<?php 							
							if($wal===0){ ?>
							<span id="bbd">
							<a href="JavaScript:Void(0);" class="blue_button p_btns">Pay</a>							
							</span>
							<span id="bbds">
							<a href="<?php echo base_url(); ?>Employee_profile/Profile/successdiscount" class="blue_button p_btns" disabled>Pay</a>							
							</span>
							<?php } else {  ?>
                            <input type="submit" class="blue_button p_btns" id="ptpay" value="Pay"/ disabled>
							<?php } ?>	
							</div>
					      
              	</form>
              </div>
            </div>
		</div>
    </div>
</div>
<!-- Content section End -->
<script>
$( document ).ready(function() {
document.getElementById("bbds").style.display = "none";
});

function handleChange(staff)
{
var strArray = staff.split(" ");
var myvar = strArray[0];
var myvar1 = strArray[1];
var myvar2 = strArray[2];
document.getElementById("item_name").value = myvar;
document.getElementById("amount").value = myvar1;
document.getElementById("tax").value = myvar2;
document.getElementById("mmh").style.display = "none";
if(myvar1!=0){
document.getElementById("ptpay").disabled = false;
}
document.getElementById("bbd").style.display = "none";
document.getElementById("bbds").style.display = "block";

}
</script>