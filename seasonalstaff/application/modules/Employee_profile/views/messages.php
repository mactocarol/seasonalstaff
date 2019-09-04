<div class="breadcrumb text-center">
    <div class="container">
    <h1>Dashboard Page</h1>
    <ul><li><a href="#">home</a></li><li>Messages</li></ul>
    </div>
</div>
<!-- breadcrumb section End -->
<!-- Dashboard section Start -->
 <center><h4 class="hhm">Ask a question</h4> </center>
<div class="dashboard_section">
    <div class="container">
        <div class="row">
             <!-- Sidebar Start -->

            <?php include 'side_bar.php';?>
          
            <!-- Sidebar End -->
  <!-- Dashboard content Start -->
  
            <div class="col-xl-9 col-lg-8 col-md-12 col-sm-12">
                <div class="dashboard_content_part">					
					<center><span id="hh"><h5><?php if(isset($userdeatil[0]->first_name)){ echo $userdeatil[0]->first_name; } ?> <?php if(isset($userdeatil[0]->last_name)){ echo $userdeatil[0]->last_name."<br><span style='font-size:12px;margin-left: 34%;'>Send a message to … and then have the user they are sending the message to.<span>"; } ?></h5></center>	
                    <div class="dashboard_content">
                        <div class="employer_message_section">
						
                            <div class="row">						
                            	<!--user search section-->
                                <div class="col-lg-4 col-md-5 col-sm-12 pad_r_0">								
                                    <div class="find_user_part">
                                        <!-- search form -->
                                        <div class="user_search_form">
                                            <form action="#" method="post">
                                                <div class="form_group">
                                                    <input type="text" name="usersearch" id="usersearch" placeholder="Search Friend..." onKeyPress="edValueKeyPress()">				
                                                   <!-- <button type="submit" class="search_btn"><i class="fa fa-search"></i></button> -->
                                                </div>
                                            </form>
                                        </div>
                                        <!-- search form -->
										<div id="userlist">
										<?php if(isset($user)) { 
											foreach($user as $list){
											$photo = $list->image;
											?>
                                        <!-- user list start -->
                                        <a href="javascript:void(0);" onclick="user(<?php echo $list->id; ?>); users(<?php echo $list->id; ?>);">								
										<div class="find_user_list transition" id="cc<?php echo $list->id; ?>">
                                            <div class="thumbs">
											    <?php if($photo==''){ ?>
                                             <img src="<?php echo base_url(); ?>public/upload/userProfile/defaultuser.png">
                                                <?php } else {  ?>
											 <img src="<?php echo base_url(); ?>public/upload/userProfile/<?php echo $photo; ?>">
												<?php } ?>
											</div>
                                            <div class="user_right_text">
                                                <h5><?php echo $list->first_name; ?> <?php echo $list->last_name; ?></h5>
                                                <span class="times"><?php echo $list->no; ?></span>
                                            </div>
                                        </div>
										</a>
										<?php }}  ?>
										</div>
                                        <!-- user list End -->                                      
                                        
                                       
                                    </div>
                                </div>
                                <!--user search section-->
                                <div class="col-lg-8 col-md-7 col-sm-12 border_left">
								   <center><h2 id="msgno"></h2></center>
                                	<!-- message section -->
	                                <div class="messages_section">
	                                	<!-- heading Start -->
										 <div class="top_msg_heading" id="uheading">
										 	
										 </div>
		                               
		                                <!-- heading end -->
		                                <!-- Chat part Start -->
		                                <div class="user_chat_part" id="chat">
			                                
		                                </div>
		                                <!-- Chat part End -->
		                                <!-- bottom form Start -->
		                                <div class="bottom_chat_form">
		                                	<form method="post" action="#" id="msg_form">
		                                	
											<input type="hidden" name="sid" id="sid" value="<?php echo $this->session->userdata('user_id')?>">
											<input type="hidden" name="rid" id="rid" value="<?php echo $this->uri->segment(4);  ?>">
													
											<input type="hidden" name="rid1" id="rid1">
												
												
												<div class="chat_form" id="chatf">
		                                			<label class="attach_icon transition">
		                                				<!-- <input type="file" name="attach_file"> -->
		                                				<i class="fa fa-comments-o" title="chat"></i>
		                                			</label>
		                                															
                                					<textarea name="msg" id="msg" placeholder="Type your message here!" rows="3"></textarea>												
		                                			<!-- <span class="like_btn transition"><i class="fa fa-thumbs-o-up"></i>
		                                			</span> -->
		                                			<button type="button" class="chat_send_icon" onclick="msend();">
		                                				<i class="fa fa-paper-plane" aria-hidden="true" title="chat"></i>
		                                			</button>													
													<label id="msg-error" class="error" for="msg"><center></center></label>
		                                		</div>
		                                	</form>
		                                </div>
		                                <!-- bottom form End -->
	                                </div>
                                	<!-- message section -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- Dashboard content End -->
        </div>
    </div>
