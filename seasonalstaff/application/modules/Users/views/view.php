<?php $this->load->view('admin/includes/sidebar'); ?>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Users
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo site_url('admin/dashboard');?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Users</li>
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
            <section class="col-lg-12">
            
               <div class="box">
                <div class="box-header">
                  <h3 class="box-title">List Users</h3>
                      <button class="btn btn-danger pull-right"><a href="<?php echo site_url('add-user'); ?>" style="color:white">Add User</a></button>&nbsp;
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                <div class="top_filter_form">
                   <form role="form"  name="" method="post" action="<?php echo site_url('users-list'); ?>">
					 <div class="row">
					    <div class="col-lg-2">
                               <div class="form-group">

                                <label>Offer</label>
                                <input class="form-control" id="" name="offercode" placeholder="Offer code" type="text"/ value="<?php if(isset($_REQUEST['offercode'])) { echo $_REQUEST['offercode']; } ?>" autocomplete="off">
                             </div>
                            </div> 
							<div class="col-lg-2">
                               <div class="form-group">

                                <label>From Date</label>
                                <input class="form-control" id="" name="offerdate" placeholder="MM-DD-YYY" type="text"/ value="<?php if(isset($_REQUEST['offerdate'])) { echo $_REQUEST['offerdate']; } ?>" autocomplete="off">
                             </div>
                           </div> 
                           <div class="col-lg-2">
                             <div class="form-group">
                                <label>To Date </label>
                                <input class="form-control" name="offerTillDate" placeholder="MM-DD-YYY" type="text"/ value="<?php if(isset($_REQUEST['offerTillDate'])) { echo $_REQUEST['offerTillDate']; } ?>" autocomplete="off">
                             </div>
                           </div>
						   <div class="col-lg-3">
                            <div class="form-group search_button_group">
                                <label>Staff Profile </label>
								<div class="select_group">
									 <select name="staffprofile" class="form-control">
									  <option value="">Select Profile </option>
										<option value="complete" <?php if($_REQUEST['staffprofile']=='complete'){ echo 'selected';} ?>>Complete Staff Profile</option>
										<option value="incomplete" <?php if($_REQUEST['staffprofile']=='incomplete'){ echo 'selected';} ?>>Incomplete Staff Profile</option>
									 </select>
								</div>
								
                               </div>
							</div>
						   
                           <div class="col-lg-3">
                            <div class="form-group search_button_group">
                                <label>Role </label>
								<div class="select_group">
									 <select name="role" class="form-control">
									  <option value="">Select Role</option>
										<option value="employer" <?php if($_REQUEST['role']=='employer'){ echo 'selected';} ?>>Employer</option>
										<option value="staff" <?php if($_REQUEST['role']=='staff'){ echo 'selected';} ?>>Staff</option>
									 </select>
								</div>
								<button type="submit" class="btn btn-success"><i class="fa fa-search"></i></button>
                               </div>
							</div>
                          
						 </div>
					 </form>
				   </div>


                <div class="box-body">
                 
                 <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                      <th>Sr. No.</th>                        
                      <th>Name</th>
                       <th>Plan</th>   
                        <th>Offer</th>
                        <th>Role</th>
                        <!-- <th>Gender</th> -->
                        <th>Contact</th>
                        <th>Email</th>
                        <th>Address</th>
						<th>Email Status</th>
                        <th>Created Date</th>
                        <!-- <th>Updated Date</th> -->
                        <th>Status</th>
						
						<th>Staff Status map</th>
						
                       <th style="width:5px">Action</th>                       
                      </tr>
                    </thead>
                    <tbody>
					
                          <?php if(!empty($results)) {
                                $count = 0;                              
                                foreach($results as $row){ ?>
                            <tr>
                                <td><?= ++$count; ?></td>
                                <td>
                                    <?php echo isset($row->first_name) ? $row->first_name.' '.$row->last_name : ''; ?>                                    
                                  </td>   
                                  <td> <?php echo !empty($row->plan_name) ? $row->plan_name : 'NA'; ?></td>    
                                   <td> <?php echo !empty($row->offer_id) ? $row->offer_id : 'NA'; ?></td>    
                                    <td> <?php echo !empty($row->role_name) ? $row->role_name : 'NA'; ?></td>    
                                     <!-- <td> <?php //echo !empty($row->gender) ? $row->gender : ''; ?></td>   -->  
                                      <td> <?php echo !empty($row->contact_number) ? $row->contact_number : ''; ?></td>    
                                       <td> <?php echo !empty($row->email) ? $row->email : ''; ?></td>   
											<?php 
											//if($row->role_name=="staff") { ?>	
											   <!--  <td> <?php echo !empty($row->current_location) ? $row->current_location : ''; ?></td> -->
											<?php //} else { ?>
											<td> <?php echo !empty($row->business_location) ? $row->business_location : ''; //}?></td>
											
											
									    <td> <?php if( $row->email_status==1){ ?>
                                        <span class="label label-table label-success __web-inspector-hide-shortcut__" title="Click to Disapproved">Verified</span>

										<?php } else { ?> 
									    <span class="label label-table label-danger" title="Click to Approved" href="<?php echo site_url('Users/User/status/'.$row->status.'/'.$row->id); ?>">Not verified</span>
										
										<?php }  ?></td>

											
										<td> <?php echo (date('Y',strtotime($row->created_date)) != '1970') ? date('d M Y',strtotime($row->created_date)) : 'NA'; ?></td>
                                          <!-- <td> <?php echo (date('Y',strtotime($row->updated_date)) != '1970') ? date('d M Y',strtotime($row->updated_date)) : 'NA'; ?></td>  -->                            
                                <td>
                                  <?php
                                   if($row->delete == 0){
                                  ?>

                                  <span class="label label-table label-success __web-inspector-hide-shortcut__" title="Click to Disapproved" href="<?php echo site_url('Users/User/status/'.$row->status.'/'.$row->id); ?>">Approved</span>
                        <?php }else{ ?>

                         <span class="label label-table label-danger" title="Click to Approved" href="<?php echo site_url('Users/User/status/'.$row->status.'/'.$row->id); ?>">Disapproved</span>

                        <?php } ?>
                                </td>
								
						<td>
                                  <?php
                                   if($row->staffbasicstatus == 1){
                                  ?>

                                  <span class="label label-table label-success __web-inspector-hide-shortcut__" title="Click to Disapproved" href="<?php echo site_url('Users/User/status/'.$row->status.'/'.$row->id); ?>">Approved</span>
                        <?php }else{ ?>

                         <span class="label label-table label-danger" title="Click to Approved" href="<?php echo site_url('Users/User/status/'.$row->status.'/'.$row->id); ?>">Disapproved</span>

                        <?php } ?>
                                </td>
								
								
                                <td>
                                

                                    <div class="dropdown">
                                        <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"><i class="fa fa-cog fa-fw"></i>Action
                                        <span class="caret"></span></button>
                                        <ul class="dropdown-menu">

                                         <li><a href="javascript:void(0)" class="emailveract" data-toggle="modal" data-id="<?php echo $row->id; ?>" data-target="#myModalemv" style="color:green;"><i class="fa fa-envelope" aria-hidden="true"></i> Email verified</a></li>
                                          <!-- <li><a href="#"><i class="fa fa-eye"></i>View</a></a></li> -->
                                         <li> 

										<li><a href="<?php echo site_url(); ?>edit-user/<?php echo $row->id;?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Edit</a></li>

                                         <li><a href="javascript:void(0)" class="staffdeactiv" data-toggle="modal" data-id="<?php echo $row->id; ?>" data-target="#myModalstaffd" style="color:red;"><i class="fa fa-trash" aria-hidden="true"></i>Deactivate Staff Map account
										 </a></li>
										 
										 
										<li><a href="javascript:void(0)" class="staffactiv" data-toggle="modal" data-id="<?php echo $row->id; ?>" data-target="#myModalstaffact" style="color:green;"><i class="fa fa-trash" aria-hidden="true"></i> Activate  Staff Map account</a></li>
                                          <!-- <li><a href="#"><i class="fa fa-eye"></i>View</a></a></li> -->
                                         <li> 
										 
										 <li><a href="javascript:void(0)" class="removeData" data-toggle="modal" data-id="<?php echo $row->id; ?>" data-target="#myModal" style="color:red;"><i class="fa fa-trash" aria-hidden="true"></i>Deactivate account
										 </a></li>
                                          <!-- <li><a href="#"><i class="fa fa-eye"></i>View</a></a></li> -->
                                         <li>
										 
										  <!-- <li><a href="javascript:void(0)" class="removeData" data-toggle="modal" data-id="<?php echo $row->id; ?>" data-target="#myModalsp" style="color:#e8900d;"><i class="fa fa-trash" aria-hidden="true"></i>Suspend account
										  </a></li> -->
                                          <!-- <li><a href="#"><i class="fa fa-eye"></i>View</a></a></li> -->
                                          <li>


 										  <li><a href="javascript:void(0)" class="removeDataact" data-toggle="modal" data-id="<?php echo $row->id; ?>" data-target="#myModalact" style="color:green;"><i class="fa fa-trash" aria-hidden="true"></i> Activate account</a></li>
                                          <!-- <li><a href="#"><i class="fa fa-eye"></i>View</a></a></li> -->
                                          <li> 
																			 
										 
										  
										  <li><a href="javascript:void(0)" class="removeDataper" data-toggle="modal" data-id="<?php echo $row->id; ?>" data-target="#myModalper"><i class="fa fa-trash" aria-hidden="true"></i>Permanently <br> &nbsp; &nbsp; &nbsp; Delete</a></li>
                                          <!-- <li><a href="#"><i class="fa fa-eye"></i>View</a></a></li> -->
                                          <li> 
										  
										 
										  
										  
										  <!-- <li><a href="javascript:void(0)" class="emailverno" data-toggle="modal" data-id="<?php echo $row->id; ?>" data-target="#myModalemvno" style="color:red;"><i class="fa fa-envelope" aria-hidden="true"></i> Email Not verified</a></li>
                                               <li> -->
										  
										  
										  
                                            
                                                  <?php
                                                   // if($row->status == 1){
                                                    ?>
                                                     <!--  <a class="statusSuspend" style="color: red;" href="javascript:void(0)"  data-id="<?php echo $row->id; ?>" data-toggle="modal" data-target="#Suspend"><i class="fa fa-edit"></i>Suspend</a>
                                                  
                                               <?php //}else{ ?>
                                                      <a style="color: green;" class="statusUpdatess" data-id="<?php echo $row->id; ?>" href="javascript:void(0)" data-toggle="modal" data-target="#Approve" ><i class="fa fa-edit"></i>Apporve</a> -->
                                                            
                                              <?php //} ?>
                                          </li>
                                        </ul>
                                      </div>

                                     <?php
                                     if($row->role==8){
                                      ?>
                                      <div>
                                        <a href="<?php echo site_url('job-list'),'?id='.base64_encode($row->id); ?>" class="btn btn-success"><i class="fa fa-eye"></i> View Job</a>
                                      </div>

                                      <?php
                                     }

                                     ?>
                                         
                                        
                                     



                                </td> 
                            </tr>                          
                    <?php  } }?>                      
                                                       
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
  
  <div id="myModalstaffd" class="modal fade modelAction" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Deactivate Staff Map  Account?</h4>
      </div>
      <div class="modal-body">
        <input type="hidden" name="" id="staffdeacti">
        <p>Are you sure want to Deactivate  Staff Map Account?.</p>

         <p>Press Yes if you sure.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
       <button type="button" class="btn btn-success" id="staffd">Yes</button> 
        </div>
    </div>

  </div>
