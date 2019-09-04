<?php       
		date_default_timezone_set("Asia/Kolkata");
        include('config.php');
        include('hybridauth/Hybrid/Auth.php');
        if(isset($_GET['provider']))
        {
        	$provider = $_GET['provider'];
        	
        	try{
        	
        	$hybridauth = new Hybrid_Auth( $config );
        	
        	$authProvider = $hybridauth->authenticate($provider);

	        $user_profile = $authProvider->getUserProfile();
	        
			if($user_profile && isset($user_profile->identifier))
	        {
				//print_r($user_profile); die;
	          
				$fname=uniqid().'.jpg';
				$image = file_get_contents($user_profile->photoURL); // sets $image to the contents of the url
			   
				$uname=$user_profile->displayName;
				$email=$user_profile->email;
				$cdt=date("Y-m-d H:i:s");
				
				$sql="select * from mlm_users where email='".$email."'";
				$query=mysqli_query($con,$sql);
				//echo mysqli_num_rows($query); die;
				if(mysqli_num_rows($query)>0)
				{
					if($row=mysqli_fetch_array($query))
					{
					$id=$row['id'];
					
					if($row['image']!="")
					{
					@unlink("upload/profile_image/".$row['image']);					
					}

                    file_put_contents('/home2/macto4j1/public_html/car-rental/upload/profile_image/'.$fname.'', $image);
				
						
						$sql="update mlm_users set email='".$email."',image='".$fname."',f_name='".$user_profile->firstName."',l_name='".$user_profile->lastName."' where id='".$id."'";
						$q=mysqli_query($con,$sql);
						
					}
					
				}	
				else
				{
                    file_put_contents('/home2/macto4j1/public_html/car-rental/upload/profile_image/'.$fname.'', $image);
					$sql="insert into mlm_users(f_name,l_name,email,image,is_verified) values('".$user_profile->firstName."','".$user_profile->lastName."','".$email."','".$fname."','1')";
					$q=mysqli_query($con,$sql) or die(mysqli_error($con));
					$id=mysqli_insert_id($con);
					//echo $id; die;
										
				}
				
				?>
				<script>
				window.location="<?php echo $base_url; ?>user/social_login_check/<?php echo $id; ?>";
				</script>
				<?php
	        }	        

			}
			catch( Exception $e )
			{ 
			
				 switch( $e->getCode() )
				 {
                        case 0 : header("location: $base_url"); break;
                        case 1 : header("location: $base_url"); break;
                        case 2 : header("location: $base_url"); break;
                        case 3 : header("location: $base_url"); break;
                        case 4 : header("location: $base_url"); break;
                        case 5 : header("location: $base_url"); break;
                        case 6 : header("location: $base_url"); break;
                        case 7 : header("location: $base_url"); $twitter->logout(); break;
                        case 8 : header("location: $base_url"); break;
                }

                // well, basically your should not display this to the end user, just give him a hint and move on..
                echo "<br /><br /><b>Original error message:</b> " . $e->getMessage();

                echo "<hr /><h3>Trace</h3> <pre>" . $e->getTraceAsString() . "</pre>";

			}
        
        }
?>