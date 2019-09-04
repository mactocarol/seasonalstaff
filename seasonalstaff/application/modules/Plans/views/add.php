<?php $this->load->view('admin/includes/sidebar'); ?>

<!-- Content Wrapper. Contains page content -->

  <div class="content-wrapper">

    <!-- Content Header (Page header) -->

    <section class="content-header">

      <h1>

        Add Plan

        <small>Control panel</small>

      </h1>

      <ol class="breadcrumb">

        <li><a href="<?php echo site_url('admin/dashboard');?>"><i class="fa fa-dashboard"></i> Home</a></li>

        <li class="active">Add Plan</li>

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

                  <h3 class="box-title">Add Plan</h3>

                    <button class="btn btn-danger pull-right"><a href="<?php echo site_url('plan-list'); ?>" style="color:white">Go to Plan List</a></button>

                </div>

                <!-- /.box-header -->

                <div class="box-body">

                  <form role="form" id="add_user_by_admin" name="" method="post" action="<?php echo site_url('add-plan'); ?>">

                        <!-- text input -->

                        



                           <section class="col-lg-12 connectedSortable">

                             <div class="form-group">

                                <label>Staff Range</label>

                                <input type="text" class="form-control" name="plan" placeholder="Enter staff range" value="">

                             </div>

                             <div class="form-group">

                                <label>Amount</label>

                                <input type="text" class="form-control" name="amount" placeholder="Amount" value="">

                             </div>
							 
							   <div class="form-group">

                                <label>Reduce your recruitment costs</label>
								<textarea rows="2" cols="50" class="form-control" name="descriptionfw" placeholder="Reduce your recruitment costs Description" data-bv-field="description"></textarea>
                               

                             </div>

                             <div class="form-group">
                                <label>Find staff by location</label>
								<textarea rows="2" cols="50" class="form-control" name="descriptionfem" placeholder="Find staff by location Description" data-bv-field="descriptionfem"></textarea>                               

                             </div>
							 
							  <div class="form-group">
                                <label>Find staff by Month</label>
								<textarea rows="2" cols="50" class="form-control" name="descriptionfws" placeholder="Find staff by Month Description" data-bv-field="descriptionfws"></textarea>                               

                             </div>
							 
							  <div class="form-group">
                                <label>Search for staff by Skill</label>
								<textarea rows="2" cols="50" class="form-control" name="descriptionmfav" placeholder="Search for staff by Skill Description" data-bv-field="descriptionmfav"></textarea>                         

                              </div>
							  
							  <div class="form-group">
                                <label>Promote your point of difference</label>
								<textarea rows="2" cols="50" class="form-control" name="descriptiontrack" placeholder="TPromote your point of difference Description" data-bv-field="descriptiontrack"></textarea>                         

                              </div>
							  
							  <div class="form-group">
                                <label>Make a favourites list</label>
								<textarea rows="2" cols="50" class="form-control" name="descriptionprofile" placeholder="Make a favourites list Description" data-bv-field="descriptionprofile"></textarea>                         

                              </div>
							  
							   <div class="form-group">
                                <label>Reduce your HR & Admin time</label>
								<textarea rows="2" cols="50" class="form-control" name="descriptionprocess" placeholder="Reduce your HR & Admin time Description" data-bv-field="descriptionprocess"></textarea>                 

                              </div>
							  
							   <div class="form-group">
                                <label>More features</label>
								<textarea rows="2" cols="50" class="form-control" name="descriptionfeature" placeholder="Track your applications Description" data-bv-field="descriptionfeature"></textarea>                 

                              </div>
							  
							  			 

                             <div class="box-footer">
                                <input type="submit" class="btn btn-primary" name="Update_profile" value="Add Plan">                

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