</div>
 
 <div id="myModalstaffact" class="modal fade modelAction" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Activate Staff Map Account??</h4>
      </div>
      <div class="modal-body">
        <input type="hidden" name="" id="staffactev">
        <p>Are you sure want to Activate Staff Map Account?.</p>

         <p>Press Yes if you sure.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
       <button type="button" class="btn btn-success" id="staffact">Yes</button> 
        </div>
    </div>

  </div>
</div>
 
 
 
 <div id="myModalsp" class="modal fade modelAction" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Suspend Account??</h4>
      </div>
      <div class="modal-body">
        <input type="hidden" name="" id="userDel">
        <p>Are you sure want to Suspend Account?.</p>

         <p>Press Yes if you sure.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
       <button type="button" class="btn btn-success" id="delYe">Yes</button> 
        </div>
    </div>

  </div>
</div> 
  
  

  <div id="myModal" class="modal fade modelAction" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Deactivate Account??</h4>
      </div>
      <div class="modal-body">
        <input type="hidden" name="" id="userDel">
        <p>Are you sure want to Deactivate Account?.</p>

         <p>Press Yes if you sure.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
       <button type="button" class="btn btn-success" id="delYe">Yes</button> 
        </div>
    </div>

  </div>
</div>


 <div id="myModalact" class="modal fade modelAction" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Activate Account??</h4>
      </div>
      <div class="modal-body">
        <input type="hidden" name="" id="userDelact">
        <p>Are you sure want to Activate Account?.</p>

         <p>Press Yes if you sure.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
       <button type="button" class="btn btn-success" id="delYeact">Yes</button> 
        </div>
    </div>

  </div>
