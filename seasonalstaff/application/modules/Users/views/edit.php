<?php print_r($data);?>
<?php $this->load->view('admin/includes/sidebar'); ?>

<!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">

    <!-- Content Header (Page header) -->
     <section class="content-header">
      <h1>
        Edit User
        <small>Control panel</small>
      </h1>

      <ol class="breadcrumb">
        <li><a href="<?php echo site_url('admin/dashboard');?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Edit user</li>
      </ol>
    </section>



    <!-- Main content -->
    <section class="content"> 
	<!-- Main row -->
      <div class="row">
        <!-- Left col -->
			<?php
			if($this->session->flashdata('item')) {
				$items = $this->session->flashdata('item');
				if($items->success){
				?>

         <section class="col-lg-7 connectedSortable">
					<div class="alert alert-success" id="alert">
							<strong>Success!</strong> <?php print_r($items->message); ?>
					</div>
          </section> 
		  <?php
				}else{
				?>

         <section class="col-lg-7 connectedSortable">
					<div class="alert alert-danger" id="alert">
							<strong>Error!</strong> <?php print_r($items->message); ?>
					</div>
          </section>   
				<?php
				}}
				?>

                 

        <section class="col-lg-12 connectedSortable"> 
               <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Edit User</h3>
                    <button class="btn btn-danger pull-right"><a href="<?php echo site_url('users-list'); ?>" style="color:white">Go to User List</a></button>
                </div>

                <!-- /.box-header -->

                <div class="box-body">
                  <form role="form" id="edit_user_by_admin" name="" method="post" action="<?php echo site_url().'edit-user/'.$reslt->id; ?>" >
				  <!-- text input -->

                        <section class="col-lg-4 connectedSortable">
                            
							<div class="form-group">
                                <label>First Name </label>
                                <input type="text" class="form-control" name="f_name" placeholder="First Name" value="<?php echo (!empty($reslt->first_name)) ? $reslt->first_name : ''?>">
                             </div>
							 

                             <div class="form-group">
                                <label>Username </label>
                                <input type="text" class="form-control" name="username" placeholder="User Name" value="<?php echo (!empty($reslt->username)) ? $reslt->username : ''?>">
                             </div>
							 
                             <!-- <div class="form-group">
                                <label>Gender </label>
                                <select class="form-control" name="gender">
                                  <option  value="">Select Gender</option>
                                  <option <?php echo ($reslt->gender=='Male') ? 'selected' : ''; ?> value="Male">Male</option>
                                  <option <?php echo ($reslt->gender=='Female') ? 'selected' : ''; ?> value="Female">Female</option>
                                  <option <?php echo ($reslt->gender=='Other') ? 'selected' : ''; ?> value="Other">Other</option>
                                </select>
                             </div> -->
							 

                             <div class="form-group">
                                <label>Location </label>

                                 <input name="mapaddress" id="mapaddress" type="text" placeholder="Enter Google Map Address" value="<?php echo (!empty($reslt->business_location)) ? $reslt->	business_location : ''?>" class="form-control">								 
								 
								 
								<input  type="hidden" name="cityc" id="cityc" value="<?php echo (!empty($reslt->city2)) ? $reslt->city2 : ''?>" class="form-control" placeholder="Enter longitude">

								<input  type="hidden" name="longitude" id="longitude" value="<?php echo (!empty($reslt->cityLat)) ? $reslt->cityLat : ''?>" class="form-control" placeholder="Enter longitude">
								 
							    <input type="hidden" name="latitude" id="latitude" value="<?php echo (!empty($reslt->cityLng)) ? $reslt->cityLng : ''?>" class="form-control" placeholder="Enter latitude">
								 
								 
								 
								 
                             </div>				

                           </section>

						   <section class="col-lg-4 connectedSortable">
						   
                            <!-- <div class="form-group">
                                <label>Middle Name </label>
                                <input type="text" class="form-control" name="m_name" placeholder="Middle Name" value="<?php echo (!empty($reslt->middle_name)) ? $reslt->middle_name : ''?>">
                             </div> -->

                             <div class="form-group">
                                <label>Email </label>
                                <input type="email" class="form-control" name="email" placeholder="Email" value="<?php echo (!empty($reslt->email)) ? $reslt->email : ''?>">
                             </div>


							 <!-- <div class="form-group">
                                <label>Plans </label>
                                <select name="plan" class="form-control">
                                <option value="">Select Plan</option>
                                <?php
                                  if(!empty($plan)){
                                    foreach ($plan as  $plans) {                                      
                                ?>
                                <option <?php echo ( $reslt->plan_id == $plans['id']) ? 'selected' : ''?>  value="<?php echo !empty($plans['id']) ? $plans['id'] : ''  ?>"><?php echo !empty($plans['name']) ? $plans['name'] : ''  ?></option>
                                <?php
                              }
                              }
                             ?>
						    </select>
						    </div> -->

							 
						<!-- <div class="form-group">
                                <label>Country </label>                               
                                <select class="form-control" name="country">
                                  <option value="">Select Country</option>
                                  <?php
                                    if(!empty($country)){
                                      foreach($country as $c){
                                        ?>

                                        '<option <?php echo ($reslt->country == $c['Name']) ? 'selected' : ''?>  value="<?php echo  $c['Name']; ?>"><?php echo $c['Name']; ?></option>';
                                        <?php
                                      }
                                    }else{
                                      echo '<option value="">No Country Found</option>';
                                    }
                                  ?>                                  
                                </select>
                             </div> -->
							 
							 
							  <div class="form-group">
                                <label>Contact Number </label>
                                <input type="text" class="form-control" name="contact" placeholder="Contact Number" value="<?php echo (!empty($reslt->contact_number)) ? $reslt->contact_number : ''?>">
                             </div>	
							 
							  
                              <div class="form-group">
                                <label>Role </label>
                               <select name="role" class="form-control" readonly>
                                <option value="">Select Role</option>                                
                                 <option value="employer" <?php if($reslt->role=='employer'){ echo 'selected';} ?>>Employer</option>
								 <option value="staff" <?php if($reslt->role=='staff'){ echo 'selected';} ?>>Staff</option>
								  
                               </select>
                              </div>	
							  
							 

                            <!--  <div class="form-group">
                                <label>Confirm Password</label>
                                <input type="password" class="form-control" id="repassword" name="repassword" placeholder="Confirm Password" value="">
                             </div> -->
                          

                           </section>
						   


						   <section class="col-lg-4 connectedSortable">
                            
							<div class="form-group">
                                <label>Last Name </label>
                                <input type="text" class="form-control" name="l_name" placeholder="Last Name" value="<?php echo (!empty($reslt->last_name)) ? $reslt->last_name : ''?>">

                             </div>
							 
                             <!-- <div class="form-group">
                                <label>Birth's Date </label>
                                <input class="form-control" value="<?php echo (date('Y',strtotime($reslt->dob))!= '1970') ? date('M-d-Y',strtotime($reslt->dob)) : ''; ?>" id="" name="dob" placeholder="MM-DD-YYY" type="text" />
                             </div> -->

                             

                             <div class="form-group">
                                <label>Offers </label>
                                <select name="offers" class="form-control">
                                <option value="">Select offers</option>
                               <?php
                                  if(!empty($offers)){
                                    foreach ($offers as  $offer) {
                                      
                                ?>

                                <option <?php echo ( $reslt->offer_id == $offer['offer_name']) ? 'selected' : ''?> value="<?php echo !empty($offer['offer_name']) ? $offer['offer_name'] : ''  ?>"><?php echo !empty($offer['offer_name']) ? $offer['offer_name'] : ''  ?></option>
                                <?php
                              }
                            } ?>

                               </select>
                             </div> 
							 
							
							
							
							<!-- <div class="form-group">
                                <label>Password </label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Password" value="">
                             </div> -->
							 

                             <div class="box-footer">
                                <input type="submit" class="btn btn-primary" name="Update_profile" value="Update">

                             </div>

                           </section>                        

                  </form>
				     </div>

                     <hr>
				  
				     <div class="box-body">
				     <form role="form" id="edit_user_by_admin12" name="" method="post" action="<?php echo site_url().'edit-user/'.$reslt->id; ?>" >
				  <!-- text input -->

                         <section class="col-lg-12 connectedSortable"> 						  
						    <section class="col-lg-6 connectedSortable">
						    
							<div class="form-group">
                                <label>Password </label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Password" value="" required>
                             </div>                                               

							 
							</section> 
							 
							 <section class="col-lg-6 connectedSortable">
						               				
	                          <div class="box-footer">							  
                                <input type="submit" class="btn btn-primary" name="Update_pass" value="Update password" style="margin-top: 11px;">
                             </div>                                            
            				 </section> 
                
           				</section>    							 
                             
                            
                  </form>

                </div>

               </div>

        </section>

        <!-- /.Left col -->

   

    </div>



    </section>

    <!-- /.content -->

  </div>



