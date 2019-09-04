<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Staffprofile extends HT_Controller 
{
	public function __construct(){
        parent::__construct();
        $this->load->model('Staffprofile_model');

        if(!$this->session->userdata('logged_in')){
                redirect('Welcome');
            } 
      }
	  

public function index(){
   
        $sid = $this->session->userdata('user_id');
		$data['user']=$this->Staffprofile_model->getdata("users",$where=array("id"=>$sid,"role"=>'staff'),$sort="");
		if($data['user'][0]->em_staff_status==1){
		$this->load->view('front_common/header',$data);
		$this->load->view('profile',$data);
		$this->load->view('front_common/footer',$data);
		}
		else {
		 redirect('staff-membership');   	
		}
        		
}

public function manage_work_profile()
{
    
        $sid =  $this->session->userdata('user_id');
		$data['user']=$this->Staffprofile_model->getdata("users",$where=array("id"=>$sid,"role"=>'staff'),$sort="");
		if($data['user'][0]->em_staff_status==1){
		$data['basicinfo']=$this->Staffprofile_model->getdata("staff_basicinfo",$where=array("staff_id"=>$sid),$sort="");
		$data['skillinfo']=$this->Staffprofile_model->getdata("staff_sklills_arti",$where=array("staff_id"=>$sid),$sort="");
		$data['employment']=$this->Staffprofile_model->getdata("staff_employment",$where=array("staff_id"=>$sid),$sort="");
		$data['lconsidered']=$this->Staffprofile_model->getdata("location_considered",$where=array(),$sort="id asc");
		$data['skills']=$this->Staffprofile_model->getdata("skill",$where=array(),$sort="id asc");
		$data['industry']=$this->Staffprofile_model->getdata("industry",$where=array(),$sort="id asc");
		$this->load->view('front_common/header',$data);
		$this->load->view('manage-work-profile',$data);
		$this->load->view('front_common/footer',$data);	
		}
		else {
		 redirect('staff-membership');   	
		}
}

	  
// profile side_bar //
          public function side_bar(){
             $this->content['result'] = $this->Staffprofile_model->getUsers($this->session->userdata('user_id'));  
             $this->load->view('side_bar',$this->content);
        }
// profile side_bar //	 

// profile image change //
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
         
		 $last_insertId =$this->Staffprofile_model->UpdateRecord('users',$udata, array("id"=>$id));
	     if($last_insertId)
         {
         $this->session->set_flashdata('result', 1);
		 $this->session->set_flashdata('class', 'success');
		 $this->session->set_flashdata('msg', "your profile is updated successfully.");
         redirect('staff-profile');                                  
         } else {
         $this->session->set_flashdata('result', 1);
		 $this->session->set_flashdata('class', 'danger');
		 $this->session->set_flashdata('msg', "Error to update");
         redirect('staff-profile');		  
          }
          
    }
  }
// profile image change //

// update staff profile  //
public function updateprofile($id)
{
if(!empty($id)){  			
                        
          $where=array("id"=>$id);
		  $name = explode(" ", $this->input->post("uname"));
		  //print_r($name); die;
		  $datas=array("first_name"=>$name[0],"last_name"=>$name[1],"username"=>$this->input->post("username"),"contact_number"=>$this->input->post("phone"));
		  $updt= $this->Staffprofile_model->update("users",$datas,$where); 
		  //echo $this->db->last_query(); die;
                   if ($updt)
                    {
                    $this->session->set_flashdata('result', 1);
		            $this->session->set_flashdata('class', 'success');
		            $this->session->set_flashdata('msg', "Profile Update Sucessfully");   
					}
					else{
                   $this->session->set_flashdata('result', 1);
		           $this->session->set_flashdata('class', 'danger');
		           $this->session->set_flashdata('msg', "Error to update");                 
                    }
                  $this->session->set_flashdata('item',$data);
                  redirect('staff-profile');
       
    }
}

// update staff profile //

// profile updatepass work //	
public function updatepass($id=null)
	{	  
	  if(!empty($id)){ 
	     $password = $this->input->post('n_pass');
		  $where=array("id"=>$id);
		  $datas=array("password"=>md5($password));
		  $updt= $this->Staffprofile_model->update("users",$datas,$where);  
		  
                   if ($updt)
                    {
                        $data->error=0;
                        $data->success=1;
                        $data->message='Password Update Sucessfully.';
                                            
                    }else{
					 $this->session->set_flashdata('result', 1);
		             $this->session->set_flashdata('class', 'danger');
		             $this->session->set_flashdata('msg', "Error to update");   	
					                 
                    }
                 $this->session->set_flashdata('item',$data);
                redirect('staff-profile');
         
    }	
	}

 // profile updatepass work //   

