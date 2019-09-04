<?php $this->load->view('admin/includes/sidebar'); ?>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Edit Role
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo site_url('admin/dashboard');?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Edit Role</li>
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
                  <h3 class="box-title">Edit Role</h3>
                    <button class="btn btn-danger pull-right"><a href="<?php echo site_url('role-list'); ?>" style="color:white">Go to Role List</a></button>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  <form role="form" id="add_user_by_admin" name="" method="post" action="<?php echo site_url().'edit-role/'.$reslt->id; ?>">
                        <!-- text input -->
                        

                           <section class="col-lg-12 connectedSortable">
                             <div class="form-group">
                                <label>User Role</label>
                                <input type="text" class="form-control" name="role" placeholder="User Role" value="<?php echo isset($reslt->role) ? $reslt->role : ''?>">
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