</div>

  <div id="myModalper" class="modal fade modelAction" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Permanently delete record??</h4>
      </div>
      <div class="modal-body">
        <input type="hidden" name="" id="userDelper">
        <p>Are you sure want to permanently delete record?.</p>

         <p>Press Yes if you sure.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
       <button type="button" class="btn btn-success" id="delYepp">Yes</button> 
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


<div id="myModalemv" class="modal fade modelAction" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Email verified?</h4>
      </div>
      <div class="modal-body">
        <input type="hidden" name="" id="useremailv">
        <p>Are you sure want to Email verified?.</p>

         <p>Press Yes if you sure.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
       <button type="button" class="btn btn-success" id="emailver">Yes</button> 
        </div>
    </div>

  </div>
</div>


<div id="myModalemvno" class="modal fade modelAction" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Not Email verified?</h4>
      </div>
      <div class="modal-body">
        <input type="hidden" name="" id="useremailno">
        <p>Are you sure want to Not Email verified?.</p>

         <p>Press Yes if you sure.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
       <button type="button" class="btn btn-success" id="emailverno">Yes</button> 
        </div>
    </div>

  </div>
</div>


<script type="text/javascript">
$(document).on("click", ".removeData", function () {
        var dynamicID = $(this).data('id');
       $(".modal-body #userDel").val(dynamicID);         

});

