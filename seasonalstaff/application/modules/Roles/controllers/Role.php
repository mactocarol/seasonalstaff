<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Role extends HT_Controller {

	 public function __construct(){            
            parent::__construct();
            $this->load->model('Role_model');   
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
           
            $data->roles_data = $this->Role_model->SelectRecord('role','*',array(""),'id desc');
            $udata = array("id"=>$this->session->userdata('user_id'));                
           
            $data->result = $this->Role_model->SelectSingleRecord('admin','*',$udata,$orderby=array());
            $data->title = 'Roles';
            $data->field = 'Datatable';
            $data->page = 'list_roles';
            $this->load->view('admin/includes/header',$data);		
            $this->load->view('view',$data);
            $this->load->view('admin/includes/footer',$data);
            }
            else {
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

                        $udata=array(
                        'role'=>$this->input->post('role'),
                        "created_date"=>date('Y-m-d H:i:s'),
                        "status"=>0,
                        "modify_by"=>$this->session->userdata('user_id')

                    );

                $last_insertId = $this->Role_model->InsertRecord('role',$udata);
  
                             
               if($last_insertId){
                    $data->error=0;
                    $data->success=1;
                    $data->message="User Role Added Successfully";
               }else{
                    $data->error=1;
                    $data->success=0;
                    $data->message="Network Error";
               }
               $this->session->set_flashdata('item',$data);
               redirect('role-list');
            }
            $udata = array("id"=>$this->session->userdata('user_id'));                
            $data->result = $this->Role_model->SelectSingleRecord('admin','*',$udata,$orderby=array());

            $data->title = 'Add User Role';
            $data->field = 'Add User Role';
            $data->page = 'list_roles';
            $this->load->view('admin/includes/header',$data);		
            $this->load->view('add',$data);
            $this->load->view('admin/includes/footer',$data);
		   }
          else {
			redirect('Admin');  
		  }		   
        }

         
      public function delete($id){
            $data=new stdClass();
            if($this->Role_model->delete_record('role',array("id"=>$id))){
                $data->error=0;
                $data->success=1;
                $data->message="User Role Deleted Successfully";
            }else{
                $data->error=1;
                $data->success=0;
                $data->message="Network Error";
            }
            $this->session->set_flashdata('item',$data);
            redirect('role-list');
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
           if(!empty($this->input->post())){

                         $roledata=array(
                        'role'=>$this->input->post('role'),
                        "updated_date"=>date('Y-m-d H:i:s'),
                        "status"=>0,
                        "modify_by"=>$this->session->userdata('user_id')

                    );

                  
                   if ($this->Role_model->UpdateRecord('role',$roledata, array("id"=>$id)))
                    {
                        $data->error=0;
                        $data->success=1;
                        $data->message='User Role Update Sucessfully.';
                                            
                    }else{
                        $data->error=1;
                        $data->success=0;
                        $data->message='Network Error!';                    
                    }
                 $this->session->set_flashdata('item',$data);
                redirect('edit-role/'.$id);
            }
            $udata = array("id"=>$this->session->userdata('user_id'));                
            $data->result = $this->Role_model->SelectSingleRecord('admin','*',$udata,$orderby=array());

          $data->reslt = $this->Role_model->SelectSingleRecord('role','*',array("id"=>$id),$orderby=array());
            $data->title = 'Edit User Role';
            $data->field = 'Edit User Role';
            $data->page = 'list_roles';
            $this->load->view('admin/includes/header',$data);       
            $this->load->view('edit',$data);
            $this->load->view('admin/includes/footer',$data);
		  } 
         else {
		 redirect('Admin');	 
		 }		  
        }
        
   

}
