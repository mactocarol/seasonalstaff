<?php $this->load->view('admin/includes/sidebar'); ?>

<!-- Content Wrapper. Contains page content -->





  <div class="content-wrapper">

    <!-- Content Header (Page header) -->

    <section class="content-header">

      <h1>

        Edit Staff

        <small>Control panel</small>

      </h1>

      <ol class="breadcrumb">

        <li><a href="<?php echo site_url('admin/dashboard');?>"><i class="fa fa-dashboard"></i> Home</a></li>

        <li class="active">Edit Staff</li>

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

        }

      }

      ?>

                 

        <section class="col-lg-12 connectedSortable">

             

               <div class="box">

                <div class="box-header">

                  <h3 class="box-title">Edit Staff</h3>

                    <button class="btn btn-danger pull-right"><a href="<?php echo site_url('staff-list'); ?>" style="color:white">Go to Staff List</a></button>

                </div>

                <!-- /.box-header -->

                <div class="box-body">

                  <form role="form" id="edit_Staff_by_admin" name="" method="post" action="<?php echo site_url().'edit-staff/'.$reslt->id; ?>" >

                        <!-- text input -->

                        <section class="col-lg-4 connectedSortable">

                             <div class="form-group">

                                <label>First Name </label>

                                <input type="text" class="form-control" name="f_name" placeholder="First Name" value="<?php echo (!empty($reslt->first_name)) ? $reslt->first_name : ''?>">

                             </div>

                             <div class="form-group">

                                <label>Staffname </label>

                                <input type="text" class="form-control" name="Staffname" placeholder="Staff Name" value="<?php echo (!empty($reslt->Staffname)) ? $reslt->Staffname : ''?>">

                             </div>

                             <div class="form-group">

                                <label>Gender </label>

                               <!--  <input type="text" class="form-control" name="gender" placeholder="Gender" value="<?php echo (!empty($reslt->gender)) ? $reslt->gender : ''?>"> -->
                                <select class="form-control" name="gender">
                                  <option  value="">Select Gender</option>
                                  <option <?php echo ($reslt->gender=='Male') ? 'selected' : ''; ?> value="Male">Male</option>
                                  <option <?php echo ($reslt->gender=='Female') ? 'selected' : ''; ?> value="Female">Female</option>
                                  <option <?php echo ($reslt->gender=='Other') ? 'selected' : ''; ?> value="Other">Other</option>
                                </select>

                             </div>

                             <div class="form-group">

                                <label>Location </label>

                                <!-- <input type="text" class="form-control" name="mapaddress" placeholder="Mapaddress" value=""> -->

                                 <input name="mapaddress" id="mapaddress" type="text" placeholder="Enter Google Map Address" value="<?php echo (!empty($reslt->map_address)) ? $reslt->map_address : ''?>" class="form-control">

                             </div>

                            

                               <div class="form-group">

                                <label>Password </label>

                                <input type="password" class="form-control" id="password" name="password" placeholder="Password" value="">

                             </div>

                           

                           </section>





                           <section class="col-lg-4 connectedSortable">

                             <div class="form-group">

                                <label>Middle Name </label>

                                <input type="text" class="form-control" name="m_name" placeholder="Middle Name" value="<?php echo (!empty($reslt->middle_name)) ? $reslt->middle_name : ''?>">

                             </div>

                             <div class="form-group">

                                <label>Email </label>

                                <input type="email" class="form-control" name="email" placeholder="Email" value="<?php echo (!empty($reslt->email)) ? $reslt->email : ''?>">

                             </div>

                             <div class="form-group">

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

                                

                             </div>

                             <div class="form-group" style="display:none">

                                <label>Longitude </label>

                                <!-- <input type="text" class="form-control" name="longitude" placeholder="Email" value=""> -->

                                <input onchange="showPositionlat()" type="text" name="longitude" id="longitude" value="<?php echo (!empty($reslt->longitude)) ? $reslt->longitude : ''?>" class="form-control" placeholder="Enter longitude">

                             </div>

                             <div class="form-group" style="display:none">

                                <label>Address </label>

                                <input type="text" class="form-control"  name="address" placeholder="Address" value="<?php echo (!empty($reslt->address)) ? $reslt->address : ''?>">

                             </div>
                              <div class="form-group">

                                <label>Country </label>

                                <!-- <input type="text" class="form-control" name="country" placeholder="Country" value="<?php echo (!empty($reslt->country)) ? $reslt->country : ''?>"> -->

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

                             </div>

                             <div class="form-group">

                                <label>Confirm Password</label>

                                <input type="password" class="form-control" id="repassword" name="repassword" placeholder="Confirm Password" value="">

                             </div>

                          

                           </section>





                           <section class="col-lg-4 connectedSortable">

                             <div class="form-group">

                                <label>Last Name </label>

                                <input type="text" class="form-control" name="l_name" placeholder="Last Name" value="<?php echo (!empty($reslt->last_name)) ? $reslt->last_name : ''?>">

                             </div>
                              <div class="form-group">


                                <label>Birth's Date </label>

                                <input class="form-control" value="<?php echo (date('Y',strtotime($reslt->dob))!= '1970') ? date('M-d-Y',strtotime($reslt->dob)) : ''; ?>" id="" name="dob" placeholder="MM-DD-YYY" type="text" />


                             </div>

                             <div class="form-group">

                                <label>Contact Number </label>

                                <input type="number" class="form-control" name="contact" placeholder="Contact Number" value="<?php echo (!empty($reslt->contact_number)) ? $reslt->contact_number : ''?>">

                             </div>

                             <div class="form-group">

                                <label>Offers </label>

                                <select name="offers" class="form-control">

                                <option value="">Select offers</option>
                               <?php
                                  if(!empty($offers)){
                                    foreach ($offers as  $offer) {
                                      
                                ?>

                                <option <?php echo ( $reslt->offer_id == $offer['id']) ? 'selected' : ''?> value="<?php echo !empty($offer['id']) ? $offer['id'] : ''  ?>"><?php echo !empty($offer['offer_name']) ? $offer['offer_name'] : ''  ?></option>
                                <?php
                              }
                            }
                         ?>

                               </select>

                             </div>
                              <div class="form-group">

                                <label>Role </label>

                               <select name="role" class="form-control">

                                <option value="">Select Role</option>
                                <?php
                                $roleId = $reslt->role;

                                  if(!empty($role)){
                                    foreach ($role as  $roles) {
                                      
                                ?>

                                <option  <?php echo ( $roleId == $roles['id']) ? 'selected' : ''?>  value="<?php echo !empty($roles['id']) ? $roles['id'] : ''  ?>">   <?php echo !empty($roles['role']) ? $roles['role'] : ''  ?>       </option>
                                <?php
                              }
                            }
                         ?>


                               </select>


                             </div>

                             <div class="form-group" style="display:none">

                                <label>Latitude </label>

                                <!-- <input type="text" class="form-control" name="latitude" placeholder="latitude" value=""> -->

                               <input onchange="showPositionlat()" type="text" name="latitude" id="latitude" value="<?php echo (!empty($reslt->latitude)) ? $reslt->latitude : ''?>" class="form-control" placeholder="Enter latitude">

                             </div>

                            

                            

                             <div class="box-footer">

                                <input type="submit" class="btn btn-primary" name="Update_profile" value="Update">

                                

                             </div>

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

    function initialize() {

        var input = document.getElementById('mapaddress');

        var autocomplete = new google.maps.places.Autocomplete(input);



        google.maps.event.addListener(autocomplete, 'place_changed', function () {

            var place = autocomplete.getPlace();

            document.getElementById('latitude').value = place.geometry.location.lat();

            document.getElementById('longitude').value = place.geometry.location.lng();

           

   

    var latlng = new google.maps.LatLng(place.geometry.location.lat(), place.geometry.location.lng());

        var myOptions =

        {

            zoom: 8,

            center: latlng,

            mapTypeId: google.maps.MapTypeId.ROADMAP,

            disableDefaultUI: true

        };

        map = new google.maps.Map(document.getElementById("map"), myOptions);



    var marker = new google.maps.Marker({

        position: latlng,

        map: map,



    title:''

    });



var infowindow = new google.maps.InfoWindow({

    content: $("#mapaddress").val()

});

        

          

        google.maps.event.addListener(marker, 'mouseover', function() {

            infowindow.open(map,marker);   

        });

    

        });

    }

    google.maps.event.addDomListener(window, 'load', initialize); 

  

  $( document ).ready(function() {

  

    if (navigator.geolocation) {

        navigator.geolocation.getCurrentPosition(showPosition);

    

    } else { 

        x.innerHTML = "Geolocation is not supported by this browser.";

    }

}); 

  

