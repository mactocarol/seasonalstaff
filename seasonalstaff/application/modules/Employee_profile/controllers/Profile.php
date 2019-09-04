<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Profile extends HT_Controller 
{
	public function __construct(){
        parent::__construct();
        $this->load->model('Profile_model');

        if(!$this->session->userdata('logged_in')){
                redirect('Welcome');
            } 
      }
// index page  work //
      	public function index(){
        $sid = $this->session->userdata('user_id');
		$data['user']=$this->Profile_model->getdata("users",$where=array("id"=>$sid,"role"=>'employer'),$sort="");
		
		if($data['user'][0]->em_staff_status==1){
		

		$data=new stdClass();

         $users= $this->Profile_model->SelectRecord('users','*',array("id"=>$this->session->userdata('user_id')),'id asc');

         foreach ($users as $key => $value) {

      if(!empty($value['id'])){
         $address = $this->Profile_model->SelectSingleRecord('address','address, country, latitude, longitude, map_address',array("user_id"=>$value['id']),$orderby=array());

      $users[$key]['address'] = !empty($address->address)? $address->address : '';
      $users[$key]['country'] = !empty($address->country)? $address->country : '';
      $users[$key]['latitude'] = !empty($address->latitude)? $address->latitude : '';
      $users[$key]['longitude'] = !empty($address->longitude)? $address->longitude : '';
      $users[$key]['map_address'] = !empty($address->map_address)? $address->map_address : '';

      }
      if(!empty($value['plan_id'])){
        $plan = $this->Profile_model->SelectSingleRecord('plan','name as plan_name,amount as plan_amount',array("id"=>$value['plan_id']),$orderby=array());

        $users[$key]['plan_name'] = !empty($plan->plan_name)? $plan->plan_name : '';
        $users[$key]['plan_amount'] = !empty($plan->plan_amount)? $plan->plan_amount : '';

      }

       if(!empty($value['role'])){
        $role = $this->Profile_model->SelectSingleRecord('role','role as role_name',array("id"=>$value['role']),$orderby=array());

        $users[$key]['role_name'] = !empty($role->role_name)? $role->role_name : '';

       }

       if(!empty($value['offer_id'])){

        
      $offer = $this->Profile_model->SelectSingleRecord('offers','offer_name,description as offer_description ,discount_amount as offer_discount_amount ,discount_percentage as offer_discount_percentage,from_date as plan_from_date,to_date as plan_to_date',array("id"=>$value['offer_id']),$orderby=array());

        $users[$key]['offer_name'] = !empty($offer->offer_name)? $role->offer_name : '';
        $users[$key]['offer_description'] = !empty($offer->offer_description)? $role->offer_description : '';
        $users[$key]['offer_discount_amount'] = !empty($offer->offer_discount_amount)? $role->offer_discount_amount : '';
        $users[$key]['offer_discount_percentage'] = !empty($offer->offer_discount_percentage)? $role->offer_discount_percentage : '';
        $users[$key]['plan_from_date'] = !empty($offer->plan_from_date)? $role->plan_from_date : '';
        $users[$key]['plan_to_date'] = !empty($offer->plan_to_date)? $role->plan_to_date : '';

       } }
      $data->result = $users;  
      $data->industries = $this->Profile_model->SelectRecord('industry','*',array(),'id asc');
      $data->user = $this->Profile_model->SelectRecord('users','*',array("id"=>$this->session->userdata('user_id')),'id asc');
	  
		$this->load->view('front_common/header',$data);
		$this->load->view('profile',$data);
		$this->load->view('front_common/footer',$data);
		}
		else {
		 redirect('employee-staff-pricing');   			
		}
	}

// index page work //

 
// profile iamge work //
 public function profileImage($id){  
   if(!empty($id)){
       $data=new stdClass();
           if($this->session->flashdata('item')) {
                $items = $this->session->flashdata('item');
                if($items->success){
                    $data->error=0;
                    $data->success=1;
                    $data->message=$items->message;
                }else{
                    $data->error=1;
                    $data->success=0;
                    $data->message=$items->message;
                }               
            }
           
		   $new_image_name = time() . str_replace(str_split(' ()\\/,:*?"<>|'), '', $_FILES['image']['name']);
           $image_path = realpath(APPPATH . '../public/upload/userProfile');
           $config['upload_path'] = $image_path;
            
          $config['allowed_types'] = 'gif|jpg|png|jpeg';
          $config['file_name'] = $new_image_name;

          $this->load->library('upload', $config);
          if ($this->upload->do_upload('image')) {
          $datas = $this->upload->data();
          $img = $datas['file_name'];
           } else {
                 $img = "";
                    }

                     //print_r($img); die; 
                        $udata=array(
                        "image"=>$img,
                        "updated_date"=>date('Y-m-d H:i:s'),
                        "status"=>0,
                        "modify_by"=>$this->session->userdata('user_id'),                     
                    );
			  $last_insertId =$this->Profile_model->UpdateRecord('users',$udata, array("id"=>$id));		
		
                 if ($last_insertId)
                    {
                        $data->error=0;
                        $data->success=1;
                        $data->message='Profile Image Updated Sucessfully.';
                                            
                    }else{
                        $data->error=1;
                        $data->success=0;
                        $data->message='Network Error!';                    
                    }

            
            $this->session->set_flashdata('item',$data);
            redirect('employee-profile');
    }
  }
// profile iamge work //

// profile update_Profile work //
  public function update_Profile($id){
    if(!empty($id)){
       $data=new stdClass();
           if($this->session->flashdata('item')) {
                $items = $this->session->flashdata('item');
                if($items->success){
                    $data->error=0;
                    $data->success=1;
                    $data->message=$items->message;
                }else{
                    $data->error=1;
                    $data->success=0;
                    $data->message=$items->message;
                }
                
            }
			
            if(!empty($this->input->post())){                    
                      $password = '';
                      if(!empty($this->input->post('c_pass'))){
                           $password = $this->input->post('c_pass');
                      }else{
                        $password = $this->input->post('n_pass');
                      }

                      $inmplode_location = '';
                      if($this->input->post('addtional_b')){
                        $inmplode_location = implode(',', $this->input->post('addtional_b'));
                      }
					  
					  $name = explode(" ", $this->input->post("manager_name"));
                      $udata=array(
                        'first_name'=> $name[0],
						'last_name'=> $name[1],
                        'username'=>$this->input->post('username'),
                        'email'=>$this->input->post('email'),
                        'contact_number'=>$this->input->post('manager_phone'),
                        /*'industry_id'=>$this->input->post('industry'),                        
                        'business_location'=>$this->input->post('mapaddress'), 
                        'city2'=>$this->input->post('city2'),
                        'cityLat'=>$this->input->post('cityLat'),
						'cityLng'=>$this->input->post('cityLng'),*/
                       //'about_business'=>$this->input->post('about_business'),
                        "updated_date"=>date('Y-m-d H:i:s'),
                        "status"=>0,
                        "modify_by"=>$this->session->userdata('user_id'),                      

                    );

                  $last_insertId =$this->Profile_model->UpdateRecord('users',$udata, array("id"=>$id));                  
                   if ($last_insertId)
                    {
					$this->session->set_flashdata('result', 1);
		            $this->session->set_flashdata('class', 'success');
		            $this->session->set_flashdata('msg', "Profile Update Sucessfully!");	
                                                              
                    }else{
					$this->session->set_flashdata('result', 1);
		            $this->session->set_flashdata('class', 'danger');
		            $this->session->set_flashdata('msg', "Network Error!"); 	

                    }
                 $this->session->set_flashdata('item',$data);
                redirect('employee-profile');
            }
    }}
	
	// profile update_Profile work //


// profile updatepass work //	
	public function updatepass($id=null)
	{
	  
	  if(!empty($id)){		
       $data=new stdClass();
           if($this->session->flashdata('item')) {
                $items = $this->session->flashdata('item');
                if($items->success){
                    $data->error=0;
                    $data->success=1;
                    $data->message=$items->message;
                }else{
                    $data->error=1;
                    $data->success=0;
                    $data->message=$items->message;
                }                
            }
			
            if(!empty($this->input->post())){  
			
                    $password = $this->input->post('n_pass');
                      
                      $udata=array(                      
                        'password'=>md5($password),                      
                        "updated_date"=>date('Y-m-d H:i:s'),                       
                        "modify_by"=>$this->session->userdata('user_id'),             
                      );

                   $last_insertId =$this->Profile_model->UpdateRecord('users',$udata, array("id"=>$id));                     
                   if ($last_insertId)
                    {
					$this->session->set_flashdata('result', 1);
		            $this->session->set_flashdata('class', 'success');
		            $this->session->set_flashdata('msg', "Password Update Sucessfully!");	
				
                    }else{
						
					  $this->session->set_flashdata('result', 1);
		              $this->session->set_flashdata('class', 'danger');
		              $this->session->set_flashdata('msg', "Network Error!");   	
                                     
                    }
                 $this->session->set_flashdata('item',$data);
                redirect('employee-profile');
            }
    }	
	}

 // profile updatepass work //   

  // profile check_email_exists work //   
	  function check_email_exists($id)
        {                
            if (array_key_exists('email',$_POST)) 
            {
                if ( $this->Profile_model->email_exists($this->input->post('email'),$id) == TRUE ) 
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

  // profile check_email_exists work //

  // profile check_email_exists_intable //     
   function check_email_exists_intable()
        {     


          if (array_key_exists('email',$_POST)) 
            {
                if ( $this->Profile_model->email_exists($this->input->post('email'),'') == TRUE ) 
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
		
	  // profile check_email_exists_intable //	
	  
// profile check_USERNAME_exists //	
       function check_USERNAME_exists($id='')
        {     
    
            if (array_key_exists('username',$_POST)) 
            {
                if ( $this->Profile_model->username_exists($this->input->post('username'),$id) == TRUE ) 
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
// profile check_USERNAME_exists //	


// profile manage_job //	
        public function manage_job(){             
        $this->content['result'] = $this->Profile_model->getUsers($this->session->userdata('user_id'));
        
        $uid = $this->session->userdata('user_id'); 
        $this->content['job_list'] = $this->Profile_model->SelectRecord('jobs','*',array("delete"=>'0','modify_by'=>$uid),'id desc');
           
          $this->load->view('front_common/header');
          $this->load->view('manage_job',$this->content);
          $this->load->view('front_common/footer');
        }

// profile manage_job //	


// profile list_a_job //	
            public function list_a_job(){
		    $this->content['aboutcompany'] = $this->Profile_model->SelectRecord('company_detail','*',array("uid"=>$this->session->userdata('user_id')),'id asc');
            $this->content['companyaddress']=$this->Profile_model->getdata("company_address",array("uid"=>$this->session->userdata('user_id')),'id asc');

		   // echo count($this->content['aboutcompany']); die;			
		    if(count($this->content['aboutcompany'])==1){
             $data = new stdClass();
              if(!empty($this->input->post())){
                if(!empty($this->input->post('terms_Conditions'))){

                $benefit = '';
                $skill = '';
                $status = '';
                if(!empty($this->input->post('other_benefits'))){
                  $benefit = implode(',', $this->input->post('other_benefits'));
                }
                if(!empty($this->input->post('skill'))){
                  $skill = implode(',', $this->input->post('skill'));
                }

                if($this->input->post('save_btn') == 'Publish your Job'){
                  $status = 1;

                }
                 if($this->input->post('save_btn') == 'save as draft'){
                  $status = 2;

                }
               
                $package_id = $this->input->post('Package');
                if($package_id==''){
				$package_id = 0;	
				}
				
				$form1 =date_create($this->input->post('start_date'));
                $to1 = date_create($this->input->post('end_date'));                       
                $diff=date_diff($form1,$to1);
                $daycount =  $diff->format("%a");

               $this->content['companyaddress']=$this->Profile_model->getdata("company_address",array("id"=>$this->input->post('map_address')),'id asc');
              
				$business_location= $this->content['companyaddress'][0]->business_location; 
			    $city2= $this->content['companyaddress'][0]->city2; 
				$cityLat= $this->content['companyaddress'][0]->cityLat;
				$cityLng= $this->content['companyaddress'][0]->cityLng;  

                $array = array(
                  'job_title'=>$this->input->post('job_title'),
				  'no_staff'=>$this->input->post('no_staff'),
                  'job_type'=>$this->input->post('job_type_cv'),
				  'contract_type'=>$this->input->post('contract_type'),				
                  'industry_id'=>$this->input->post('industry_id'),
                   'city2'=>$city2,
				  'map_address'=>$business_location,
                  'latitude'=>$cityLat,
                  'longitude'=>$cityLng,
                  'from_date'=>date('Y-m-d',strtotime($this->input->post('start_date'))),
                  'to_date'=>date('Y-m-d',strtotime($this->input->post('end_date'))),
				  'daycount'=>$daycount,
                  'approx_hr'=>$this->input->post('approx_hr'),
                  'hourly_rate'=>$this->input->post('hourly_rate'),
                  'work_intensity'=>$this->input->post('work_intensity'),
                  'benifit_id'=>$benefit,
                  'job_description'=>$this->input->post('job_desc'),
                  'skill'=>$skill,
                  //'company_name'=>$this->input->post('c_name'),
                  //'web_adress'=>$this->input->post('c_web'),
                  //'company_profile'=>$this->input->post('Company_profile'),
                  'package_id'=>$package_id,
                  'created_date'=>date('Y-m-d H:i:s'),
                  'modify_by'=>$this->session->userdata('user_id'),
                  'status'=>$status,
                  'accept_condidtion'=>1,

                );
	         

            $last_insertId = $this->Profile_model->InsertRecord('jobs',$array);

                if($last_insertId){
				$this->session->set_flashdata('result', 1);
		        $this->session->set_flashdata('class', 'success');
		        $this->session->set_flashdata('msg', "Jobs Added Successfully!");	
              
               }else{
				 $this->session->set_flashdata('result', 1);
		         $this->session->set_flashdata('class', 'danger');
		         $this->session->set_flashdata('msg', "Network Error!");  
			  }
              

                }else{
				$this->session->set_flashdata('result', 1);
		        $this->session->set_flashdata('class', 'danger');
		        $this->session->set_flashdata('msg', "Please accept terms and conditions!");  	
                }

                 $this->session->set_flashdata('item',$data);
               redirect('list-a-job');

              }else{


                  $this->content['result'] = $this->Profile_model->getUsers($this->session->userdata('user_id'));
        

                  $this->content['industries'] = $this->Profile_model->SelectRecord('industry','*',array(""),'id asc');
				

                   $this->content['benefit'] = $this->Profile_model->SelectRecord('benefit','*',array(""),'name asc');

                   $this->content['package'] = $this->Profile_model->SelectRecord('package','*',array(""),'name asc');

                   $this->content['skills'] = $this->Profile_model->SelectRecord('skill','*',array(""),'skills desc');

                $this->content['users']= $this->Profile_model->SelectRecord('users','*',array("id"=>$this->session->userdata('user_id')),'id asc');
				
				$data->user = $this->Profile_model->SelectRecord('users','*',array("id"=>$this->session->userdata('user_id')),'id asc');
              			   
			    $this->load->view('front_common/header',$data);
                $this->load->view('list_a_job',$this->content);
                $this->load->view('front_common/footer',$data);

              }
			 }
			 else {
			$this->session->set_flashdata('result', 1);
		    $this->session->set_flashdata('class', 'danger');
		    $this->session->set_flashdata('msg', "Please complete about your business , after than you can  add list a job!");  
			  redirect('about_company');
			 }

         
        }
// profile list_a_job //

// profile side_bar //

          public function side_bar(){
             $this->content['result'] = $this->Profile_model->getUsers($this->session->userdata('user_id'));  
             $this->load->view('side_bar',$this->content);
        }
// profile side_bar //

// profile delete //
         public function delete($id){
            
            $data=new stdClass();

                   /* $udata=array(
                        'delete'=>1                        
                    ); */

            if($this->Profile_model->delete_record('jobs',array("id"=>$id))){
			$this->session->set_flashdata('result', 1);
		    $this->session->set_flashdata('class', 'success');
		    $this->session->set_flashdata('msg', "Job Deleted Successfully!");		
            
            }else{
			$this->session->set_flashdata('result', 1);
		    $this->session->set_flashdata('class', 'danger');
		    $this->session->set_flashdata('msg', "Error to delete!");  	
          
            }
            $this->session->set_flashdata('item',$data);
           echo 1;
        }

// profile delete //
// profile userjobs //
          public function userjobs($id){
           $status = $this->input->post('status');  
            
            $data=new stdClass();

                    $udata=array(
                        'status'=>$status                        
                    );

            if($this->Profile_model->UpdateRecord('jobs',$udata,array("id"=>$id))){
			$this->session->set_flashdata('result', 1);
		    $this->session->set_flashdata('class', 'success');
		    $this->session->set_flashdata('msg', "Job Status Change Successfully!");	
           
            }else{
            $this->session->set_flashdata('result', 1);
		    $this->session->set_flashdata('class', 'danger');
		    $this->session->set_flashdata('msg', "Error to change!");  
            }
            $this->session->set_flashdata('item',$data);
           echo 1;
        }

// profile userjobs //

// profile edit_list_a_job //
        public function edit_list_a_job($id){
         $this->content['aboutcompany'] = $this->Profile_model->SelectRecord('company_detail','*',array("uid"=>$this->session->userdata('user_id')),'id asc');	
		  $this->content['companyaddress']=$this->Profile_model->getdata("company_address",array("uid"=>$this->session->userdata('user_id')),'id asc');
 
		   if(count($this->content['aboutcompany']==1)){
			$data = new stdClass();
              if(!empty($this->input->post())){

                if(!empty($this->input->post('terms_Conditions'))){

                  $benefit = '';
                $skill = '';
                $status = '';
                if(!empty($this->input->post('other_benefits'))){
                  $benefit = implode(',', $this->input->post('other_benefits'));
                }
                if(!empty($this->input->post('skill'))){
                  $skill = implode(',', $this->input->post('skill'));
                }

                if($this->input->post('save_btn') == 'Publish your Job'){
                  $status = 1;

                }
                 if($this->input->post('save_btn') == 'save as draft'){
                  $status = 2;

                }
                $package_id = $this->input->post('Package');
                if($package_id==''){
				$package_id = 0;	
				}
                $form1 =date_create($this->input->post('start_date'));
                $to1 = date_create($this->input->post('end_date'));                       
                $diff=date_diff($form1,$to1);
                $daycount =  $diff->format("%a");
				
			    $this->content['companyaddress']=$this->Profile_model->getdata("company_address",array("id"=>$this->input->post('mapaddress')),'id asc');
              
				$business_location= $this->content['companyaddress'][0]->business_location; 
			    $city2= $this->content['companyaddress'][0]->city2; 
			    $cityLat= $this->content['companyaddress'][0]->cityLat;
				$cityLng= $this->content['companyaddress'][0]->cityLng; 
				
                $array = array(
                  'job_title'=>$this->input->post('job_title'),
				  'no_staff'=>$this->input->post('no_staff'),
                  'job_type'=>$this->input->post('job_type_cv'),
				  'contract_type'=>$this->input->post('contract_type'),				
                  'industry_id'=>$this->input->post('industry_id'),
                  'city2'=> $city2,
				  'map_address'=>$business_location,
                  'latitude'=>$cityLat,
                  'longitude'=>$cityLng,
                  'from_date'=>date('Y-m-d',strtotime($this->input->post('start_date'))),
                  'to_date'=>date('Y-m-d',strtotime($this->input->post('end_date'))),
				  'daycount'=>$daycount,
                  'approx_hr'=>$this->input->post('approx_hr'),
                  'hourly_rate'=>$this->input->post('hourly_rate'),
                  'work_intensity'=>$this->input->post('work_intensity'),
                  'benifit_id'=>$benefit,
                  'job_description'=>$this->input->post('job_desc'),
                  'skill'=>$skill,
                  //'company_name'=>$this->input->post('c_name'),
                  //'web_adress'=>$this->input->post('c_web'),
                  //'company_profile'=>$this->input->post('Company_profile'),
                  'package_id'=>$package_id,
                  'created_date'=>date('Y-m-d H:i:s'),
                  'modify_by'=>$this->session->userdata('user_id'),
                  'status'=>$status,
                  'accept_condidtion'=>1,

                );


    $jobsUpdated = $this->Profile_model->UpdateRecord('jobs',$array, array("id"=>$id));

                if($jobsUpdated){
					$this->session->set_flashdata('result', 1);
		            $this->session->set_flashdata('class', 'success');
		            $this->session->set_flashdata('msg', "Jobs Updated Successfully.");					
                
               }else{
				 $this->session->set_flashdata('result', 1);
		         $this->session->set_flashdata('class', 'danger');
		         $this->session->set_flashdata('msg', "Error to Update!");     
               
               }    

                }else{
				 $this->session->set_flashdata('result', 1);
		         $this->session->set_flashdata('class', 'danger');
		         $this->session->set_flashdata('msg', "Please accept terms and conditions!");             
                }

                 $this->session->set_flashdata('item',$data);
                  redirect('edit-list-a-job/'.$id);

              }else{


                  $this->content['result'] = $this->Profile_model->getUsers($this->session->userdata('user_id'));
        

                  $this->content['industries'] = $this->Profile_model->SelectRecord('industry','*',array(""),'id asc');

                   $this->content['benefit'] = $this->Profile_model->SelectRecord('benefit','*',array(""),'name asc');

                   $this->content['package'] = $this->Profile_model->SelectRecord('package','*',array(""),'name asc');

                   $this->content['skills'] = $this->Profile_model->SelectRecord('skill','*',array(""),'skills desc');

                 $this->content['jobsdata'] = $this->Profile_model->getJob($id);
           
                $this->content['users']= $this->Profile_model->SelectRecord('users','*',array("id"=>$this->session->userdata('user_id')),'id asc');
                $this->load->view('front_common/header',$data);
                $this->load->view('edit_list_job',$this->content);
                $this->load->view('front_common/footer',$data);

              }
		     }
			else {
			$this->session->set_flashdata('result', 1);
		    $this->session->set_flashdata('class', 'danger');
		    $this->session->set_flashdata('msg', "Please complete about your business , after than you can  add list a job!"); 
			redirect('about_company');
			 } 

         
        }
		// profile edit_list_a_job //
		
		// ** neha work for work deatil  **//
		
		  public function work_detail($id){
		  $id = $this->uri->segment(3); 
      $this->content['jobsdata'] = $this->Profile_model->getJob($id);
   	  $inid =  $this->content['jobsdata']->industry_id; 
		  $bnid =  $this->content['jobsdata']->benifit_id;
      $uid =  $this->content['jobsdata']->modify_by;
		  $this->content['industries'] = $this->Profile_model->SelectRecord('industry','*',array("id"=>$inid),'id asc');		 
		  $this->content['benefit'] = $this->Profile_model->SelectRecord('benefit','*',array("id"=>$bnid),'id asc');

      $this->content['userrole'] = $this->Profile_model->SelectRecord('users','role',array("id"=>$uid),'id asc');
		  	  
		  //echo $this->db->last_query(); die();	  
          $this->load->view('front_common/header');
          $this->load->view('work-detail',$this->content);
          $this->load->view('front_common/footer');
        }
		// ** neha work for work deatil  **//


     // **  work for manage_applicant **//
    
      public function manage_applicant($id){
      $id = $this->uri->segment(2); 
      $data['jobs']=$this->Profile_model->getapplyjob($id);          
      //echo $this->db->last_query(); die();    
          $this->load->view('front_common/header');
          $this->load->view('manage-applicant',$data);
          $this->load->view('front_common/footer');
        }
    // **  work for manage_applicant 
	
	
	
	// **  work for manage_applicant **//
    
      public function reviews(){	  	  
          $this->load->view('front_common/header');
          $this->load->view('reviews',$this->content);
          $this->load->view('front_common/footer');
        }
    // **  work for manage_applicant **//

	
	// **  work for about_company **//
    
      public function about_company(){
          $uid = $this->session->userdata('user_id');
		  $data['companydetail']=$this->Profile_model->getdata("company_detail",$where=array("uid"=>$uid),$sort='');
		  $data['companyaddress']=$this->Profile_model->getdata("company_address",$where=array("uid"=>$uid),$sort='');
		  $data->user = $this->Profile_model->SelectRecord('users','*',array("id"=>$this->session->userdata('user_id')),'id asc');
		  $data['industries'] = $this->Profile_model->SelectRecord('industry','*',array(),'id asc');
          $this->load->view('front_common/header');
		  $this->load->view('about_company',$data);
          $this->load->view('front_common/footer');
        }
    // **  work for about_company **//
	
	// **  work for company **//
	 public function create_company(){
		
	    $this->form_validation->set_rules('company_name', 'Company Name', 'required');		
		//$this->form_validation->set_rules('url_comapny', 'Company Url', 'required');
        $this->form_validation->set_rules('company_description', 'Company Description', 'required');		

		if ($this->form_validation->run() == FALSE)
		{
		//echo 'valid'; die;
			$this->about_company();
		}
		else
		{		
		$uid = $this->session->userdata('user_id'); 
		$data['companydetail']=$this->Profile_model->getdata("company_detail",$where=array("uid"=>$uid),$sort='');
		//echo count($data['companydetail']); die; 
		if(count($data['companydetail'])==1){
		//echo 'no'; die;	
		if($_FILES['photo']['name'])
		  {	
           
		  $this->Profile_model->unsetImage($uid,'company_detail','company_logo','public/upload/company_logo/');
		  $photo = $this->Profile_model->savecompanylogo("photo","public/upload/company_logo/");		 	     
		  }
		  else{		 
		  $photo=$this->input->post('photo1');
          }
		  //echo $this->input->post('approve_gap'); die;
		  if($this->input->post('approve_gap')=="no"){
		   $number_gap = "Ex- PMO140-C00416 "; 
		  }	
		  
		  if($this->input->post('number_gap1')==""){			  
		  $number_gap = $this->input->post('number_gap');
		  }
		  else 
		  {
	      $number_gap = $this->input->post('number_gap1');  
		  }
			  
		  		 
		  $where=array("uid"=>$uid); 
		  $datas=array("company_logo"=>$photo,"company_name"=>$this->input->post("company_name"),"company_url"=>$this->input->post("url_comapny"),"c_description"=>$this->input->post("company_description"),
		  "industry_id"=>$this->input->post('industry'),"approve_gap"=>$this->input->post('approve_gap'),
		  "number_gap"=>$number_gap,"business_location"=>$this->input->post('mapaddress'),
		  "city2"=>$this->input->post('city2'),"cityLat"=>$this->input->post('cityLat'),"cityLng"=>$this->input->post('cityLng'),"uid"=>$uid,'create_dt'=>date('Y-m-d H:i:s'));
		  $updt= $this->Profile_model->update("company_detail",$datas,$where);		  
		  //echo $this->db->last_query(); die;		
		  
		  $where=array("id"=>$uid); 
		  $datas1=array("industry_id"=>$this->input->post('industry'), "business_location"=>$this->input->post('mapaddress'), "city2"=>$this->input->post('city2'),"cityLat"=>$this->input->post('cityLat'),"cityLng"=>$this->input->post('cityLng'));
		  
		  $updt1= $this->Profile_model->update("users",$datas1,$where);
		  
		  
		}
		else {
		
		$photo = $this->Profile_model->savecompanylogo("photo","public/upload/company_logo/"); 		 
        
		$datas=array("company_logo"=>$photo,"company_name"=>$this->input->post("company_name"),"company_url"=>$this->input->post("url_comapny"),"c_description"=>$this->input->post("company_description"),"industry_id"=>$this->input->post('industry'),"business_location"=>$this->input->post('mapaddress'),"city2"=>$this->input->post('city2'),"cityLat"=>$this->input->post('cityLat'),"cityLng"=>$this->input->post('cityLng'),"uid"=>$uid,'create_dt'=>date('Y-m-d H:i:s'));	 
		 
   		$updt=$this->Profile_model->insert("company_detail",$datas);
		
		
	    $where=array("id"=>$uid); 
	    $datas1=array("industry_id"=>$this->input->post('industry'), "business_location"=>$this->input->post('mapaddress'), "city2"=>$this->input->post('city2'),"cityLat"=>$this->input->post('cityLat'),"cityLng"=>$this->input->post('cityLng'));
		
		$updt1= $this->Profile_model->update("users",$datas1,$where);
		
		
		}
		
	    $data['companyadd']=$this->Profile_model->getdata("company_address",$where=array("uid"=>$uid,"cityLat"=>$this->input->post('cityLat')),$sort='');
        //echo $this->db->last_query();
        //print_r($data['companyadd']);		
		$statusm= $data['companyadd'][0]->statusm;
		$statusmid= $data['companyadd'][0]->id; 
		if($statusm==1){
		$where=array("id"=>$statusmid); 	
		$datas=array("business_location"=>$this->input->post('mapaddress'),"city2"=>$this->input->post('city2'),"cityLat"=>$this->input->post('cityLat'),"cityLng"=>$this->input->post('cityLng'),"uid"=>$uid,"statusm"=>1);	 
		$updt1=$this->Profile_model->update("company_address",$datas,$where);			
		}else {			
		$datas=array("business_location"=>$this->input->post('mapaddress'),"city2"=>$this->input->post('city2'),"cityLat"=>$this->input->post('cityLat'),"cityLng"=>$this->input->post('cityLng'),"uid"=>$uid,"statusm"=>1);	 
		$updt1=$this->Profile_model->insert("company_address",$datas);
		}
		
		//$multiadd = array();    
	    $mapadddress = $this->input->post("loactionmore[]");
		$city2more= $this->input->post("city2more[]");
        $cityLatmore  = $this->input->post("cityLatmore[]");
        $cityLngmore  = $this->input->post("cityLngmore[]");
		//print_r($mapadddress[1]); 
		 $dataCount = count($mapadddress);				
       	
		for($i=0; $i<$dataCount;$i++){					
		$mapadddress_  = $mapadddress[$i]; 
		$city2more1_  = $city2more[$i]; 
		$cityLatmore_  = $cityLatmore[$i]; 
		$cityLngmore_  = $cityLngmore[$i]; 
	    //echo $mapadddress; die;
			
		$datas=array("business_location"=>$mapadddress_,"city2"=>$city2more1_,"cityLat"=>$cityLatmore_,"cityLng"=>$cityLngmore_,"uid"=>$uid);	 
		//print_r($datas);
		$upd11t=$this->Profile_model->insert("company_address",$datas);
				  
		}
		
		//echo $this->db->last_query(); die;	
		//die;
        /* $city2more = $this->input->post("city2more1");
        $cityLatmore = $this->input->post("cityLatmore1");
        $cityLngmore = $this->input->post("cityLngmore1");
		
        if($mapadddress!=""){		
		$datas=array("business_location"=>$mapadddress,"city2"=>$city2more,"cityLat"=>$cityLatmore,"cityLng"=>$cityLngmore,"uid"=>$uid);	 
		$updt=$this->Profile_model->insert("company_address",$datas);
		}*/
		//echo $this->db->last_query(); die;
		 if($updt){
                  	 
			$this->session->set_flashdata('result', 1);
		    $this->session->set_flashdata('class', 'success');
		    $this->session->set_flashdata('msg', "Save Successfully!");
			redirect("about_company/about");
            }
			else
			{
		    $this->session->set_flashdata('result', 1);
		    $this->session->set_flashdata('class', 'danger');
		    $this->session->set_flashdata('msg', "Error to change!");         
            redirect("about_company/about");
               }
              		 
		}	
	 }
  // **  work for comapny **//
// pricing // 
 public function pricing(){
          $uid = $this->session->userdata('user_id');
		  $data['userd']=$this->Profile_model->getdata("users",$where=array("id"=>$uid),$sort='id asc');
		  $code =  $data['userd'][0]->offer_id;
		  $data['coupon_code']=$this->Profile_model->getdataoffercode($code);	
		  $data['price']=$this->Profile_model->getdata("pricing_staff",$where="",$sort='id asc');
		  $this->load->view('front_common/header');
		  $this->load->view('pricing',$data);
          $this->load->view('front_common/footer');
        }
// pricing // 

// success // 
public function success()
			{
				$custom= $_POST['custom'];
				//echo $custom;die;

				$record = explode(",",$custom);
				$milestone_id = $record[0];	
				
				$uid  = $this->session->userdata('user_id');

				$sid = $this->input->post('item_number'); // product ID
				$descr= $this->input->post('item_name');
				$product_transaction = $this->input->post('txn_id'); // PayPal transaction ID

				$product_price= $this->input->post('mc_gross'); // PayPal received amount

				$product_currency = $this->input->post('mc_currency'); // PayPal currency type of received amount

				$cdt=date("Y-m-d");
				$datas=array("create_dt"=>$cdt,'uid'=>$uid,'staff'=>$sid,'price'=>$product_price,'milestone_id'=>$milestone_id,
				'transactionid'=>$product_transaction,'currency'=>$product_currency,'status'=>0);

				$this->Profile_model->insert("staffpayment",$datas);
                //echo $this->db->last_query(); 
				
				$where=array("id"=>$uid);
		        $datas=array("em_staff_status"=>1,"em_staff"=>$sid);
		        $updt= $this->Profile_model->update("users",$datas,$where);
			
				$this->db->select("email,first_name");
				$this->db->where("id",$uid);
				$q=$this->db->get("users")->result();
                
				$to=$q[0]->email;
				$name=$q[0]->first_name;
				
				$sid=$sid; 
				
                $ddate = $cdt=date("d M Y");
				$ddexp = date('d M Y', strtotime($ddate .'+1 years'));
						//date('Y-m-d', strtotime($ddate .'+1 years'));
              
				
                $cdt=date("Y-m-d");
				$ffd = date("d M Y", strtotime($cdt));
                $headers = "From: " . 'info@seasonalstaff.co.nz' . "\r\n";
			    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";	
				$msg="Congratulation on becoming a member of Seasonal Staff NZ<br>
				Your membership payment has been received.<br>
				Date of registration - ".$ffd."<br>
				Amount Paid - ".$product_price." <br>
				Membership valid until - ".$ddexp." <br>
				Transaction Id  - ".$product_transaction." <br>
				We hope you enjoy using our website and we welcome any feedback.<br/>
				<br/> <a style='display: inline-block;background-color: #2396F3;color: #fff;text-transform: capitalize;padding: 0 25px;height: 40px;line-height: 40px;border-radius: 2em;font-size: 13px;cursor: pointer;font-weight: 500;text-decoration:none;margin: 15px 0;' href='".base_url()."Welcome/'>Login</a>
				<a style='display: inline-block;background-color: #2396F3;color: #fff;text-transform: capitalize;padding: 0 25px;height: 40px;line-height: 40px;border-radius: 2em;font-size: 13px;cursor: pointer;font-weight: 500;text-decoration:none;margin: 15px 0;' href='".base_url()."Welcome/contact'>Contact us</a><br/>
				Kind regards<br>
				The Seasonal Staff Team";
				
				//print_r($message);	die;
				//$datas['messages']=array($name,$message);
				//$body = $this->load->view('Common',$datas,TRUE);
				
				 $subject="Payment confirmation - Seasonal Staff NZ Membership";
				 $this->smtpemail($to,$subject,$msg);
				//mail($to, $subject, $message, $headers);
					
				$this->session->set_flashdata('result', 1);
				$this->session->set_flashdata('class', 'success');
				$this->session->set_flashdata('msg', "Success - Your payment has been approved!");
				redirect("Welcome/thankyoupayment");
			}
// success // 	
// cancel // 
public function cancel()
			{
				$this->session->set_flashdata('result', 1);
				$this->session->set_flashdata('class', 'success');
				$this->session->set_flashdata('msg', "Payment Successfully Cancelled");
				redirect("employee-staff-pricing");
			}
// cancel // 


// userapplystatus //
public function userapplystatus()
{
$id = $this->input->post('id');	
$job_id = $this->input->post('job_id');
$value = $this->input->post('value'); 

          $where=array("id"=>$id);
		  $datas=array("status"=>$value);
		  $updt= $this->Profile_model->update("user_applied_jobs",$datas,$where);
	 if($updt){                  	 
			$this->session->set_flashdata('result', 1);
		    $this->session->set_flashdata('class', 'success');
		    $this->session->set_flashdata('msg', "Success - Your payment has been approved!");
			redirect("manage_applicant/$job_id");
            }
			else
			{
		    $this->session->set_flashdata('result', 1);
		    $this->session->set_flashdata('class', 'danger');
		    $this->session->set_flashdata('msg', "Error to change!");   
            redirect("manage_applicant/$job_id");
           }
}
// userapplystatus //

// userapplydelete //

         public function deleteapply($id){
         $job_id = $this->input->post('job_id');  
		 
            $deldd=$this->Profile_model->deletedata('user_applied_jobs',array('id'=>$id));	
            
			if($deldd){
			$this->session->set_flashdata('result', 1);
		    $this->session->set_flashdata('class', 'success');
		    $this->session->set_flashdata('msg', "User Deleted Successfully!");
			redirect("manage_applicant/$job_id");            
            }
			else{
			$this->session->set_flashdata('result', 1);
			$this->session->set_flashdata('class', 'success');
		    $this->session->set_flashdata('msg', "User Deleted Successfully!");
		    //$this->session->set_flashdata('class', 'danger');
		    //$this->session->set_flashdata('msg', "Error to delete apply!");
			redirect("manage_applicant/$job_id");
          
            }
           
        }

// userapplydelete //



    // **  work for manage_applicant **//
    
      public function manage_applicants(){ 
	  $uid = $this->session->userdata('user_id');  
      $data['jobs']=$this->Profile_model->getapplyjobcu($uid);         
    
          $this->load->view('front_common/header');
          $this->load->view('manage-applicants',$data);
          $this->load->view('front_common/footer');
        }
    // **  work for manage_applicant 
	
// userapplystatus //
public function userapplystatuss()
{
$id = $this->input->post('id');	
$job_id = $this->input->post('job_id');
$value = $this->input->post('value'); 

          $where=array("id"=>$id);
		  $datas=array("status"=>$value);
		  $updt= $this->Profile_model->update("user_applied_jobs",$datas,$where);
	 if($updt){                  	 
			$this->session->set_flashdata('result', 1);
		    $this->session->set_flashdata('class', 'success');
		    $this->session->set_flashdata('msg', "Change Successfully!");
			redirect("manage_applicants");
            }
			else
			{
		    $this->session->set_flashdata('result', 1);
		    $this->session->set_flashdata('class', 'danger');
		    $this->session->set_flashdata('msg', "Error to change!");   
            redirect("manage_applicants");
           }
}
// userapplystatus //

// userapplydelete //

         public function deleteapplys($id){
         $job_id = $this->input->post('job_id');  
		 
            $deldd=$this->Profile_model->deletedata('user_applied_jobs',array('id'=>$id));	
            
			if($deldd){
			$this->session->set_flashdata('result', 1);
		    $this->session->set_flashdata('class', 'success');
		    $this->session->set_flashdata('msg', "User Deleted Successfully!");
			redirect("manage-applicants");            
            }
			else{
			$this->session->set_flashdata('result', 1);
			$this->session->set_flashdata('class', 'success');
		    $this->session->set_flashdata('msg', "User Deleted Successfully!");
		    //$this->session->set_flashdata('class', 'danger');
		    //$this->session->set_flashdata('msg', "Error to delete apply!");
			redirect("manage-applicants");
          
            }
           
        }

// userapplydelete //

 // **  work for manage_interesteduser **//    
      public function manage_interesteduser(){ 
	  $uid = $this->session->userdata('user_id');  
      $data['jobs']=$this->Profile_model->getinteresteduser($uid);         
    
          $this->load->view('front_common/header');
          $this->load->view('manage-interesteduser',$data);
          $this->load->view('front_common/footer');
        } 
// **  work for manage_interesteduser **//


// manage_interesteduser userapplystatus //
public function interesteduserstatus()
{
$id = $this->input->post('id');	
$job_id = $this->input->post('job_id');
$value = $this->input->post('value'); 

          $where=array("id"=>$id);
		  $datas=array("status"=>$value);
		  $updt= $this->Profile_model->update("user_interested_jobs",$datas,$where);
	 if($updt){                  	 
			$this->session->set_flashdata('result', 1);
		    $this->session->set_flashdata('class', 'success');
		    $this->session->set_flashdata('msg', "Change Successfully!");
			redirect("manage-interesteduser");
            }
			else
			{
		    $this->session->set_flashdata('result', 1);
		    $this->session->set_flashdata('class', 'danger');
		    $this->session->set_flashdata('msg', "Error to change!");   
            redirect("manage-interesteduser");
           }
}
// manage_interesteduser userapplystatus //

// manage_interesteduser userapplydelete //

         public function deleteinteresteduser($id){
         $job_id = $this->input->post('job_id');  
		 
            $deldd=$this->Profile_model->deletedata('user_interested_jobs',array('id'=>$id));	
            
			if($deldd){
			$this->session->set_flashdata('result', 1);
		    $this->session->set_flashdata('class', 'success');
		    $this->session->set_flashdata('msg', "User Deleted Successfully!");
			redirect("manage-interesteduser");            
            }
			else{
			$this->session->set_flashdata('result', 1);
			$this->session->set_flashdata('class', 'success');
		    $this->session->set_flashdata('msg', "User Deleted Successfully!");
		    //$this->session->set_flashdata('class', 'danger');
		    //$this->session->set_flashdata('msg', "Error to delete apply!");
			redirect("manage-interesteduser");
          
            }
           
        }

// manage_interesteduser userapplydelete //

//  work for message //
    
      public function messages(){
	  	  $id = $this->uri->segment(4); 
		  $data['userdeatil']=$this->Profile_model->getdata("users",$where=array("id"=>$id),$sort='');
		  $data['user']=$this->Profile_model->getuser();
		  $this->load->view('front_common/header');
		  $this->load->view('messages',$data);
          $this->load->view('front_common/footer');
        }
//  work for message //

// sendmsg // 
public function sendmsg(){
	     $cdt=date("Y-m-d h:i:s");
	     $datas=array("create_dt"=>$cdt,"rid"=>$this->input->post("rid"),"message"=>$this->input->post("msg"),"sid"=>$this->session->userdata('user_id'));		 
 		 $id=$this->Profile_model->insert("userschating",$datas);
		 if($id)
                {
		  echo '';	 		   
		 }
		 else{
			echo 0;	 
		 }
}
// sendmsg // 

// getmessage // 
public function getmeassage()
{
        $sid=$this->input->post('rid');
		$data['msg']=$this->Profile_model->getmsg($sid);	
		$errors = array_filter($data['msg']);

		if (!empty($errors)){
			echo $dt=$this->load->view("Ajaxmessage",$data,TRUE);
		}
		else{
			echo '';
		}
} 
// getmesage //

// getuserlist //
public function getmsglist()
{
	   $rid=$_POST['rid'];
	   $surid=$_POST['surid'];
   	   $data['user']=$this->Profile_model->getuser($rid,$surid);	
		$errors = array_filter($data['user']);

		if (!empty($errors)){
			echo $dt=$this->load->view("Ajaxmsglist",$data,TRUE);
		}
		else{
			echo "";
		}
	
}
// getuserlist //

// work for previejob //
public function previejob()
{
		 $cuid=  $this->session->userdata('user_id');
		 $benefit = implode(',', $this->input->post('other_benefits'));
		 $skill = implode(',', $this->input->post('skill'));		 
		 
		$data['jobsd']=$this->Profile_model->getdata("jobspreview",$where=array("modify_by"=>$cuid),$sort="id desc");	
	
	    if($data['jobsd'][0]->currentcode=='no'){
		$code = 'nulln';
		}
		else {
		$code = $data['jobsd'][0]->currentcode;; 	
		}
		// echo $code; die;
		 $data['jobs']=$this->Profile_model->getdata("jobspreview",$where=array("currentcode"=>$code,"modify_by"=>$cuid),$sort="id desc");					
		 //echo count($data['jobs']); die;
		 if(count($data['jobs'])==0){
		 $un = uniqid();
		 $datas=array("currentcode"=>$un,"job_id"=>0,"job_title"=>$this->input->post("job_title"),"no_staff"=>$this->input->post("no_staff"),"job_type"=>$this->input->post("job_type_cv"),"contract_type"=>$this->input->post("contract_type"),"industry_id"=>$this->input->post("industry_id"),"city2"=>$this->input->post("city2"),"map_address"=>$this->input->post("mapaddress"),"latitude"=>$this->input->post("cityLat"),"longitude"=>$this->input->post("cityLng"),"from_date"=>date('Y-m-d',strtotime($this->input->post('start_date'))),"to_date"=>date('Y-m-d',strtotime($this->input->post('end_date'))),"approx_hr"=>$this->input->post("approx_hr"),"hourly_rate"=>$this->input->post("hourly_rate"),"work_intensity"=>$this->input->post("work_intensity"),"benifit_id"=>$benefit,"job_description"=>$this->input->post("job_desc"),"skill"=>$skill,'modify_by'=>$this->session->userdata('user_id'),"created_date"=>date("Y-m-d H:i:s"));
		 $updt= $this->Profile_model->insert("jobspreview",$datas,$where);   
		 //echo $this->db->last_query(); die;
		  }
		  else {		  
		  $sid = $data['jobs'][0]->id;
		  $where=array("id"=>$sid);
		  $datas=array("job_title"=>$this->input->post("job_title"),"no_staff"=>$this->input->post("no_staff"),"job_type"=>$this->input->post("job_type_cv"),"contract_type"=>$this->input->post("contract_type"),"industry_id"=>$this->input->post("industry_id"),"city2"=>$this->input->post("city2"),"map_address"=>$this->input->post("mapaddress"),"latitude"=>$this->input->post("cityLat"),"longitude"=>$this->input->post("cityLng"),"from_date"=>date('Y-m-d',strtotime($this->input->post('start_date'))),"to_date"=>date('Y-m-d',strtotime($this->input->post('end_date'))),"approx_hr"=>$this->input->post("approx_hr"),"hourly_rate"=>$this->input->post("hourly_rate"),"work_intensity"=>$this->input->post("work_intensity"),"benifit_id"=>$benefit,"job_description"=>$this->input->post("job_desc"),"skill"=>$skill);
		  $updt= $this->Profile_model->update("jobspreview",$datas,$where);  
		  //echo $this->db->last_query(); die;  
		  }
		
		  $data['jobs']=$this->Profile_model->getdata("jobspreview",$where=array("modify_by"=>$cuid),$sort="id desc");
          $sid = $data['jobs'][0]->id;
	      echo   $sid; 
		  
		 
}

// work for previejob // 

// work for previejob //
public function previejobb()
{
	//echo 'hello'; die;
		 $cuid=  $this->session->userdata('user_id');
		 $benefit = implode(',', $this->input->post('other_benefits'));
		 $skill = implode(',', $this->input->post('skill'));		 
		 
		 $jbid = $this->input->post("sid");			
		 $data['jobs']=$this->Profile_model->getdata("jobspreview",$where=array("job_id"=>$jbid,"modify_by"=>$cuid),$sort="");
		 //echo $this->db->last_query(); die;	
		// echo count($data['jobs']); die;
		 if(count($data['jobs'])==0){		
		 $datas=array("job_id"=>$jbid,"job_title"=>$this->input->post("job_title"),"no_staff"=>$this->input->post("no_staff"),"job_type"=>$this->input->post("job_type_cv"),"contract_type"=>$this->input->post("contract_type"),"industry_id"=>$this->input->post("industry_id"),"city2"=>$this->input->post("city2"),"map_address"=>$this->input->post("mapaddress"),"latitude"=>$this->input->post("cityLat"),"longitude"=>$this->input->post("cityLng"),"from_date"=>date('Y-m-d',strtotime($this->input->post('start_date'))),"to_date"=>date('Y-m-d',strtotime($this->input->post('end_date'))),"approx_hr"=>$this->input->post("approx_hr"),"hourly_rate"=>$this->input->post("hourly_rate"),"work_intensity"=>$this->input->post("work_intensity"),"benifit_id"=>$benefit,"job_description"=>$this->input->post("job_desc"),"skill"=>$skill,'modify_by'=>$this->session->userdata('user_id'),"created_date"=>date("Y-m-d H:i:s"));
		 $updt= $this->Profile_model->insert("jobspreview",$datas,$where);   
		 //echo $this->db->last_query(); die;
		  }
		  else {         	  
		  $sid = $data['jobs'][0]->id;
		  $where=array("job_id"=>$jbid);
		  $datas=array("job_title"=>$this->input->post("job_title"),"no_staff"=>$this->input->post("no_staff"),"job_type"=>$this->input->post("job_type_cv"),"contract_type"=>$this->input->post("contract_type"),"industry_id"=>$this->input->post("industry_id"),"city2"=>$this->input->post("city2"),"map_address"=>$this->input->post("mapaddress"),"latitude"=>$this->input->post("cityLat"),"longitude"=>$this->input->post("cityLng"),"from_date"=>date('Y-m-d',strtotime($this->input->post('start_date'))),"to_date"=>date('Y-m-d',strtotime($this->input->post('end_date'))),"approx_hr"=>$this->input->post("approx_hr"),"hourly_rate"=>$this->input->post("hourly_rate"),"work_intensity"=>$this->input->post("work_intensity"),"benifit_id"=>$benefit,"job_description"=>$this->input->post("job_desc"),"skill"=>$skill);
		  $updt= $this->Profile_model->update("jobspreview",$datas,$where);  
		 // echo $this->db->last_query(); die;  
		  }		 
		  $data['jobs']=$this->Profile_model->getdata("jobspreview",$where=array("job_id"=>$jbid,"modify_by"=>$cuid),$sort="id desc");
		 //echo $this->db->last_query(); die; 
         echo  $sid = $data['jobs'][0]->id;	     
		 
}

// work for previejob // 



 public function work_detailp($id){
	  $id = $this->uri->segment(4);
      $this->content['jobsdata'] = $this->Profile_model->getJobp($id);
	 // print_r( $this->content['jobsdata']); die;
   	  $inid =  $this->content['jobsdata']->industry_id; 
		  $bnid =  $this->content['jobsdata']->benifit_id;
      $uid =  $this->content['jobsdata']->modify_by;
		  $this->content['industries'] = $this->Profile_model->SelectRecord('industry','*',array("id"=>$inid),'id asc');		 
		  $this->content['benefit'] = $this->Profile_model->SelectRecord('benefit','*',array("id"=>$bnid),'id asc');

      $this->content['userrole'] = $this->Profile_model->SelectRecord('users','role',array("id"=>$uid),'id asc');
		  	  
		  //echo $this->db->last_query(); die();	  
          $this->load->view('front_common/header');
          $this->load->view('work-details',$this->content);
          $this->load->view('front_common/footer');
        }

public function successdiscount()
			{
				
				$uid  = $this->session->userdata('user_id');
				$sid =  "Annual Pricing"; // product ID
				$product_price = 0;
				
				$where=array("id"=>$uid);
		        $datas=array("em_staff_status"=>1,"em_staff"=>$sid);
		        $updt= $this->Profile_model->update("users",$datas,$where);
			
				$this->db->select("email,first_name");
				$this->db->where("id",$uid);
				$q=$this->db->get("users")->result();
                
				$to=$q[0]->email;
				$name=$q[0]->first_name;
				
				$sid=$sid;
				
				$ddate = $cdt=date("d M Y");
				$ddexp = date('d M Y', strtotime($ddate .'+1 years'));
						//date('Y-m-d', strtotime($ddate .'+1 years'));
              
				$cdt=date("Y-m-d");
				$ffd = date("d-m-Y", strtotime($cdt));
                $headers = "From: " . 'info@seasonalstaff.co.nz' . "\r\n";
			    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";	
				$msg="Congratulation on becoming a member of Seasonal Staff NZ<br>
				Your membership payment has been received.<br>
				Date of registration - ".$ffd."<br>
				Amount Paid - ".$product_price." <br>
				Membership valid until - ".$ddexp."<br>
				We hope you enjoy using our website and we welcome any feedback.<br/>
				<br/> <a style='display: inline-block;background-color: #2396F3;color: #fff;text-transform: capitalize;padding: 0 25px;height: 40px;line-height: 40px;border-radius: 2em;font-size: 13px;cursor: pointer;font-weight: 500;text-decoration:none;margin: 15px 0;' href='".base_url()."Welcome/'>Login</a>
				<a style='display: inline-block;background-color: #2396F3;color: #fff;text-transform: capitalize;padding: 0 25px;height: 40px;line-height: 40px;border-radius: 2em;font-size: 13px;cursor: pointer;font-weight: 500;text-decoration:none;margin: 15px 0;' href='".base_url()."Welcome/contact'>Contact us</a><br/>
				Kind regards<br>
				The Seasonal Staff Team";
				
				//print_r($message);	die;
				//$datas['messages']=array($name,$message);
				//$body = $this->load->view('Common',$datas,TRUE);
				
				 $subject="Payment confirmation - Seasonal Staff NZ Membership";
				 $this->smtpemail($to,$subject,$msg);
				// mail($to, $subject, $message, $headers);
					
				$this->session->set_flashdata('result', 1);
				$this->session->set_flashdata('class', 'success');
				$this->session->set_flashdata('msg', "Payment successful");
				redirect("Welcome/thankyoupayment");
			}			
	
// mail send //
public function mailsendstaff()
{
		 $uid= $this->input->post('staff_uid');

         $data['jobs']=$this->Profile_model->getdata("users",$where=array("id"=>$uid),$sort="id desc");
	
    	 $site_title="Seasonal Staff";
		 $fname= $data['jobs'][0]->first_name;
		 $lname = $data['jobs'][0]->last_name;
		 $name = $fname .' '. $lname; 
		 $to= $data['jobs'][0]->email;
		 //$to= 'prktechneha@gmail.com';
		  
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

        
		 //mail($to, $subject, $message, $headers); ;	
		 $this->smtpemail($to,$subject,$msg);
		 
		 $this->session->set_flashdata('result', 1);
		 $this->session->set_flashdata('class', 'success');
		 $this->session->set_flashdata('msg', "Mail Send Successfully!");  
		 redirect("manage-applicants/");
		
}
// mail send //		


// user Watching delete //

         public function deletewatching($id){
         $data=new stdClass();
		 
            $deldd=$this->Profile_model->deletedata('job_like_staff',array('id'=>$id));	
           
			$this->session->set_flashdata('result', 1);
		    $this->session->set_flashdata('class', 'success');
		    $this->session->set_flashdata('msg', "People Watching Your Job Deleted Successfully!");		
            
            $this->session->set_flashdata('item',$data);
            echo 1;
           
        }

// user Watching delete //
public function deleteextraadd($id){
            $delddd=$this->Profile_model->deletedata('company_address',array('id'=>$id));	
            if($delddd){
			$this->session->set_flashdata('result', 1);
		    $this->session->set_flashdata('class', 'success');
		    $this->session->set_flashdata('msg', "Extra Address delete Successfully!");
			redirect("about_company/about"); 			
            }
			else{
			$this->session->set_flashdata('result', 1);
			$this->session->set_flashdata('class', 'success');
		    $this->session->set_flashdata('msg', "Extra Address  Successfully!");
		    //$this->session->set_flashdata('class', 'danger');
		    //$this->session->set_flashdata('msg', "Error to delete apply!");
			redirect("about_company/about");           
            }
            redirect("about_company/about");
        }

	
}