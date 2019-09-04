<?php $this->load->view('admin/includes/sidebar'); ?>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Plans
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo site_url('admin/dashboard');?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">About</li>
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
                  <h3 class="box-title">List About</h3>
                     <!--  <button class="btn btn-danger pull-right"><a href="<?php echo site_url('add-plan'); ?>" style="color:white">Add Plan</a></button>&nbsp; -->
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                 <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                      <th>Sr. No.</th>                        
                      <th>Heading</th>
                      <th>Description</th>
					  <th>Image</th>
					  <th>Find Staff Description</th>
					  <th>Find Work Description</th>
                       <th>Created Date</th>
                        <th style="width:5px">Action</th>                       
                      </tr>
                    </thead>
                    <tbody>
                          <?php if(isset($records)) {
                                $count = 0;                              
                                foreach($records as $row){ ?>
                            <tr>
                                <td><?= ++$count; ?></td>
                                <td> <?php echo isset($row['heading']) ? $row['heading'] : ''; ?> </td>   
                                <td> <?php echo isset($row['description']) ? $row['description'] : ''; ?> </td>
                                <td> <img id="blah" src="<?php echo base_url();?>public/upload/about/<?php echo isset($row['image']) ? $row['image'] : '';; ?>" width="100px" height="100px"> </td>
								<td><?php echo isset($row['staff_description']) ? $row['staff_description'] : ''; ?> </td>							 
   								<td><?php echo isset($row['emp_description	']) ? $row['emp_description	'] : ''; ?> </td>
                                      
                               <td> <?php echo (date('Y',strtotime($row['create_dt'])) != '1970') ? date('d M Y',strtotime($row['create_dt'])) : 'NA'; ?> </td>
                                       
                               
                                <td>
                                  <a href="<?php echo site_url(); ?>Admin/editabout/<?php echo $row['id'];?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>                                                                   
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
  