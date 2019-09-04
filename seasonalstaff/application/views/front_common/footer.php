<footer>
  	<div class="container">
    	<div class="row">
            <div class="col-lg-6">
                <div class="footer_menu">
                    <ul>
                        <li><a href="<?php echo base_url(); ?>Welcome/termconditions">Terms & Conditions</a></li>
                        <li><a href="<?php echo base_url(); ?>Welcome/privacypolicy">Privacy Policy</a></li>            
                    </ul>
                </div>
            </div>
            <div class="col-lg-6">
                <ul class="ftr_social_icon">
                	<li><a href="#"><i class="fa fa-facebook"></i></a></li>
                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                    <li><a href="#"><i class="fa fa-google"></i></a></li>
                    <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                    <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                </ul>
            </div>
        </div>
    </div>
</footer>
<div class="copyright_footer">
    <div class="container">
        <div class="copyright_text">
            <p>Copyright Seasonal Staff © 2018. All Rights Reserved </p>
        </div>
    </div>
</div>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
	
<script>
    $(document).ready( function () {
    $('#dataTable').DataTable();
    } );         
</script>

	<script src="<?php echo base_url();?>public/front_end/js/popper.min.js"></script>
	<script src="<?php echo base_url();?>public/front_end/js/bootstrap.min.js"></script>
	<script src="<?php echo base_url();?>public/front_end/js/plugins/selectpicker/bootstrap-select.js"></script>
	<!-- jquery ui -->
	<script src="<?php echo base_url();?>public/front_end/js/plugins/jquery-ui/jquery-ui.js"></script>
	<!-- jquery ui -->
	<script src="<?php echo base_url();?>public/front_end/js/custom.js"></script>
    <script src="<?php echo base_url();?>public/dovelopment_js/formValidation.js"></script>




<script type="text/javascript">
$(document).ready(function(){
  $("#code").blur(function(){
  var code = $(this).val();
  if(code.replace(/^\s+|\s+$/g, "").length == 0){ 
  //document.getElementById("showcodm").style.display = "none";
  document.getElementById("showcodm").innerHTML = " ";
  }
  var account_type = $('#account_type').val();
  //alert(account_type);
  /* if(account_type==null){
  document.getElementById("showcodm").innerHTML = "Please select type of membership";
  }
  else { */
   $.ajax({
            url: site_url +"Welcome/matchcode",
            type: "POST",
            data: {
                value: code,code
             },
             success: function (msg) {
				//alert(msg); 
				if(msg==2){
					document.getElementById("showcodm").innerHTML = "Your code expire";
					document.getElementById("showcodmv").innerHTML = " ";
					$('#signup').attr('disabled',true);
					this.submit();
				}
			    else if(msg==1){
				document.getElementById("showcodmv").innerHTML = "Your code valid";	
				document.getElementById("showcodm").innerHTML = " ";
				$('#signup').attr('disabled',false);
					this.submit();
				}
				else if(msg==4){
				document.getElementById("showcodm").innerHTML = "";
				document.getElementById("showcodmv").innerHTML = " ";
				$('#signup').attr('disabled',false);
					this.submit();	
				}
			   else{
				document.getElementById("showcodm").innerHTML = "Your code invalid";
				document.getElementById("showcodmv").innerHTML = " ";
				$('#signup').attr('disabled',false);
					this.submit();
			   }
			 }
   });
 /* } */

   });
});

jQuery.validator.addMethod("lettersonly", function(value, element) {
   return this.optional(element) || /^[a-z\s]+$/i.test(value);
}, "Only alphabetical characters");

jQuery.validator.addMethod("numbers", function (value, element) {
   return this.optional(element) || /^(\d+|\d+,\d{1,2})$/.test(value);
}, "Only numbers allow");


var jvalidate = $("#signUpUser").validate({
	
                ignore: [],
                rules: {                                                                 
                        'email': {
                                required: true,
								email: true,
                                minlength: 6,
                                maxlength: 300,
							    remote: {
		url: "<?php echo base_url(); ?>Welcome/checkMail",
        type: "post",
        data: {
          email: function() {			  
            return $( "#email" ).val();
          }
		
        }
      }
                        },
						
						
						'name': {
                                required: true,
                                minlength: 3,
                                maxlength: 50,
							   lettersonly:true
							},
							
						'account_type': {
                                required: true                            
							},
								
							
						'lastname': {
                                required: true,
                                minlength: 3,
                                maxlength: 50,
							   lettersonly:true
							},
						'loaction_c': {
                                required: true
                               
						},	


						'phone': {
                                required: true,
                                minlength: 5,
                                //maxlength: 14,
								numbers:true
							},
                           'username': {
                                required: true,
                           remote: {
		url: "<?php echo base_url(); ?>Welcome/checkusername",
        type: "post",
        data: {
          username: function() {			  
            return $( "#username" ).val();
          }
		
        }
      }
                 								
							},						
						
						'password': {
                                required: true,
                                minlength: 5,
                                maxlength: 16                              
                        },
						 'C_pass': {
                                required: true,
                                minlength: 5,
                                maxlength: 16,
								equalTo: "#password"                              
                        },
						'term': {
                                required: true
                              
							},
					/*	'date_avail': {
							required: true
						},*/
					    'age': {
						  required: true	
						}
                    },
           messages: {
                        'email': 
						{
							required:"Please enter email.",
                            email:"Please enter valid email",
							remote:"Already registered with this email id"							
						}, 
                        'username': 
						{
							required:"Please enter username.",                            
							remote:"Already registered with this username"							
						},							
			            'phone': "please enter a valid phone number.",     
                       				
                     						
                     }					
                });	

 </script>
</body>
</html>