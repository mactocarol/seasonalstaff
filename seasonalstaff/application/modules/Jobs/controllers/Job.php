<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Job extends HT_Controller {

	 public function __construct(){            
            parent::__construct();
            $this->load->model('Job_model');   
             if(!$this->session->userdata('logged_in')){
                redirect('Admin');
            }        
        }

     public function index(){
           
            
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
           
            // $data->records = $this->Job_model->SelectRecord('jobs','*',array(""),'id desc');
            $getUserId='';
            if(!empty($this->input->get('id'))){
               $getUserId = $this->input->get('id');
            }

         
            $data->records = $this->Job_model->getJobs(base64_decode($getUserId));
            $udata = array("id"=>$this->session->userdata('user_id'));                
            $data->result = $this->Job_model->SelectSingleRecord('admin','*',$udata,$orderby=array());
             $data->job_category = $this->Job_model->SelectRecord('job_category','*',array(""),'category_name asc');
             $data->users = $this->Job_model->SelectRecord('users','*',array(""),'username asc');
            $data->title = 'Jobs';
            $data->field = 'Datatable';
            $data->page = 'jobs_list';
            $this->load->view('admin/includes/header',$data);		
            $this->load->view('view',$data);
            $this->load->view('admin/includes/footer',$data);		
        }

        public function add(){ 

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


            $skill=$this->input->post('skills');
            $implode_skill='';
            if(!empty($skill)){
              $implode_skill = implode(',',$skill);
            }

                      $udata=array(
                                    'job_title'=>$this->input->post('jobname'),
                                    'job_category_id'=>$this->input->post('job_cat_id'),
                                    'designation'=>$this->input->post('designation'),
                                    'skill'=>$implode_skill,
                                    'number_of_post'=>$this->input->post('no_of_jobs'),
                                    'salary'=>$this->input->post('Salary'),
                                    'map_address'=>$this->input->post('mapaddress'),
                                    'latitude'=>$this->input->post('latitude'),
                                    'longitude'=>$this->input->post('longitude'),
                                    'from_date'=>date('Y-m-d',strtotime($this->input->post('jobdate'))),
                                   'to_date'=>date('Y-m-d',strtotime($this->input->post('jobTillDate'))),
                                   'job_description'=>$this->input->post('description'),
                                   "created_date"=>date('Y-m-d H:i:s'),
                                    "status"=>0,
                                    "modify_by"=>$this->session->userdata('user_id'),
                                    "employerId"=>$this->input->post('employee'),
                                    "jobId"=>$this->input->post('jobIDUnique')

                                );

                            $last_insertId = $this->Job_model->InsertRecord('jobs',$udata);
              
                                         
                           if($last_insertId){
                                $data->error=0;
                                $data->success=1;
                                $data->message="Job Added Successfully";
                           }else{
                                $data->error=1;
                                $data->success=0;
                                $data->message="Network Error";
                           }

                      
                  

               $this->session->set_flashdata('item',$data);
               redirect('job-list');
                      
            }
            $udata = array("id"=>$this->session->userdata('user_id'));                
            $data->result = $this->Job_model->SelectSingleRecord('admin','*',$udata,$orderby=array());
            $data->job_category = $this->Job_model->SelectRecord('job_category','*',array(""),'category_name asc');
            $data->skills = $this->Job_model->SelectRecord('skill','*',array(""),'skills asc');
            $data->users = $this->Job_model->SelectRecord('users','*',array(""),'username asc');
           $data->title = 'Add Job';
            $data->field = 'Add Job';
            $data->page = 'jobs_list';
            $this->load->view('admin/includes/header',$data);		
            $this->load->view('add',$data);
            $this->load->view('admin/includes/footer',$data);                                        
        }

      
      // public function delete($id){
      //       $data=new stdClass();
      //       if($this->Job_model->delete_record('jobs',array("id"=>$id))){
      //           $data->error=0;
      //           $data->success=1;
      //           $data->message="Job Deleted Successfully";
      //       }else{
      //           $data->error=1;
      //           $data->success=0;
      //           $data->message="Network Error";
      //       }
      //       $this->session->set_flashdata('item',$data);
      //       redirect('job-list');
      //   }
        

        

         public function edit($id){

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
                       
                        $skill=$this->input->post('skills');
            $implode_skill='';
            if(!empty($skill)){
              $implode_skill = implode(',',$skill);
            }

                       $udata=array(
                                    'job_title'=>$this->input->post('jobname'),
                                    'job_category_id'=>$this->input->post('job_cat_id'),
                                    'designation'=>$this->input->post('designation'),
                                    'skill'=>$implode_skill,
                                    'number_of_post'=>$this->input->post('no_of_jobs'),
                                    'salary'=>$this->input->post('Salary'),
                                    'map_address'=>$this->input->post('mapaddress'),
                                    'latitude'=>$this->input->post('latitude'),
                                    'longitude'=>$this->input->post('longitude'),
                                    'from_date'=>date('Y-m-d',strtotime($this->input->post('jobdate'))),
                                   'to_date'=>date('Y-m-d',strtotime($this->input->post('jobTillDate'))),
                                   'job_description'=>$this->input->post('description'),
                                   "updated_date"=>date('Y-m-d H:i:s'),
                                    "status"=>0,
                                    "modify_by"=>$this->session->userdata('user_id'),
                                     "employerId"=>$this->input->post('employee'),
                                    "jobId"=>$this->input->post('jobIDUnique')

                                );
                                  
                      if ($this->Job_model->UpdateRecord('jobs',$udata, array("id"=>$id)))
                            {
                                $data->error=0;
                                $data->success=1;
                                $data->message='Job Update Sucessfully.';
                                                    
                            }else{
                                $data->error=1;
                                $data->success=0;
                                $data->message='Network Error!';                    
                            }

                  
                   
                 $this->session->set_flashdata('item',$data);
                redirect('edit-job/'.$id);
            }
            $udata = array("id"=>$this->session->userdata('user_id'));                
            $data->result = $this->Job_model->SelectSingleRecord('admin','*',$udata,$orderby=array());

           $data->reslt = $this->Job_model->SelectSingleRecord('jobs','*',array("id"=>$id),$orderby=array());
           $data->job_category = $this->Job_model->SelectRecord('job_category','*',array(""),'category_name asc');
           $data->users = $this->Job_model->SelectRecord('users','*',array(""),'username asc');
            $data->skills = $this->Job_model->SelectRecord('skill','*',array(""),'skills asc');

            $data->title = 'Edit Job';
            $data->field = 'Edit Job';
            $data->page = 'jobs_list';
            $this->load->view('admin/includes/header',$data);       
            $this->load->view('edit',$data);
            $this->load->view('admin/includes/footer',$data);                                        
        }
        
            function check_JobId_exists($id='')
        {     
    
            if (array_key_exists('jobIDUnique',$_POST)) 
            {
                if ( $this->Job_model->jobId_exists($this->input->post('jobIDUnique'),$id) == TRUE ) 
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
               
                if ($this->Job_model->UpdateRecord('jobs',$udata,array("id"=>$userid)))
                {
                    $data->error=0;
                    $data->success=1;
                    $data->message='Job Approved Sucessfully.';
                                        
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
                        'status'=>2                    
                    );
               
                if ($this->Job_model->UpdateRecord('jobs',$udata,array("id"=>$userid)))
                {
                    $data->error=0;
                    $data->success=1;
                    $data->message='Job Disaprove Sucessfully.';
                                        
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

                   /* $udata=array(
                        'delete'=>1                        
                    );*/

            if($this->Job_model->delete_record('jobs',array("id"=>$id))){
                $data->error=0;
                $data->success=1;
                $data->message="Job Deleted Successfully";
            }else{
                $data->error=1;
                $data->success=0;
                $data->message="Network Error";
            }
            $this->session->set_flashdata('item',$data);
           echo 1;
        }
		
// neha work map address //
 public function mapaddressstatus($userid){
          
            $data=new stdClass();
            if($userid){
               
                    $udata=array(
                        'mapaddstatus'=>1                        
                    );
               
                if ($this->Job_model->UpdateRecord('jobs',$udata,array("id"=>$userid)))
                {
                    $data->error=0;
                    $data->success=1;
                    $data->message='Change Sucessfully.';
                                        
                }else{
                    $data->error=1;
                    $data->success=0;
                    $data->message='Network Error!';                    
                }
            $this->session->set_flashdata('item',$data);
           echo 1;
            }
                                
  }
 public function mapaddressstatusnot($userid){
          
            $data=new stdClass();
            if($userid){
               
                    $udata=array(
                        'mapaddstatus'=>0                        
                    );
               
                if ($this->Job_model->UpdateRecord('jobs',$udata,array("id"=>$userid)))
                {
                    $data->error=0;
                    $data->success=1;
                    $data->message='Change Sucessfully.';
                                        
                }else{
                    $data->error=1;
                    $data->success=0;
                    $data->message='Network Error!';                    
                }
            $this->session->set_flashdata('item',$data);
           echo 1;
            }
                                
  }  
  
// neha work map address //				
   

}