$('#delYe').on('click',function(){
var user_id = $('#userDel').val();
        $.ajax({
            url: site_url +"Users/User/delete/"+user_id,
            type: "POST",
            data: {
                user_id: user_id,

            },
             success: function (msg) {
                if (msg) {

                   window.location.href = site_url+"users-list";

                }
				}            
        });
});


$(document).on("click", ".removeDataact", function () {
        var dynamicID = $(this).data('id');
       $(".modal-body #userDelact").val(dynamicID);         

});

$('#delYeact').on('click',function(){
var user_id = $('#userDelact').val();
        $.ajax({
            url: site_url +"Users/User/deleteact/"+user_id,
            type: "POST",
            data: {
                user_id: user_id,

            },
             success: function (msg) {
                if (msg) {

                   window.location.href = site_url+"users-list";

                }
				}            
        });
});


$(document).on("click", ".removeDataper", function () {
        var dynamicID = $(this).data('id');
       $(".modal-body #userDelper").val(dynamicID);         

});

$('#delYepp').on('click',function(){
var user_id = $('#userDelper').val();
        $.ajax({
            url: site_url +"Users/User/deleteper/"+user_id,
            type: "POST",
            data: {
                user_id: user_id,

            },
             success: function (msg) {
                if (msg) {

                   window.location.href = site_url+"users-list";

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
            url: site_url +"Users/User/statusone/"+user_id,
            type: "POST",
            data: {
                user_id: user_id,

            },
             success: function (msg) {
                if (msg) {

                   window.location.href = site_url+"users-list";


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
            url: site_url +"Users/User/statuszero/"+user_id,
            type: "POST",
            data: {
                user_id: user_id,

            },
             success: function (msg) {
                if (msg) {

                   window.location.href = site_url+"users-list";


                }
            }
            
        });


});

$(document).on("click", ".emailveract", function () {
        var dynamicID = $(this).data('id');
       $(".modal-body #useremailv").val(dynamicID);         

});

$('#emailver').on('click',function(){
var user_id = $('#useremailv').val();
        $.ajax({
            url: site_url +"Users/User/emailverify/"+user_id,
            type: "POST",
            data: {
                user_id: user_id,

            },
             success: function (msg) {
                if (msg) {

                   window.location.href = site_url+"users-list";

                }
				}            
        });
});


$(document).on("click", ".emailverno", function () {
        var dynamicID = $(this).data('id');
       $(".modal-body #useremailno").val(dynamicID);         

});

$('#emailverno').on('click',function(){
var user_id = $('#useremailno').val();
        $.ajax({
            url: site_url +"Users/User/emailverifyno/"+user_id,
            type: "POST",
            data: {
                user_id: user_id,

            },
             success: function (msg) {
                if (msg) {

                   window.location.href = site_url+"users-list";

                }
				}            
        });
});


</script>


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
	
	
$(document).on("click", ".staffdeactiv", function () {
        var dynamicID = $(this).data('id');
       $(".modal-body #staffdeacti").val(dynamicID);         

});

$('#staffd').on('click',function(){
var user_id = $('#staffdeacti').val();
        $.ajax({
            url: site_url +"Users/User/staffdeactive/"+user_id,
            type: "POST",
            data: {
                user_id: user_id,

            },
             success: function (msg) {
                if (msg) {

                   window.location.href = site_url+"users-list";

                }
				}            
        });
});
	
	
	
	
	
	
	
$(document).on("click", ".staffactiv", function () {
        var dynamicID = $(this).data('id');
       $(".modal-body #staffactev").val(dynamicID);         

});

$('#staffact').on('click',function(){
var user_id = $('#staffactev').val();
        $.ajax({
            url: site_url +"Users/User/staffactivate/"+user_id,
            type: "POST",
            data: {
                user_id: user_id,

            },
             success: function (msg) {
                if (msg) {

                   window.location.href = site_url+"users-list";

                }
				}            
        });
});
	
</script>