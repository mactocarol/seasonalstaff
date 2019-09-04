<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends HT_Controller { 

	function __construct() {

		parent::__construct();	

		$this->load->model('Welcome_model');	
        $this->load->library('facebook');
        $this->load->library('googleplus');
        $this->load->helper('template_helper');
		$this->load->library("pagination");
        $this->load->library('Ajax_pagination');
		$this->load->library('session');
        $this->perPage = 10;
		}

	public function index(){
        $userData = array();     
       
        if($this->facebook->is_authenticated()){
         
         $fbUser = $this->facebook->request('get', '/me?fields=id,first_name,last_name,email,link,gender,picture');

            //print_r($fbUser); die;

            $userData['facebook'] = 'facebook';			
            $userData['facebook_id']    = !empty($fbUser['id'])?$fbUser['id']:'';;
            $userData['first_name']    = !empty($fbUser['first_name'])?$fbUser['first_name']:'';
            $userData['last_name']    = !empty($fbUser['last_name'])?$fbUser['last_name']:'';
            $userData['email']        = !empty($fbUser['email'])?$fbUser['email']:'';
            $userData['gender']        = !empty($fbUser['gender'])?$fbUser['gender']:'';
            $userData['server_image']    = !empty($fbUser['picture']['data']['url'])?$fbUser['picture']['data']['url']:'';
            $userData['server_link']        = !empty($fbUser['link'])?$fbUser['link']:'';
            
          
            $userID = $this->Welcome_model->checkUser($userData);
           
           
            if(!empty($userID)){

                $result = $this->Welcome_model->SelectSingleRecord('users',array('*'),array("id"=>$userID),$orderby=array());
                $em_staff=  $result->em_staff_status;
                $role=  $result->role;
                $em_status = $result->email_status;				
				$deletes =$result->delete; 
                $sess_array = array(
                        'user_id' => $result->id,
                        'email' => $result->username,
                        'user_group_id' => 1,
                        'image' =>$result->image,
                        'userData'=> $userData,
                        'logged_in' => TRUE
                        );               
                
                 $this->session->set_userdata($sess_array);
				
				
              	if($deletes==1){
					   redirect('Welcome/deactivateaccoount');   
			    }
						
				$data['userData'] = $userData;	
				$this->session->set_userdata('userData', $userData);        

               
                 if(!empty($this->session->userdata('userData'))){ 
				 if($em_status==0){
		                 
						 redirect('Welcome/emailnotverify');
						} 
				 
				 if($role=='employer'){
						if($em_staff==0){
						redirect('employee-staff-pricing');	
						}
                        redirect('Welcome/user');  
                        }
                        if($role=='staff'){
						if($em_staff==0){
						redirect('staff-membership');	
						}	
                        redirect('Welcome/user');    
                        }	
                    	
                }                 
                   

                   


            }else{
               $data['userData'] = array();
            }
            
            // Get logout URL
            $data['logoutURL'] = $this->facebook->logout_url();
        }else{
            // Get login URL
            $data['authURL'] =  $this->facebook->login_url();
        }


/*-------------------------------------------------------*/


         $data['login'] =  $this->googleplus->loginURL();


            $data['maplocation'] = $this->Welcome_model->selectmap();
			$data['maplocations'] = $this->Welcome_model->selectmapstaff();
    		$this->load->view('front_common/header',$data);
    		$this->load->view('pages/index',$data);
    		$this->load->view('front_common/footer');
	}

    public function googleLogin(){
   
        if($this->googleplus->getAuthenticate()){
            $userInfo = $this->googleplus->getUserInfo();

            if($userInfo){

                $userData['google'] = 'google';
				//$userData['role'] = $this->session->userdata('utype');
                $userData['google_id']      = $userInfo['id'];
                $userData['first_name']     = $userInfo['given_name'];
                $userData['last_name']      = $userInfo['family_name'];
                $userData['email']          = $userInfo['email'];
				//$userData['role']           = $userInfo['role'];
                $userData['gender']         = !empty($userInfo['gender'])?$userInfo['gender']:'';
                $userData['google_locale']         = !empty($userInfo['locale'])?$userInfo['locale']:'';
                $userData['server_link']           = !empty($userInfo['link'])?$userInfo['link']:'';
                $userData['server_image']        = !empty($userInfo['picture'])?$userInfo['picture']:'';
                
                
                $userID = $this->Welcome_model->google_checkUser($userData);
                if($userID){

                $result = $this->Welcome_model->SelectSingleRecord('users',array('*'),array("id"=>$userID),$orderby=array());
                
				$em_staff=  $result->em_staff_status;
                $role=  $result->role;
				$deletes =$result->delete;
                $em_status = $result->email_status; 			
                $sess_array = array(
                        'user_id' => $result->id,
                        'email' => $result->username,
                        'user_group_id' => 1,
                        'image' =>$result->image,
                        'userData'=> $userData,
                        'logged_in' => TRUE
                        );

                
                    if($deletes==1){
					   redirect('Welcome/deactivateaccoount');   
					   }
				     $this->session->set_userdata($sess_array);               

                     $this->session->set_userdata('userinfo',$userInfo);                   
                     if(!empty($this->session->userdata('userinfo'))){
					 if($em_status==0){											
						//$this->session->set_flashdata('msg', "Please verify your Email account. Once Verified your information will show to users!");
						 redirect('Welcome/emailnotverify');
						} 
					 
					 if($role=='employer'){
						if($em_staff==0){
						redirect('employee-staff-pricing');	
						}
                        redirect('Welcome/user');  
                        }
                        if($role=='staff'){
						if($em_staff==0){
						redirect('staff-membership');	
						}	
                        redirect('Welcome/user');    
                        }	
                    	
						
                    }

                }    
                
            }
         

        }else{
        $data['login'] =  $this->googleplus->loginURL();
        $this->load->view('front_common/header',$data);
        $this->load->view('pages/index',$data);
        $this->load->view('front_common/footer');

        }


    }

   public function frontheader($data=null){
		     
		$data['authURL'] =  $this->facebook->login_url();
		$data['login'] =  $this->googleplus->loginURL();
		$this->load->view('front_common/header',$data);	 
	}


	public function aboutUs(){
		
		$data['about'] = $this->Welcome_model->SelectRecord('aboutus','*',array(),'id asc');		
		$this->frontheader();
		$this->load->view('pages/aboutUs',$data);
		$this->load->view('front_common/footer');
	}

		public function contact(){
		
		$this->frontheader();
		$this->load->view('pages/contact');
		$this->load->view('front_common/footer');
	}

public function blog($rowno=0){
			
		$search = "";	
		
		if($this->input->post('submit') != NULL ){
	        $search = $this->input->post('search');
			$this->session->set_userdata(array("search"=>$search));
				
		}else{
			if($this->session->userdata('search') != NULL){
				$search = $this->session->userdata('search');				
			}		
			
			
		}
		//echo $search; die;
		
		// Row position
		$rowperpage = 5;
		
		if($rowno != 0){
			$rowno = ($rowno-1) * $rowperpage;
		}
        $data['blogcategory'] = $this->Welcome_model->SelectRecord('blog_category','*',array("cat_name"=>$search),'id asc');	       
	   if(count($data['blogcategory'])!=0){	  
	   $category =$data['blogcategory'][0]['id']; 
	   }
	   else{
	   $category='null';   
	   }	
	   $allcount = $this->Welcome_model->selectblogcount($search,$category);
	   $users_record = $this->Welcome_model->selectblog($rowno,$rowperpage,$search,$category);
	   $data['blog'] = $this->Welcome_model->selectblogs();
	   $data['blogcategory'] = $this->Welcome_model->SelectRecord('blog_category','*',array(),'id asc');
	   
	    $config['base_url'] = base_url().'Welcome/blog';
      	$config['use_page_numbers'] = TRUE;
		$config['total_rows'] = $allcount;
		$config['per_page'] = $rowperpage;

		// Initialize
		$this->pagination->initialize($config);
		
		$data['pagination'] = $this->pagination->create_links();
		$data['bloglist'] = $users_record;
		$data['row'] = $rowno;
		$data['search'] = $search_text;
		
		$this->frontheader();
		$this->load->view('pages/blog',$data);
		$this->load->view('front_common/footer');
	}

		public function pricing(){
		$uid= $this->session->userdata("user_id");
        $data['user'] = $this->Welcome_model->SelectRecord('users','*',array("id"=>$uid),'id asc');		
		$data['em_price'] = $this->Welcome_model->SelectRecord('pricing_staff','*',array(),'id asc');
		$data['em_pricestaff'] = $this->Welcome_model->SelectRecord('pricing_staffplan','*',array(),'id asc');
		
		$this->frontheader();
		$this->load->view('pages/pricing',$data);
		$this->load->view('front_common/footer');
	}
	
public function blogdetail($id){
	    $data['blogd'] = $this->Welcome_model->SelectRecord('blog','*',array("id"=>$id),'id asc');
		$data['bloglist'] = $this->Welcome_model->selectblogs();
		$data['blogcomment'] = $this->Welcome_model->blogcomment($id);
		$data['blogcategory'] = $this->Welcome_model->SelectRecord('blog_category','*',array(),'id asc');
        $this->frontheader();
		$this->load->view('pages/blogdetail',$data);
		$this->load->view('front_common/footer');
}

public function category($id){
	    $data['bloglist'] = $this->Welcome_model->SelectRecord('blog','*',array("category"=>$id),'id asc');
		//echo $this->db->last_query(); die;
		$data['blog'] = $this->Welcome_model->selectblogs();
		$data['blogcategory'] = $this->Welcome_model->SelectRecord('blog_category','*',array(),'id asc');
        $this->frontheader();
		$this->load->view('pages/blogcategory',$data);
		$this->load->view('front_common/footer');
}


	public function login_check()
        {

            $data=new stdClass();
            $this->form_validation->set_rules('email', 'Email', 'trim|required');
            $this->form_validation->set_rules('password', 'Password', 'trim|required');       
            if ($this->form_validation->run() == FALSE)
            {
                $data->error=1;
                $data->success=0;
                $data->message=validation_errors();
            }
            else
            {
                $email = $this->security->xss_clean($this->input->post('email'));
                $password = $this->security->xss_clean($this->input->post('password'));
                $Selectdata = array('id','email','username','image','role','em_staff_status','delete','email_status');
				
                $udata = array(
                	"email"=>$email,
                	"password"=>md5($password)
                );     

               $result = $this->Welcome_model->SelectSingleRecord('users',$Selectdata,$udata,$orderby=array());
               $em_staff=  $result->em_staff_status;
               if($result!=''){
               $role =  $result->role;
			   $uud = $result->id;
			   $em_status = $result->email_status;
			   $deletes =$result->delete;
               $cdt=date("Y-m-d h:i:s");
			   $id=$result->id;
			   $this->db->where('id',$id);
			   $data =array('onlinestatus'=>1,'onlineuserdate'=>$cdt);
			   $this->db->update("users",$data);			   
               }
                
                $udata = array(
                	"username"=>$email,
                	"password"=>md5($password)
                );                
                $result1 = $this->Welcome_model->SelectSingleRecord('users',$Selectdata,$udata,$orderby=array());

                if($result1!=''){
                $role =  $result1->role;
                $uud = $result1->id;
				echo $em_status = $result1->email_status;
				$deletes =$result1->delete;
                }
                if($result || $result1)
                {
                   

                     if($result){
                        $sess_array = array(
                        'user_id' => $result->id,
                        'email' => $result->username,
                        'user_group_id' => 1,
                        'image' =>$result->image,
                        'logged_in' => TRUE
                        );
                        }  else if($result1){
                        $sess_array = array(
                        'user_id' => $result1->id,
                        // 'email' => $result1->username,
                        'user_group_id' => 1,
                        'image' => $result->image,
                        'logged_in' => TRUE
                        );
                        }
                        
						$data['payment'] = $this->Welcome_model->SelectRecord('staffpayment','*',array("uid"=>$uud),'id asc');
						$ddate = $data['payment'][0]['create_dt'];
                        $ddexp = date('Y-m-d', strtotime($ddate .'+1 years'));
						//date('Y-m-d', strtotime($ddate .'+1 years'));
                        $todate = date("Y-m-d");
						
                        if($deletes==1){
					    redirect('Welcome/deactivateaccoount');   
					    }
					 
					    $this->session->set_userdata($sess_array);
						$this->session->set_flashdata('result', 1);
		                $this->session->set_flashdata('class', 'success');
		                $this->session->set_flashdata('msg', "Welcome back , login Successfully!");
						
						
						if($em_status==0){											
                         //$this->session->set_flashdata('result', 1);
		                 //$this->session->set_flashdata('class', 'danger');
		                 //$this->session->set_flashdata('msg', "Please verify your Email account. Once Verified your information will show to users!");
						 redirect('Welcome/emailnotverify');
						} 
                       
					   if($role=='employer'){
						if($em_staff==0){
						redirect('employee-staff-pricing');	
						}
                        redirect('Welcome/user');  
                        }
                        if($role=='staff'){
						if($em_staff==0 or $todate>$ddexp){
						redirect('staff-membership');	
						}	
                        redirect('Welcome/user');  
                        }	
                    
                }
                else
                {
               $this->session->set_flashdata('result', 2);
		       $this->session->set_flashdata('class', 'danger');
		       $this->session->set_flashdata('msg', "Incorrect Username or Password");
                    
                }
            }
            $this->session->set_flashdata('item',$data);            
            redirect('Welcome');
        }

	    public function logout(){

      
            $data=new stdClass();
            if($this->session->userdata('logged_in')){
                $this->session->unset_userdata('logged_in');
                $this->session->sess_destroy();    
            }
            if($this->session->userdata('userinfo')){
                $this->googleplus->revokeToken();
                $this->session->unset_userdata('user_id');
                $this->session->unset_userdata('logged_in');
                $this->session->unset_userdata('userinfo');
                $this->session->sess_destroy();    
            }
            if($this->session->userdata('userData')){
                $this->session->unset_userdata('user_id');
                $this->session->unset_userdata('userData');
                $this->facebook->destroy_session();
            }  

            $this->session->set_flashdata('result', 1);
		    $this->session->set_flashdata('class', 'success');
		    $this->session->set_flashdata('msg', "Logged Out Successfully");
            
            redirect('Welcome');
    	}

        public function user_registration(){
            
           // echo "hello"; die;
            $data=new stdClass();
            if(!empty($this->input->post())){
             
			 $email=$this->input->post("email");		 
		     $name=$this->input->post("name");
			 $role = $this->input->post('account_type');
			 if($role=="staff"){
				$mstatus=1; 
			 }	
             else {
			 $mstatus=0; 	
			 }	
			
			 $codeoffer	=$this->input->post('code');
			 
			 if($this->input->post('date_avail')==""){
			 $avadate = date('Y-m-d');
			 }
			 else {
				 $avadate = date("Y-m-d", strtotime($this->input->post('date_avail'))); 
			 }
			 
			//echo $avadate; die;
               
                if(!empty($this->input->post('account_type'))){

                     $usr = array(
                    'role'=>$this->input->post('account_type'),
                    'first_name'=>$this->input->post('name'),
                    'last_name'=>$this->input->post('lastname'),
                    'email'=>$this->input->post('email'),
                    'contact_number'=>$this->input->post('phone'),
					'username'=>$this->input->post('username'),
                    'offer_id'=>$codeoffer,
					'age'=>$this->input->post('age'), 
					'business_location'=>$this->input->post('loaction_c'),
					'city2'=>$this->input->post('city2c'),
					'cityLat'=>$this->input->post('cityLatcc'),
					'cityLng'=>$this->input->post('cityLngcc'),
					'date_avail'=>$avadate,
					'em_staff_status'=>$mstatus,
                    'password'=>md5($this->input->post('password')),
                    'created_date'=>date('Y-m-d'));

            $userrecoreds = $this->Welcome_model->InsertRecord('users',$usr);
			//echo $this->db->last_query(); die;
            if($userrecoreds){			
			$ids=base64_encode($userrecoreds); 
			
			$to = $email;			
    		$subject = 'Welcome, You have now registered with Seasonal staff';
		    $headers = "From: " . 'info@seasonalstaff.co.nz' . "\r\n";
			$headers .= "Content-Type: text/html; charset=UTF-8\r\n";			
            $site_title="Seasonal Staff";
			
	        $msg="Welcome and thank you for registering with Seasonal Staff NZ.<br>
			So that we can get you started, please confirmation your email so that we know your details are correct. Verify Email. <br/> <a style='display: inline-block;background-color: #2396F3;color: #fff;text-transform: capitalize;padding: 0 25px;height: 40px;line-height: 40px;border-radius: 2em;font-size: 13px;cursor: pointer;font-weight: 500;text-decoration:none;margin: 15px 0;' href='".base_url()."Verify/account/".$ids."'>Verify Your Email</a><br/>
			We hope you enjoy using our website.<br/>
			Regards<br>
			Sharon and Wayne George.";
	       
            
			$this->smtpemail($to,$subject,$msg);
			//mail($to, $subject, $message, $headers);			
			
			 if(!empty($userrecoreds)){
                $result = $this->Welcome_model->SelectSingleRecord('users',array('*'),array("id"=>$userrecoreds),$orderby=array());
                $em_staff=  $result->em_staff_status;
                $role=  $result->role;
                $em_status = $result->email_status;				
				$deletes =$result->delete; 
                $sess_array = array(
                        'user_id' => $result->id,
                        'email' => $result->username,
                        'user_group_id' => 1,
                        'image' =>$result->image,
                        'userData'=> $usr,
                        'logged_in' => TRUE
                        );               
               // print_r($sess_array); die;
                $this->session->set_userdata($sess_array);
				
				
              	
				       

               
                 if(!empty($this->session->userdata('userinfo'))){ 
				
				 
				 }
			
			
			/* $this->session->set_flashdata('result', 1);
		    $this->session->set_flashdata('class', 'success');
		    $this->session->set_flashdata('msg', "Welcome you are now registered, Thank you for joining. Log in to continue!");*/
               if($role=="staff"){
					 redirect('Welcome/staffn');  
				}
			}
            }
			
			else{
				
           $this->session->set_flashdata('result', 1);
		   $this->session->set_flashdata('class', 'danger');
		   $this->session->set_flashdata('msg', "Error to signup");
               }

                }else{
					
		   $this->session->set_flashdata('result', 1);
		   $this->session->set_flashdata('class', 'danger');
		   $this->session->set_flashdata('msg', "Please select any one Employee or staff.");	

                }               
               $this->session->set_flashdata('item',$data);
                redirect('Welcome/emailnotverify');
            }

        }
  
        function check_email_exists()
        {  
		if (array_key_exists('email',$_POST)) 
            {
                if ( $this->User_model->email_exists($this->input->post('email'),'') == TRUE ) 
                {
                    $isAvailable=false;
                } 
                else 
                {
                    $isAvailable= true;
                }
                 echo json_encode(array('valid' => $isAvailable, ));
            }
        }

// work for email check //
 	public function checkMail()
	{	
		header('Content-type: application/json');
        $request = $this->input->post('email');
		if($this->uri->segment(3))
		{
        $eml=$this->uri->segment(3);
		$this->db->where('email !=', $eml);
		}
        $this->db->where("email",$request);
        $result=$this->db->get("users");
        if ($result->num_rows()>0){
        $valid = 'false';
		}
        else{
        $valid = 'true';
        }
        echo $valid;
	}
// work for email check //

// work for username check //
 	public function checkusername()
	{	
		header('Content-type: application/json');
        $request = $this->input->post('username');
		if($this->uri->segment(3))
		{
        $usern=$this->uri->segment(3);
		$this->db->where('username !=', $usern);
		}
        $this->db->where("username",$request);
        $result=$this->db->get("users");
        if ($result->num_rows()>0){
        $valid = 'false';
		}
        else{
        $valid = 'true';
        }
        echo $valid;
	}
// work for username check //

function utypesession(){
$utype = $this->input->post('type');

 $userData['type'] =  $utype;
 $data['userData'] = $userData; 

//echo $data['userData']['type']; die;
 $this->session->set_userdata('utype', $data['userData']['type']);
 $this->session->userdata('utype'); 
}

public function find_work($rowno=0){
 $uid= $this->session->userdata("user_id");
 $data['user'] = $this->Welcome_model->SelectRecord('users','*',array("id"=>$uid),'id asc');
 $status = $data['user'][0]['em_staff_status'];
 $role = $data['user'][0]['role']; 
 if($role=='staff' && $status==1){	  
       	
        $data['benefit'] = $this->Welcome_model->SelectRecord('benefit','*',array(),'id asc');
		$location = "";
		$from_date ="";
		$to_date ="";
		$keyword ="";
		$oder ="";
		$benefit ="";
		$workduration ="";
		//echo implode(',', $this->input->post('benefit')); die;
		//$this->input->post('benefit'); die;
		
		if($this->input->post('submitclear')=="Clear search data"){
			//echo 'hello'; die;
			$this->session->unset_userdata('loaction'); 
			$this->session->unset_userdata('from_date');
			$this->session->unset_userdata('to_date'); 
			$this->session->unset_userdata('keyword'); 
			$this->session->unset_userdata('workduration'); 
			$this->session->unset_userdata('benefit'); 
		}
		else {
		
		
		if($this->input->post('submit') == "Search" ){
	        $location = $this->input->post('loaction');
			$this->session->set_userdata(array("loaction"=>$location));
			
			$from_date = $this->input->post('from_date');
			$this->session->set_userdata(array("from_date"=>$from_date));
			
			$to_date = $this->input->post('to_date');
			$this->session->set_userdata(array("to_date"=>$to_date));
			
			$keyword = $this->input->post('keyword');
			$this->session->set_userdata(array("keyword"=>$keyword));
			
			$oder = $this->input->post('orderby');
			$this->session->set_userdata(array("orderby"=>$oder));
			
            $benefit = implode(',', $this->input->post('benefit'));
			$this->session->set_userdata(array("benefit"=>$benefit));

			$workduration = $this->input->post('workduration');
			$this->session->set_userdata(array("workduration"=>$workduration));
			
			
		}else{
			if($this->session->userdata('loaction') != NULL){
				$location = $this->session->userdata('loaction');				
			}
			if($this->session->userdata('from_date') != NULL){
				$from_date = $this->session->userdata('from_date');				
			}
			if($this->session->userdata('to_date') != NULL){
				$to_date = $this->session->userdata('to_date');				
			}
			if($this->session->userdata('keyword') != NULL){
				$keyword = $this->session->userdata('keyword');				
			}
            if($this->session->userdata('orderby') != NULL){
				$oder = $this->session->userdata('orderby');				
			}
			
            if($this->session->userdata('benefit') != NULL){
				$benefit = implode(',', $this->input->post('benefit'));				
			}
			
            if($this->session->userdata('workduration') != NULL){
				$workduration = $this->session->userdata('workduration');				
			}
			
		}
		}
		
		if($this->input->post('recordp')!=0)
		{
		$rowperpage = $this->input->post('recordp');	
		}
		else {
		$rowperpage = 10;
		}

		// Row position
		if($rowno != 0){
			$rowno = ($rowno-1) * $rowperpage;
		}
	
	   $allcount = $this->Welcome_model->selectjobcount($location,$from_date,$to_date,$keyword,$oder,$benefit,$workduration);
	   $users_record = $this->Welcome_model->selectjob($rowno,$rowperpage,$location,$from_date,$to_date,$keyword,$oder,$benefit,$workduration);
	   $users_recordall = $this->Welcome_model->selectjobcc($location,$from_date,$to_date,$keyword,$oder,$benefit,$workduration);
		
		$config['base_url'] = base_url().'Welcome/find_work';
      	$config['use_page_numbers'] = TRUE;
		$config['total_rows'] = $allcount;
		$config['per_page'] = $rowperpage;

		// Initialize
		$this->pagination->initialize($config);
		
		$data['pagination'] = $this->pagination->create_links();
		$data['jobslist'] = $users_record;
		$data['countt'] = $users_recordall;
		$data['row'] = $rowno;
		$data['search'] = $search_text;
		
		$data['maplocation'] = $this->Welcome_model->selectmapwork();
		//print_r($data['jobslist']); die;
		$this->load->view('front_common/header');
        $this->load->view('pages/find_work',$data);
        $this->load->view('front_common/footer');
 }
 else {
	   redirect("Welcome");
 }
    }
// find work //


// work detail //
 public function work_detail($id){
	/* $uid= $this->session->userdata("user_id");
	 if($uid!=''){ */
	  $id = $this->uri->segment(4);
      $data['jobsdata'] = $this->Welcome_model->getJob($id);	 
      if(count($data['jobsdata'])!=0){	 
   	  $inid =   $data['jobsdata'][0]->industry_id; 
	  $bnid =  $data['jobsdata'][0]->benifit_id; 
      $uid =  $data['jobsdata'][0]->modify_by;
	  $data['industries'] = $this->Welcome_model->SelectRecord('industry','*',array("id"=>$inid),'id asc');		 
	  $data['benefit'] = $this->Welcome_model->SelectRecord('benefit','*',array("id"=>$bnid),'id asc');
      $data['userrole'] = $this->Welcome_model->SelectRecord('users','role',array("id"=>$uid),'id asc');
      $uidd= $this->session->userdata("user_id");
	  $data['basicinfo'] = $this->Welcome_model->SelectRecord('staff_basicinfo','*',array("staff_id"=>$uidd),'id asc');
	  
          $this->load->view('front_common/header');
          $this->load->view('pages/work-detail',$data);
          $this->load->view('front_common/footer');
	
	 }
	  else {
	   redirect("Welcome");
      }
        }
// work detail //

// work staff cv //
public function staffcv(){
	    $resume1 =  $_FILES['cv_file']['name']; 
	    $resume = $this->Welcome_model->cvstaffs('cv_file',"public/upload/cv/");		 
        $uid = $this->session->userdata('user_id');
		$jobid = $this->input->post("jobid");
		$job_userid = $this->input->post("job_userid");
		//$jott = $this->input->post("jott");
		$jott = preg_replace('/[^a-zA-Z0-9]/s', '-', $this->input->post("jott"));
		
		 $userData['jobidd'] =  $jobid;
         $data['userData'] = $userData; 

         //echo $data['userData']['type']; die;
        $this->session->set_userdata('jobidd', $data['userData']['jobidd']);
        $this->session->userdata('jobidd'); 
		
		$data['interested'] = $this->Welcome_model->SelectRecord('user_applied_jobs','*',array("user_id"=>$uid,"job_id"=>$jobid),'id asc');	
		if(count($data['interested'])==1){
		 $this->session->set_flashdata('result', 1);
		   $this->session->set_flashdata('class', 'danger');
		   $this->session->set_flashdata('msg', "you Allready Apply this job");   
          redirect("Welcome/work_detail/$jott/$jobid");	
		}
		else 
		{
		
		$data['userj'] = $this->Welcome_model->SelectRecord('users','*',array("id"=>$job_userid),'id desc');
        $name = $data['userj'][0]['first_name'] .' '.$data['userj'][0]['last_name']; 
        $to = $data['userj'][0]['email']; 	       	
  
       $data['jobt'] = $this->Welcome_model->SelectRecord('jobs','*',array("id"=>$this->session->userdata('jobidd')),'id desc');
 
       $jobid = $this->input->post("job_id");
 
       $titlej = $data['jobt'][0]['job_title']; 
		
				 
		$subject = 'Contact us at Seasonal Staff';
		//$headers = "MIME-Version: 1.0\r\n";
		$headers = "From: " . 'info@seasonalstaff.co.nz' . "\r\n";
	    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";			
        $site_title="Seasonal Staff";	
		 
		 $msg='<div style="max-width: 700px;font-size: 18px;"> '.$name.' <br>'.$name.'is interested in your   '.$titlej.'. Job<br>
         
		 Message - '.$this->input->post('maildescr').' <br> 
		 
		 Job - <a href="'.site_url().'/Welcome/work_detail/'. str_replace(' ', '-', $titlej).' /'.$jobid.'"> '. $titlej.'</a><br> 
		 Check out '.$name.' - <a href='.base_url().'staff-detail/'.$uid.'> Staff Profile</a> here.<br>
		 Seetheir Attached CV & Information - <a href='.base_url().'public/upload/cv/'.$resume.'>'.$resume.'</a><br>
		 To Manage your jobs & applications, Please log in to <a href="'.site_url().'/Welcome/"> Seasonastaff.co.nz</a>.<br> 
		 View your Dashboard -  <a href='.base_url().'manage-work-profile/> Manager Employment Tab</a>.  Here you will find all your Jobs and Applicants</div><br/>
		 Kind regards<br>
		 The Seasonal Staff Team<br>
		 <a href="'.site_url().'/Welcome/">www.seasonalstaff.co.nz</a>' ;            
		
		 //mail($to, $subject, $message, $headers);   
		 $this->smtpemail($to,$subject,$msg);
		
		
		
		$datas=array("resume"=>$resume,"job_id"=>$this->session->userdata('jobidd'),"user_id"=>$uid,'job_userid'=>$job_userid );		 
		 
   		 $updt=$this->Welcome_model->insert("user_applied_jobs",$datas);
		 
		 
		
      
		 
		 //echo $this->db->last_query(); die;
		//echo $jobid; die;	
		 if($updt){
            $this->session->set_flashdata('result', 3);
		    $this->session->set_flashdata('class', 'success');
		    $this->session->set_flashdata('msg', "Send Successfully");  
     		//redirect("Welcome/work_detail/$jott/".$jobid."");
           }
	    else{
		   $this->session->set_flashdata('result', 1);
		   $this->session->set_flashdata('class', 'danger');
		   $this->session->set_flashdata('msg', "Network Error");   
         
           }
		}
		
       redirect("Welcome/work_detail/$jott/".$this->session->userdata('jobidd')."/msg");        		 
}
// work staff cv //

// work staff interested //
public function interestedstaff()
{
        //echo 'no'; die;
		$uid = $this->session->userdata('user_id');
	    $interested = $this->input->post('value');
		$jobid = $this->input->post("jobid");
		$job_userid = $this->input->post("job_userid");
        $jott = $this->input->post("jott");	
        $date = date('Y-m-d H:i:s');
		
	    $data['interested'] = $this->Welcome_model->SelectRecord('user_applied_jobs','*',array("user_id"=>$uid,"job_id"=>$jobid),'id asc');	   
        $instaff = count($data['interested']);
		if(count($data['interested'])==1){
		//echo 'hello no ';
		echo 'allready';
		//redirect("Welcome/work_detail/$jott/$jobid");	
		}
		else {
  //echo 'hello'; die; 
  $datas=array("interested"=>$interested,"job_id"=>$jobid,"user_id"=>$uid,'job_userid'=>$job_userid,"created_date"=>$date);	 
  $updt=$this->Welcome_model->insert("user_applied_jobs",$datas);
			
  $data['userl'] = $this->Welcome_model->SelectRecord('users','*',array("id"=>$uid),'id desc');
  $namecu = $data['userl'][0]['first_name'] .' '.$data['userl'][0]['last_name']; 
  
  $data['userj'] = $this->Welcome_model->SelectRecord('users','*',array("id"=>$this->input->post("job_userid")),'id desc');
  $name = $data['userj'][0]['first_name'] .' '.$data['userj'][0]['last_name']; 
  $to = $data['userj'][0]['email']; 
  $data['jobt'] = $this->Welcome_model->SelectRecord('jobs','*',array("id"=>$this->input->post("jobid")),'id desc');
 
  $jobid = $this->input->post("job_id");
 
  $titlej = $data['jobt'][0]['job_title']; 
   
  $subject = 'Seasonal Staff';
  $headers = "MIME-Version: 1.0\r\n";
  $headers .= "Content-Type: text/html; charset=UTF-8\r\n";  
  $headers .= 'From: <info@seasonalstaff.co.nz>' . "\r\n";
						
  $msg =  '<div style="max-width: 700px;font-size: 18px;">'.$name.' <br>User - '.$namecu.' is interested in your '.$titlej.' job<br>
  Job - <a href="'.site_url().'/Welcome/work_detail/'. str_replace(' ', '-',$titlej).' /'.$jobid.'"> '.$titlej.'</a>
  <br/>
  Check out '.$namecu.' - <a href='.base_url().'staff-detail/'.$uid.'> Staff Profile</a> here.<br>
  To Manage your jobs & applications, Please log in to <a href="'.site_url().'/Welcome/"> Seasonastaff.co.nz</a>.<br/>
  View your Dashboard -  <a href='.base_url().'manage-work-profile/> Manager Employment Tab</a>.  Here you will find all your Jobs and Applicants<br/>
  Kind regards<br>
  The Seasonal Staff Team<br>
  <a href="'.site_url().'/Welcome/">www.seasonalstaff.co.nz</a></div>';
		 
  //mail($to, $subject, $message,$headers);
   $this->smtpemail($to,$subject,$msg);
   
		if($updt){
            $this->session->set_flashdata('result', 1);
		    $this->session->set_flashdata('class', 'success');
		    $this->session->set_flashdata('msg', "Send Successfully");  
     		redirect("Welcome/work_detail/$jott/$jobid");
           }
	    else{
		   $this->session->set_flashdata('result', 1);
		   $this->session->set_flashdata('class', 'danger');
		   $this->session->set_flashdata('msg', "Network Error");   
          redirect("Welcome/work_detail/$jott/$jobid");
               }
		}			   
}
// work staff interested //

// find staff work //
public function find_staff($rowno=0){   
 $uid= $this->session->userdata("user_id");
 $data['user'] = $this->Welcome_model->SelectRecord('users','*',array("id"=>$uid),'id asc');
 $status = $data['user'][0]['em_staff_status'];
 $role = $data['user'][0]['role']; 
 if($role=='employer' && $status==1){	
 
        $data['industry'] = $this->Welcome_model->SelectRecord('industry','*',array(),'id asc');        
		$data['skills'] = $this->Welcome_model->SelectRecord('skill','*',array(),'id asc'); 
		//print_r ($data['skills']); die;
		$location = "";
		$from_date ="";
		$to_date ="";
		$keyword ="";
		$oder ="";
		$industry ="";
		$industryskills ="";
		$workduration ="";
		
		if($this->input->post('submitclear')=="Clear search data"){
			//echo 'hello'; die;
			$this->session->unset_userdata('loactionstaff'); 
			$this->session->unset_userdata('staff_sdate');
			$this->session->unset_userdata('staff_edate'); 
			$this->session->unset_userdata('staff_keyword'); 
			$this->session->unset_userdata('orderby'); 
			$this->session->unset_userdata('industry'); 
			$this->session->unset_userdata('industryskills');
			$this->session->unset_userdata('workduration');
		}
		else {
		
		if($this->input->post('submit')!= NULL ){
	        $location = $this->input->post('loactionstaff');
			$this->session->set_userdata(array("loactionstaff"=>$location));
			
			$from_date = $this->input->post('staff_sdate');
			$this->session->set_userdata(array("staff_sdate"=>$from_date));
			
			$to_date = $this->input->post('staff_edate');
			$this->session->set_userdata(array("staff_edate"=>$to_date));
			
			$keyword = $this->input->post('staff_keyword');
			$this->session->set_userdata(array("staff_keyword"=>$keyword));
			
			$oder = $this->input->post('orderby');
			$this->session->set_userdata(array("orderby"=>$oder));
			
            $industry = implode(',', $this->input->post('industry'));
			$this->session->set_userdata(array("industry"=>$industry));
			
			$industryskills = implode(',', $this->input->post('industryskills'));
			$this->session->set_userdata(array("industryskills"=>$industryskills));

			$workduration = $this->input->post('workduration');
			$this->session->set_userdata(array("workduration"=>$workduration));
		
			
		}else{
			if($this->session->userdata('loactionstaff') != NULL){
				$location = $this->session->userdata('loactionstaff');				
			}
			if($this->session->userdata('staff_sdate') != NULL){
				$from_date = $this->session->userdata('staff_sdate');				
			}
			if($this->session->userdata('staff_edate') != NULL){
				$to_date = $this->session->userdata('staff_edate');				
			}
			if($this->session->userdata('staff_keyword') != NULL){
				$keyword = $this->session->userdata('staff_keyword');				
			}
            if($this->session->userdata('orderby') != NULL){
				$oder = $this->session->userdata('orderby');				
			}
			
            if($this->session->userdata('industry') != NULL){
				$industry = $this->session->userdata('industry');
				//$industry = implode(',', $this->input->post('industry'));
				
			}
			
			 if($this->session->userdata('industryskills') != NULL){
				$industryskills = $this->session->userdata('industryskills');
				
				//implode(',', $this->input->post('industryskills'));				
			}
			
            if($this->session->userdata('workduration') != NULL){
				$workduration = $this->session->userdata('workduration');				
			}
		}
		
		}
		//echo 'hello'; die;
		//print_r($industryskills); 	
		 
		if($this->input->post('recordp')!=0)
		{
		$rowperpage = $this->input->post('recordp');	
		}
		else {
		$rowperpage = 10;
		}
		
	    // Row position
		if($rowno != 0){
			$rowno = ($rowno-1) * $rowperpage;
		}
		
			
		$allcount  = $this->Welcome_model->selectstaffcount($location,$keyword,$from_date,$to_date,$oder,$industry,$industryskills,$workduration);
				
		$users_record  = $this->Welcome_model->selectstaff($rowno,$rowperpage,$location,$keyword,$from_date,$to_date,$oder,$industry,$industryskills,$workduration);
		
		$users_recordcco  = $this->Welcome_model->selectstaffcc($location,$keyword,$from_date,$to_date,$oder,$industry,$industryskills,$workduration);
		
		$config['base_url'] = base_url().'Welcome/find_staff';
      	$config['use_page_numbers'] = TRUE;
		$config['total_rows'] = $allcount;
		$config['per_page'] = $rowperpage;

		// Initialize
		$this->pagination->initialize($config);
		
		$data['pagination'] = $this->pagination->create_links();
		$data['stafflist'] = $users_record;
		$data['countt'] = $users_recordcco;
		$data['row'] = $rowno;
		$data['search'] = $search_text;
		
		$data['maplocation'] = $this->Welcome_model->selectmapstaff();
		//print_r($data['jobslist']); die;
		$this->load->view('front_common/header');
        $this->load->view('pages/find-staff',$data);
        $this->load->view('front_common/footer');
 }
 else {
	  redirect("Welcome"); 
 }
    }
// find staff work //


// find staff work pageination //
 function ajaxstaff(){
	
	$page = $this->input->post('page');
        if(!$page){
            $offset = 0;
        }else{
            $offset = $page;
        }
		
		$keyword = $_SESSION['staff_keyword'];
		$location = $_SESSION['loactionstaff'];
		$from_date = $_SESSION['staff_sdate'];
		$to_date = $_SESSION['staff_edate'];
        //total rows count
        $totalRec = count($this->Welcome_model->selectstaff());
        
        //pagination configuration
        $config['target']      = '#staffList';
        $config['base_url']    = base_url().'Welcome/ajaxstaff';
        $config['total_rows']  = $totalRec;
        $config['per_page']    = $this->perPage;
        $this->ajax_pagination->initialize($config);
       	   
	    $data['stafflist'] = $this->Welcome_model->selectstaff(array('start'=>$offset,'limit'=>$this->perPage),$location,$keyword,$from_date,$to_date);
    
    	//load the view
        $this->load->view('pages/Ajaxstafflist', $data, false);
    }
	
// find staff work pageination //

//  staff detail work //
public function staff_detail($id){ 
      
        $data['staffdetail'] = $this->Welcome_model->getstaffdetail($id);  
		if(count($data['staffdetail'])!=0){	
        $this->load->view('front_common/header');
        $this->load->view('pages/staff-detail',$data);
        $this->load->view('front_common/footer');
		}
		else {
		 redirect("Welcome");	
		}
		
    }
// staff detail work //

// mailsend staff work //

public function mailsendstaff()
{
		 $site_title="Seasonal Staff";
		 $fname= $this->input->post('staff_uname');
		 $lname = $this->input->post('staff_lname');
		 $name = $fname .' '. $lname;
		 $to= $this->input->post('email_staff');
		 //$to= 'prktechneha@gmail.com';
		 $uid= $this->input->post('staff_uid');
		 
		$f_name = $_FILES["ad_file"]['name'];
	    $f_tmp = $_FILES["ad_file"]['tmp_name']; 
	    $f_extension = explode('.',$f_name); //To breaks the string into array
	    $f_extension = strtolower(end($f_extension)); //end() is used to retrun a last element to the array
	    $f_newfile="";
	    if($f_name){
	    $f_newfile = uniqid().'.'.$f_extension; // It`s use to stop overriding if the image will be same then uniqid() will generate the unique name 
	    $store = "public/upload/mailattach/" . $f_newfile;
	    $file1 =  move_uploaded_file($f_tmp,$store);
		}		
		 
		$subject = 'Contact us at Seasonal Staff';
		$headers = "From: " . 'info@seasonalstaff.co.nz' . "\r\n";
	    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";			
        $site_title="Seasonal Staff";	
		 
		 $msg="
            Name - ".$name." <br>			
			Message - ".$this->input->post('maildescr')." <br> 
			Attach file - '<a href=".base_url().'public/upload/mailattach/'.$f_newfile.">".$f_newfile."</a>'";  

            //mail($to, $subject, $message, $headers);
			 $this->smtpemail($to,$subject,$msg);
			
		$subject1 = 'Contact us at Seasonal Staff';
		$headers = "From: " . 'info@seasonalstaff.co.nz' . "\r\n";
	    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";			
        $site_title="Seasonal Staff";	
		$to1="info@seasonalstaff.co.nz";
		 
		 $msg1="
            Name - ".$name." <br>			
			Message - ".$this->input->post('maildescr')." <br> 
			Attach file - '<a href=".base_url().'public/upload/mailattach/'.$f_newfile.">".$f_newfile."</a>'";  

            $this->smtpemail($to1,$subject1,$msg1);
			//mail($to1, $subject1, $message1, $headers); 			
      
		 
		 $this->session->set_flashdata('result', 1);
		 $this->session->set_flashdata('class', 'success');
		 $this->session->set_flashdata('msg', "Mail Send Successfully!");  
		 redirect("staff-detail/$uid");
		
}

// mailsend staff work //

// joblike staff //
public function joblike()
 {
  $uid= $this->session->userdata("user_id");
  $datas=array("user_id"=>$uid,"job_id"=>$this->input->post("job_id"),"job_userid"=>$this->input->post("juserid"),"created_date"=>date("Y-m-d H:i:s"),"like"=>1);
  $updt= $this->Welcome_model->insert("job_like_staff",$datas,$where);  
  //echo $this->db->last_query(); die;
 }
// joblike staff //

// contact mail //
public function contactmail()
{         
		    $to = 'info@seasonalstaff.co.nz';
			//$to = 'prktechneha@gmail.com';
    		$subject = 'Contact us at Seasonal Staff';
		    $headers = "From: " . 'info@seasonalstaff.co.nz' . "\r\n";
			$headers .= "Content-Type: text/html; charset=UTF-8\r\n";			
            $site_title="Seasonal Staff";
			
	        $msg="<h4>Contact information</h4>
            Name - ".$this->input->post("name")." <br>
			Email - ".$this->input->post("email")." <br>
			Phone Number - ".$this->input->post("phone")."<br>
            Subject - ".$this->input->post("subject")."<br>
			Comment - ".$this->input->post("comment")." ";          

           $this->smtpemail($to,$subject,$msg);
		   //mail($to, $subject, $message, $headers); 
		   
		   $this->session->set_flashdata('result', 1);
		   $this->session->set_flashdata('class', 'success');
		   $this->session->set_flashdata('msg', "Mail Send Successfully!");  
		   redirect("Welcome/contact");	
}
// contact mail //

// thank you apge //
public function thankyoupayment(){
        $uid= $this->session->userdata("user_id");
		if($uid){
        $data['user'] = $this->Welcome_model->SelectRecord('users','*',array("id"=>$uid),'id asc');    
        $this->load->view('front_common/header');
        $this->load->view('pages/thankyoupayment',$data);
        $this->load->view('front_common/footer');
		}
		else {
		 redirect("Welcome");		
		}
    }
// thank you apge //

//  work termconditions// 
public function termconditions(){
		
		$data['termc'] = $this->Welcome_model->SelectRecord('terms_conditions','*',array(),'id asc');		
		$this->frontheader();
		$this->load->view('pages/termconditions',$data);
		$this->load->view('front_common/footer');
	}
//  work termconditions// ]

//  work privacypolicy// 
public function privacypolicy(){
		
		$data['privacy'] = $this->Welcome_model->SelectRecord('privacy_policy','*',array(),'id asc');		
		$this->frontheader();
		$this->load->view('pages/privacypolicy',$data);
		$this->load->view('front_common/footer');
	}
//  work privacypolicy// 

// deactivate account  apge //
public function deactivateaccoount(){
	    $uid= $this->session->userdata("user_id");
        $data['user'] = $this->Welcome_model->SelectRecord('users','*',array("id"=>$uid),'id asc');    
        $this->load->view('front_common/header');
        $this->load->view('pages/deactivateaccoount',$data);
        $this->load->view('front_common/footer');
		
    }
// deactivate account  apge //

// deactivate account  apge //

public function emailnotverify(){
	    $uid= $this->session->userdata("user_id");
        $data['user'] = $this->Welcome_model->SelectRecord('users','*',array("id"=>$uid),'id asc');    
        $this->load->view('front_common/header');
        $this->load->view('pages/emailnotverify',$data);
        $this->load->view('front_common/footer');
		
    }
// deactivate account  apge //
// matchcode //
public function matchcode()
{
$code = $this->input->post('code'); 
if($code!=''){	 
$data['codes']=$this->Welcome_model->SelectRecord("offers",'*',$where=array("offer_name"=>$code,'user_type'=>$this->session->userdata('utype')),'id desc');
//echo $this->db->last_query(); die;
$dd = count($data['codes']);
if($dd==1){
$dt=  $data['codes'][0]['to_date'];
$dt1 =  date("d-m-Y", strtotime($dt));	
$dtc  = date("d-m-Y");
if($dt1<$dtc){
echo 2;	
}
else {
	echo 1;
	}
	
}
else {
 echo 0;	
}
}
else {
	echo 4;
}	
}

// match code //

// blog comment // 
public function createcomment()
{	
         $uid= $this->session->userdata("user_id");
		 $bid=$this->input->post('bid');
		 $cdt=date("Y-m-d H:i:s");
		 $datas=array('comment' => $this->input->post('comment'),'bid'=>$bid,'uid'=>$uid,'create_dt'=>$cdt);		 
   		 $updt=$this->Welcome_model->insert("blogcomment",$datas);
		 //echo $this->db->last_query(); die;
		  if($updt)
         { 	 
	       $this->session->set_flashdata('result', 1);
		   $this->session->set_flashdata('class', 'success');
		   $this->session->set_flashdata('msg', "Thanks for your Review!");
		   redirect("Welcome/blogdetail/$bid");
         }
         else	
         {  
           $this->session->set_flashdata('result', 1);
		   $this->session->set_flashdata('class', 'danger');
		   $this->session->set_flashdata('msg', "Error to add");
           redirect("Welcome/blogdetail/$bid");
	     }
	 
}
// blog comment // 

// page not found page //

public function pagenotfound(){
	    $uid= $this->session->userdata("user_id");
        $data['user'] = $this->Welcome_model->SelectRecord('users','*',array("id"=>$uid),'id asc');    
        $this->load->view('front_common/header');
        $this->load->view('pages/pagenotfound.php',$data);
        $this->load->view('front_common/footer');
		
    }
// page not found  page //	

// deals  page //

public function deals(){	 
	    $uid= $this->session->userdata("user_id");
        $data['locations'] = $this->Welcome_model->SelectRecord('location_considered','*',array(),'id asc');   
        $this->load->view('front_common/header');
        $this->load->view('pages/Deals.php',$data);
        $this->load->view('front_common/footer');
		
    }
// deals page //	

// deals deatil  page //

public function deal_detail($id){
	    //echo 'hello'; die;
	    $uid= $this->session->userdata("user_id");
        $data['user'] = $this->Welcome_model->SelectRecord('users','*',array("id"=>$uid),'id asc');    
        $this->load->view('front_common/header');
        $this->load->view('pages/dealdetail.php',$data);
        $this->load->view('front_common/footer');
		
    }
// deals deatil page //	

}