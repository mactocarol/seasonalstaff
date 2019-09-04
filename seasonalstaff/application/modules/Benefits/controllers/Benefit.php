<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Benefit extends HT_Controller {

	 public function __construct(){            
            parent::__construct();
            $this->load->model('Benefit_model');   
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
           
            $data->benefits = $this->Benefit_model->SelectRecord('benefit','*',array(""),'id desc');
            $udata = array("id"=>$this->session->userdata('user_id'));                
      
            $data->result = $this->Benefit_model->SelectSingleRecord('admin','*',$udata,$orderby=array());
            $data->title = 'Benefit';
            $data->field = 'Datatable';
            $data->page = 'benefit_lists';
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

         
                        $udata = array(
                        'name'=>$this->input->post('name'),
                        "created_date"=>date('Y-m-d H:i:s'),
                        "status"=>0,
                        "modify_by"=>$this->session->userdata('user_id')

                    );

                $last_insertId = $this->Benefit_model->InsertRecord('benefit',$udata);
  
                             
               if($last_insertId){
                    $data->error=0;
                    $data->success=1;
                    $data->message="Benefit Added Successfully";
               }else{
                    $data->error=1;
                    $data->success=0;
                    $data->message="Network Error";
               }
               $this->session->set_flashdata('item',$data);
               redirect('add-Benefit');
            }
            $udata = array("id"=>$this->session->userdata('user_id'));                
            $data->result = $this->Benefit_model->SelectSingleRecord('admin','*',$udata,$orderby=array());

            $data->title = 'benefit';
            $data->field = 'benefit';
            $data->page = 'benefit_lists';
            $this->load->view('admin/includes/header',$data);		
            $this->load->view('add',$data);
            $this->load->view('admin/includes/footer',$data);                                        
        }

         
      public function delete($id){
            $data=new stdClass();
            if($this->Benefit_model->delete_record('benefit',array("id"=>$id))){
                $data->error=0;
                $data->success=1;
                $data->message="benefit Deleted Successfully";
            }else{
                $data->error=1;
                $data->success=0;
                $data->message="Network Error";
            }
            $this->session->set_flashdata('item',$data);
            // redirect('job-Category');
            echo 1;
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

                        $udata = array(
                        'name'=>$this->input->post('name'),
                        "updated_date"=>date('Y-m-d H:i:s'),
                        "status"=>0,
                        "modify_by"=>$this->session->userdata('user_id')

                    );

                  
                   if ($this->Benefit_model->UpdateRecord('benefit',$udata, array("id"=>$id)))
                    {
                        $data->error=0;
                        $data->success=1;
                        $data->message='Benefit Update Sucessfully.';
                                            
                    }else{
                        $data->error=1;
                        $data->success=0;
                        $data->message='Network Error!';                    
                    }
                 $this->session->set_flashdata('item',$data);
                redirect('edit-Benefit/'.$id);
            }
            $udata = array("id"=>$this->session->userdata('user_id'));                
            $data->result = $this->Benefit_model->SelectSingleRecord('admin','*',$udata,$orderby=array());

           $data->reslt = $this->Benefit_model->SelectSingleRecord('benefit','*',array("id"=>$id),$orderby=array());

            $data->title = 'Edit benefit';
            $data->field = 'Edit benefit';
            $data->page = 'benefit_lists';
            $this->load->view('admin/includes/header',$data);       
            $this->load->view('edit',$data);
            $this->load->view('admin/includes/footer',$data);                                        
        }
        
   

}
