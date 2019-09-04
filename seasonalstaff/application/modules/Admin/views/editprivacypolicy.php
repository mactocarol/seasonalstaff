<?php $this->load->view('admin/includes/sidebar'); ?>

<!-- Content Wrapper. Contains page content -->

  <div class="content-wrapper">

    <!-- Content Header (Page header) -->

    <section class="content-header">

      <h1>

        Edit Privacy Policy

        <small>Control panel</small>

      </h1>

      <ol class="breadcrumb">

        <li><a href="<?php echo site_url('admin/dashboard');?>"><i class="fa fa-dashboard"></i> Home</a></li>

        <li class="active">Edit Privacy Policy</li>

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

                  <h3 class="box-title">Edit Privacy Policy</h3>

                    <button class="btn btn-danger pull-right"><a href="<?php echo site_url(); ?>Admin/privacypolicy" style="color:white">Go to Privacy Policy</a></button>

                </div>

                <!-- /.box-header -->

                <div class="box-body">

             <form Plan="form" id="add_coupon_code" method="post" action="<?php echo site_url();?>Admin/editprivacypolicy/<?php echo  $reslt->id; ?>" enctype="multipart/form-data">

                        <!-- text input -->
						<section class="col-lg-12 connectedSortable">

                              <div class="form-group">

                             

                             <div class="form-group">
                                <label>Description</label>
                                 <textarea name="description" id="description" class="form-control"><?php echo  (!empty($reslt->describtion)) ? $reslt->describtion : '' ?></textarea>
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
  <script>  
var jvalidate = $("#add_coupon_code").validate({
	
                ignore: [],
                rules: {                                                                 
                        					
						'heading': {
                                required: true,
                                minlength: 3,
                                maxlength: 3
							},
							
						'description': {
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
<script>
CKEDITOR.replace( 'description' );
CKEDITOR.replace( 'staff_description' );
CKEDITOR.replace( 'emp_description' );



    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#blah').attr('src', e.target.result).width(100).height(100);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

