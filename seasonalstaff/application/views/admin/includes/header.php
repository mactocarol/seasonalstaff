<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <link rel="icon" href="<?php echo base_url(); ?>public/images/seasonal_fav.ico">
  <title>Seasonal Staff </title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo base_url();?>public/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo base_url();?>public/bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="<?php echo base_url();?>public/bower_components/Ionicons/css/ionicons.min.css">  
  <link rel="stylesheet" href="<?php echo base_url();?>public/bower_components/select2/dist/css/select2.min.css">	


  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>

  <link rel="stylesheet" href="<?php echo base_url();?>public/css/bootstrap-tagsinput.css">  
    <link rel="stylesheet" href="<?php echo base_url();?>public/css/custom.css"> 
  
  <?php if($field == 'Datepicker'){ ?>
			<link rel="stylesheet" href="<?php echo base_url();?>public/bower_components/bootstrap-daterangepicker/daterangepicker.css">
			<link rel="stylesheet" href="<?php echo base_url();?>public/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
			<link rel="stylesheet" href="<?php echo base_url();?>public/plugins/timepicker/bootstrap-timepicker.min.css">			
  <?php } ?>
  <?php if($field == 'Datatable'){ ?>
			<!-- DataTables -->
			<link rel="stylesheet" href="<?php echo base_url();?>public/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <?php } ?>	      
  <link rel="stylesheet" href="<?php echo base_url();?>public/dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="<?php echo base_url();?>public/dist/css/skins/_all-skins.min.css">
    <script src="https://cdn.ckeditor.com/4.8.0/standard/ckeditor.js"></script>
  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
	
	<script src="<?php echo base_url();?>public/bower_components/jquery/dist/jquery.min.js"></script>
	<script src="<?php echo base_url();?>public/bower_components/jquery-ui/jquery-ui.min.js"></script>
	<script src="<?php echo base_url();?>public/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
	<script src="<?php echo base_url();?>public/js/bootstrapValidator.min.js"></script>

  <script type="text/javascript">
    var site_url = "<?php echo site_url(); ?>";
    var base_url = "<?php echo base_url(); ?>";
    var id= "<?=$this->uri->segment(2)?>";
  </script>
  
<script src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyAC90POLhEY3ZLhZq4PUwvBZAgOKLpixfk" type="text/javascript"></script>

	<style type="text/css">
		input.num {
			width: 40%;
			background: #f2f2f2;
			border: none;
	}
	.mytb td{text-align: center;}
	.mytb .table-bordered>tbody>tr>td{background: #22243b;}
	.mytb span {
			background: #f77d0bb0;
			width: 25px;
			height: 25px;
			line-height: 25px;
			display: inline-block;
			color: #fff;
			margin-bottom: 5px;
	}
	.mytb th{text-align: center;background: #f77d0bb0;color: #fff;font-size: 24px;}
	</style>
</head>
<body class="hold-transition skin-red sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <a href="index2.html" class="logo">
      <span class="logo-mini"><b>S</b></span>
      <span class="logo-lg"><b>Seasonal Staff</b></span>
    </a>
    <nav class="navbar navbar-static-top">
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
			 <?php if($result->image==""){ ?>
              <img src="<?php echo base_url(); ?>public/upload/profile_image/1559209916User-icon.png" class="user-image" alt="User Image">
			 <?php } else {  ?>
			    <img src="<?php echo base_url(); ?>public/upload/profile_image/<?=$result->image?>" class="user-image" alt="User Image">
			 <?php } ?>
              <span class="hidden-xs"><?php print_r($this->session->userdata('email'));?></span>
            </a>
            <ul class="dropdown-menu">
              <li class="user-header">
               
                <img src="<?php echo base_url(); ?>public/upload/profile_image/<?=$result->image?>" class="img-circle" alt="User Image">

                <p>
                  <?php print_r($this->session->userdata('email'));?>                  
                </p>
              </li>
              
              <li class="user-footer">
                <div class="pull-left">
                  <a href="<?php echo site_url('Admin/update_profile'); ?>" class="btn btn-default btn-flat"> Profile </a>
                </div>
                <div class="pull-right">
                  <a href="<?php echo site_url('Admin/logout'); ?>" class="btn btn-default btn-flat"> Sign out</a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>