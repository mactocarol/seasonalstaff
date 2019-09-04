<?php $this->load->view('admin/includes/sidebar'); ?>

<!-- Content Wrapper. Contains page content -->

  <div class="content-wrapper">

    <!-- Content Header (Page header) -->

    <section class="content-header">

      <h1>

        Edit Offer Codes

        <small>Control panel</small>

      </h1>

      <ol class="breadcrumb">

        <li><a href="<?php echo site_url('Admin/dashboard');?>"><i class="fa fa-dashboard"></i> Home</a></li>

        <li class="active">Edit Offer Codes</li>

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

         <section class="col-lg-7 ">

          <div class="alert alert-success" id="alert">

              <strong>Success!</strong> <?php print_r($items->message); ?>

          </div>

          </section>   

        <?php

        }else{

        ?>

         <section class="col-lg-7 ">

          <div class="alert alert-danger" id="alert">

              <strong>Error!</strong> <?php print_r($items->message); ?>

          </div>

          </section>   

        <?php

        }

      }

      ?>

                 

        <section class="col-lg-12 ">

             

               <div class="box">

                <div class="box-header">

                  <h3 class="box-title">Edit Offer Codes</h3>

                    <button class="btn btn-danger pull-right"><a href="<?php echo site_url('offer-list'); ?>" style="color:white">Go to Offer Codes List</a></button>

                </div>

                

                <div class="box-body">

                  <form role="form" id="offers" name="" method="post" action="<?php echo site_url().'edit-offer/'.$reslt->id; ?>">

                         <div class="col-lg-12">



                            <div class="col-lg-6 ">

                               <div class="form-group">

                                <label>Offer Name</label>

                                <input type="text" class="form-control" name="offer" placeholder="Offer" value="<?php echo !empty($reslt->offer_name) ? $reslt->offer_name : ''?>">

                             </div>

                            </div>

                            <div class="col-lg-6 ">

                                 <div class="form-group">

                                <label>Disocunt(<i class="fa fa-percent" aria-hidden="true"></i>)</label>

                                <input type="text" class="form-control" name="dicount_in_percentage" placeholder="Disocunt in %" value="<?php echo !empty($reslt->discount_percentage) ? $reslt->discount_percentage : ''?>">

                             </div>

                            </div>

                          </div>

                        <div class="col-lg-12 ">



                            <div class="col-lg-6 ">

                                <div class="form-group">

                                <label>Disocunt (<i class="fa fa-dollar aria-hidden="true"></i>)</label>

                                <input type="text" class="form-control" name="dicount_in_amount" placeholder="Disocunt Amount" value="<?php echo !empty($reslt->discount_amount) ? $reslt->discount_amount : ''?>">

                             </div>

                            </div>

                            <div class="col-lg-6 ">

                                <div class="form-group">

                                <label>Offer's Apply Date</label>

                                 <input type="text" class="form-control" name="offerdate" placeholder="MM-DD-YYY" value="<?php echo  date('d M Y', strtotime($reslt->from_date)); ?>"> 
                               
                             </div>

                            </div>

                          </div>

                         <div class="col-lg-12 ">



                            <div class="col-lg-6 ">

                              <div class="form-group">

                                <label>Offer's Valid Date</label>

                                <input type="text" class="form-control" name="offerTillDate" placeholder="MM-DD-YYY" value="<?php echo  date('d M Y', strtotime($reslt->to_date)); ?> ">

                             </div>

                            </div>
							
							<div class="col-lg-6 ">
                              <div class="form-group">
                                <label>Select User Type</label>
                                <select name="user_type"  id="user_type" class="form-control">
                              	<option value="employer" <?php if($reslt->user_type=="employer") { echo 'selected';} ?>>Employer</option>                                
                                <option value="staff" <?php if($reslt->user_type=="staff") { echo 'selected';} ?>>Staff</option>                                                             
                               </select>
                             </div>

                            </div>
							
							

                             <div class="col-lg-6 ">
                               <div class="form-group">
                                <label>Description</label>
                                <textarea rows="4" cols="50" class="form-control" name="description" placeholder="Offer Description"><?php echo !empty($reslt->description) ? $reslt->description : ''?></textarea>
                                

                             </div>
                            </div>



                            <div class="col-lg-6 ">

                               <div class="form-group">

                                 <input type="submit" class="btn btn-primary" name="Update_profile" value="Update">

                                

                             </div>

                            </div>

                          </div>

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
    $(document).ready(function(){
      var date_input=$('input[name="offerdate"]'); //our date input has the name "offerdate"
      var options={
        format: 'd M yyyy',
        todayHighlight: true,
        autoclose: true,
      };
      date_input.datepicker(options);
    })
</script>
<script>
        $(document).ready(function(){
      var date_input=$('input[name="offerTillDate"]'); //our date input has the name "offerTillDate"
      var options={
        format: 'd M yyyy',
        todayHighlight: true,
        autoclose: true,
      };
      date_input.datepicker(options);
    })
</script>