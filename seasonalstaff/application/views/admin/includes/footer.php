  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.0.0
    </div>
    <strong>Copyright &copy; 2019 <a href="#">Seasonal Jobs</a>.</strong> All rights
    reserved.
  </footer>

</div>
<script src="<?php echo base_url();?>public/bower_components/select2/dist/js/select2.full.min.js"></script>

  <?php if($field == 'Datepicker'){ ?>			
			<script src="<?php echo base_url();?>public/plugins/input-mask/jquery.inputmask.js"></script>
			<script src="<?php echo base_url();?>public/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
			<script src="plugins/input-mask/jquery.inputmask.extensions.js"></script>
			<script src="<?php echo base_url();?>public/bower_components/moment/min/moment.min.js"></script>
			<script src="<?php echo base_url();?>public/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
			<script src="<?php echo base_url();?>public/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
			<script src="<?php echo base_url();?>public/plugins/timepicker/bootstrap-timepicker.min.js"></script>
			<script src="<?php echo base_url();?>public/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
			<script src="<?php echo base_url();?>public/plugins/iCheck/icheck.min.js"></script>
			<!-- Page script -->
			<script>
			  $(function () {
				//Datemask dd/mm/yyyy
				$('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' });
				//Datemask2 mm/dd/yyyy
				$('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' });
				//Money Euro
				$('[data-mask]').inputmask();
			
				//Date range picker
				$('#reservation').daterangepicker();
				//Date range picker with time picker
				$('#reservationtime').daterangepicker({ timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A' });
				//Date range as a button
				$('#daterange-btn').daterangepicker(
				  {
					ranges   : {
					  'Today'       : [moment(), moment()],
					  'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
					  'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
					  'Last 30 Days': [moment().subtract(29, 'days'), moment()],
					  'This Month'  : [moment().startOf('month'), moment().endOf('month')],
					  'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
					},
					startDate: moment().subtract(29, 'days'),
					endDate  : moment()
				  },
				  function (start, end) {
					$('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
				  }
				);
			
				//Date picker
				$('#datepicker').datepicker({
				  autoclose: true
				});
			
				//iCheck for checkbox and radio inputs
				$('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
				  checkboxClass: 'icheckbox_minimal-blue',
				  radioClass   : 'iradio_minimal-blue'
				});
				//Red color scheme for iCheck
				$('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
				  checkboxClass: 'icheckbox_minimal-red',
				  radioClass   : 'iradio_minimal-red'
				});
				//Flat red color scheme for iCheck
				$('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
				  checkboxClass: 'icheckbox_flat-green',
				  radioClass   : 'iradio_flat-green'
				});
			
			
			
				//Timepicker
				$('.timepicker').timepicker({
				  showInputs: false
				});
			  });
			</script>
  <?php } ?>
  <?php if($field == 'Datatable'){ ?>			
			<!-- DataTables -->
			<script src="<?php echo base_url();?>public/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
			<script src="<?php echo base_url();?>public/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
			<!-- page script -->
			<script>
			  $(function () {
				$('#dataTable').DataTable();
				//$('#example2').DataTable({
				//  'paging'      : true,
				//  'lengthChange': false,
				//  'searching'   : true,
				//  'ordering'    : true,
				//  'info'        : true,
				//  'autoWidth'   : false
				//});
			  });
			</script>
  <?php } ?>
<!-- AdminLTE App -->
<script src="<?php echo base_url();?>public/dist/js/adminlte.min.js"></script>
<script src="<?php echo base_url();?>public/js/bootstrap3-typeahead.js"></script>
<script src="<?php echo base_url();?>public/js/bootstrap-tagsinput.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>

<!-- Page script -->
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2();
  });
</script>

