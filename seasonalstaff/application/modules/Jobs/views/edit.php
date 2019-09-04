<?php $this->load->view('admin/includes/sidebar'); ?>

<!-- Content Wrapper. Contains page content -->

  <div class="content-wrapper">

    <!-- Content Header (Page header) -->

    <section class="content-header">

      <h1>

        Edit Job

        <small>Control panel</small>

      </h1>

      <ol class="breadcrumb">

        <li><a href="<?php echo site_url('Admin/dashboard');?>"><i class="fa fa-dashboard"></i> Home</a></li>

        <li class="active">Edit Job</li>

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

         <section class="col-lg-7 ">

          <div class="alert alert-success" id="alert">

              <strong>Success!</strong> <?php print_r($items->message); ?>

          </div>

          </section>   

        <?php

        }else{

        ?>

         <section class="col-lg-7 ">

          <div class="alert alert-danger" id="alert">

              <strong>Error!</strong> <?php print_r($items->message); ?>

          </div>

          </section>   

        <?php

        }

      }

      ?>

                 

        <section class="col-lg-12 ">

             

               <div class="box">

                <div class="box-header">

                  <h3 class="box-title">Edit Job</h3>

                    <button class="btn btn-danger pull-right"><a href="<?php echo site_url('job-list'); ?>" style="color:white">Go to Job List</a></button>

                </div>

                

                <div class="box-body">

          
 <form role="form" id="jobs" name="" method="post" action="<?php echo site_url().'edit-job/'.$reslt->id; ?>">

  <div class="col-lg-12">



                            <div class="col-lg-6 ">

                               <div class="form-group">

                                <label>Employee</label>

                                <select name="employee" class="form-control">
                                <option value="">Select Job Category</option>
                                <?php
                                  if(!empty($users)){
                                    foreach($users as $cat){
                                      ?>
                                      <option <?php echo ($cat['id']==$reslt->employerId)? 'selected' : ''; ?>  value="'.$cat['id'].'"><?php echo !empty($cat['username'])? ($cat['username']) : ''; ?></option>

                                      <?php  
                                    }
                                  }else{
                                    echo '<option value> Records Not Found </option>';
                                  }
                                ?>
                                 
                               </select>

                               

                             </div>

                            </div>

                            <div class="col-lg-6 ">

                                 <div class="form-group">

                                <label>Job Id<span>*</span></label>
                                 <input type="text" class="form-control" name="jobIDUnique" placeholder="Job Id" value="<?php echo (!empty($reslt->jobId)) ? ($reslt->jobId): ('')?>">                              

                             </div>

                            </div> 

                          </div>
                           <div class="col-lg-12">



                            <div class="col-lg-6 ">

                               <div class="form-group">

                                <label>Job Title</label>

                                <input type="text" class="form-control" name="jobname" placeholder="Job Name" value="<?php echo (!empty($reslt->job_title)) ? ($reslt->job_title): ('')?>">

                             </div>

                            </div>

                            <div class="col-lg-6 ">

                                 <div class="form-group">

                                <label>Job Category</label>

                               <select name="job_cat_id" class="form-control">
                                <option value="">Select Job Category</option>
                                <?php
                                  if(!empty($job_category)){
                                    foreach($job_category as $cat){?>

                                          <option <?php echo ($cat['id'] == $reslt->job_category_id) ? 'selected' : ''; ?> value="<?php echo $cat['id']; ?>"><?php echo !empty($cat['category_name']) ? ($cat['category_name']) : ''?></option>

                                      <?php
                                      
                                    }
                                  }else{
                                    echo '<option value> Records Not Found </option>';
                                  }
                                ?>
                                 
                               </select>

                             </div>

                            </div>

                          </div>

                        <div class="col-lg-12 ">



                            <div class="col-lg-6 ">

                                <div class="form-group">

                                <label>Designation</label>

                                <input type="text" class="form-control" name="designation" placeholder="Designation" value="<?php echo (!empty($reslt->designation)) ? ($reslt->designation): ('')?>">

                             </div>

                            </div>
                            <div class="col-lg-6 ">

                                <div class="form-group">

                                <label>Skill</label>

                                 <!-- <input type="text" class="form-control" name="skills[]" placeholder="Skill" value="<?php echo (!empty($reslt->skill)) ? ($reslt->skill): ('')?>" id="category" data-role="tagsinput">  -->

                                 <select class="form-control select2 select2-hidden-accessible" multiple="" data-placeholder="Select a State" style="width: 100%;" tabindex="-1" aria-hidden="true" name="skills[]">
                                      <option value="">Select Skills</option>

                                      <?php

                                      $explode = explode(',', $reslt->skill);

                                      if(!empty($skills)){
                                        foreach ($skills as $value) {
                                         

                                      ?>
                                    <option <?php echo (in_array($value['id'],$explode)) ? 'selected' : ''; ?> value="<?php echo (!empty($value['id'])) ? $value['id'] : ''; ?>"><?php echo (!empty($value['skills'])) ? $value['skills'] : ''; ?></option> 
                                      <?php

                                        }
                                      }

                                      ?>

                                     
                               </select>
                               
                             </div>

                            </div>

                          </div>


                          <div class="col-lg-12 ">



                            <div class="col-lg-6 ">

                                <div class="form-group">

                                <label>No of Jobs</label>

                                <input type="number" class="form-control" name="no_of_jobs" placeholder="No of Jobs" value="<?php echo (!empty($reslt->number_of_post)) ? ($reslt->number_of_post): ('')?>">

                             </div>

                            </div>

                            <div class="col-lg-6 ">

                                <div class="form-group">

                                <label>Salary</label>

                                <input type="number" class="form-control" name="Salary" placeholder="Salary" value="<?php echo (!empty($reslt->salary)) ? ($reslt->salary): ('')?>"> 
                             </div>

                            </div>

                          </div>

                          <div class="col-lg-12 ">



                            <div class="col-lg-6 ">

                                <div class="form-group">

                                <label>Jobs From</label>

                                <input class="form-control" id="" name="jobdate" placeholder="MM-DD-YYY" type="text" value="<?php echo (date('M-d-Y',strtotime($reslt->from_date)) !=1970 ) ? (date('M-d-Y',strtotime($reslt->from_date))): ('')?>" />

                             </div>

                            </div>
                              <div class="col-lg-6 ">

                              <div class="form-group">

                                <label>Jobs Last Date</label>

                            
                                <input class="form-control" name="jobTillDate" placeholder="MM-DD-YYY" type="text" value="<?php echo (date('M-d-Y',strtotime($reslt->to_date)) !=1970 ) ? (date('M-d-Y',strtotime($reslt->to_date))): ('')?>"/>

                             </div>

                            </div>

                          </div>

                         <div class="col-lg-12 ">



                            <div class="col-lg-6 ">

                              <div class="form-group">

                                <label>Location </label>
                                <!-- <input type="text" class="form-control" name="mapaddress" placeholder="Mapaddress" value=""> -->
                                 <input name="mapaddress" id="mapaddress" type="text" placeholder="Enter Google Map Address" value="<?php echo (!empty($reslt->map_address)) ? ($reslt->map_address): ('')?>" class="form-control">

                             </div>
