<?php $this->load->view('admin/includes/sidebar'); ?>
<?php  $this->load->model('Job_model');  ?>
<!-- Content Wrapper. Contains page content -->
<style>
div#dataTable_wrapper {
    overflow: unset;
}
</style>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Jobs
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo site_url('admin/dashboard');?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Jobs</li>
      </ol>
    </section>

        <!-- Main content -->
        <section class="content">
          
          <!-- Main row -->
          <div class="row">            
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
          
            <!-- Left col -->
            <section class="col-lg-12 connectedSortable">
            
               <div class="box">
                <div class="box-header">
                  <h3 class="box-title">List Jobs</h3>
                      <!-- <button class="btn btn-danger pull-right"><a href="<?php echo site_url('add-job'); ?>" style="color:white">Add Job</a></button>&nbsp;  -->
                </div>
                <!-- /.box-header -->

                <!-- <div class="box-body pull-right ">
                   <form role="form"  name="" method="post" action="<?php echo site_url('job-list'); ?>">
                           <div class="col-lg-12">
                             <div class="col-lg-2 ">
                               <div class="form-group">

                                <label>From Date</label>

                                <input class="form-control" id="" name="offerdate" placeholder="MM-DD-YYY" type="text"/>

                             </div>
                           </div>      
                           
                        <div class="col-lg-2 ">

                             <div class="form-group">

                                <label>To Date </label>

                                <input class="form-control" name="offerTillDate" placeholder="MM-DD-YYY" type="text"/>

                             </div>
                           </div>
                 
                           
                        <div class="col-lg-2 ">
                           <div class="form-group">

                               <label>Job Category</label>

                               <select name="job_cat_id" class="form-control">
                                <option value="">Select Job Category</option>
                                <?php
                                  if(!empty($job_category)){
                                    foreach($job_category as $cat){
                                      echo '<option value="'.$cat['id'].'">'.$cat['category_name'].' </option>';
                                    }
                                  }else{
                                    echo '<option value> Records Not Found </option>';
                                  }
                                ?>
                                 
                               </select>

                               </div>
                    </div> 
                     <div class="col-lg-2 ">
                      <label>Employee/Staff</label>

                                <select name="employee" class="form-control">
                                <option value="">Select Employee</option>
                                <?php
                                  if(!empty($users)){
                                    foreach($users as $cat){
                                      echo '<option value="'.$cat['id'].'">'.$cat['username'].' </option>';
                                    }
                                  }else{
                                    echo '<option value> Records Not Found </option>';
                                  }
                                ?>
                                 
                               </select>

                     </div>


                    <div class="col-lg-3 ">

                             <div class="form-group">

                                <button style=" margin-top: 22px;" type="submit" class="btn btn-success"><i class="fa fa-search"></i></button>

                             </div>
                           </div>

                  </div>
                          
                   </form>
                </div> -->


                <div class="box-body">
                 <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                      <th>Sr. No.</th>                        
                      <th>Job Name</th>
                      <th>Job Category</th>
                      <!-- <th>Designation</th> -->
                      <th>Skill</th>
                      <th>Available Job</th>
                      <th>Salary</th>
                       <th>Location</th>
                      <th>From Date</th>
                      <th>To Date</th>
                     
                       <th>Status</th>
                        <th style="width:5px">Action</th>                       
                      </tr>
                    </thead>
                    <tbody>
                          <?php if(isset($records)) {
                            if(!empty($records)){
                                $count = 0;                              
                                foreach($records as $row){ ?>
                            <tr>
                                <td><?= ++$count; ?></td>
                                <td> <?php echo isset($row['job_title']) ? $row['job_title'] : ''; ?> </td>
                                <td> <?php echo isset($row['category_name']) ? $row['category_name'] : ''; ?> </td>
                                <!-- <td> <?php //echo isset($row['designation']) ? $row['designation'] : ''; ?> </td> -->
                                <td> <?php //echo isset($row['skill']) ? $row['skill'] : ''; 

                                        $explode = explode(',', $row['skill']);

                                        for ($i=0; $i < count($explode); $i++) { 

                                          $skillId = array("id"=>$explode[$i]);                
                                          $skills = $this->Job_model->SelectSingleRecord('skill','*',$skillId,$orderby=array());

                                         
                                         echo $skills->skills.'<br>';
                                          
                                        }

                                ?> </td>
                                <td> <?php echo isset($row['number_of_post']) ? $row['number_of_post'] : ''; ?> </td>                                 
                                <td><i class="fa fa-dollar"></i> <?php echo isset($row['salary']) ? $row['salary'] : ''; ?> </td>
                                 <td> <?php echo isset($row['map_address']) ? $row['map_address'] : ''; ?> 
								 <?php if($row['mapaddstatus']==1){ ?>  <span class="label label-table label-success __web-inspector-hide-shortcut__" title="Click to Disapproved">Show Map</span>
								 <?php } else {  ?><span class="label label-table label-danger" title="Click to Approved">Not Show Map</span><?php } ?>
								 </td>
                                <td> <?php echo (date('Y',strtotime($row['from_date'])) != '1970') ? date('M-d-Y',strtotime($row['from_date'])) : 'NA'; ?> </td>   
                                <td> <?php echo (date('Y',strtotime($row['to_date'])) != '1970') ? date('M-d-Y',strtotime($row['to_date'])) : 'NA'; ?> </td>   
                                      
                         <td>
                                  <?php
                                   if($row['status'] == 1){
                                  ?>

                                  <span class="label label-table label-success __web-inspector-hide-shortcut__" title="Click to Disapproved">Approved</span>
                        <?php } if($row['status'] == 2){ ?>

                         <span class="label label-table label-danger" title="Click to Approved">Disapproved</span>

                        <?php } ?>
                                </td>
                                       
                               
                                <td>
                                 <!--  <a href="<?php echo site_url(); ?>edit-job/<?php echo $row['id'];?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> 
                                    <a href="<?php echo site_url(); ?>Jobs/Job/delete/<?php echo $row['id'];?>" onclick=" var c = confirm('Are you sure want to delete?'); if(!c) return false;"><i class="fa fa-close" aria-hidden="true"></i></a>&nbsp;&nbsp; -->                                    
                                
                                    <div class="dropdown">
                                        <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"><i class="fa fa-cog fa-fw"></i>Action
                                        <span class="caret"></span></button>
                                        <ul class="dropdown-menu">

                                          <!-- <li><a href="<?php echo site_url(); ?>edit-job/<?php echo $row['id'];?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Edit</a></li> -->

                                          <?php if($row['mapaddstatus']==1){ ?>
										  <li><a href="javascript:void(0)" class="notadd" data-toggle="modal" data-id="<?php echo $row['id']; ?>" data-target="#myModal2"><i class="fa fa-eye-slash" aria-hidden="true"></i>Not Show Address Map</a></li>
                                          <li> 
                                          <?php } else {  ?>
										  <li><a href="javascript:void(0)" class="showadd" data-toggle="modal" data-id="<?php echo $row['id']; ?>" data-target="#myModal1"><i class="fa fa-eye" aria-hidden="true"></i>Show Address Map</a></li>
                                          <li> 
										  <?php } ?>
										  
										  <li><a href="javascript:void(0)" class="removeData" data-toggle="modal" data-id="<?php echo $row['id']; ?>" data-target="#myModal"><i class="fa fa-trash" aria-hidden="true"></i>Delete</a></li>
                                          <li> 
                                            
                                                  
                                                      <a class="statusSuspend" style="color: red;" href="javascript:void(0)"  data-id="<?php echo $row['id']; ?>" data-toggle="modal" data-target="#Suspend"><i class="fa fa-edit"></i>Suspend</a>
                                                  
                                              
                                                      <a style="color: green;" class="statusUpdatess" data-id="<?php echo $row['id']; ?>" href="javascript:void(0)" data-toggle="modal" data-target="#Approve" ><i class="fa fa-edit"></i>Apporve</a>
                                                            
                                            
                                          </li>
                                        </ul>
                                      </div>

                                </td> 
                            </tr>                          
                    <?php  }
                    }
                     }?>                      
                                                       
                    </tfoot>
                  </table>
                 
              
                </div>
                <!-- /.box-body -->
              </div>
    
            </section>
            <!-- /.Left col -->
          </div>
          <!-- /.row (main row) -->
        
        </section>

    <!-- /.content -->
  </div>
  <script>
    $(document).ready(function(){
      var date_input=$('input[name="offerdate"]'); //our date input has the name "date"
    var options={
        // format: 'mm-dd-yyyy',
         todayHighlight: true,
        autoclose: true,
      };
      date_input.datepicker(options);
    })


       $(document).ready(function(){
      var date_input=$('input[name="offerTillDate"]'); //our date input has the name "date"
     var options={
        // format: 'mm-dd-yyyy',
        todayHighlight: true,
        autoclose: true,
      };
      date_input.datepicker(options);
    })
