<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Jobrequest extends HT_Controller {

	 public function __construct(){            
            parent::__construct();
            $this->load->model('Jobrequest_model');   
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
           
            // $data->records = $this->Jobrequest_model->SelectRecord('offers','*',array(""),'id desc');

            $data->records = $this->Jobrequest_model->getRecievedJobRequest();
            $udata = array("id"=>$this->session->userdata('user_id'));                
            $data->result = $this->Jobrequest_model->SelectSingleRecord('admin','*',$udata,$orderby=array());
           $data->title = 'Job Application List';
            $data->field = 'Datatable';
            $data->page = 'job_request_application';
            $this->load->view('admin/includes/header',$data);		
            $this->load->view('view',$data);
            $this->load->view('admin/includes/footer',$data);		
        }


      
      public function delete($id){
            $data=new stdClass();
            if($this->Jobrequest_model->delete_record('user_applied_jobs',array("id"=>$id))){
                $data->error=0;
                $data->success=1;
                $data->message="Application Deleted Successfully";
            }else{
                $data->error=1;
                $data->success=0;
                $data->message="Network Error";
            }
            $this->session->set_flashdata('item',$data);
            redirect('job-request-application');
        }
        

        

         
   

}
