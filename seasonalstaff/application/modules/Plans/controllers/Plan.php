<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Plan extends HT_Controller {

	 public function __construct(){            
            parent::__construct();
            $this->load->model('Plan_model');   
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
           
            $data->records = $this->Plan_model->SelectRecord('pricing_staff','*',array(""),'id desc');
            $udata = array("id"=>$this->session->userdata('userid'));                
            $data->result = $this->Plan_model->SelectSingleRecord('admin','*',$udata,$orderby=array());
            $data->title = 'Plans';
            $data->field = 'Datatable';
            $data->page = 'list_plan';
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
                        'staff'=>$this->input->post('plan'),
                        'price'=>$this->input->post('amount'),
						'descriptionfw'=>$this->input->post('descriptionfw'),
						'descriptionfem'=>$this->input->post('descriptionfem'),
						'descriptionfws'=>$this->input->post('descriptionfws'),
						'descriptionmfav'=>$this->input->post('descriptionmfav'),
                        'descriptiontrack'=>$this->input->post('descriptiontrack'),
                        'descriptionprofile'=>$this->input->post('descriptionprofile'),
                        'descriptionprocess'=>$this->input->post('descriptionprocess'),
						'descriptionfeature'=>$this->input->post('descriptionfeature'),						
                        "created_at"=>date('Y-m-d H:i:s')                  

                    );

                $last_insertId = $this->Plan_model->InsertRecord('pricing_staff',$udata);
  
                             
               if($last_insertId){
                    $data->error=0;
                    $data->success=1;
                    $data->message="Plan Added Successfully";
               }else{
                    $data->error=1;
                    $data->success=0;
                    $data->message="Network Error";
               }
               $this->session->set_flashdata('item',$data);
               redirect('plan-list');
            }
            $udata = array("id"=>$this->session->userdata('userid'));                
            $data->result = $this->Plan_model->SelectSingleRecord('admin','*',$udata,$orderby=array());

            $data->title = 'Add Plan';
            $data->field = 'Add Plan';
            $data->page = 'list_plan';
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
            if($this->Plan_model->delete_record('pricing_staff',array("id"=>$id))){
                $data->error=0;
                $data->success=1;
                $data->message="Plan Deleted Successfully";
            }else{
                $data->error=1;
                $data->success=0;
                $data->message="Network Error";
            }
            $this->session->set_flashdata('item',$data);
            redirect('plan-list');
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

                         $plandata=array(
                        'staff'=>$this->input->post('plan'),
                        'price'=>$this->input->post('amount'),
						'descriptionfw'=>$this->input->post('descriptionfw'),
						'descriptionfem'=>$this->input->post('descriptionfem'),
						'descriptionfws'=>$this->input->post('descriptionfws'),
						'descriptionmfav'=>$this->input->post('descriptionmfav'),
                        'descriptiontrack'=>$this->input->post('descriptiontrack'),
                        'descriptionprofile'=>$this->input->post('descriptionprofile'),
                        'descriptionprocess'=>$this->input->post('descriptionprocess'),
						'descriptionfeature'=>$this->input->post('descriptionfeature'),	
                        "created_at"=>date('Y-m-d H:i:s')                      
                    );

                  
                   if ($this->Plan_model->UpdateRecord('pricing_staff',$plandata, array("id"=>$id)))
                    {
                        $data->error=0;
                        $data->success=1;
                        $data->message='Plan Update Sucessfully.';
                                            
                    }else{
                        $data->error=1;
                        $data->success=0;
                        $data->message='Network Error!';                    
                    }
                 $this->session->set_flashdata('item',$data);
                redirect('edit-plan/'.$id);
            }
            $udata = array("id"=>$this->session->userdata('userid'));                
            $data->result = $this->Plan_model->SelectSingleRecord('admin','*',$udata,$orderby=array());

          $data->reslt = $this->Plan_model->SelectSingleRecord('pricing_staff','*',array("id"=>$id),$orderby=array());
            $data->title = 'Edit Plan';
            $data->field = 'Edit Plan';
            $data->page = 'list_plan';
            $this->load->view('admin/includes/header',$data);       
            $this->load->view('edit',$data);
            $this->load->view('admin/includes/footer',$data);
			}
           else{
		   redirect('Admin');  
		  }			 
        }
        
 		
// neha work coupon //
public function coupon(){ 
//echo 'hello'; die;   
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
           
            $data->records = $this->Plan_model->SelectRecord('coupon_code','*',array(""),'id desc');
            $udata = array("id"=>$this->session->userdata('userid'));                
            $data->result = $this->Plan_model->SelectSingleRecord('admin','*',$udata,$orderby=array());
            $data->title = 'Coupon';
            $data->field = 'Datatable';
            $data->page = 'list_coupon';
            $this->load->view('admin/includes/header',$data);		
            $this->load->view('coupon_viewlist',$data);
            $this->load->view('admin/includes/footer',$data);	
        }
// neha work coupon //		
        