// profile staffbasiccreate work //	
public function staffbasiccreate()
	{
	    //echo 'heelol'; die;
		$this->form_validation->set_rules('eligibility_address', 'Eligibility To Work In NZ is required and cannot be empty!', 'required');
		
		$this->form_validation->set_rules('available_date', 'Dates Available To Work From is required and cannot be empty!', 'required');
		$this->form_validation->set_rules('current_location', 'Current Location is required and cannot be empty!', 'required');
		$this->form_validation->set_rules("level_fitness","Level Of Fitness is required and cannot be empty!","required");
		$this->form_validation->set_rules("considered_location[]","Location Considered is required and cannot be empty!","required");
		$this->form_validation->set_rules("level_english","Level Of English Considered is required and cannot be empty!","required");
		$this->form_validation->set_rules("languages[]","Languages Known is required and cannot be empty!","required");
		$this->form_validation->set_rules("contact","Contact is required and cannot be empty!","required");
		$this->form_validation->set_rules("member_since","Member Since is required and cannot be empty!","required");
		
		if ($this->form_validation->run() == FALSE)
		{
			//echo 'hello'; die;
	    	$this->manage_work_profile();
		}
		else
		{
		//echo 'yes'; die;		
         $considered_location = implode(',', $this->input->post('considered_location'));
		 $languages = implode(',', $this->input->post('languages'));
         $extra_about =  implode(',', $this->input->post('extra_about')); 		 
		 $dc = $this->Staffprofile_model->savedocumentup("document","public/upload/document/"); 
		 if($dc==""){
		  $dc="null"; 
		 }
		 else {
			$dc=$dc; 
		 }
          $av_date = date("Y-m-d", strtotime($this->input->post("available_date"))); 
          $sid=  $this->session->userdata('user_id');
		  $datas=array("eligibility_address"=>$this->input->post("eligibility_address"),"document"=>$dc,
		  "available_date"=>$av_date,"current_location"=>$this->input->post("current_location"),
		  "cityc"=>$this->input->post("cityc"),"cityLatc"=>$this->input->post("cityLatc"),"cityLngc"=>$this->input->post("cityLngc"),
		  "considered_location"=>$considered_location,"level_english"=>$this->input->post("level_english"), 
		  "languages"=>$languages,"contact"=>$this->input->post("contact"),"member_since"=>$this->input->post("member_since"),"level_fitness"=>$this->input->post("level_fitness"),
		  "nationality"=>$this->input->post("nationality"),"basic_description"=>$this->input->post("basic_description"),
		  "extra_about"=> $extra_about,"staff_id"=>$sid,"create_dt"=>date("Y-m-d H:i:s"),);
		  $updt= $this->Staffprofile_model->insert("staff_basicinfo",$datas,$where);  
		 // echo $this->db->last_query(); die;
		  
		 $sklill_artisdsr = $this->input->post('sklills-description');
		 $licence =  implode(',', $this->input->post('licence')); 
         $sid=  $this->session->userdata('user_id');
		 $datas1=array("sklills_description"=>$sklill_artisdsr,"licence"=> $licence,"staff_id"=>$sid,"create_dt"=>date("Y-m-d H:i:s"),);
		 $updt1= $this->Staffprofile_model->insert("staff_sklills_arti",$datas1,$where);

		 
		 $sid=  $this->session->userdata('user_id');
		 $where=array("id"=>$sid);
		 $datas1=array("business_location"=>$this->input->post("current_location"),"city2"=>$this->input->post("cityc"),"cityLat"=>$this->input->post("cityLatc"),"cityLng"=>$this->input->post("cityLngc"),"staffbasicstatus"=>1);
		 $updt1= $this->Staffprofile_model->update("users",$datas1,$where); 
		 
		 /* $title = serialize($this->input->post('jobtitle'));
		 $fromdate = serialize($this->input->post('fromdate')); 
		 $todate = serialize($this->input->post('todate')); 
		 $employment_description = serialize($this->input->post('employment-description')); 
		 $industry = serialize($this->input->post('industry')); 
         $sid=  $this->session->userdata('user_id');
		 // echo 'hello'; die;
		  $datas2=array("jobtitle"=>$title,"em_industry"=>$industry,"fromdate"=>$fromdate,"todate"=> $todate,"employment_description"=> $employment_description,"staff_id"=>$sid,"create_dt"=>date("Y-m-d H:i:s"));
		  $updt2= $this->Staffprofile_model->insert("staff_employment",$datas2,$where); */
		      if ($updt)
                    {
                        $data->error=0;
                        $data->success=1;
                        $data->message='Basic Info Save Sucessfully.';
                                            
                    }else{
					 $this->session->set_flashdata('result', 1);
		             $this->session->set_flashdata('class', 'danger');
		             $this->session->set_flashdata('msg', "Error to Save");   	
					                 
                    }
                 $this->session->set_flashdata('item',$data);
                redirect('manage-work-profile/go');
		}
 	
	}
	
