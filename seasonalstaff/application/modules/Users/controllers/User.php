<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User extends HT_Controller {

	 public function __construct(){            
            parent::__construct();
            $this->load->model('User_model');   
             if(!$this->session->userdata('logged_in')){
                redirect('Admin');
            }        
        }

     public function index(){
       if($this->session->userdata('userid')!=''){
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

            
            $users= $this->User_model->getUsers(false);
            $data->results = $users;

// print_r($data->results); die;

            $udata = array("id"=>$this->session->userdata('user_id'));                
            $data->result = $this->User_model->SelectSingleRecord('admin','*',$udata,$orderby=array());
            $data->role = $this->User_model->SelectRecord('role','*',array(""),'role asc');
            $data->country = $this->User_model->SelectRecord('country','*',array(""),'Name asc');

            $data->title = 'Users';
            $data->field = 'Datatable';
            $data->page = 'list_user';
            $this->load->view('admin/includes/header',$data);		
            $this->load->view('view',$data);
            $this->load->view('admin/includes/footer',$data);
	       }
           else{
		   redirect('Admin');   
		   } 		   
        }



        public function add(){
           if($this->session->userdata('userid')!=''){
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
			  	$role =	$this->input->post('role');	
			
                        $empdata=array(
                        'first_name'=>$this->input->post('f_name'),
                        //'middle_name'=>$this->input->post('m_name'),
                        'last_name'=>$this->input->post('l_name'),                        
                        'username'=>$this->input->post('username'),
                        'email'=>$this->input->post('email'),
                        'password'=>md5($this->input->post('password')),
                        //'gender'=>$this->input->post('gender'),
                       // 'plan_id'=>$this->input->post('plan'),
                        'offer_id'=>$this->input->post('offers'),                        
                        'contact_number'=>$this->input->post('contact'),
						'business_location'=>$this->input->post('mapaddress'),
						'city2'=>$this->input->post('cityc'),
						'cityLat'=>$this->input->post('longitude'),
						'cityLng'=>$this->input->post('latitude'),
                        'role'=>$this->input->post('role'),
                        "updated_date"=>date('Y-m-d H:i:s'),
                        "status"=>0
                        //"modify_by"=>$this->session->userdata('user_id')
                        //'dob'=>date('Y-m-d',strtotime($this->input->post('dob'))),
					);
					$userrecoreds =$this->User_model->InsertRecord('users',$empdata);
		            //echo $this->db->last_query(); die;
                  
               if($userrecoreds){
                    $data->error=0;
                    $data->success=1;
                    $data->message="User Added Successfully";
               }else{
                    $data->error=1;
                    $data->success=0;
                    $data->message="Network Error";
               }
               $this->session->set_flashdata('item',$data);
               redirect('add-user'.$id);
            }
            //$udata = array("id"=>$this->session->userdata('user_id'));                
            //$data->result = $this->User_model->SelectSingleRecord('admin','*',$udata,$orderby=array());
            $data->plan = $this->User_model->SelectRecord('plan','*',array(""),'id desc');
            $data->role = $this->User_model->SelectRecord('role','*',array(""),'id desc');
            $data->country = $this->User_model->SelectRecord('country','*',array(""),'name asc');
            $data->offers = $this->User_model->SelectRecord('offers','*',array(""),'id desc');
            $data->title = 'Add User';
            $data->field = 'Add User';
            $data->page = 'list_user';
            $this->load->view('admin/includes/header',$data);		
            $this->load->view('add',$data);
            $this->load->view('admin/includes/footer',$data);
		   }
           else {
			 redirect('Admin');   
		   }   		   
        }

          function check_email_exists($id)
        {                
            if (array_key_exists('email',$_POST)) 
            {
                if ( $this->User_model->email_exists($this->input->post('email'),$id) == TRUE ) 
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


        function check_email_exists_intable()
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

         function check_USERNAME_exists($id='')
        {     
    
            if (array_key_exists('username',$_POST)) 
            {
                if ( $this->User_model->username_exists($this->input->post('username'),$id) == TRUE ) 
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
          public function statusone($userid){
          
            $data=new stdClass();
			if($userid){
               
                    $udata=array(
                        'status'=>1                        
                    );
               
				if ($this->User_model->UpdateRecord('users',$udata,array("id"=>$userid)))
				{
                    $data->error=0;
                    $data->success=1;
                    $data->message='User Approved Sucessfully.';
                     					
				}else{
                    $data->error=1;
                    $data->success=0;
                    $data->message='Network Error!';                    
                }
            $this->session->set_flashdata('item',$data);
           echo 1;
			}
                       			
		}

 public function statuszero($userid){
          
            $data=new stdClass();
            if($userid){
            
                    $udata=array(
                        'status'=>0                     
                    );
               
                if ($this->User_model->UpdateRecord('users',$udata,array("id"=>$userid)))
                {
                    $data->error=0;
                    $data->success=1;
                    $data->message='User Suspended Sucessfully.';
                                        
                }else{
                    $data->error=1;
                    $data->success=0;
                    $data->message='Network Error!';                    
                }
            $this->session->set_flashdata('item',$data);
           echo 1;
            }
                                
        }
 public function delete($id){
            
            $data=new stdClass();

                    $udata=array(
                        'delete'=>1                        
                    );

            if($this->User_model->UpdateRecord('users',$udata,array("id"=>$id))){
                $data->error=0;
                $data->success=1;
                $data->message="Deactivate Account Successfully";
            }else{
                $data->error=1;
                $data->success=0;
                $data->message="Network Error";
            }
            $this->session->set_flashdata('item',$data);
           echo 1;
        }
		
	 public function deleteact($id){
            
            $data=new stdClass();

                    $udata=array(
                        'delete'=>0                        
                    );

            if($this->User_model->UpdateRecord('users',$udata,array("id"=>$id))){
                $data->error=0;
                $data->success=1;
                $data->message="Activate Account Successfully";
            }else{
                $data->error=1;
                $data->success=0;
                $data->message="Network Error";
            }
            $this->session->set_flashdata('item',$data);
           echo 1;
        }	

        
        public function deleteper($id){
            
           $data=new stdClass();
            if($this->User_model->delete_record('users',array("id"=>$id))){
                $data->error=0;
               $data->success=1;
                $data->message="User Deleted Successfully";
            }else{
                 $data->error=1;
                $data->success=0;
                $data->message="Network Error";
            }
            $this->session->set_flashdata('item',$data);
             redirect('users-list');
        }


       public function edit($id){
		if($this->session->userdata('userid')!=''){   
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
           if($this->input->post('Update_pass') == 'Update password'){
			
		   $empdata=array(                       
                        'password'=>md5($this->input->post('password'))                      
					);
					$userrecoredspass =$this->User_model->UpdateRecord('users',$empdata, array("id"=>$id));
		  
		   if($userrecoredspass)
                    {
                        $data->error=0;
                        $data->success=1;
                        $data->message='Password Update Sucessfully.';
                                            
                    }else{
                        $data->error=1;
                        $data->success=0;
                        $data->message='Network Error!';                    
                    }
                 $this->session->set_flashdata('item',$data);
                redirect('edit-user/'.$id);
		  }
		
		   $data->basicinfo = $this->User_model->SelectRecord('staff_basicinfo','*',array("staff_id"=>$id),'id desc');
						
           if($this->input->post('Update_profile') == 'Update'){
			
			  	$role =	$this->input->post('role');	
			
                        $empdata=array(
                        'first_name'=>$this->input->post('f_name'),
                        //'middle_name'=>$this->input->post('m_name'),
                        'last_name'=>$this->input->post('l_name'),                        
                        'username'=>$this->input->post('username'),
                        'email'=>$this->input->post('email'),
                        //'password'=>md5($this->input->post('password')),
                        'email'=>$this->input->post('email'),
                        //'plan_id'=>$this->input->post('plan'),
                        'offer_id'=>$this->input->post('offers'),                        
                        'contact_number'=>$this->input->post('contact'),
						'business_location'=>$this->input->post('mapaddress'),
						'city2'=>$this->input->post('cityc'),
						'cityLat'=>$this->input->post('latitude'),
						'cityLng'=>$this->input->post('longitude'),
						
                        'role'=>$this->input->post('role'),
                        "updated_date"=>date('Y-m-d H:i:s'),
                        "status"=>0,
                        "modify_by"=>$this->session->userdata('user_id'),
                        'dob'=>date('Y-m-d',strtotime($this->input->post('dob'))),
					);
					$userrecoreds =$this->User_model->UpdateRecord('users',$empdata, array("id"=>$id));
            
			if(count($data->basicinfo)!=0){
			 $empdatab=array(                       
						'current_location'=>$this->input->post('mapaddress'),
						'cityc'=>$this->input->post('cityc'),
						'cityLatc'=>$this->input->post('latitude'),
						'cityLngc'=>$this->input->post('longitude')					
                        
					);
					$userrecoreds =$this->User_model->UpdateRecord('staff_basicinfo',$empdatab, array("staff_id"=>$id));	
			}
                  
                   if($userrecoreds)
                    {
                        $data->error=0;
                        $data->success=1;
                        $data->message='User Update Sucessfully.';
                                            
                    }else{
                        $data->error=1;
                        $data->success=0;
                        $data->message='Network Error!';                    
                    }
                 $this->session->set_flashdata('item',$data);
                redirect('edit-user/'.$id);
            }
			
            $udata = array("id"=>$this->session->userdata('user_id'));                
            $data->result = $this->User_model->SelectSingleRecord('admin','*',$udata,$orderby=array());

            $data->plan = $this->User_model->SelectRecord('plan','*',array(""),'id desc');
            $data->role = $this->User_model->SelectRecord('role','*',array(""),'id desc');
            $data->offers = $this->User_model->SelectRecord('offers','*',array(""),'id desc');
            $data->reslt = $this->User_model->getUsers($id);
            $data->country = $this->User_model->SelectRecord('country','*',array(""),'name asc');
            $data->title = 'Edit User';
            $data->field = 'Edit User';
            $data->page = 'list_user';
            $this->load->view('admin/includes/header',$data);       
            $this->load->view('edit',$data);
            $this->load->view('admin/includes/footer',$data);
		   }
           else {
		 redirect('Admin');   
		   }		   
        }



         public function staff_view(){
            if($this->session->userdata('userid')!=''){   
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

            
            $users= $this->User_model->getStaff(false);
            $data->results = $users;

            $udata = array("id"=>$this->session->userdata('user_id'));                
            $data->result = $this->User_model->SelectSingleRecord('admin','*',$udata,$orderby=array());
            $data->role = $this->User_model->SelectRecord('role','*',array(""),'role asc');
            $data->country = $this->User_model->SelectRecord('country','*',array(""),'Name asc');


            $data->title = 'Staff-list';
            $data->field = 'Datatable';
            $data->page = 'staff_list';
            $this->load->view('admin/includes/header',$data);       
            $this->load->view('staff_view',$data);
            $this->load->view('admin/includes/footer',$data);
			}
			else {
			redirect('Admin');	
			}

        }

        public function staff_add(){
          if($this->session->userdata('userid')!=''){
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
                        $udata=array(
                        'first_name'=>$this->input->post('f_name'),
                        'middle_name'=>$this->input->post('m_name'),
                        'last_name'=>$this->input->post('l_name'),                        
                        'username'=>$this->input->post('username'),
                        'email'=>$this->input->post('email'),
                        'password'=>md5($this->input->post('password')),
                        'gender'=>$this->input->post('gender'),
                        'plan_id'=>$this->input->post('plan'),
                        'offer_id'=>$this->input->post('offers'),                        
                        'contact_number'=>$this->input->post('contact'),
                        'role'=>$this->input->post('role'),
                        "created_date"=>date('Y-m-d H:i:s'),
                        "status"=>0,
                        "modify_by"=>$this->session->userdata('user_id'),
                        'dob'=>date('Y-m-d',strtotime($this->input->post('dob'))),

                    );
              
                $last_insertId = $this->User_model->InsertRecord('users',$udata);
  
           
            
                 $userrecoreds='';
                if($last_insertId){
                     $address=array(
                        "user_id"=>$last_insertId,
                        'map_address'=>$this->input->post('mapaddress'),
                        'longitude'=>$this->input->post('longitude'),
                        'latitude'=>$this->input->post('latitude'),
                        'address'=>$this->input->post('address'),                        
                        'country'=>$this->input->post('country'),
                        "created_date"=>date('Y-m-d H:i:s'),
                         "modify_by"=>$this->session->userdata('user_id')
                        
                    );
                     $userrecoreds = $this->User_model->InsertRecord('address',$address);
                }

                  
               if($userrecoreds){
                    $data->error=0;
                    $data->success=1;
                    $data->message="Staff Added Successfully";
               }else{
                    $data->error=1;
                    $data->success=0;
                    $data->message="Network Error";
               }
               $this->session->set_flashdata('item',$data);
               redirect('add-staff');
            }
            $udata = array("id"=>$this->session->userdata('user_id'));                
            $data->result = $this->User_model->SelectSingleRecord('admin','*',$udata,$orderby=array());
            $data->plan = $this->User_model->SelectRecord('plan','*',array(""),'id desc');
            $data->role = $this->User_model->SelectRecord('role','*',array(""),'id desc');
            $data->country = $this->User_model->SelectRecord('country','*',array(""),'name asc');
            $data->offers = $this->User_model->SelectRecord('offers','*',array(""),'id desc');
            $data->title = 'Add Staff';
            $data->field = 'Add Staff';
            $data->page = 'staff_list';
            $this->load->view('admin/includes/header',$data);       
            $this->load->view('staff_add',$data);
            $this->load->view('admin/includes/footer',$data);
		   }
            else {
	       redirect('Admin');
            }		  
        }

        public function staffedit($id){
           if($this->session->userdata('userid')!=''){
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
                        $udata=array(
                        'first_name'=>$this->input->post('f_name'),
                        'middle_name'=>$this->input->post('m_name'),
                        'last_name'=>$this->input->post('l_name'),                        
                        'username'=>$this->input->post('username'),
                        'email'=>$this->input->post('email'),
                        'password'=>md5($this->input->post('password')),
                        'gender'=>$this->input->post('gender'),
                        'plan_id'=>$this->input->post('plan'),
                        'offer_id'=>$this->input->post('offers'),                        
                        'contact_number'=>$this->input->post('contact'),
                        'role'=>$this->input->post('role'),
                        "updated_date"=>date('Y-m-d H:i:s'),
                        "status"=>0,
                        "modify_by"=>$this->session->userdata('user_id'),
                        'dob'=>date('Y-m-d',strtotime($this->input->post('dob'))),

                    );

                $last_insertId =$this->User_model->UpdateRecord('users',$udata, array("id"=>$id));
  
           
            
                 $userrecoreds='';
                if($last_insertId){
                     $address=array(
                        "user_id"=>$id,
                        'map_address'=>$this->input->post('mapaddress'),
                        'longitude'=>$this->input->post('longitude'),
                        'latitude'=>$this->input->post('latitude'),
                        'address'=>$this->input->post('address'),                        
                        'country'=>$this->input->post('country'),
                        "updated_date"=>date('Y-m-d H:i:s'),
                         "modify_by"=>$this->session->userdata('user_id')
                        
                    );
                     // $userrecoreds = $this->User_model->InsertRecord('address',$address);

                       $userrecoreds = $this->User_model->UpdateRecord('address',$address, array("user_id"=>$id));
                }

                  
                   if ($userrecoreds)
                    {
                        $data->error=0;
                        $data->success=1;
                        $data->message='Staff Update Sucessfully.';
                                            
                    }else{
                        $data->error=1;
                        $data->success=0;
                        $data->message='Network Error!';                    
                    }
                 $this->session->set_flashdata('item',$data);
                redirect('edit-staff/'.$id);
            }
            $udata = array("id"=>$this->session->userdata('user_id'));                
            $data->result = $this->User_model->SelectSingleRecord('admin','*',$udata,$orderby=array());

            $data->plan = $this->User_model->SelectRecord('plan','*',array(""),'id desc');
            $data->role = $this->User_model->SelectRecord('role','*',array(""),'id desc');
            $data->offers = $this->User_model->SelectRecord('offers','*',array(""),'id desc');
            $data->reslt = $this->User_model->getUsers($id);
            $data->country = $this->User_model->SelectRecord('country','*',array(""),'name asc');
            $data->title = 'Edit Staff';
            $data->field = 'Edit Staff';
            $data->page = 'staff_list';
            $this->load->view('admin/includes/header',$data);       
            $this->load->view('staff_edit',$data);
            $this->load->view('admin/includes/footer',$data);
		   }
          else {
			redirect('Admin');  
		  }		   
        }
		
			
	 public function emailverify($id){
            
            $data=new stdClass();

                    $udata=array(
                        'email_status'=>1                        
                    );

            if($this->User_model->UpdateRecord('users',$udata,array("id"=>$id))){
                $data->error=0;
                $data->success=1;
                $data->message="Eamil Verified  Successfully";
            }else{
                $data->error=1;
                $data->success=0;
                $data->message="Network Error";
            }
            $this->session->set_flashdata('item',$data);
           echo 1;
        }


public function emailverifyno($id){
            
            $data=new stdClass();

                    $udata=array(
                        'email_status'=>0                        
                    );

            if($this->User_model->UpdateRecord('users',$udata,array("id"=>$id))){
                $data->error=0;
                $data->success=1;
                $data->message="Not Eamil Verified  Successfully";
            }else{
                $data->error=1;
                $data->success=0;
                $data->message="Network Error";
            }
            $this->session->set_flashdata('item',$data);
           echo 1;
        }		
        
 public function staffdeactive($userid){
          
            $data=new stdClass();
            if($userid){
            
                    $udata=array(
                        'staffbasicstatus'=>0                     
                    );
               
                if ($this->User_model->UpdateRecord('users',$udata,array("id"=>$userid)))
                {
                    $data->error=0;
                    $data->success=1;
                    $data->message='User Suspended Sucessfully.';
                                        
                }else{
                    $data->error=1;
                    $data->success=0;
                    $data->message='Network Error!';                    
                }
            $this->session->set_flashdata('item',$data);
           echo 1;
            }
                                
        }

 public function staffactivate($userid){
          
            $data=new stdClass();
            if($userid){
            
                    $udata=array(
                        'staffbasicstatus'=>1                     
                    );
               
                if ($this->User_model->UpdateRecord('users',$udata,array("id"=>$userid)))
                {
                    $data->error=0;
                    $data->success=1;
                    $data->message='User Suspended Sucessfully.';
                                        
                }else{
                    $data->error=1;
                    $data->success=0;
                    $data->message='Network Error!';                    
                }
            $this->session->set_flashdata('item',$data);
           echo 1;
            }
                                
        }   		
		
   

}