// neha work add coupon code //
public function addcoupon(){ 

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
						'couponc'=>$this->input->post('couponc'),
                        'discount'=>$this->input->post('amount'),                       
                        "created_at"=>date('Y-m-d H:i:s'));

                $last_insertId = $this->Plan_model->InsertRecord('coupon_code',$udata);  
                             
               if($last_insertId){
                    $data->error=0;
                    $data->success=1;
                    $data->message="coupon code Added Successfully";
               }else{
                    $data->error=1;
                    $data->success=0;
                    $data->message="Network Error";
               }
               $this->session->set_flashdata('item',$data);
               redirect('coupon-list');
            }
            $udata = array("id"=>$this->session->userdata('userid'));                
            $data->result = $this->Plan_model->SelectSingleRecord('admin','*',$udata,$orderby=array());

            $data->title = 'Add Coupon';
            $data->field = 'Add Coupon';
            $data->page = 'list_coupon';
            $this->load->view('admin/includes/header',$data);		
            $this->load->view('add_couponcode',$data);
            $this->load->view('admin/includes/footer',$data);                                        
        }


     public function deletecoupon($id){
            $data=new stdClass();
            if($this->Plan_model->delete_record('coupon_code',array("id"=>$id))){
                $data->error=0;
                $data->success=1;
                $data->message="Coupon Code  Deleted Successfully";
            }else{
                $data->error=1;
                $data->success=0;
                $data->message="Network Error";
            }
            $this->session->set_flashdata('item',$data);
            redirect('coupon-list');
        }
        



         public function editcoupon($id){

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

                         $plandata=array(
                         'couponc'=>$this->input->post('couponc'),
                         'discount'=>$this->input->post('amount'),     
                        "created_at"=>date('Y-m-d H:i:s'));

                  
                   if ($this->Plan_model->UpdateRecord('coupon_code',$plandata, array("id"=>$id)))
                    {
                        $data->error=0;
                        $data->success=1;
                        $data->message='Plan Update Sucessfully.';
                                            
                    }else{
                        $data->error=1;
                        $data->success=0;
                        $data->message='Network Error!';                    
                    }
                 $this->session->set_flashdata('item',$data);
                redirect('coupon-list');
            }
            $udata = array("id"=>$this->session->userdata('userid'));                
            $data->result = $this->Plan_model->SelectSingleRecord('admin','*',$udata,$orderby=array());

          $data->reslt = $this->Plan_model->SelectSingleRecord('coupon_code','*',array("id"=>$id),$orderby=array());
            $data->title = 'Edit Coupon';
            $data->field = 'Edit Coupon';
            $data->page = 'list_coupon';
            $this->load->view('admin/includes/header',$data);       
            $this->load->view('editcoupon',$data);
            $this->load->view('admin/includes/footer',$data);                                        
        }


// neha work add coupon // 

// edit staff plan price //
public function staffplan(){
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
           
            $data->records = $this->Plan_model->SelectRecord('pricing_staffplan','*',array(""),'id desc');
            $udata = array("id"=>$this->session->userdata('userid'));                
            $data->result = $this->Plan_model->SelectSingleRecord('admin','*',$udata,$orderby=array());
            $data->title = 'Plans';
            $data->field = 'Datatable';
            $data->page = 'list_planstaff';
            $this->load->view('admin/includes/header',$data);		
            $this->load->view('staffplanlist',$data);
            $this->load->view('admin/includes/footer',$data);
		 }
         else {
		 redirect('Admin');	 
		 }		 
        }



 public function editstaff($id){
	 
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
			   
                        $plandata=array(                      
                        'price'=>$this->input->post('amount'),
						'descriptionfw'=>$this->input->post('descriptionfw'),
						'descriptionfem'=>$this->input->post('descriptionfem'),
						'descriptionfws'=>$this->input->post('descriptionfws'),
						'descriptionmfav'=>$this->input->post('descriptionmfav'),
                        'descriptiontrack'=>$this->input->post('descriptiontrack'),
                        'descriptionprofile'=>$this->input->post('descriptionprofile'),
                        'descriptionprocess'=>$this->input->post('descriptionprocess'),
						'descriptionfeature'=>$this->input->post('descriptionfeature'),	
                        "created_at"=>date('Y-m-d H:i:s')                      
                    );

                  
                   if ($this->Plan_model->UpdateRecord('pricing_staffplan',$plandata, array("id"=>$id)))
                    {
                        $data->error=0;
                        $data->success=1;
                        $data->message='Plan Update Sucessfully.';
                                            
                    }else{
                        $data->error=1;
                        $data->success=0;
                        $data->message='Network Error!';                    
                    }
                 $this->session->set_flashdata('item',$data);
                redirect('Plans/Plan/editstaff/'.$id);
            }
            $udata = array("id"=>$this->session->userdata('userid'));                
            $data->result = $this->Plan_model->SelectSingleRecord('admin','*',$udata,$orderby=array());

           $data->reslt = $this->Plan_model->SelectSingleRecord('pricing_staffplan','*',array("id"=>$id),$orderby=array());
            $data->title = 'Edit Plan';
            $data->field = 'Edit Plan';
            $data->page = 'list_plan';
            $this->load->view('admin/includes/header',$data);       
            $this->load->view('edit_staff_plan',$data);
            $this->load->view('admin/includes/footer',$data);
			}
           else{
		   redirect('Admin');  
		  }			 
        }
        

// edit staff plan price //    

}