public function staffbasicpublish(){
	 $sid =  $this->session->userdata('user_id'); 
	  $where=array("id"=>$sid);
		  $datas=array("staffbasicstatus"=>1);
		  $updt= $this->Staffprofile_model->update("users",$datas,$where);
		  // echo $this->db->last_query(); die;
		   if($updt)
                    {
                     $this->session->set_flashdata('result', 1);
		             $this->session->set_flashdata('class', 'success');
		             $this->session->set_flashdata('msg', "Publish Your Profile Sucessfully");
                                            
                    }
                 $this->session->set_flashdata('item',$data);
                redirect('manage-work-profile/go');
		
} 


 // profile staffbasiccreate work //  

public function staffbasicupdate(){
       		 
	    $this->form_validation->set_rules('eligibility_address', 'Eligibility To Work In NZ is required and cannot be empty!', 'required');
		
		$this->form_validation->set_rules('available_date', 'Dates Available To Work From is required and cannot be empty!', 'required');
		$this->form_validation->set_rules('current_location', 'Current Location is required and cannot be empty!', 'required');
		$this->form_validation->set_rules("level_fitness","Level Of Fitness is required and cannot be empty!","required");
		$this->form_validation->set_rules("considered_location[]","Location Considered is required and cannot be empty!","required");
		$this->form_validation->set_rules("level_english","Level Of English Considered is required and cannot be empty!","required");
		$this->form_validation->set_rules("languages[]","Languages Known is required and cannot be empty!","required");
		$this->form_validation->set_rules("contact","Contact is required and cannot be empty!","required");
		$this->form_validation->set_rules("member_since","Member Since is required and cannot be empty!","required");
		
		if ($this->form_validation->run() == FALSE)
		{
	    	$this->manage_work_profile();
		}
		else
		{
		    
			
         $considered_location = implode(',', $this->input->post('considered_location'));
		 $languages = implode(',', $this->input->post('languages')); 
		 $extra_about =  implode(',', $this->input->post('extra_about')); 
		 
		 if($_FILES['document']['name'])
		  {	
          $sid= $this->input->post("bid"); 
		  $this->Staffprofile_model->unsetImage1($sid,'staff_basicinfo','document','public/upload/document/');
		  $dc = $this->Staffprofile_model->savecompanylogo("document","public/upload/document/");  	     
		  }
		  else{		 
		  $dc=$this->input->post('document1');
          }	
         
          $av_date = date("Y-m-d", strtotime($this->input->post("available_date")));   	  
		  $sid= $this->input->post("bid");
		  $where=array("id"=>$sid);
		  $datas=array("eligibility_address"=>$this->input->post("eligibility_address"),"document"=>$dc,
		  "available_date"=>$av_date,"current_location"=>$this->input->post("current_location"),
		  "cityc"=>$this->input->post("cityc"),"cityLatc"=>$this->input->post("cityLatc"),"cityLngc"=>$this->input->post("cityLngc"),
		  "considered_location"=>$considered_location,"level_english"=>$this->input->post("level_english"),"languages"=>$languages,
		  "contact"=>$this->input->post("contact"),"member_since"=>$this->input->post("member_since"),"level_fitness"=>$this->input->post("level_fitness"),
		  "nationality"=>$this->input->post("nationality"),"basic_description"=>$this->input->post("basic_description"),
		  "extra_about"=>$extra_about,"create_dt"=>date("Y-m-d H:i:s"),);
		  
		  $updt= $this->Staffprofile_model->update("staff_basicinfo",$datas,$where);  
		  //echo $this->db->last_query(); die;
		  
		  $sid=  $this->session->userdata('user_id');
		  $data['skill']=$this->Staffprofile_model->getdata("staff_sklills_arti",$where=array("staff_id"=>$sid),$sort="");
		 
		  if(count( $data['skill'])==0){
        	  
		  $sklill_artisdsr = $this->input->post('sklills-description');
		  $licence =  implode(',', $this->input->post('licence')); 
          $sid=  $this->session->userdata('user_id');
		  $datas1=array("sklills_description"=>$sklill_artisdsr,"licence"=> $licence,"staff_id"=>$sid,"create_dt"=>date("Y-m-d H:i:s"),);
		  $updt1= $this->Staffprofile_model->insert("staff_sklills_arti",$datas1,$where);
          //echo $this->db->last_query(); die;		  
		  }
		  
		  else {		 
		  $sklill_artisdsr = $this->input->post('sklills-description');		 
		  $licence = implode(',', $this->input->post('licence')); 
          $sid= $this->input->post("skid"); 
		  $where=array("id"=>$sid);
		  $datas1=array("sklills_description"=>$sklill_artisdsr,"licence"=> $licence,"create_dt"=>date("Y-m-d H:i:s"),);
		  $updt1= $this->Staffprofile_model->update("staff_sklills_arti",$datas1,$where);    
		  }
		  
		  
		 $sid=  $this->session->userdata('user_id');
		 $where=array("id"=>$sid);
		 $datas1=array("business_location"=>$this->input->post("current_location"),"city2"=>$this->input->post("cityc"),"cityLat"=>$this->input->post("cityLatc"),"cityLng"=>$this->input->post("cityLngc"),"staffbasicstatus"=>1);
		 
		 $updt1= $this->Staffprofile_model->update("users",$datas1,$where);
		 
		  if($updt)
                    {
                     $this->session->set_flashdata('result', 1);
		             $this->session->set_flashdata('class', 'success');
		             $this->session->set_flashdata('msg', "Basic Info Update Sucessfully");
                                            
                    }else{
					 $this->session->set_flashdata('result', 1);
		             $this->session->set_flashdata('class', 'danger');
		             $this->session->set_flashdata('msg', "Error to update");   	
					                 
                    }
                 $this->session->set_flashdata('item',$data);
                redirect('manage-work-profile/go');
		}	
}
// profile staffbasiccreate work //  