<div style="display: none">
                              <div class="form-group">
                                <label>Latitude </label>
                                <!-- <input type="text" class="form-control" name="latitude" placeholder="latitude" value=""> -->
                               <input onchange="showPositionlat()" type="text" name="latitude" id="latitude" value="<?php if(isset($_REQUEST['latitude'])) { echo $_REQUEST['latitude']; } else { if($this->session->flashdata("addproperty")) { echo $this->session->userdata("latitude"); } } ?>" class="form-control" placeholder="Enter latitude">
                             </div>
                              <div class="form-group">
                                <label>Longitude </label>
                                <!-- <input type="text" class="form-control" name="longitude" placeholder="Email" value=""> -->
                                <input onchange="showPositionlat()" type="text" name="longitude" id="longitude" value="<?php if(isset($_REQUEST['longitude'])) { echo $_REQUEST['longitude']; } else { if($this->session->flashdata("addproperty")) { echo $this->session->userdata("longitude"); } } ?>" class="form-control" placeholder="Enter longitude">
                             </div>
</div>
                            </div>

                             <div class="col-lg-6 ">

                               <div class="form-group">

                                <label>Description</label>

                                <textarea rows="4" cols="50" class="form-control" name="description" placeholder="Job Description"><?php echo (!empty($reslt->job_description)) ? ($reslt->job_description): ('')?></textarea>

                                

                             </div>

                            </div>



                            <div class="col-lg-6 ">

                               <div class="form-group">

                                 <input type="submit" class="btn btn-primary" name="Update_profile" value="Update">

                                

                             </div>

                            </div>

                          </div>

                  </form>

                </div>

               </div>

        </section>

        <!-- /.Left col -->

   

    </div>



    </section>

    <!-- /.content -->

  </div>

<script>
    $(document).ready(function(){
      var date_input=$('input[name="offerdate"]'); //our date input has the name "offerdate"
      var options={
        // format: 'mm-dd-yyyy',
        todayHighlight: true,
        autoclose: true,
      };
      date_input.datepicker(options);
    })
</script>
<script>
        $(document).ready(function(){
      var date_input=$('input[name="offerTillDate"]'); //our date input has the name "offerTillDate"
      var options={
        // format: 'mm-dd-yyyy',
        todayHighlight: true,
        autoclose: true,
      };
      date_input.datepicker(options);
    })
</script>



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