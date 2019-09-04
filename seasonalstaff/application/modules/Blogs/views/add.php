<?php $this->load->view('admin/includes/sidebar'); ?>

<!-- Content Wrapper. Contains page content -->

  <div class="content-wrapper">

    <!-- Content Header (Page header) -->

    <section class="content-header">

      <h1>

        Add Blog

        <small>Control panel</small>

      </h1>

      <ol class="breadcrumb">

        <li><a href="<?php echo site_url('admin/dashboard');?>"><i class="fa fa-dashboard"></i> Home</a></li>

        <li class="active">Add Blog</li>

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

                  <h3 class="box-title">Add Blog</h3>

                    <button class="btn btn-danger pull-right"><a href="<?php echo site_url('Blog-list'); ?>" style="color:white">Go to Blog List</a></button>

                </div>

                <!-- /.box-header -->

                <div class="box-body">

                  <form role="form" id="blogs_form" name="" method="post" action="<?php echo site_url('add-Blog'); ?>" enctype="multipart/form-data">

                        <!-- text input -->

                        



                           <section class="col-lg-12 connectedSortable">

                             <div class="form-group">

                                <label>Blog Title</label>

                                <input type="text" class="form-control" name="blog_title" placeholder="Blog Title" value="" >

                             </div>

                             <div class="form-group">
                                <label>Image*</label>
                                <input type="file" class="form-control" name="image" value="" >
                             </div>
							 
                             <div class="form-group">
                                <label>Description </label>                                
                                <textarea name="editor1" id="editor1" class="form-control"></textarea>
    
                             </div>
							 
							 <div class="form-group">
                                <label>Category</label>                                
                               <select name="category" class="form-control">
                                <option value="">Select Job Category</option>
                                <?php 
							
								if(isset($category)){ foreach($category as $list){
                               	?>
                                <option value="<?php echo $list['id']; ?>"><?php echo $list['cat_name']; ?></option>                               
								<?php }} ?>                                 
                                 
                               </select>  
                             </div>
							 

                             <div class="box-footer">

                                <input type="submit" class="btn btn-primary" name="Update_profile" value="Add Blog">

                                

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