public function historyupdate()
{
         $sid=  $this->session->userdata('user_id');
		 $data['basicss']=$this->Staffprofile_model->getdata("staff_employment",$where=array("staff_id"=>$sid),$sort=""); 
		 if(count( $data['basicss'])==0){
         //echo $this->input->post('industry'); die;			 
		 $title = serialize($this->input->post('jobtitle'));
		 $fromdate = serialize($this->input->post('fromdate')); 
		 $todate = serialize($this->input->post('todate')); 
		 $employment_description = serialize($this->input->post('employment_description')); 
		 $industry = serialize($this->input->post('industry')); 
         $sid=  $this->session->userdata('user_id');
		 // echo 'hello'; die;
		  $datas2=array("jobtitle"=>$title,"em_industry"=>$industry,"fromdate"=>$fromdate,"todate"=> $todate,"employment_description"=> $employment_description,"staff_id"=>$sid,"create_dt"=>date("Y-m-d H:i:s"));
		  $updt2= $this->Staffprofile_model->insert("staff_employment",$datas2,$where);  
		 }
		 else {	  
		  
		  $title = serialize($this->input->post('jobtitle'));
		  $fromdate = serialize($this->input->post('fromdate')); 
		  $todate = serialize($this->input->post('todate')); 
		  $employment_description = serialize($this->input->post('employment_description')); 
		  $industry = serialize($this->input->post('industry')); 
          $sid= $this->input->post("sid");
		  $where=array("id"=>$sid);
		  $datas3=array("jobtitle"=>$title,"em_industry"=>$industry,"fromdate"=>$fromdate,"todate"=> $todate,"employment_description"=> $employment_description,"create_dt"=>date("Y-m-d H:i:s"));
		  $updt3= $this->Staffprofile_model->update("staff_employment",$datas3,$where); 
          //echo $this->db->last_query(); die;
		 }
		 
}

//  staffbasiccreate work  preview//
public function staffbasicupdatepp(){
  $cuid=  $this->session->userdata('user_id');
  $data['basicinfo']=$this->Staffprofile_model->getdata("staff_basicinfo_preview",$where=array("staff_id"=>$cuid),$sort="");	
  if(count( $data['basicinfo'])==0){
	 $dc = $this->Staffprofile_model->savedocumentup("form_data","public/upload/document/");	  
          $datas=array("document"=>$dc,"create_dt"=>date("Y-m-d H:i:s"));
		  $updt= $this->Staffprofile_model->insert("staff_basicinfo_preview",$datas,$where);   
  }
  else {
	      $sid = $data['basicinfo'][0]->id;	 
		  $dir = "public/upload/document/";
          move_uploaded_file($_FILES["document"]["tmp_name"], $dir. $_FILES["document"]["name"]);
		  $dc =  $_FILES["document"]["name"]; 
		  $where=array("id"=>$sid);  
	  	  $datas=array("document"=>$dc,"create_dt"=>date("Y-m-d H:i:s"),);
		  $updt= $this->Staffprofile_model->update("staff_basicinfo_preview",$datas,$where);     
  }
} 
 
 
 