<script type="text/javascript">
function initialize1() {
        var input = document.getElementById('mapaddress');
        var autocomplete = new google.maps.places.Autocomplete(input);
        autocomplete.setComponentRestrictions(
            //{'country': ['nz','all']},
			{'country': ['nz','al']});


		 //var autocomplete = new google.maps.places.Autocomplete(input,options);	
        google.maps.event.addListener(autocomplete, 'place_changed', function () {
            var place = autocomplete.getPlace();
            document.getElementById('cityc').value = place.name;
            document.getElementById('latitude').value = place.geometry.location.lat();
            document.getElementById('longitude').value = place.geometry.location.lng();
            //alert("This function is working!");
            //alert(place.name);
           // alert(place.address_components[0].long_name);
		   
		   var latlng = new google.maps.LatLng(place.geometry.location.lat(),place.geometry.location.lng());
        var myOptions =
        {
            zoom: 8,
            center: latlng,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            disableDefaultUI: true
        };
        map = new google.maps.Map(document.getElementById("map"), myOptions);

        });
    }
    google.maps.event.addDomListener(window, 'load', initialize1);
</script>



<script>
    $(document).ready(function(){
      var date_input=$('input[name="dob"]'); //our date input has the name "date"
    var options={
        // format: 'mm-dd-yyyy',
         todayHighlight: true,
        autoclose: true,
      };
      date_input.datepicker(options);
    })	
</script>