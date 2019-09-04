<div class="breadcrumb text-center">
    <div class="container">
    <h1>looking for Work Annual Membership</h1>
    <ul><li><a href="#">home</a></li><li>Membership </li></ul>
    </div>
</div>
<!-- breadcrumb section End -->
<!-- Content section Start -->
<div class="content-section emp_price_section">
    <div class="container">
        <div class="row">
            <div class="col-xl-6 col-lg-8 col-md-12 col-sm-12 offset-lg-2 offset-xl-3">
              <div class="emp_price_form">
              	<div class="form_heading">
              	Membership 
              	</div>
                   <?php 
               		     //$payment_url  = "https://www.sandbox.paypal.com/cgi-bin/webscr";
						  $payment_url  = "https://www.paypal.com/cgi-bin/webscr";
						// $merchant_email="suraj.pandagre-facilitator@imphasys.com";
						  $merchant_email="info@seasonalstaff.co.nz";
						  
                          ?>
                          <form action="<?php echo $payment_url; ?>" method="post" id="serviceform" class="sky-form" novalidate>
              		<?php 
					//echo '<pre>';									
					/* if(count($coupon_code)==1){	
				         $price = 49;
						 $wal = 49;
					     
						 if($coupon_code[0]->discount_amount!="null"){							
							 $cprice= $coupon_code[0]->discount_amount;
							 $c=$cprice;
							 $wal = $price-$c;  
					 
						 }
						 
   					     if($coupon_code[0]->discount_percentage!="null"){					
							 $cprice = $coupon_code[0]->discount_percentage;
							 $c1=$cprice*$price;						
							 $c2=$c1/100;
						     $wal=$price-$c2; 
						 }                       					 
					     }
						 else {
					     $wal = 49;	
					     }	*/	
						 $wal=$pricingstaff[0]->price;
					?>
					<div class="form_group">
              			<div class="radio_box">						
              				<div>
	              				<label>
	              					<input type="radio" name="pricing" id="pricing" value="<?php echo $wal; ?>"
									checked>								
	              					<span class="r_check"></span>
	              					<span class="r_text">Pay $<?php echo $wal; ?> NZD Annually </span>
	              				</label>
              				</div>
						
              			              				
              			</div>
              		</div>
              		<!-- <div class="form_group">
              			<button class="blue_button p_btns" type="submit" value="Pay" name="submit">Pay</button>
              			<button class="blue_button p_btns" type="submit" value="Skip" name="submit">Skip</button>
              		</div> -->
					
				            <input type="hidden" name="cancel_return" value="<?php echo base_url(); ?>Staff_profile/Staffprofile/cancel">
                            <input type="hidden" name="return" value="<?php echo base_url(); ?>Staff_profile/Staffprofile/success">
                            <input type="hidden" name="business" value="<?php echo $merchant_email; ?>">
                            <input type="hidden" name="cmd" value="_xclick">
                            <input type="hidden" name="item_name" value="#" >
                            <input type="hidden" name="item_number" id="item_name" value="staff yearly membership">
                            <input type="hidden" name="credits" value="510">
                            <input type='hidden' name='rm' value='2'>
                            <input type="hidden" name="userid" value="1">
                            <input type='hidden' name='custom' value='<?php echo $this->session->userdata('user_id'); ?>'>
                            <!-- <input type="hidden" name="amount" id="amount" value="<?php if($wal==""){ echo 49;} else { echo $wal; }?>"> -->
							
							<input type="hidden" name="amount" id="amount" value="<?php if($wal==""){ echo 49;} else { echo $wal; }?>">							
							
							
                            <input type="hidden" name="cpp_header_image" value="<?php echo base_url(); ?>front/images/logo.png">
                            <input type="hidden" name="no_shipping" value="1">
                            <input type="hidden" name="currency_code" value="NZD">
                            <input type="hidden" name="handling" value="0">
							<?php if($wal==0){ ?>
							<a href="<?php echo base_url(); ?>Staff_profile/Staffprofile/successdiscount" class="blue_button p_btns">Pay now</a> 
							<?php } else { ?>
                            <input type="submit" class="blue_button p_btns" id="ptpay" value="Pay now"/>
                            <?php } ?>							
					        <!-- <a href="<?php echo base_url(); ?>staff-profile/" class="blue_button p_btns">Skip</a> -->
              	</form>
              </div>
            </div>
		</div>
    </div>
</div>
<!-- Content section End -->
<script>
function handleChange(staff)
{
var strArray = staff.split(" ");
var myvar = strArray[0];
var myvar1 = strArray[1];
document.getElementById("item_name").value = myvar;
document.getElementById("amount").value = myvar1;
}
</script>