<?php $this->load->view('admin/includes/sidebar'); ?>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Job's Application
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo site_url('admin/dashboard');?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"> Job's Application</li>
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
                  <h3 class="box-title">List  Job's Application</h3>
                      &nbsp;
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                 <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                      <th>Sr. No.</th>                        
                      <th>Name</th>
                      <th>Email</th>
                      <!-- <th>Contact No</th> -->
                      <th>Job Title</th>
                      <th>Job Category</th>
                       <th>Salary</th>
                      <th>Designation</th>
                      <th>Interest</th>
                      <th>Preffer Date</th>
                       <th>Applied Date</th>
                        <th style="width:5px">Action</th>                       
                      </tr>
                    </thead>
                    <tbody>
                          <?php if(isset($records)) {
                                $count = 0;              
                                if(!empty($records)){               
                                foreach($records as $row){ ?>
                            <tr>
                                <td><?= ++$count; ?></td>
                                <td> <?php echo isset($row['username']) ? $row['username'] : ''; ?> </td>
                                <td><?php echo isset($row['email']) ? $row['email'] : ''; ?>  </td>
                                <!-- <td><?php// echo isset($row['contact_number']) ? $row['contact_number'] : ''; ?>   </td> -->
                                <td> <?php echo isset($row['job_title']) ? $row['job_title'] : ''; ?>  </td>
                                <td> <?php echo isset($row['category_name']) ? $row['category_name'] : ''; ?>  </td>
                                <td>  <?php echo isset($row['expected_salary']) ? $row['expected_salary'] : ''; ?> </td>
                                <td> <?php echo isset($row['designation']) ? $row['designation'] : ''; ?>  </td>
                                <td> <?php echo ($row['interest']==1) ? 'Yes' : 'No'; ?>  </td>
                                <td> <?php echo (date('Y',strtotime($row['prefer_datetime'])) != '1970') ? date('M-d-Y',strtotime($row['prefer_datetime'])) : 'NA'; ?> </td>   
                                <td> <?php echo (date('Y',strtotime($row['applied_date'])) != '1970') ? date('M-d-Y',strtotime($row['applied_date'])) : 'NA'; ?> </td>   
                             
                               
                                <td>
                                    <a href="<?php echo site_url(); ?>Recieved_job_application/Jobrequest/delete/<?php echo $row['id'];?>" onclick=" var c = confirm('Are you sure want to delete?'); if(!c) return false;"><i class="fa fa-close" aria-hidden="true"></i></a>&nbsp;&nbsp;                                    
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
  