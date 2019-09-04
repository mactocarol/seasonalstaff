<?php $this->load->view('admin/includes/sidebar'); ?>

<!-- Content Wrapper. Contains page content -->

  <div class="content-wrapper">

    <!-- Content Header (Page header) -->

    <section class="content-header">

      <h1>

        Edit Add On's

        <small>Control panel</small>

      </h1>

      <ol class="breadcrumb">

        <li><a href="<?php echo site_url('Admin/dashboard');?>"><i class="fa fa-dashboard"></i> Home</a></li>

        <li class="active">Edit Add On's</li>

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

                  <h3 class="box-title">Edit Add On's</h3>

                    <button class="btn btn-danger pull-right"><a href="<?php echo site_url('Package-list'); ?>" style="color:white">Go to Add On's List</a></button>

                </div>

                <!-- /.box-header -->

                <div class="box-body">

                  <form role="form" id="Package_form" name="" method="post" action="<?php echo site_url().'edit-Package/'.$reslt->id; ?>">

                        <!-- text input -->

                        



                           <section class="col-lg-12 connectedSortable">

                             
                             <div class="form-group">

                               <label>Add On's</label>

                                 <input type="text" class="form-control" name="name" placeholder="Package" value="<?php echo (!empty($reslt->name)) ? $reslt->name : ''?>" > 

                             </div>

                             <div class="form-group">

                               <label>Price</label>

                                 <input type="number" class="form-control" name="price" placeholder="Price" value="<?php echo (!empty($reslt->price)) ? $reslt->price : ''?>"> 

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

