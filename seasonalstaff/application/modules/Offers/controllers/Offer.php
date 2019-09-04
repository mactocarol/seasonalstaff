<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Offer extends HT_Controller {

	 public function __construct(){            
            parent::__construct();
            $this->load->model('Offer_model');   
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
           
            $data->records = $this->Offer_model->SelectRecord('offers','*',array(""),'id desc');
            $udata = array("id"=>$this->session->userdata('user_id'));                
            $data->result = $this->Offer_model->SelectSingleRecord('admin','*',$udata,$orderby=array());
           $data->title = 'Offers';
            $data->field = 'Datatable';
            $data->page = 'offers_list';
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

                      $dicount_in_percentage='';
                      $dicount_in_amount ='';

                  
					 
					 if(empty($this->input->post('dicount_in_percentage')) && empty($this->input->post('dicount_in_amount'))){

                               $data->error=1;
                               $data->success=0;
                               $data->message="You can enter only discount in percentage or amount";
					
                      }elseif ($this->input->post('dicount_in_percentage')!='' || $this->input->post('dicount_in_amount')!='') {
				
                                     if(!empty($this->input->post('dicount_in_percentage'))){

                                                $dicount_in_percentage = $this->input->post('dicount_in_percentage');
                                                $dicount_in_amount = 'null';

                                          }elseif (!empty($this->input->post('dicount_in_amount'))) {
                                              $dicount_in_amount = $this->input->post('dicount_in_amount');
                                              $dicount_in_percentage = 'null';
                                          }

                                   $udata=array(
                                    'offer_name'=>$this->input->post('offer'),
									'user_type'=>$this->input->post('user_type'),
                                    'discount_percentage'=>$dicount_in_percentage,
                                    'discount_amount'=>$dicount_in_amount,
                                    'from_date'=>date('Y-m-d',strtotime($this->input->post('offerdate'))),
                                   'to_date'=>date('Y-m-d',strtotime($this->input->post('offerTillDate'))),
                                   'description'=>$this->input->post('description'),
                                   "created_date"=>date('Y-m-d H:i:s'),
                                    "status"=>0,
                                    "modify_by"=>$this->session->userdata('userid')

                                );

                            $last_insertId = $this->Offer_model->InsertRecord('offers',$udata);
                            //echo $this->db->last_query(); die;
                                         
                           if($last_insertId){
                                $data->error=0;
                                $data->success=1;
                                $data->message="Offer Added Successfully";
                           }else{
                                $data->error=1;
                                $data->success=0;
                                $data->message="Network Error";
                           }
                      }else{
                                $data->error=1;
                               $data->success=0;
                               $data->message="Please enter only discount in percentage or amount";

                      }

                      
                  

               $this->session->set_flashdata('item',$data);
               redirect('add-offer');
                      
            }
            $udata = array("id"=>$this->session->userdata('user_id'));                
            $data->result = $this->Offer_model->SelectSingleRecord('admin','*',$udata,$orderby=array());

            $data->title = 'Add Offer';
            $data->field = 'Add Offer';
            $data->page = 'offers_list';
            $this->load->view('admin/includes/header',$data);		
            $this->load->view('add',$data);
            $this->load->view('admin/includes/footer',$data);                                        
        }

      
      public function delete($id){
            $data=new stdClass();
            if($this->Offer_model->delete_record('offers',array("id"=>$id))){
                $data->error=0;
                $data->success=1;
                $data->message="Offer Deleted Successfully";
            }else{
                $data->error=1;
                $data->success=0;
                $data->message="Network Error";
            }
            $this->session->set_flashdata('item',$data);
            redirect('offer-list');
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
                      $dicount_in_percentage='';
                      $dicount_in_amount ='';
           
               if(empty($this->input->post('dicount_in_percentage')) && empty($this->input->post('dicount_in_amount'))){

                          
						       $data->error=1;
                               $data->success=0;
                               $data->message="You can enter only offer discount in percentage or amount";

                      }elseif ($this->input->post('dicount_in_percentage')!='' || $this->input->post('dicount_in_amount')!='') {
                                     if(!empty($this->input->post('dicount_in_percentage'))){

                                                $dicount_in_percentage = $this->input->post('dicount_in_percentage');
                                                $dicount_in_amount = 'null';

                                          }elseif (!empty($this->input->post('dicount_in_amount'))) {
                                              $dicount_in_amount = $this->input->post('dicount_in_amount');
                                              $dicount_in_percentage = 'null';
                                          }

                                  $udata=array(
                                    'offer_name'=>$this->input->post('offer'),
									'user_type'=>$this->input->post('user_type'),
                                    'discount_percentage'=>$dicount_in_percentage,
                                    'discount_amount'=>$dicount_in_amount,
                                    'from_date'=>date('Y-m-d',strtotime($this->input->post('offerdate'))),
                                   'to_date'=>date('Y-m-d',strtotime($this->input->post('offerTillDate'))),
                                   'description'=>$this->input->post('description'),
                                   "updated_date"=>date('Y-m-d H:i:s'),
                                    "status"=>0,
                                    "modify_by"=>$this->session->userdata('userid')

                                );
								
                            if($this->Offer_model->UpdateRecord('offers',$udata, array("id"=>$id)))
                            {
                                $data->error=0;
                                $data->success=1;
                                $data->message='Offer Update Sucessfully.';
                                                    
                            }else{
                                $data->error=1;
                                $data->success=0;
                                $data->message='Network Error!';                    
                            }
                      }else{
                                $data->error=1;
                               $data->success=0;
                               $data->message="Please enter only offer discount in percentage or amount";

                      }

                  
                   
                 $this->session->set_flashdata('item',$data);
                redirect('offer-list');
            }
            $udata = array("id"=>$this->session->userdata('userid'));                
            $data->result = $this->Offer_model->SelectSingleRecord('admin','*',$udata,$orderby=array());

          $data->reslt = $this->Offer_model->SelectSingleRecord('offers','*',array("id"=>$id),$orderby=array());
            $data->title = 'Edit Offer';
            $data->field = 'Edit Offer';
            $data->page = 'offers_list';
            $this->load->view('admin/includes/header',$data);       
            $this->load->view('edit',$data);
            $this->load->view('admin/includes/footer',$data);                                        
        }
        
   

}
