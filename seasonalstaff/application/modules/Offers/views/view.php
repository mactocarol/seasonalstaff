<?php $this->load->view('admin/includes/sidebar'); ?>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Offer Codes
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo site_url('admin/dashboard');?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Offer Codes</li>
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
                  <h3 class="box-title">List Offer Codes</h3>
                      <button class="btn btn-danger pull-right"><a href="<?php echo site_url('add-offer'); ?>" style="color:white">Add Offer Codes</a></button>&nbsp;
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                 <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                      <th>Sr. No.</th>                        
                      <th>Offer</th>
					  <th>User Type</th>
                      <th>Disocunt(<i class="fa fa-percent" aria-hidden="true"></i>)</th>
                      <th>Disocunt (<i class="fa fa-dollar aria-hidden="true"></i>)</th>
                      <th>Description</th>
                      <th>From Date</th>
                      <th>To Date</th>

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
                                <td> <?php echo isset($row['offer_name']) ? $row['offer_name'] : ''; ?> </td>
								<td> <?php echo isset($row['user_type']) ? $row['user_type'] : ''; ?> </td>
                                <td> <?php echo (isset($row['discount_percentage'])) ? ($row['discount_percentage'].' <i class="fa fa-percent" aria-hidden="true"></i>') : ''; ?> </td>
                                <td> <?php echo isset($row['discount_amount']) ? '<i class="fa fa-dollar" aria-hidden="true"></i> '.$row['discount_amount'] : ''; ?> </td>
                                <td> <?php echo isset($row['description']) ? $row['description'] : ''; ?> </td>
                                <td> <?php echo (date('Y',strtotime($row['from_date'])) != '1970') ? date('d M Y',strtotime($row['from_date'])) : 'NA'; ?> </td>   
                                <td> <?php echo (date('Y',strtotime($row['to_date'])) != '1970') ? date('d M Y',strtotime($row['to_date'])) : 'NA'; ?> </td>   
                                      
                               <td> <?php echo (date('Y',strtotime($row['created_date'])) != '1970') ? date('d M Y',strtotime($row['created_date'])) : 'NA'; ?> </td>
                                       
                               
                                <td>
                                  <a href="<?php echo site_url(); ?>edit-offer/<?php echo $row['id'];?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> 
                                    <a href="<?php echo site_url(); ?>Offers/Offer/delete/<?php echo $row['id'];?>" onclick=" var c = confirm('Are you sure want to delete?'); if(!c) return false;"><i class="fa fa-close" aria-hidden="true"></i></a>&nbsp;&nbsp;                                    
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
  