<?php $this->load->view('admin/includes/sidebar'); ?>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Benefit
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo site_url('admin/dashboard');?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Benefit</li>
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
                  <h3 class="box-title">List Benefit</h3>
                      <button class="btn btn-danger pull-right"><a href="<?php echo site_url('add-Benefit'); ?>" style="color:white">Add Benefit</a></button>&nbsp;
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                 <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                      <th>Sr. No.</th>                        
                      <th>Benefit</th>
                       <th>Created Date</th>
                        <th style="width:5px">Action</th>                       
                      </tr>
                    </thead>
                    <tbody>
                          <?php if(isset($benefits)) {
                                $count = 0;                              
                                foreach($benefits as $row){ ?>
                            <tr>
                                <td><?= ++$count; ?></td>
                                <td> <?php
                              echo isset($row['name']) ? $row['name'] : '';


                                  ?> 

                               </td>   
                                      
                               <td> <?php echo (date('Y',strtotime($row['created_date'])) != '1970') ? date('d M Y',strtotime($row['created_date'])) : 'NA'; ?> </td>
                                       
                               
                                <td>
                                  <a href="<?php echo site_url(); ?>edit-Benefit/<?php echo $row['id'];?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> 

               

                                    <a href="javascript:void(0)" class="removeData" data-toggle="modal" data-id="<?php echo $row['id']; ?>" data-target="#myModal"><i class="fa fa-trash" aria-hidden="true"></i></a>




                                    &nbsp;&nbsp;                                    
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

<script type="text/javascript">
    $(document).on("click", ".removeData", function () {
        var dynamicID = $(this).data('id');

       $(".modal-body #userDel").val(dynamicID);

         

});

$('#delYe').on('click',function(){

var user_id = $('#userDel').val();
        $.ajax({
            url: site_url +"Benefits/Benefit/delete/"+user_id,
            type: "POST",
            data: {
                user_id: user_id,

            },
             success: function (msg) {
                if (msg) {

                   window.location.href = site_url+"Benefit-list";


                }
            }
            
        });


});
</script>