<script>
    
    $(document).ready(function() {
        setTimeout(function(){ $("#alert").css("display","none");}, 3000);
	//alert('http://localhost/caroldata.com/hmvc_hotel_booking/registration/register_email_exists');
    $('#profile_form').bootstrapValidator({
        //container: '#messages',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            f_name: {
                validators: {
                    notEmpty: {
                        message: 'The First name is required and cannot be empty'
                    },
                }
            },
			l_name: {
                validators: {
                    notEmpty: {
                        message: 'The Last name is required and cannot be empty'
                    },
                }
            },
                       
			email: {
                validators: {
					notEmpty: {
						message : 'The email Field is required and cannot be empty '
					},
					 remote: {  
					 type: 'POST',
					 url: "<?php echo site_url();?>user/check_email_exists",
					 data: function(validator) {
						 return {
							 //email: $('#email').val()
							 email: validator.getFieldElements('email').val()
							 };
						},
					 message: 'This email is already in use.'     
					 }
				},
			},    
			
			password: {
				validators: {					
					identical: {
                        field: 'con_pass',
                        message: 'The password and its confirm are not the same'
                    },
					stringLength: {
						min: 6 ,
						max: 15,
						message: 'The password length min 6 and max 15 character Long'
					}
				}
			},
			repassword: {
				validators: {					
					identical: {
                        field: 'password',
                        message: 'The password and its confirm are not the same'
                    }
					
				}
			},
        }
    });
    
    $('#profile_update_form').bootstrapValidator({
        //container: '#messages',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            f_name: {
                validators: {
                    notEmpty: {
                        message: 'The First name is required and cannot be empty'
                    },
                }
            },
			l_name: {
                validators: {
                    notEmpty: {
                        message: 'The Last name is required and cannot be empty'
                    },
                }
            },
                       
			email: {
                validators: {
					notEmpty: {
						message : 'The email Field is required and cannot be empty '
					},
					 remote: {  
					 type: 'POST',
					 url: "<?php echo site_url();?>user/check_email_exists1",
					 data: function(validator) {
						 return {
							 //email: $('#email').val()
							 email: validator.getFieldElements('email').val()
							 };
						},
					 message: 'This email is already in use.'     
					 }
				},
			},    
			
			password: {
				validators: {					
					identical: {
                        field: 'con_pass',
                        message: 'The password and its confirm are not the same'
                    },
					stringLength: {
						min: 6 ,
						max: 15,
						message: 'The password length min 6 and max 15 character Long'
					}
				}
			},
			repassword: {
				validators: {					
					identical: {
                        field: 'password',
                        message: 'The password and its confirm are not the same'
                    }
					
				}
			},
        }
    });
    
    $('#profile_form_admin').bootstrapValidator({
        //container: '#messages',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            f_name: {
                validators: {
                    notEmpty: {
                        message: 'The First name is required and cannot be empty'
                    },
                }
            },
			l_name: {
                validators: {
                    notEmpty: {
                        message: 'The Last name is required and cannot be empty'
                    },
                }
            },
                       
			email: {
                validators: {
					notEmpty: {
						message : 'The email Field is required and cannot be empty '
					},
					 remote: {  
					 type: 'POST',
					 url: "<?php echo site_url();?>Admin/check_email_exists/<?=$this->uri->segment(3)?>",
					 data: function(validator) {
						 return {
							 //email: $('#email').val()
							 email: validator.getFieldElements('email').val()
							 };
						},
					 message: 'This email is already in use.'     
					 }
				},
			},    
			
			password: {
				validators: {					
					identical: {
                        field: 'con_pass',
                        message: 'The password and its confirm are not the same'
                    },
					stringLength: {
						min: 6 ,
						max: 15,
						message: 'The password length min 6 and max 15 character Long'
					}
				}
			},
			repassword: {
				validators: {					
					identical: {
                        field: 'password',
                        message: 'The password and its confirm are not the same'
                    }
					
				}
			},
        }
    });


 	 

    });
  </script>
  <script src="<?php echo base_url();?>public/dovelopment_js/formValidation.js"></script>
  <script type='text/javascript' src='<?php echo base_url(); ?>public/front_end/plugin/jquery-validation/jquery.validate.js'></script>
  <script>
    // $('#password').keyup(function(){
    //     //alert();
    //     if($('#password').val() !== ''){            
    //         if($('#repassword').val() === ''){
    //             //alert($('#repassword').val());
    //             $(':input[type="submit"]').prop('disabled', true);
    //         }else{
    //             $(':input[type="submit"]').prop('disabled', false);
    //         }
    //     }
    // });
  </script>
<script>
	CKEDITOR.replace( 'editor1' );
</script>

</body>
</html>