<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Admin extends HT_Controller 
{
       public function __construct(){            
            parent::__construct();
            $this->load->model('Admin_model');           
        }
        public function index(){        
            if($this->session->userdata('logged_in') && $this->session->userdata('usergroup_id') == 'admin'){
                redirect('Admin/dashboard');
            }
            
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
            
            $this->load->view('login_view',$data);			
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
                $Selectdata = array('id','email','username','image');
                $udata = array("email"=>$email,"password"=>md5($password));                
                $result = $this->Admin_model->SelectSingleRecord('admin',$Selectdata,$udata,$orderby=array());
                
                $udata = array("username"=>$email,"password"=>md5($password));                
                $result1 = $this->Admin_model->SelectSingleRecord('admin',$Selectdata,$udata,$orderby=array());
                if($result || $result1)
                {
                    // if($result){
                    //     $sess_array = array(
                    //     'userid' => $result->id,
                    //     'email' => $result->username,
                    //     'image' => $result->image,
                    //     'usergroup_id' => 1,
                    //     'logged_in' => TRUE
                    //     );
                    // }else if($result1){
                    //     $sess_array = array(
                    //     'userid' => $result1->id,
                    //     'email' => $result1->username,
                    //     'usergroup_id' => 1,
                    //     'image' => $result->image,
                    //     'logged_in' => TRUE
                    //     );
                    // }

                     if($result){
                        $sess_array = array(
                        'userid' => $result['id'],
                        'email' => $result['username'],
                        'image' => $result['image'],
                        'usergroup_id' =>'admin',
                        'logged_in' => TRUE
                        );
                    }else if($result1){
                        $sess_array = array(
                        'userid' => $result1->id,
                        'email' => $result1->username,
                        'usergroup_id' =>'admin',
                        'image' => $result['image'],
                        'logged_in' => TRUE
                        );
                    }
                        
                        $this->session->set_userdata($sess_array);
                        $data->error=0;
                        $data->success=1;
                        $data->message='Login Successful';
                        redirect('Admin/dashboard');	
                    
                }
                else
                {
                    $data->error=1;
                    $data->success=0;
                    $data->message='Invalid Username or Password.';
                    
                }
            }
            $this->session->set_flashdata('item',$data);            
            redirect('Admin');
        }
        
        public function dashboard()
        {
            if($this->session->userdata('usergroup_id') != 'admin'){
                redirect('Admin');
            }
            if(!$this->session->userdata('logged_in')){
                redirect('Admin');
            }
			  
            $data=new stdClass();
            if($this->session->flashdata('item')) {
                
                $items = $this->session->flashdata('item');
                if($items->success){
                    $data->error=0;
                    $data->success=1;
                    $data->msg=$items->message;
                }else{
                    $data->error=1;
                    $data->success=0;
                    $data->message=$items->message;
                }
                
            }
            $udata = array("id"=>$this->session->userdata('userid'));                
            $data->result = $this->Admin_model->SelectSingleRecord('admin','*',$udata,$orderby=array());
            
            $data->total_user = $this->Admin_model->countrecords('users',array());
            $data->employee = $this->Admin_model->countrecords('users',array('role'=>'employer'));
            $data->staff = $this->Admin_model->countrecords('users',array('role'=>'staff'));
            $data->total_post_jobs = $this->Admin_model->countrecords('jobs',array());
            
           
            $data->title = 'Dashboard';
            $data->field = 'Dashboard';
            $data->page = 'dashboard';
            $this->load->view('admin/includes/header',$data);		
            $this->load->view('dashboard_view',$data);
            $this->load->view('admin/includes/footer',$data);

        }
        
        
        public function update_profile(){

            if($this->session->userdata('usergroup_id') != 'admin'){
                redirect('Admin');
            }

            if(!$this->session->userdata('logged_in')){
                redirect('Admin');
            }
            $data=new stdClass();
			
          	if($_POST){
                if($this->input->post('password') != ''){
                    $udata=array(
                        'f_name'=>$this->input->post('f_name'),
                        'l_name'=>$this->input->post('l_name'),
                        'email'=>$this->input->post('email'),
                        'username'=>$this->input->post('username'),
                        'password' => md5($this->input->post('password'))
                    );
                }else{
                    $udata=array(
                        'f_name'=>$this->input->post('f_name'),
                        'l_name'=>$this->input->post('l_name'),
                        'username'=>$this->input->post('username'),
                        'email'=>$this->input->post('email')					
                    );
                }
				if ($this->Admin_model->UpdateRecord('admin',$udata,array("id"=>$this->session->userdata('userid'))))
				{
                    $data->error=0;
                    $data->success=1;
                    $data->message='Profile Update Sucessfully.';
                     					
				}else{
                    $data->error=1;
                    $data->success=0;
                    $data->message='Network Error!';                    
                }
            $this->session->set_flashdata('item',$data);
            redirect('Admin/update_profile');
			}
            
            $udata = array("id"=>$this->session->userdata('userid'));                
            $data->result = $this->Admin_model->SelectSingleRecord('admin','*',$udata,$orderby=array());
            
            
            $data->title = 'Admin Profile';
            $data->field = 'Admin Profile';
            $data->page = 'profile';
            $this->load->view('admin/includes/header',$data);		
            $this->load->view('profile_view',$data);
            $this->load->view('admin/includes/footer',$data);			
		}
        
        public function upload_image(){
            $data=new stdClass();
            if($this->session->userdata('usergroup_id') != 'admin'){
                redirect('Admin');
            }
            if(!$this->session->userdata('logged_in')){
                redirect('Admin');
            }
            if($_FILES){
                $config=[   'upload_path'   =>'./public/upload/profile_image/',
                        'allowed_types' =>'jpg|gif|png|jpeg',
                        'file_name' => strtotime(date('y-m-d h:i:s')).$_FILES["profile_pic"]['name']
                    ];
                $this->load->library ('upload',$config);

                if ($this->upload->do_upload('profile_pic'))
                {
                    $adminpic=$this->Admin_model->SelectSingleRecord('admin','*',array("id"=>$this->session->userdata('userid')),$orderby=array());                                        
                    unlink('./public/upload/profile_image/'.$adminpic->image);
                    // unlink('./public/upload/thumb/'.$adminpic->image);
                    $udata = $this->upload->data();                    
                                    //resize profile image
                                    $config10['image_library'] = 'gd2';
                                    $config10['source_image'] = $udata['full_path'];
                                    $config10['new_image'] = './public/upload/thumb/'.$udata['file_name'];
                                    $config10['maintain_ratio'] = TRUE;
                                    $config10['width']         = 200;
                                    $config10['height']       = 200;
                                    
                                    $this->load->library('image_lib', $config10);
                                    
                                    $this->image_lib->resize();
                    $image_path= $udata['file_name'];
                    $this->Admin_model->UpdateRecord('admin',array("image"=>$image_path),array("id"=>$this->session->userdata('userid')));
                    $data->error=0;
                    $data->success=1;
                    $data->message='Uploaded Successfully'; 
                    $this->session->set_flashdata('item', $data);
                    redirect('Admin/upload_image'); 
                }
                else
                {
                    $data->error=1;
                    $data->success=0;
                    $data->message='Only jpeg/png/gif/jpg allowed!'; 
                    $this->session->set_flashdata('item', $data);
                    redirect('Admin/upload_image'); 
                }
            }
            $udata = array("id"=>$this->session->userdata('userid'));                
            $data->result = $this->Admin_model->SelectSingleRecord('admin','*',$udata,$orderby=array());
            $data->title = 'Admin Profile Image';
            $data->field = 'Dashboard';
            $data->page = 'upload_image';
            $this->load->view('admin/includes/header',$data);       
            $this->load->view('profile_pic_view',$data);
            $this->load->view('admin/includes/footer',$data);

        }
        
        public function logout()
        {
            $data=new stdClass();
            if($this->session->userdata('logged_in')){
                $this->session->sess_destroy();    
            }
            
            $data->error=0;
            $data->success=1;
            $data->message='Logged Out Successfully';
            $this->session->set_flashdata('item',$data);            
            redirect('Admin');
        }


        function check_email_exists($id)
        {                
            if (array_key_exists('email',$_POST)) 
            {
                if ( $this->Admin_model->email_exists($this->input->post('email'),$id) == TRUE ) 
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
		
// work for about us page //
  public function aboutus(){           
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
           
            $data->records = $this->Admin_model->SelectRecord('aboutus','*',array(""),'id desc');
            $udata = array("id"=>$this->session->userdata('userid'));                
            $data->result = $this->Admin_model->SelectSingleRecord('admin','*',$udata,$orderby=array());
            $data->title = 'About Us';
            $data->field = 'Datatable';
            $data->page = 'aboutus';
            $this->load->view('admin/includes/header',$data);		
            $this->load->view('about',$data);
            $this->load->view('admin/includes/footer',$data);
           }
           else {
      redirect('Admin');
		   }		   
        }
		
   public function editabout($id){
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

                  $img='';
                    if($_FILES['image']['name']){

                         $new_image_name = time() . str_replace(str_split(' ()\\/,:*?"<>|'), '', $_FILES['image']['name']);

                            $image_path = realpath(APPPATH . '../public/upload/about');
                            $config['upload_path'] = $image_path;
                         
                            $config['allowed_types'] = 'gif|jpg|png|jpeg';
                            $config['file_name'] = $new_image_name;


                            $this->load->library('upload', $config);
                            if ($this->upload->do_upload('image')) {


                                $datass = $this->upload->data();
                                $img =  $datass['file_name'];
                            } else {
                                $img = "";
                            }

                    }else{
                        $img = $this->input->post('imageold');
                    }           
						
						$plandata=array(
                        'heading'=>$this->input->post('heading'),
                        'description'=>$this->input->post('description'),
						'image'=>$img,
						'staff_description'=>$this->input->post('staff_description'),
                        'emp_description'=>$this->input->post('emp_description'),
                        "create_dt"=>date('Y-m-d H:i:s'));
                         $this->Admin_model->UpdateRecord('aboutus',$plandata, array("id"=>$id));
						// echo $this->db->last_query(); die;
                  
                   if ($this->Admin_model->UpdateRecord('aboutus',$plandata, array("id"=>$id)))
                    {
                        $data->error=0;
                        $data->success=1;
                        $data->message='About Us Update Sucessfully.';
                                            
                    }else{
                        $data->error=1;
                        $data->success=0;
                        $data->message='Network Error!';                    
                    }
                 $this->session->set_flashdata('item',$data);
                redirect('Admin/aboutus');
            }
            $udata = array("id"=>$this->session->userdata('userid'));                
            $data->result = $this->Admin_model->SelectSingleRecord('admin','*',$udata,$orderby=array());

            $data->reslt = $this->Admin_model->SelectSingleRecord('aboutus','*',array("id"=>$id),$orderby=array());
            $data->title = 'Edit About';
            $data->field = 'Edit About';
            $data->page = 'aboutus';
            $this->load->view('admin/includes/header',$data);       
            $this->load->view('editabout',$data);
            $this->load->view('admin/includes/footer',$data); 
             }
            else {
           redirect('Admin');
		   }			
        }
        		
		