public function staffbasicupdatep(){
        
			
         $considered_location = implode(',', $this->input->post('considered_location'));
		 $languages = implode(',', $this->input->post('languages'));
		 $extra_about =  implode(',', $this->input->post('extra_about')); 
		 $cuid=  $this->session->userdata('user_id');
		 $data['basicinfo']=$this->Staffprofile_model->getdata("staff_basicinfo_preview",$where=array("staff_id"=>$cuid),$sort="");
					
		 if(count( $data['basicinfo'])==0){
			 
		 $dir = "public/upload/document/";	 
		 move_uploaded_file($_FILES["document"]["tmp_name"], $dir. $_FILES["document"]["name"]);
		// echo $_FILES["document"]["name"]; die;	 
		 $datas=array("staff_id"=>$cuid,"eligibility_address"=>$this->input->post("eligibility_address"),"available_date"=>$this->input->post("available_date"),
		 "current_location"=>$this->input->post("current_location"),"cityc"=>$this->input->post("cityc"),"cityLatc"=>$this->input->post("cityLatc"),
		 "cityLngc"=>$this->input->post("cityLngc"),"considered_location"=>$considered_location,"level_english"=>$this->input->post("level_english"),
		 "languages"=>$languages,"contact"=>$this->input->post("contact"),"member_since"=>$this->input->post("member_since"),"level_fitness"=>$this->input->post("level_fitness"),
		 "nationality"=>$this->input->post("nationality"),"extra_about"=>$extra_about,"basic_description"=>$this->input->post("basic_description"),"create_dt"=>date("Y-m-d H:i:s"),);
		  $updt= $this->Staffprofile_model->insert("staff_basicinfo_preview",$datas,$where);   
		  }
		  else {
		  $sid = $data['basicinfo'][0]->id;
		  $dir = "public/upload/document/";	 
		  move_uploaded_file($_FILES["document"]["tmp_name"], $dir. $_FILES["document"]["name"]);
		  //echo $_FILES["document"]["name"]; die;	 
		  $where=array("id"=>$sid);
		  $datas=array("eligibility_address"=>$this->input->post("eligibility_address"),"city2"=>$this->input->post("city2"),
		  "cityLat"=>$this->input->post("cityLat"),"cityLng"=>$this->input->post("cityLng"),"available_date"=>$this->input->post("available_date"),
		  "current_location"=>$this->input->post("current_location"),"cityc"=>$this->input->post("cityc"),"cityLatc"=>$this->input->post("cityLatc"),
		  "cityLngc"=>$this->input->post("cityLngc"),"considered_location"=>$considered_location,"level_english"=>$this->input->post("level_english"),
		  "languages"=>$languages,"contact"=>$this->input->post("contact"),"member_since"=>$this->input->post("member_since"),
		  "level_fitness"=>$this->input->post("level_fitness"),"nationality"=>$this->input->post("nationality"),"basic_description"=>$this->input->post("basic_description"),
		  "extra_about"=>$extra_about,"create_dt"=>date("Y-m-d H:i:s"),);
		  $updt= $this->Staffprofile_model->update("staff_basicinfo_preview",$datas,$where);  
		  //echo $this->db->last_query(); die;
		  }
		
} 

//  staffbasiccreate work  preview//

// staff skill work preview//
public function staffskillupdatepreview()
{	
          $sklill_artisdsr = $this->input->post('sklill_artisdsr');		 
		  $licence = implode(',', $this->input->post('licence')); 
        
		  $cuid=  $this->session->userdata('user_id');
		  $data['skillinfo']=$this->Staffprofile_model->getdata("staff_sklills_arti_preview",$where=array("staff_id"=>$cuid),$sort="");				
		  if(count( $data['skillinfo'])==0){
		  $datas=array("staff_id"=>$cuid,"sklills_description"=>$sklill_artisdsr,"licence"=> $licence,"create_dt"=>date("Y-m-d H:i:s"));
		  $updt= $this->Staffprofile_model->insert("staff_sklills_arti_preview",$datas,$where);    
		  }
		  else {
		  $sid = $data['skillinfo'][0]->id; 
		  $where=array("id"=>$sid);
		  $datas=array("sklills_description"=>$sklill_artisdsr,"licence"=>$licence,"create_dt"=>date("Y-m-d H:i:s"));
		  $updt= $this->Staffprofile_model->update("staff_sklills_arti_preview",$datas,$where);
		  }		  
		  echo $this->db->last_query(); die;
                   if ($updt)
                    {
                        $data->error=0;
                        $data->success=1;
                        $data->message='Sklills And Attributes Update Sucessfully.';
                                            
                    }else{
					 $this->session->set_flashdata('result', 1);
		             $this->session->set_flashdata('class', 'danger');
		             $this->session->set_flashdata('msg', "Error to Save");   	
					                 
                    }
                 $this->session->set_flashdata('item',$data);
                redirect('manage-work-profile/');
		
}

