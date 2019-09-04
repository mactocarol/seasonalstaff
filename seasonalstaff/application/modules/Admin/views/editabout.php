<?php $this->load->view('admin/includes/sidebar'); ?>

<!-- Content Wrapper. Contains page content -->

  <div class="content-wrapper">

    <!-- Content Header (Page header) -->

    <section class="content-header">

      <h1>

        Edit About Us

        <small>Control panel</small>

      </h1>

      <ol class="breadcrumb">

        <li><a href="<?php echo site_url('admin/dashboard');?>"><i class="fa fa-dashboard"></i> Home</a></li>

        <li class="active">Edit  About Us</li>

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

                  <h3 class="box-title">Edit About Us</h3>

                    <button class="btn btn-danger pull-right"><a href="<?php echo site_url(); ?>Admin/aboutus" style="color:white">Go to About Us</a></button>

                </div>

                <!-- /.box-header -->

                <div class="box-body">

             <form Plan="form" id="add_coupon_code" method="post" action="<?php echo site_url();?>Admin/editabout/<?php echo  $reslt->id; ?>" enctype="multipart/form-data">

                        <!-- text input -->
						<section class="col-lg-12 connectedSortable">

                              <div class="form-group">

                                <label>Heading</label>

                                <input type="text" class="form-control" name="heading" id="heading" placeholder="Plan" 
								value="<?php echo isset($reslt->heading) ? $reslt->heading : '';?>">

                             </div>

                             <div class="form-group">
                                <label>Description</label>
                                 <textarea name="description" id="description" class="form-control"><?php echo  (!empty($reslt->	description)) ? $reslt->description : '' ?></textarea>
                             </div>
							 
							  <div class="form-group">
                                <label>Image*</label>
                                <input type="file" class="form-control" name="image" id="image" value=""  onchange="readURL(this);" >
								
								<input type="hidden" class="form-control" name="imageold" id="imageold" value="<?php echo  (!empty($reslt->image)) ? $reslt->image : ''?>" >
								
                              <?php
                              if(!empty($reslt->image)){?>
                               <img id="blah" src="<?php echo base_url('public/upload/about/'.$reslt->image); ?>" width="100px" height="100px" alt="<?php echo  (!empty($reslt->heading)) ? $reslt->heading : ''?>"> 
                                <?php

                              }else{
                              ?>
                              <img id="blah" src="<?php echo base_url('public/upload/profile_image/no_image.jpg'); ?>" width="100px" height="100px"> 
                              <?php 
                              }
                               ?>
                                
                             </div>
							 
							 <div class="form-group">
                                <label>Find Staff Description</label>
                                 <textarea name="staff_description" id="staff_description" class="form-control"><?php echo  (!empty($reslt->staff_description)) ? $reslt->staff_description : '' ?></textarea>
                             </div>
							 
							  <div class="form-group">
                                <label>Find Work Description</label>
                                 <textarea name="emp_description" id="emp_description" class="form-control"><?php echo  (!empty($reslt->emp_description)) ? $reslt->emp_description : '' ?></textarea>
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

