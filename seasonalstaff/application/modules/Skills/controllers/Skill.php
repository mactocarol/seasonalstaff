<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Skill extends HT_Controller {

	 public function __construct(){            
            parent::__construct();
            $this->load->model('Skill_model');   
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
           
            $data->skills = $this->Skill_model->SelectRecord('skill','*',array(""),'id desc');
            $udata = array("id"=>$this->session->userdata('user_id'));                
      
            $data->result = $this->Skill_model->SelectSingleRecord('admin','*',$udata,$orderby=array());
            $data->title = 'skill';
            $data->field = 'Datatable';
            $data->page = 'skill_lists';
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


            $this->form_validation->set_rules('skills', 'skills', 'required');

            if ($this->form_validation->run() == FALSE)
                {
                            $data->error=1;
                            $data->success=0;
                            $data->message="Skills are required. It cann't be empty.";
                }else{

                    //   $implode = '';
                    // if(!empty($this->input->post('skills'))){
                    //     $implode = implode(' ',$this->input->post('skills'));

                    // }

                                $udata=array(
                                'skills'=>$this->input->post('skills'),
                                "created_date"=>date('Y-m-d H:i:s'),
                                "status"=>0,
                                "modify_by"=>$this->session->userdata('user_id')

                            );

                        $last_insertId = $this->Skill_model->InsertRecord('skill',$udata);
          
                                     
                       if($last_insertId){
                            $data->error=0;
                            $data->success=1;
                            $data->message="skill Added Successfully";
                       }else{
                            $data->error=1;
                            $data->success=0;
                            $data->message="Network Error";
                       }

                }

             

                  
                 
                       $this->session->set_flashdata('item',$data);
                       redirect('add-Skill');
              
            }
            $udata = array("id"=>$this->session->userdata('user_id'));                
            $data->result = $this->Skill_model->SelectSingleRecord('admin','*',$udata,$orderby=array());

            $data->title = 'skill';
            $data->field = 'skill';
            $data->page = 'skill_lists';
            $this->load->view('admin/includes/header',$data);		
            $this->load->view('add',$data);
            $this->load->view('admin/includes/footer',$data);                                        
        }

         
      public function delete($id){
            $data=new stdClass();
            if($this->Skill_model->delete_record('skill',array("id"=>$id))){
                $data->error=0;
                $data->success=1;
                $data->message="skill Deleted Successfully";
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

               $this->form_validation->set_rules('skills[]', 'skills', 'required');

            if ($this->form_validation->run() == FALSE)
                {
                            $data->error=1;
                            $data->success=0;
                            $data->message="Skills are required. It cann't be empty.";
                }else{

                       // $implode = '';
                       //  if(!empty($this->input->post('skills'))){
                       //      $implode = implode(' ',$this->input->post('skills'));

                       //  }

                       $skills=array(
                                'skills'=>$this->input->post('skills'),
                                "updated_date"=>date('Y-m-d H:i:s'),
                                "status"=>0,
                                "modify_by"=>$this->session->userdata('user_id')

                            );
                  
                   if ($this->Skill_model->UpdateRecord('skill',$skills, array("id"=>$id)))
                    {
                        $data->error=0;
                        $data->success=1;
                        $data->message='skill Update Sucessfully.';
                                            
                    }else{
                        $data->error=1;
                        $data->success=0;
                        $data->message='Network Error!';                    
                    }
                }
                 $this->session->set_flashdata('item',$data);
                redirect('edit-Skill/'.$id);
            }
            $udata = array("id"=>$this->session->userdata('user_id'));                
            $data->result = $this->Skill_model->SelectSingleRecord('admin','*',$udata,$orderby=array());

           $data->reslt = $this->Skill_model->SelectSingleRecord('skill','*',array("id"=>$id),$orderby=array());

            $data->title = 'Edit skill';
            $data->field = 'Edit skill';
            $data->page = 'skill_lists';
            $this->load->view('admin/includes/header',$data);       
            $this->load->view('edit',$data);
            $this->load->view('admin/includes/footer',$data);                                        
        }
        
   

}