</div>

<script type="text/javascript">
$( document ).ready(function() {
var ct = document.getElementById("rid").value;
if(ct==''){
 document.getElementById("chatf").style.display = "none";
 document.getElementById("msgno").innerHTML = "No conversation found.";
}
});

function edValueKeyPress()
{
   var edValue = document.getElementById("usersearch");	
	var surid = edValue.value;   
		$.ajax({		
			url:'<?php echo base_url(); ?>Employee_profile/Profile/getmsglist',			
			type: 'POST',
			data:{'surid':surid},
			success: function(response){ 		
            $('#append').hide();            		
		    if(response==1){
		         
					$("#userlist").text("");		 
				}
				else
				{
					document.getElementById('userlist').innerHTML=response;
				}
			}
		});	
   
}


function user(rid)
	{ 
	document.getElementById("msgno").innerHTML = "";
	document.getElementById("chatf").style.display = "block";
	var ct = document.getElementById("rid").value;
	$("#cc"+ct).removeClass("active");
	document.getElementById("rid").value=rid; 
	$("#cc"+ct).addClass("active");			
     //alert(rid);
		$.ajax({		
			url:'<?php echo base_url(); ?>Employee_profile/Profile/getmeassage',			
			type: 'POST',
			data:{'rid':rid},
			success: function(response){ 
			//alert(response);
            $('#append').hide();            		
		    if(response==1){
		         
					$("#chat").text("");
				document.getElementById("hh").style.display = "none";	
				}
				else
				{
					document.getElementById('chat').innerHTML=response;
					document.getElementById("hh").style.display = "none";
				}
			}
		});		
    }
	
function users(rid)
	{     
	var ct = document.getElementById("rid1").value;
	$("#cc"+ct).removeClass("active");
	document.getElementById("rid1").value=rid; 
	$("#cc"+rid).addClass("active");  
		$.ajax({		
			url:'<?php echo base_url(); ?>Employee_profile/Profile/getmsglist',			
			type: 'POST',
			data:{'rid':rid},
			success: function(response){ 
			//alert(response);
            $('#append').hide();            		
		    if(response==1){
		         
					$("#userlist").text("");		 
				}
				else
				{
					document.getElementById('userlist').innerHTML=response;
				}
			}
		});		
    }	

var auto_refresh = setInterval(
function ()
{
$('#msglist').load(msglist());
//$('#users').load(users());
}, 2000); // refresh every 10000 milliseconds

var auto_refresh1 = setInterval(
function ()
{
//$('#msglist').load(msglist());
$('#users').load(users());
}, 10000);  // refresh every 10000 milliseconds
	
 function msglist()
	{	   
  	
  //var head= document.getElementsByTagName('head')[0];
  //var s = document.createElement("script");
  var rid=document.getElementById('rid').value;
 
 /*  s.type = "text/javascript";
  s.src = "<?php echo base_url(); ?>front/js/ajaxsingleusermsg.js";   
  head.appendChild(s); */
  
		$.ajax({		
			url:'<?php echo base_url(); ?>Employee_profile/Profile/getmeassage',
			type: 'POST',
			data:{'rid':rid},
			success: function(response){ 			
			document.getElementById('chat').innerHTML=response;
			 document.getElementById('chat').scrollTop = document.getElementById('chat').scrollHeight;
			 instanse = false;
			//document.getElementById("hh").style.display = "none";
			//document.getElementById('uheading').innerHTML=response;	
			}
		});		
    } 

function msend()
	{
   if(document.getElementById("msg").value!=''){	
	var rid = document.getElementById("rid").value;
	var sid = document.getElementById("sid").value;
	var msg = document.getElementById("msg").value;
	$.ajax({		
			url:'<?php echo base_url(); ?>Employee_profile/Profile/sendmsg',
			type: 'POST',
			data:{'rid':rid,'msg':msg,sid:sid},
			success: function(response){           
            document.getElementById("msg").value='';
            document.getElementById("chatmsg").innerHTML='';			
		    $.ajax({		
			url:'<<?php echo base_url(); ?>Employee_profile/Profile/getmeassage',			
			type: 'POST',
			data:{'rid':rid},
			success: function(response){ 
            $('#append').hide();            		
		    if(response==1){
		         
					$("#chat").text("");					
					$("#uheading").text("");
					document.getElementById("hh").style.display = "none";
				
				}
				else
				{
					document.getElementById('chat').innerHTML=response;					
					document.getElementById('uheading').innerHTML=response;	
				}
			}
		}); 
			}
		});	
   }
   else {
	   document.getElementById('chatmsg').innerHTML='Please Enter Message';
   }
	}
	
	
 var jvalidate = $("#msg_form").validate({			

                ignore: [],
                rules: {                                                                 
                       					   
						'msg': {
                                required: true                         					
                                  
                        }
						
                    },
           messages: {
                        
						
                     }					
                }); 		
</script>
<body onload="msglist()">
</body>