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
        <li class="active">Plan</li>
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
                  <h3 class="box-title">List Plan</h3>
                      <button class="btn btn-danger pull-right"><a href="<?php echo site_url('add-plan'); ?>" style="color:white">Add Plan</a></button>&nbsp;
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                 <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                      <th>Sr. No.</th>                        
                      <th>Plan Name</th>
                      <th>Amount</th>
					    <th>Reduce your recruitment costs</th> 
						<th>Find staff by location</th>
                        <th>Find staff by Month.</th>						
						<th>Search for staff by Skill</th>
						<th>Promote your point of difference</th>  
						<th>Make a favourites list</th> 
						<th>Reduce your HR & Admin time</th> 						 
						<th>More features</th>
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
                                <td> <?php if($row['staff']  >= 500) {  ?>
								Needing <?php echo isset($row['staff']) ? $row['staff'] : ''; ?> +Staff 
								<?php  } else { ?>
								Needing <?php echo isset($row['staff']) ? $row['staff'] : ''; ?> Staff <?php  } ?></td>   
                                <td> <i class="fa fa-dollar"></i>  <?php echo isset($row['price']) ? $row['price'] : ''; ?> </td>
								
                                  <td> <?php echo isset($row['descriptionfw']) ? $row['descriptionfw'] : ''; ?> </td>   
								  <td> <?php echo isset($row['descriptionfem']) ? $row['descriptionfem'] : ''; ?> </td>  
								  <td> <?php echo isset($row['descriptionfws']) ? $row['descriptionfws'] : ''; ?> </td> 
								  <td> <?php echo isset($row['descriptionmfav']) ? $row['descriptionmfav'] : ''; ?> </td> 
								  <td> <?php echo isset($row['descriptiontrack']) ? $row['descriptiontrack'] : ''; ?> </td> 
								  <td> <?php echo isset($row['descriptionprofile']) ? $row['descriptionprofile'] : ''; ?> </td>
								  <td> <?php echo isset($row['descriptionprocess']) ? $row['descriptionprocess'] : ''; ?> </td> 
								  <td> <?php echo isset($row['descriptionfeature']) ? $row['descriptionfeature'] : ''; ?> </td>   
                                           
									  
									  
                               <td> <?php echo (date('Y',strtotime($row['created_at'])) != '1970') ? date('d M Y',strtotime($row['created_at'])) : 'NA'; ?> </td>
                                       
                               
                                <td>
                                  <a href="<?php echo site_url(); ?>edit-plan/<?php echo $row['id'];?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> 
                                    <a href="<?php echo site_url(); ?>Plans/Plan/delete/<?php echo $row['id'];?>" onclick=" var c = confirm('Are you sure want to delete?'); if(!c) return false;"><i class="fa fa-close" aria-hidden="true"></i></a>&nbsp;&nbsp;                                    
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
  