</script>



  <div id="myModal" class="modal fade modelAction" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Delete record??</h4>
      </div>
      <div class="modal-body">
        <input type="hidden" name="" id="userDel">
        <p>Are you sure want to Delete record?.</p>

         <p>Press Yes if you sure.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
       <button type="button" class="btn btn-success" id="delYe">Yes</button> 
        </div>
    </div>

  </div>
</div>


  <div id="myModal1" class="modal fade modelAction" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Show Address Map??</h4>
      </div>
      <div class="modal-body">
        <input type="hidden" name="" id="addmap">
        <p>Are you sure want to Show Address Map.</p>

         <p>Press Yes if you sure.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
       <button type="button" class="btn btn-success" id="showmapYe">Yes</button> 
        </div>
    </div>

  </div>
</div>

  <div id="myModal2" class="modal fade modelAction" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Not Show  Address Map??</h4>
      </div>
      <div class="modal-body">
        <input type="hidden" name="" id="notmap">
        <p>Are you sure want to Not Show Address Map.</p>

         <p>Press Yes if you sure.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
       <button type="button" class="btn btn-success" id="notmapYe">Yes</button> 
        </div>
    </div>

  </div>
</div>


  <div id="Suspend" class="modal fade modelAction" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Suspend record?</h4>
      </div>
      <div class="modal-body">
        <input type="hidden" name="" id="UserForSuspend">
        <p>Are you sure want to Suspend record?</p>


         <p>Press Yes if you sure.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
     
       <button type="button" class="btn btn-success" id="SuspendButton">Yes</button>
      </div>
    </div>

  </div>