// staff skill work preview//
// staff Employment History work update preview//
public function staffemploymentupdatepreview()
{	
         $title = serialize($this->input->post('jobtitle'));
		 $industry = serialize($this->input->post('industry'));
		 $fromdate = serialize($this->input->post('fromdate')); 
		 $todate = serialize($this->input->post('todate')); 
		 $employment_description = serialize($this->input->post('employment_description')); 
          $cuid=  $this->session->userdata('user_id');
		  $data['employment']=$this->Staffprofile_model->getdata("staff_employment_preview",$where=array("staff_id"=>$cuid),$sort="");				
		  if(count( $data['employment'])==0){
		  $datas=array("staff_id"=>$cuid,"jobtitle"=>$title,"em_industry"=>$industry,"fromdate"=>$fromdate,"todate"=> $todate,"employment_description"=> $employment_description,"create_dt"=>date("Y-m-d H:i:s"));
		  $updt= $this->Staffprofile_model->insert("staff_employment_preview",$datas,$where);    
		  }
		  else {
		  $sid = $data['employment'][0]->id; 
		  $where=array("id"=>$sid);
		  $datas=array("em_industry"=>$industry,"jobtitle"=>$title,"fromdate"=>$fromdate,"todate"=> $todate,"employment_description"=> $employment_description,"create_dt"=>date("Y-m-d H:i:s"));
		  $updt= $this->Staffprofile_model->update("staff_employment_preview",$datas,$where);  
		  }
		  //echo $this->db->last_query(); die;
                   if ($updt)
                    {
                        $data->error=0;
                        $data->success=1;
                        $data->message='Employment History  Update Sucessfully.';
                                            
                    }else{
					 $this->session->set_flashdata('result', 1);
		             $this->session->set_flashdata('class', 'danger');
		             $this->session->set_flashdata('msg', "Error to Save");   	
					                 
                    }
                 $this->session->set_flashdata('item',$data);
                redirect('manage-work-profile');
		
}

// staff staff Employment History work update preview//

// staff skill work //
public function staffskillcreate()
{	
          $sklill_artisdsr = $this->input->post('sklills-description');
		  $licence =  implode(',', $this->input->post('licence'));
		  $cv_ele = $this->Staffprofile_model->savecv_ele("cv_ele","public/upload/document/"); 
		  if($dc==""){
		  $cv_ele="null"; 
		  }
		  else {
			$cv_ele=$cv_ele; 
		  }
          $sid=  $this->session->userdata('user_id');
		  $datas=array("sklills_description"=>$sklill_artisdsr,"cv_ele"=>$cv_ele,"licence"=>$licence,"staff_id"=>$sid,"create_dt"=>date("Y-m-d H:i:s"),);
		  $updt= $this->Staffprofile_model->insert("staff_sklills_arti",$datas,$where);  
		  //echo $this->db->last_query(); die;
                   if ($updt)
                    {
                        $data->error=0;
                        $data->success=1;
                        $data->message='Sklills And Attributes Save Sucessfully.';
                                            
                    }else{
					 $this->session->set_flashdata('result', 1);
		             $this->session->set_flashdata('class', 'danger');
		             $this->session->set_flashdata('msg', "Error to Save");   	
					                 
                    }
                 $this->session->set_flashdata('item',$data);
                redirect('Staff_profile/Staffprofile/manage_work_profile/skill');
		
}

// staff skill work //

// staff skill work //
public function staffskillupdate()
{	
          $sklill_artisdsr = $this->input->post('sklills-description');		 
		  $licence = implode(',', $this->input->post('licence'));
		  if($_FILES['cv_ele']['name'])
		  {	
          $sid= $this->input->post("skid"); 
		  $this->Staffprofile_model->unsetImage1($sid,'staff_sklills_arti','cv_ele','public/upload/document/');
		  $cv_ele = $this->Staffprofile_model->savecv_ele("cv_ele","public/upload/document/");  	     
		  }
		  else{		 
		  $cv_ele=$this->input->post('cv_ele1');
          }
          $sid= $this->input->post("skid");
		  $where=array("id"=>$sid);
		  $datas=array("sklills_description"=>$sklill_artisdsr,"cv_ele"=>$cv_ele,"licence"=> $licence,"create_dt"=>date("Y-m-d H:i:s"),);
		  $updt= $this->Staffprofile_model->update("staff_sklills_arti",$datas,$where);  
		  //echo $this->db->last_query(); die;
                   if ($updt)
                    {
                        $data->error=0;
                        $data->success=1;
                        $data->message='Sklills And Attributes Update Sucessfully.';
                                            
                    }else{
					 $this->session->set_flashdata('result', 1);
		             $this->session->set_flashdata('class', 'danger');
		             $this->session->set_flashdata('msg', "Error to Save");   	
					                 
                    }
                 $this->session->set_flashdata('item',$data);
                redirect('Staff_profile/Staffprofile/manage_work_profile/skill');
		
}

// staff skill work //


