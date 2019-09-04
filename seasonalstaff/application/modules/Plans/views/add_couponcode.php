<?php $this->load->view('admin/includes/sidebar'); ?>

<!-- Content Wrapper. Contains page content -->

  <div class="content-wrapper">

    <!-- Content Header (Page header) -->

    <section class="content-header">

      <h1>

        Add Coupon Code 

        <small>Control panel</small>

      </h1>

      <ol class="breadcrumb">

        <li><a href="<?php echo site_url('admin/dashboard');?>"><i class="fa fa-dashboard"></i> Home</a></li>

        <li class="active">Add Coupon Code </li>

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

                  <h3 class="box-title">Add Coupon Code </h3>

                    <button class="btn btn-danger pull-right"><a href="<?php echo site_url('coupon-list'); ?>" style="color:white">Go to Plan List</a></button>

                </div>

                <!-- /.box-header -->

                <div class="box-body">
                <form role="form" id="add_coupon_code" name="" method="post" action="<?php echo site_url('add-coupon'); ?>">

                        <!-- text input -->
                  <section class="col-lg-12 connectedSortable">

                             <div class="form-group">

                                <label>Coupon Code</label>

                                <input type="text" class="form-control" name="couponc"  id="couponc" placeholder="couponc" value="">

                             </div>

                             <div class="form-group">

                                <label>Discount</label>

                                <input type="text" class="form-control" name="amount" id="amount" placeholder="Amount" value="">

                             </div>

                             <div class="box-footer">

                                <input type="submit" class="btn btn-primary" name="Update" value="Add Coupon Code">

                                

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
<script>  
var jvalidate = $("#add_coupon_code").validate({
	
                ignore: [],
                rules: {                                                                 
                        					
						'couponc': {
                                required: true,
                                minlength: 3,
                                maxlength: 3
							},
							
						'amount': {
                                required: true                            
							}
								
					
						
                    },
           messages: {
                       		
                     						
                     }					
                });	
				
</script>
<style>
.error {
    color: red;
}
</style>
