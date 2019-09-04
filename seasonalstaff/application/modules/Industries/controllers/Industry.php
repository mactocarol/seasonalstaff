<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Industry extends HT_Controller {

	 public function __construct(){            
            parent::__construct();
            $this->load->model('Industry_model');   
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
           
            $data->industrys = $this->Industry_model->SelectRecord('industry','*',array(""),'id desc');
            $udata = array("id"=>$this->session->userdata('user_id'));                
      
            $data->result = $this->Industry_model->SelectSingleRecord('admin','*',$udata,$orderby=array());
            $data->title = 'industry';
            $data->field = 'Datatable';
            $data->page = 'industry_lists';
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
                        'name'=>$this->input->post('industry'),
                        "created_date"=>date('Y-m-d H:i:s'),
                        "status"=>0,
                        "modify_by"=>$this->session->userdata('user_id')

                    );

                $last_insertId = $this->Industry_model->InsertRecord('industry',$udata);
  
                             
               if($last_insertId){
                    $data->error=0;
                    $data->success=1;
                    $data->message="Industry Added Successfully";
               }else{
                    $data->error=1;
                    $data->success=0;
                    $data->message="Network Error";
               }
               $this->session->set_flashdata('item',$data);
               redirect('add-Industry');
            }
            $udata = array("id"=>$this->session->userdata('user_id'));                
            $data->result = $this->Industry_model->SelectSingleRecord('admin','*',$udata,$orderby=array());

            $data->title = 'industry';
            $data->field = 'industry';
            $data->page = 'Industrys_lists';
            $this->load->view('admin/includes/header',$data);		
            $this->load->view('add',$data);
            $this->load->view('admin/includes/footer',$data);                                        
        }

         
      public function delete($id){
            $data=new stdClass();
            if($this->Industry_model->delete_record('industry',array("id"=>$id))){
                $data->error=0;
                $data->success=1;
                $data->message="Industry Deleted Successfully";
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

                       $implode = '';
                        if(!empty($this->input->post('industrys'))){
                            $implode = implode(' ',$this->input->post('industrys'));

                        }

                       $udata=array(
                        'name'=>$this->input->post('industry'),
                        "updated_date"=>date('Y-m-d H:i:s'),
                        "status"=>0,
                        "modify_by"=>$this->session->userdata('user_id')

                    );
                  
                   if ($this->Industry_model->UpdateRecord('industry',$udata, array("id"=>$id)))
                    {
                        $data->error=0;
                        $data->success=1;
                        $data->message='Industry Update Sucessfully.';
                                            
                    }else{
                        $data->error=1;
                        $data->success=0;
                        $data->message='Network Error!';                    
                    }
                 $this->session->set_flashdata('item',$data);
                redirect('edit-Industry/'.$id);
            }
            $udata = array("id"=>$this->session->userdata('user_id'));                
            $data->result = $this->Industry_model->SelectSingleRecord('admin','*',$udata,$orderby=array());

           $data->reslt = $this->Industry_model->SelectSingleRecord('industry','*',array("id"=>$id),$orderby=array());

            $data->title = 'Edit industry';
            $data->field = 'Edit industry';
            $data->page = 'industry_lists';
            $this->load->view('admin/includes/header',$data);       
            $this->load->view('edit',$data);
            $this->load->view('admin/includes/footer',$data);                                        
        }
        
   

}
