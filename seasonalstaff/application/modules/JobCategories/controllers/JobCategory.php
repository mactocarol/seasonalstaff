<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class JobCategory extends HT_Controller {

	 public function __construct(){            
            parent::__construct();
            $this->load->model('JobCategory_model');   
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
           
            $data->jobsdata = $this->JobCategory_model->SelectRecord('job_category','*',array(""),'category_name desc');
            $udata = array("id"=>$this->session->userdata('user_id'));                
           
            $data->result = $this->JobCategory_model->SelectSingleRecord('admin','*',$udata,$orderby=array());
            $data->title = 'Job Category';
            $data->field = 'Datatable';
            $data->page = 'JobCategory_list';
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

                        $udata=array(
                        'category_name'=>$this->input->post('role'),
                        "created_date"=>date('Y-m-d H:i:s'),
                        "status"=>0,
                        "modify_by"=>$this->session->userdata('user_id')

                    );

                $last_insertId = $this->JobCategory_model->InsertRecord('job_category',$udata);
  
                             
               if($last_insertId){
                    $data->error=0;
                    $data->success=1;
                    $data->message="Job Category Added Successfully";
               }else{
                    $data->error=1;
                    $data->success=0;
                    $data->message="Network Error";
               }
               $this->session->set_flashdata('item',$data);
               redirect('job-Category');
            }
            $udata = array("id"=>$this->session->userdata('user_id'));                
            $data->result = $this->JobCategory_model->SelectSingleRecord('admin','*',$udata,$orderby=array());

            $data->title = 'Job Category';
            $data->field = 'Job Category';
            $data->page = 'JobCategory_list';
            $this->load->view('admin/includes/header',$data);		
            $this->load->view('add',$data);
            $this->load->view('admin/includes/footer',$data);                                        
        }

         
      public function delete($id){
            $data=new stdClass();
            if($this->JobCategory_model->delete_record('job_category',array("id"=>$id))){
                $data->error=0;
                $data->success=1;
                $data->message="Job Category Deleted Successfully";
            }else{
                $data->error=1;
                $data->success=0;
                $data->message="Network Error";
            }
            $this->session->set_flashdata('item',$data);
            redirect('job-Category');
        }
        

        

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

                         $roledata=array(
                        'category_name'=>$this->input->post('role'),
                        "updated_date"=>date('Y-m-d H:i:s'),
                        "status"=>0,
                        "modify_by"=>$this->session->userdata('user_id')

                    );

                  
                   if ($this->JobCategory_model->UpdateRecord('job_category',$roledata, array("id"=>$id)))
                    {
                        $data->error=0;
                        $data->success=1;
                        $data->message='Job Category Update Sucessfully.';
                                            
                    }else{
                        $data->error=1;
                        $data->success=0;
                        $data->message='Network Error!';                    
                    }
                 $this->session->set_flashdata('item',$data);
                redirect('edit-job-Category/'.$id);
            }
            $udata = array("id"=>$this->session->userdata('user_id'));                
            $data->result = $this->JobCategory_model->SelectSingleRecord('admin','*',$udata,$orderby=array());

           $data->reslt = $this->JobCategory_model->SelectSingleRecord('job_category','*',array("id"=>$id),$orderby=array());
            $data->title = 'Edit Job Category';
            $data->field = 'Edit Job Category';
            $data->page = 'JobCategory_list';
            $this->load->view('admin/includes/header',$data);       
            $this->load->view('edit',$data);
            $this->load->view('admin/includes/footer',$data);                                        
        }
        
   

}