// end work for about us page //		

// work for Terms & Conditions page //
  public function termconditions (){           
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
           
            $data->records = $this->Admin_model->SelectRecord('terms_conditions','*',array(""),'id desc');
            $udata = array("id"=>$this->session->userdata('userid'));                
            $data->result = $this->Admin_model->SelectSingleRecord('admin','*',$udata,$orderby=array());
            $data->title = 'Term & Conditions';
            $data->field = 'Datatable';
            $data->page = 'termconditions';
            $this->load->view('admin/includes/header',$data);		
            $this->load->view('termconditions',$data);
            $this->load->view('admin/includes/footer',$data);
           }
           else {
      redirect('Admin');
		   }		   
        }
		
   public function edittermconditionst($id){
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
       
						
						$plandata=array(                       
                        'describtion'=>$this->input->post('description'),						
                        "create_dt"=>date('Y-m-d H:i:s'));
                         $this->Admin_model->UpdateRecord('terms_conditions',$plandata, array("id"=>$id));
						// echo $this->db->last_query(); die;
                  
                   if ($this->Admin_model->UpdateRecord('terms_conditions',$plandata, array("id"=>$id)))
                    {
                        $data->error=0;
                        $data->success=1;
                        $data->message='Term & Conditions Update Sucessfully.';
                                            
                    }else{
                        $data->error=1;
                        $data->success=0;
                        $data->message='Network Error!';                    
                    }
                 $this->session->set_flashdata('item',$data);
                redirect('Admin/termconditions');
            }
            $udata = array("id"=>$this->session->userdata('userid'));                
            $data->result = $this->Admin_model->SelectSingleRecord('admin','*',$udata,$orderby=array());

            $data->reslt = $this->Admin_model->SelectSingleRecord('terms_conditions','*',array("id"=>$id),$orderby=array());
            $data->title = 'Edit Term & Conditions';
            $data->field = 'Edit  Term & Conditions';
            $data->page = 'aboutus';
            $this->load->view('admin/includes/header',$data);       
            $this->load->view('edittermconditions',$data);
            $this->load->view('admin/includes/footer',$data); 
             }
            else {
           redirect('Admin');
		   }			
        }
        		
		

