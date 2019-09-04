<?php $this->load->view('admin/includes/sidebar'); ?>

<!-- Content Wrapper. Contains page content -->

  <div class="content-wrapper">

    <!-- Content Header (Page header) -->

    <section class="content-header">

      <h1>

        Edit Staff Plan Price

        <small>Control panel</small>

      </h1>

      <ol class="breadcrumb">

        <li><a href="<?php echo site_url('admin/dashboard');?>"><i class="fa fa-dashboard"></i> Home</a></li>

        <li class="active">Edit  Staff Plan Price</li>

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

                  <h3 class="box-title">Edit Staff Plan Price</h3>

                    <button class="btn btn-danger pull-right"><a href="<?php echo base_url();?>/Plans/plan/staffplan" style="color:white">Go to staff plan price list</a></button>

                </div>

                <!-- /.box-header -->

                <div class="box-body">

                  <form Plan="form" id="add_user_by_admin" name="" method="post" action="<?php echo base_url();?>/Plans/plan/editstaff/<?php echo $reslt->id; ?>">

                        <!-- text input -->

                        



                           <section class="col-lg-12 connectedSortable">

                              <!-- <div class="form-group">

                                <label>Staff Range</label>

                                <input type="text" class="form-control" name="plan" placeholder="Enter staff range" value="<?php echo isset($reslt->staff) ? $reslt->staff : '';?>">

                             </div> -->

                             <div class="form-group">

                                <label>Amount</label>

                                <input type="text" class="form-control" name="amount" placeholder="Amount" value="<?php echo isset($reslt->price) ? $reslt->price : 0;?>">

                             </div>
							 
							   <div class="form-group">

                                <label>Find work by location</label>
								<textarea rows="2" cols="50" class="form-control" name="descriptionfw" placeholder="Find work by location" data-bv-field="descriptionfw"><?php echo isset($reslt->descriptionfw) ? $reslt->descriptionfw : '';?></textarea>
                               

                             </div>

                             <div class="form-group">
                                <label>Find work by Month.</label>
								<textarea rows="2" cols="50" class="form-control" name="descriptionfem" placeholder="Find work by Month" data-bv-field="descriptionfem"><?php echo isset($reslt->descriptionfem) ? $reslt->descriptionfem : '';?></textarea>                               

                             </div>
							 
							  <div class="form-group">
                                <label>Find work that suits your needs</label>
								<textarea rows="2" cols="50" class="form-control" name="descriptionfws" placeholder="Find work that suits your needs" data-bv-field="descriptionfws"><?php echo isset($reslt->descriptionfws) ? $reslt->descriptionfws : '';?></textarea>                               

                             </div>
							 
							  <div class="form-group">
                                <label>Make a favourites list</label>
								<textarea rows="2" cols="50" class="form-control" name="descriptionmfav" placeholder="Make a favourites list" data-bv-field="descriptionmfav"><?php echo isset($reslt->descriptionmfav) ? $reslt->descriptionmfav : '';?></textarea>                         

                              </div>
							  
							  <div class="form-group">
                                <label>Track your applications</label>
								<textarea rows="2" cols="50" class="form-control" name="descriptiontrack" placeholder="Track your applications" data-bv-field="descriptiontrack"><?php echo isset($reslt->descriptiontrack) ? $reslt->descriptiontrack : '';?></textarea>                         

                              </div>
							  
							  <div class="form-group">
                                <label>Have your own profile</label>
								<textarea rows="2" cols="50" class="form-control" name="descriptionprofile" placeholder="Have your own profile" data-bv-field="descriptionprofile"><?php echo isset($reslt->descriptionprofile) ? $reslt->descriptionprofile : '';?></textarea>                         

                              </div>
							  
							   <div class="form-group">
                                <label>Easy application process</label>
								<textarea rows="2" cols="50" class="form-control" name="descriptionprocess" placeholder="Easy application process" data-bv-field="descriptionprocess"><?php echo isset($reslt->descriptionprocess) ? $reslt->descriptionprocess : '';?></textarea>                 

                              </div>
							  
							   <div class="form-group">
                                <label>More features</label>
								<textarea rows="2" cols="50" class="form-control" name="descriptionfeature" placeholder="More features" data-bv-field="descriptionfeature"><?php echo isset($reslt->descriptionfeature) ? $reslt->descriptionfeature : '';?></textarea>                 

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

