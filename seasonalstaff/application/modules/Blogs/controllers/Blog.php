<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Blog extends HT_Controller {

	 public function __construct(){            
            parent::__construct();
            $this->load->model('Blog_model');   
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
           
            $data->records = $this->Blog_model->SelectRecord('blog','*',array(""),'id desc');
            $udata = array("id"=>$this->session->userdata('userid'));                
            $data->result = $this->Blog_model->SelectSingleRecord('admin','*',$udata,$orderby=array());
            $data->title = 'Blogs';
            $data->field = 'Datatable';
            $data->page = 'list_Blog';
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

            $img='';

                    if($_FILES['image']['name']){

                         $new_image_name = time() . str_replace(str_split(' ()\\/,:*?"<>|'), '', $_FILES['image']['name']);

                            $image_path = realpath(APPPATH . '../public/upload/blogImage');
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
                        $img = "";
                    }



                        $udata=array(
                        'title'=>$this->input->post('blog_title'),
                        'description'=>$this->input->post('editor1'),
						'category'=>$this->input->post('category'),
                        'image'=>$img,
                        "created_date"=>date('Y-m-d H:i:s'),
                        "status"=>0,
                        "modify_by"=>$this->session->userdata('userid')

                    );
                  
                $last_insertId = $this->Blog_model->InsertRecord('blog',$udata);
  
                             
               if($last_insertId){
                    $data->error=0;
                    $data->success=1;
                    $data->message="Blog Added Successfully";
               }else{
                    $data->error=1;
                    $data->success=0;
                    $data->message="Network Error";
               }
               $this->session->set_flashdata('item',$data);
               redirect('Blog-list');
            }
            $udata = array("id"=>$this->session->userdata('userid'));                
            $data->result = $this->Blog_model->SelectSingleRecord('admin','*',$udata,$orderby=array());           
            $data->category = $this->Blog_model->SelectRecord('blog_category','*',array(""),'id desc');
		   //echo $this->db->last_query(); die;			
            $data->title = 'Add Blog';
            $data->field = 'Add Blog';
            $data->page = 'list_Blog';
            $this->load->view('admin/includes/header',$data);		
            $this->load->view('add',$data);
            $this->load->view('admin/includes/footer',$data);                                        
        }

      
      public function delete($id){
            $data=new stdClass();
            if($this->Blog_model->delete_record('blog',array("id"=>$id))){
                $data->error=0;
                $data->success=1;
                $data->message="Blog Deleted Successfully";
            }else{
                $data->error=1;
                $data->success=0;
                $data->message="Network Error";
            }
            $this->session->set_flashdata('item',$data);
            redirect('Blog-list');
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

                    $img='';

                    if($_FILES['image']['name']){

                         $new_image_name = time() . str_replace(str_split(' ()\\/,:*?"<>|'), '', $_FILES['image']['name']);

                            $image_path = realpath(APPPATH . '../public/upload/blogImage');
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
                      
                        $udata=array(
                        'title'=>$this->input->post('blog_title'),
                        'description'=>$this->input->post('editor1'),
						'category'=>$this->input->post('category'),
                        'image'=>$img,
                        "created_date"=>date('Y-m-d H:i:s'),
                        "status"=>0,
                        "modify_by"=>$this->session->userdata('userid')

                    );
                   
                  
                   if ($this->Blog_model->UpdateRecord('blog',$udata, array("id"=>$id)))
                    {
                        $data->error=0;
                        $data->success=1;
                        $data->message='Blog Update Sucessfully.';
                                            
                    }else{
                        $data->error=1;
                        $data->success=0;
                        $data->message='Network Error!';                    
                    }
                 $this->session->set_flashdata('item',$data);
                redirect('edit-Blog/'.$id);
            }
            $udata = array("id"=>$this->session->userdata('userid'));                
            $data->result = $this->Blog_model->SelectSingleRecord('admin','*',$udata,$orderby=array());
            $data->reslt = $this->Blog_model->SelectSingleRecord('blog','*',array("id"=>$id),$orderby=array());
		    $data->category = $this->Blog_model->SelectRecord('blog_category','*',array(""),'id desc');
            $data->title = 'Edit Blog';
            $data->field = 'Edit Blog';
            $data->page = 'list_Blog';
            $this->load->view('admin/includes/header',$data);       
            $this->load->view('edit',$data);
            $this->load->view('admin/includes/footer',$data);                                        
        }
		
	// work for blog category //
	public function blogcategory(){
		//echo 'hello'; die;
		    $udata = array("id"=>$this->session->userdata('userid'));   
	        $data->result = $this->Blog_model->SelectSingleRecord('admin','*',$udata,$orderby=array());
            $data->title = 'Blog Category';
            $data->field = 'Datatable';
            $data->page = 'blogcategory';
            $this->load->view('admin/includes/header',$data);		
            $this->load->view('blog_category',$data);
            $this->load->view('admin/includes/footer',$data);			
	}
	
	// work for blog category //
        
   

}