function showPosition(position) {



  var lt=$("#latitude").val();

  if(lt!="")

  {

    var lg=$("#longitude").val();

    var latlng = new google.maps.LatLng(lt,lg); 

  }

  else{

  var latlng = new google.maps.LatLng(40.1791857, 44.499102900000025);

    }

  

    var myOptions =

        {

            zoom: 8,

            center: latlng,

            mapTypeId: google.maps.MapTypeId.ROADMAP,

            disableDefaultUI: true

        };

        map = new google.maps.Map(document.getElementById("map"), myOptions);



    var marker = new google.maps.Marker({

        position: latlng,

        map: map,

    title:''

    });



        var geocoder = new google.maps.Geocoder;

        var infowindow = new google.maps.InfoWindow;



        geocodeLatLng1(geocoder, map, infowindow);

  

}



function showPositionlat() {

      var lt=$("#latitude").val();

    var lg=$("#longitude").val();

    

    if(lt!="" && lg!="")

    {

    var latlng = new google.maps.LatLng(lt,lg); 

  

    var myOptions =

        {

            zoom: 8,

            center: latlng,

            mapTypeId: google.maps.MapTypeId.ROADMAP,

            disableDefaultUI: true

        };

        map = new google.maps.Map(document.getElementById("map"), myOptions);

    var marker = new google.maps.Marker({

        position: latlng,

        map: map,

    title:''

        });

    }



        var geocoder = new google.maps.Geocoder;

        var infowindow = new google.maps.InfoWindow;



        document.getElementById('longitude').addEventListener('keyup', function() {

          geocodeLatLng(geocoder, map, infowindow);

        });



        document.getElementById('latitude').addEventListener('keyup', function() {

          geocodeLatLng(geocoder, map, infowindow);

        });

}