// staff Employment History work //
public function staffemploymentcreate()
{	

         $title = serialize($this->input->post('jobtitle'));
		 $fromdate = serialize($this->input->post('fromdate')); 
		 $todate = serialize($this->input->post('todate')); 
		 $employment_description = serialize($this->input->post('employment-description')); 
		 $industry = serialize($this->input->post('industry')); 
         $sid=  $this->session->userdata('user_id');
		 // echo 'hello'; die;
		  $datas=array("jobtitle"=>$title,"em_industry"=>$industry,"fromdate"=>$fromdate,"todate"=> $todate,"employment_description"=> $employment_description,"staff_id"=>$sid,"create_dt"=>date("Y-m-d H:i:s"));
		  $updt= $this->Staffprofile_model->insert("staff_employment",$datas,$where);  
		  //echo $this->db->last_query(); die;
                   if ($updt)
                    {
                        $data->error=0;
                        $data->success=1;
                        $data->message='Employment History Save Sucessfully.';
                                            
                    }else{
					 $this->session->set_flashdata('result', 1);
		             $this->session->set_flashdata('class', 'danger');
		             $this->session->set_flashdata('msg', "Error to Save");   	
					                 
                    }
                 $this->session->set_flashdata('item',$data);
                redirect('Staff_profile/Staffprofile/manage_work_profile/emp');
		
}
// staff Employment History work //


// staff Employment History work update //
public function staffemploymentupdate()
{	
         $title = serialize($this->input->post('jobtitle'));
		 $fromdate = serialize($this->input->post('fromdate')); 
		 $todate = serialize($this->input->post('todate')); 
		 $employment_description = serialize($this->input->post('employment-description')); 
		 $industry = serialize($this->input->post('industry'));
          $sid= $this->input->post("ekid");
		  $where=array("id"=>$sid);
		  $datas=array("jobtitle"=>$title,"em_industry"=>$industry,"fromdate"=>$fromdate,"todate"=> $todate,"employment_description"=> $employment_description,"create_dt"=>date("Y-m-d H:i:s"));
		  $updt= $this->Staffprofile_model->update("staff_employment",$datas,$where);  
		  //echo $this->db->last_query(); die;
                   if ($updt)
                    {
                        $data->error=0;
                        $data->success=1;
                        $data->message='Employment History  Update Sucessfully.';
                                            
                    }else{
					 $this->session->set_flashdata('result', 1);
		             $this->session->set_flashdata('class', 'danger');
		             $this->session->set_flashdata('msg', "Error to Save");   	
					                 
                    }
                 $this->session->set_flashdata('item',$data);
                redirect('Staff_profile/Staffprofile/manage_work_profile/emp');
		
}

// staff staff Employment History work update //

//  staff detail work //
public function staff_detail($id){ 
        $data['staffdetail'] = $this->Staffprofile_model->getstaffdetail($id);    
        $this->load->view('front_common/header');
        $this->load->view('staff-detail',$data);
        $this->load->view('front_common/footer');
    }
// staff detail work //



// work detail //
 public function apply_jobs(){
	 
        $uid=  $this->session->userdata('user_id');	
		$data['jobs']=$this->Staffprofile_model->getapplyjob($uid);		
	    $this->load->view('front_common/header',$data);
		$this->load->view('apply_jobs',$data);
		$this->load->view('front_common/footer',$data);		 	  
      
        }
// work detail //

// staff message work //
 public function staff_message(){	 
        $id = $this->uri->segment(4); 
		$data['userdeatil']=$this->Staffprofile_model->getdata("users",$where=array("id"=>$id),$sort='');
		$data['user']=$this->Staffprofile_model->getuser();	
	    $this->load->view('front_common/header',$data);
		$this->load->view('messages',$data);
		$this->load->view('front_common/footer',$data);		 	  
      
        }
// staff message work  //

// sendmsg // 
public function sendmsg(){
	     $cdt=date("Y-m-d h:i:s");
	     $datas=array("create_dt"=>$cdt,"rid"=>$this->input->post("rid"),"message"=>$this->input->post("msg"),"sid"=>$this->session->userdata('user_id'));		 
 		 $id=$this->Staffprofile_model->insert("userschating",$datas);
		 if($id)
                {
		  echo "";	 		   
		 }
		 else{
			echo "";	 
		 }
}
// sendmsg // 

// getmessage // 
public function getmeassage()
{
        $sid=$this->input->post('rid');
		$data['msg']=$this->Staffprofile_model->getmsg($sid);	
		$errors = array_filter($data['msg']);

		if (!empty($errors)){
			echo $dt=$this->load->view("Ajaxmessage",$data,TRUE);
		}
		else{
			echo "";
		}
} 
// getmesage //

// getuserlist //
public function getmsglist()
{
	   $rid=$_POST['rid'];
	   $surid=$_POST['surid']; 
   	   $data['user']=$this->Staffprofile_model->getuser($rid,$surid);	
		$errors = array_filter($data['user']);

		if (!empty($errors)){
			echo $dt=$this->load->view("Ajaxmsglist",$data,TRUE);
		}
		else{
			echo "";
		}
	
}