</div>

<div id="Approve" class="modal fade modelAction" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Approve record?</h4>
      </div>
      <div class="modal-body"> 
        <input type="hidden" name="" id="statusIdss">
        <p>Are you sure want to Approve record?</p>

         <p>Press Yes if you sure.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
        <button type="button" class="btn btn-success " id="ApproveStatuss">Yes</button>
       
      </div>
    </div>

  </div>
</div>

<script type="text/javascript">
$(document).on("click", ".removeData", function () {
        var dynamicID = $(this).data('id');
       $(".modal-body #userDel").val(dynamicID);         

});

$(document).on("click", ".showadd", function () {
        var dynamicID = $(this).data('id');
       $(".modal-body #addmap").val(dynamicID);         

});

$(document).on("click", ".notadd", function () {
        var dynamicID = $(this).data('id');
       $(".modal-body #notmap").val(dynamicID);         

});


$('#delYe').on('click',function(){
var user_id = $('#userDel').val();
        $.ajax({
            url: site_url +"Jobs/Job/delete/"+user_id,
            type: "POST",
            data: {
                user_id: user_id,

            },
             success: function (msg) {
                if (msg) {

                   window.location.href = site_url+"job-list";
                }
				}            
        });
		});


$('#showmapYe').on('click',function(){
var user_id = $('#addmap').val();
        $.ajax({
            url: site_url +"Jobs/Job/mapaddressstatus/"+user_id,
            type: "POST",
            data: {
                user_id: user_id,
				},
             success: function (msg) {
                if (msg) {

                   window.location.href = site_url+"job-list";
                }
				}            
        });
});

$('#notmapYe').on('click',function(){
var user_id = $('#notmap').val();
        $.ajax({
            url: site_url +"Jobs/Job/mapaddressstatusnot/"+user_id,
            type: "POST",
            data: {
                user_id: user_id,
				},
             success: function (msg) {
                if (msg) {

                   window.location.href = site_url+"job-list";
                }
				}            
        });
});

$(document).on("click", ".statusUpdatess", function () { 
        var UserStatus = $(this).data('id');
       $(".modal-body #statusIdss").val(UserStatus); 
});

$('#ApproveStatuss').on('click',function(){
var user_id = $('#statusIdss').val();
        $.ajax({
            url: site_url +"Jobs/Job/statusone/"+user_id,
            type: "POST",
            data: {
                user_id: user_id,

            },
             success: function (msg) {
                if (msg) {
                   window.location.href = site_url+"job-list";

                }
				}            
        });
});

$(document).on("click", ".statusSuspend", function () { 
        var UserS = $(this).data('id');
       $(".modal-body #UserForSuspend").val(UserS);
});


$('#SuspendButton').on('click',function(){
var user_id = $('#UserForSuspend').val();
        $.ajax({
            url: site_url +"Jobs/Job/statuszero/"+user_id,
            type: "POST",
            data: {
                user_id: user_id,

            },
             success: function (msg) {
                if (msg) {
                   window.location.href = site_url+"job-list";

                }
				}            
       });
});
</script>