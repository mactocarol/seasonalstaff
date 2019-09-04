<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Package extends HT_Controller {

	 public function __construct(){            
            parent::__construct();
            $this->load->model('Package_model');   
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
           
            $data->packages = $this->Package_model->SelectRecord('package','*',array(""),'id desc');
            $udata = array("id"=>$this->session->userdata('user_id'));                
      
            $data->result = $this->Package_model->SelectSingleRecord('admin','*',$udata,$orderby=array());
            $data->title = 'Package';
            $data->field = 'Datatable';
            $data->page = 'package_lists';
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
                        'name'=>$this->input->post('name'),
                        'price'=>$this->input->post('price'),
                        "created_date"=>date('Y-m-d H:i:s'),
                        "status"=>0,
                        "modify_by"=>$this->session->userdata('user_id')

                    );

                $last_insertId = $this->Package_model->InsertRecord('package',$udata);
  
                             
               if($last_insertId){
                    $data->error=0;
                    $data->success=1;
                    $data->message="Package Added Successfully";
               }else{
                    $data->error=1;
                    $data->success=0;
                    $data->message="Network Error";
               }
               $this->session->set_flashdata('item',$data);
               redirect('add-Package');
            }
            $udata = array("id"=>$this->session->userdata('user_id'));                
            $data->result = $this->Package_model->SelectSingleRecord('admin','*',$udata,$orderby=array());

            $data->title = 'Package';
            $data->field = 'package';
            $data->page = 'package_lists';
            $this->load->view('admin/includes/header',$data);		
            $this->load->view('add',$data);
            $this->load->view('admin/includes/footer',$data);                                        
        }

         
      public function delete($id){
            $data=new stdClass();
            if($this->Package_model->delete_record('package',array("id"=>$id))){
                $data->error=0;
                $data->success=1;
                $data->message="Package Deleted Successfully";
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

                     
                        $package=array(
                        'name'=>$this->input->post('name'),
                        'price'=>$this->input->post('price'),
                        "updated_date"=>date('Y-m-d H:i:s'),
                        "status"=>0,
                        "modify_by"=>$this->session->userdata('user_id')

                    );

                  
                   if ($this->Package_model->UpdateRecord('package',$package, array("id"=>$id)))
                    {
                        $data->error=0;
                        $data->success=1;
                        $data->message='Package Update Sucessfully.';
                                            
                    }else{
                        $data->error=1;
                        $data->success=0;
                        $data->message='Network Error!';                    
                    }
                 $this->session->set_flashdata('item',$data);
                redirect('edit-Package/'.$id);
            }
            $udata = array("id"=>$this->session->userdata('user_id'));                
            $data->result = $this->Package_model->SelectSingleRecord('admin','*',$udata,$orderby=array());

           $data->reslt = $this->Package_model->SelectSingleRecord('package','*',array("id"=>$id),$orderby=array());

            $data->title = 'Edit Package';
            $data->field = 'Edit Package';
            $data->page = 'package_lists';
            $this->load->view('admin/includes/header',$data);       
            $this->load->view('edit',$data);
            $this->load->view('admin/includes/footer',$data);                                        
        }
        
   

}