public function interested_jobs()
{
$uid = $this->session->userdata('user_id');  
      $data['jobs']=$this->Staffprofile_model->getinterestedjob($uid);         
    
          $this->load->view('front_common/header');
          $this->load->view('interested_jobs',$data);
          $this->load->view('front_common/footer');
}
// manage_interesteduser userapplystatus //
// getuserlist //
// staff payment //
// pricing // 
 public function pricing(){
          $uid = $this->session->userdata('user_id');
		  $data['userd']=$this->Staffprofile_model->getdata("users",$where=array("id"=>$uid),$sort='id asc');
		  $code =  $data['userd'][0]->offer_id;
		 $data['pricingstaff']=$this->Staffprofile_model->getdata("pricing_staffplan",$where=array(""),$sort='id asc');
		 $data['coupon_code']=$this->Staffprofile_model->getdataoffercode($code);
		  
		  $data['price']=$this->Staffprofile_model->getdata("pricing_staff",$where="",$sort='id asc');
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

				$this->Staffprofile_model->insert("staffpayment",$datas);
                //echo $this->db->last_query(); 
				
				$where=array("id"=>$uid);
		        $datas=array("em_staff_status"=>1,"em_staff"=>$sid);
		        $updt= $this->Staffprofile_model->update("users",$datas,$where);
			
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
				
				 //print_r($message); die;
				 $subject="Payment confirmation - Seasonal Staff NZ Membership";
				$this->smtpemail($to,$subject,$msg);
				//mail($to, $subject, $message, $headers);
					
				$this->session->set_flashdata('result', 1);
				$this->session->set_flashdata('class', 'success');
				$this->session->set_flashdata('msg', "Success - Your payment has been approved");
				redirect("Welcome/thankyoupayment");
			}
// success // 	
// cancel // 
public function cancel()
			{
				$this->session->set_flashdata('result', 1);
				$this->session->set_flashdata('class', 'success');
				$this->session->set_flashdata('msg', "Staff Payment Successfully Cancelled");
				redirect("staff-membership");
			}
// cancel // 
public function successdiscount()
			{
				
				$uid  = $this->session->userdata('user_id');
				$sid =  "staff yearly membership"; // product ID
				$product_price = 0;
				
				$where=array("id"=>$uid);
		        $datas=array("em_staff_status"=>1,"em_staff"=>$sid);
		        $updt= $this->Staffprofile_model->update("users",$datas,$where);
			
				$this->db->select("email,first_name");
				$this->db->where("id",$uid);
				$q=$this->db->get("users")->result();
                
				$to=$q[0]->email;
				$name=$q[0]->first_name;
				
				$sid=$sid; 
				
                $ddate = $cdt=date("d M Y");
				$ddexp = date('d M Y', strtotime($ddate .'+1 years'));
						//date('Y-m-d', strtotime($ddate .'+1 years'));
              
				
                $headers = "From: " . 'info@seasonalstaff.co.nz' . "\r\n";
			    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";	
				$msg="Congratulation on becoming a member of Seasonal Staff NZ<br>
				Your membership payment has been received.<br>
				Date of registration - ".$cdt=date("d M Y")."<br>
				Amount Paid - ".$product_price." <br>
				Membership valid until - ".$ddexp." <br>
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
				$this->session->set_flashdata('msg', "Success - Your payment has been approved");
				redirect("Welcome/thankyoupayment");
			} 
			
			
// apply job delete //
         public function delete($id){
            
            $data=new stdClass();

                   /* $udata=array(
                        'delete'=>1                        
                    ); */

            if($this->Staffprofile_model->delete_record('user_applied_jobs',array("id"=>$id))){
			$this->session->set_flashdata('result', 1);
		    $this->session->set_flashdata('class', 'success');
		    $this->session->set_flashdata('msg', "Apply job Deleted Successfully!");		
            
            }else{
			$this->session->set_flashdata('result', 1);
		    $this->session->set_flashdata('class', 'danger');
		    $this->session->set_flashdata('msg', "Error to delete!");  	
          
            }
            $this->session->set_flashdata('item',$data);
           echo 1;
        }

// apply job delete //


// apply job delete //
         public function deletefavorites($id){
           // echo $id;
            $data=new stdClass();

                    $udata=array(
                        'deletefav'=>1                        
                    );
            $udata =  $this->Staffprofile_model->delete_record('job_like_staff',array("id"=>$id));
			if($udata){
			//if($this->Staffprofile_model->UpdateRecord('user_interested_jobs',$udata,array("id"=>$id))){
			$this->session->set_flashdata('result', 1);
		    $this->session->set_flashdata('class', 'success');
		    $this->session->set_flashdata('msg', "My Favorites job Deleted Successfully!");		
            
            }else{
			$this->session->set_flashdata('result', 1);
		    $this->session->set_flashdata('class', 'danger');
		    $this->session->set_flashdata('msg', "Error to delete!");  	
          
            }
            $this->session->set_flashdata('item',$data);
           echo 1;
        }

// apply job delete //

}