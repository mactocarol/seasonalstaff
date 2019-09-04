<?php $this->load->view('admin/includes/sidebar'); ?>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Staffs
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo site_url('admin/dashboard');?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Staffs</li>
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
                  <h3 class="box-title">List Staffs</h3>
                      <button class="btn btn-danger pull-right"><a href="<?php echo site_url('add-staff'); ?>" style="color:white">Add Staff</a></button>&nbsp;
                </div>
                <!-- /.box-header -->
                <div class="box-body pull-right ">
                   <form role="form"  name="" method="post" action="<?php echo site_url('staff-list'); ?>">
                           <div class="col-lg-12">
                             <div class="col-lg-3 ">
                               <div class="form-group">

                                <label>From Date</label>

                                <input class="form-control" id="" name="offerdate" placeholder="MM-DD-YYY" type="text"/>

                             </div>
                           </div>      
                           
                        <div class="col-lg-3 ">

                             <div class="form-group">

                                <label>To Date </label>

                                <input class="form-control" name="offerTillDate" placeholder="MM-DD-YYY" type="text"/>

                             </div>
                           </div>
                 
                           
                        <div class="col-lg-3 ">
                           <div class="form-group">

                                <label>Country </label>

                                         <select name="country" class="form-control">

                                          <option value="">Select Country</option>
                                          <?php
                                            if(!empty($country)){
                                              foreach ($country as  $roles) {
                                                
                                          ?>

                                          <option value="<?php echo !empty($roles['Name']) ? $roles['Name'] : ''  ?>"><?php echo !empty($roles['Name']) ? $roles['Name'] : ''  ?></option>
                                          <?php
                                        }
                                      }
                                   ?>


                               </select>

                               </div>
                    </div> 


                    <div class="col-lg-3 ">

                             <div class="form-group">

                                <button style=" margin-top: 22px;" type="submit" class="btn btn-success"><i class="fa fa-search"></i></button>

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
                        <th>Created Date</th>
                        <!-- <th>Updated Date</th> -->
                        <th>Status</th>
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
                                   <td> <?php echo !empty($row->offer_name) ? $row->offer_name : 'NA'; ?></td>    
                                    <td> <?php echo !empty($row->role_name) ? $row->role_name : 'NA'; ?></td>    
                                    <!--  <td> <?php //echo !empty($row->gender) ? $row->gender : ''; ?></td>     -->
                                      <td> <?php echo !empty($row->contact_number) ? $row->contact_number : ''; ?></td>    
                                       <td> <?php echo !empty($row->email) ? $row->email : ''; ?></td>    
                                        <td> <?php echo !empty($row->map_address) ? $row->map_address : '';  ?></td>    
                                         <td> <?php echo (date('Y',strtotime($row->created_date)) != '1970') ? date('M-d-Y H:i:s',strtotime($row->created_date)) : 'NA'; ?></td>
                                          <!-- <td> <?php echo (date('Y',strtotime($row->updated_date)) != '1970') ? date('M-d-Y H:i:s',strtotime($row->updated_date)) : 'NA'; ?></td>  -->                            
                                <td>
                                  <?php
                                   if($row->status == 1){
                                  ?>

                                  <span class="label label-table label-success __web-inspector-hide-shortcut__" title="Click to Disapproved" href="<?php echo site_url('Staffs/User/status/'.$row->status.'/'.$row->id); ?>">Approved</span>
                        <?php }else{ ?>

                         <span class="label label-table label-danger" title="Click to Approved" href="<?php echo site_url('Staffs/User/status/'.$row->status.'/'.$row->id); ?>">Disapproved</span>

                        <?php } ?>
                                </td>
                                <td>
                                

                                    <div class="dropdown">
                                        <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"><i class="fa fa-cog fa-fw"></i>Action
                                        <span class="caret"></span></button>
                                        <ul class="dropdown-menu">

                                          <li><a href="<?php echo site_url(); ?>edit-staff/<?php echo $row->id;?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Edit</a></li>


                                          <li><a href="javascript:void(0)" class="removeData" data-toggle="modal" data-id="<?php echo $row->id; ?>" data-target="#myModal"><i class="fa fa-trash" aria-hidden="true"></i>Delete</a></li>
                                          <!-- <li><a href="#"><i class="fa fa-eye"></i>View</a></a></li> -->
                                          <li> 
                                            
                                                  <?php
                                                     if($row->status == 1){
                                                    ?>
                                                      <a class="statusSuspend" style="color: red;" href="javascript:void(0)"  data-id="<?php echo $row->id; ?>" data-toggle="modal" data-target="#Suspend"><i class="fa fa-edit"></i>Suspend</a>
                                                  
                                               <?php }else{ ?>
                                                      <a style="color: green;" class="statusUpdatess" data-id="<?php echo $row->id; ?>" href="javascript:void(0)" data-toggle="modal" data-target="#Approve" ><i class="fa fa-edit"></i>Apporve</a>
                                                            
                                              <?php } ?>
                                          </li>
                                        </ul>
                                      </div>
                                     <!--  <div>
                                        <a href="<?php //echo site_url('job-list'),'?id='.base64_encode($row->id); ?>" class="btn btn-success"><i class="fa fa-eye"></i> View Job</a>
                                      </div> -->



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

                   window.location.href = site_url+"staff-list";


                }
            }
            
        });


});



    $(document).on("click", ".statusUpdatess", function () { 
        var Staffstatus = $(this).data('id');

       $(".modal-body #statusIdss").val(Staffstatus);

 
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

                   window.location.href = site_url+"staff-list";


                }
            }
            
        });


});




    $(document).on("click", ".statusSuspend", function () { 
        var Staffs = $(this).data('id');

       $(".modal-body #UserForSuspend").val(Staffs);

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

                   window.location.href = site_url+"staff-list";


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
</script>