function geocodeLatLng(geocoder, map, infowindow) {

         var lt=$("#latitude").val();

     var lg=$("#longitude").val();

     if(lg=="")

     {

    var latlng = {lat: parseFloat(40.1791857), lng: parseFloat(44.499102900000025)};   

     }

     else{

        var latlng = {lat: parseFloat(lt), lng: parseFloat(lg)};

     }

    console.log(latlng);

        geocoder.geocode({'location': latlng}, function(results, status) {

          if (status === 'OK') {

            if (results[0]) {

              map.setZoom(11);

              var marker = new google.maps.Marker({

                position: latlng,

                map: map

              });

              infowindow.setContent(results[0].formatted_address);

              $("#mapaddress").val(results[0].formatted_address);

              infowindow.open(map, marker);

            } else {

              //window.alert('No results found');

            }

          } else {

            //window.alert('Geocoder failed due to: ' + status);

          }

        });

      }

    

    function geocodeLatLng1(geocoder, map, infowindow) {

         var lt=$("#latitude").val();

     var lg=$("#longitude").val();

     if(lg=="")

     {

    var latlng = {lat: parseFloat(40.1791857), lng: parseFloat(44.499102900000025)};   

     }

     else{

        var latlng = {lat: parseFloat(lt), lng: parseFloat(lg)};

     }

    console.log(latlng);

        geocoder.geocode({'location': latlng}, function(results, status) {

          if (status === 'OK') {

            if (results[0]) {

              map.setZoom(11);

              var marker = new google.maps.Marker({

                position: latlng,

                map: map

              });

              infowindow.setContent(results[0].formatted_address);

              //$("#mapaddress").val(results[0].formatted_address);

              infowindow.open(map, marker);

            } else {

              //window.alert('No results found');

            }

          } else {

            //window.alert('Geocoder failed due to: ' + status);

          }

        });

      }

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