// end work for Terms & Conditions page //	

// work for Privacy Policy page //
  public function privacypolicy (){           
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
           
            $data->records = $this->Admin_model->SelectRecord('privacy_policy','*',array(""),'id desc');
            $udata = array("id"=>$this->session->userdata('userid'));                
            $data->result = $this->Admin_model->SelectSingleRecord('admin','*',$udata,$orderby=array());
            $data->title = 'Privacy Policy';
            $data->field = 'Datatable';
            $data->page = 'privacypolicy';
            $this->load->view('admin/includes/header',$data);		
            $this->load->view('privacypolicy',$data);
            $this->load->view('admin/includes/footer',$data);
           }
           else {
      redirect('Admin');
		   }		   
        }
		
   public function editprivacypolicy($id){
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
       
						
						$plandata=array(                       
                        'describtion'=>$this->input->post('description'),						
                        "create_dt"=>date('Y-m-d H:i:s'));
                         $this->Admin_model->UpdateRecord('privacy_policy',$plandata, array("id"=>$id));
						// echo $this->db->last_query(); die;
                  
                   if ($this->Admin_model->UpdateRecord('privacy_policy',$plandata, array("id"=>$id)))
                    {
                        $data->error=0;
                        $data->success=1;
                        $data->message='Privacy Policy Update Sucessfully.';
                                            
                    }else{
                        $data->error=1;
                        $data->success=0;
                        $data->message='Network Error!';                    
                    }
                 $this->session->set_flashdata('item',$data);
                redirect('Admin/privacypolicy');
            }
            $udata = array("id"=>$this->session->userdata('userid'));                
            $data->result = $this->Admin_model->SelectSingleRecord('admin','*',$udata,$orderby=array());

            $data->reslt = $this->Admin_model->SelectSingleRecord('privacy_policy','*',array("id"=>$id),$orderby=array());
            $data->title = 'Edit Privacy Policy';
            $data->field = 'Edit Privacy Policy';
            $data->page = 'aboutus';
            $this->load->view('admin/includes/header',$data);       
            $this->load->view('editprivacypolicy',$data);
            $this->load->view('admin/includes/footer',$data); 
             }
            else {
           redirect('Admin');
		   }			
        }
        		
		

// end work for Privacy Policy page //							
		
			
        
}
?>