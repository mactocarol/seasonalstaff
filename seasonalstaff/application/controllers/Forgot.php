<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ob_start();
class Forgot extends HT_Controller{
	function __construct() {
        parent::__construct(); 
        $this->load->model("Welcome_model"); 
    }

public function index()
{	
        $this->load->view('front_common/header');
		$this->load->view("pages/Forgot");
		$this->load->view('front_common/footer');
}
	
public function resetpage()
{	
        $this->load->view('front_common/header');
		$this->load->view("pages/Resetpage");
		$this->load->view('front_common/footer');
}

public function resetpassword($id=0){   
	$this->form_validation->set_rules('code', 'Code', 'required');
	//$this->form_validation->set_rules('pass', 'Pass', 'required|min_length[6]|max_length[16]');
	//$this->form_validation->set_rules('cpassword', 'Confirm Password', 'required|min_length[6]|max_length[16]|matches[password]');
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->resetpage($id);			 
		}
		else
		{
        $email=base64_decode($this->input->post('id')); 
	    $code=$this->input->post('code');
	    $password=md5($this->input->post('pass'));
        $this->db->where("code",$code);
		$this->db->where("email",$email);
		$query=$this->db->get("users");
		
		if($query->num_rows()>0)
		{	
		$data=array('password'=>$password,"code"=>0);
		$this->db->where('email',$email);
		$this->db->where('code',$code);
	    $this->db->update('users',$data);
		//echo $this->db->last_query(); die();
        if($this->db->affected_rows()>0){
			   /*  $name=$this->getSingleValue($email,'users','name');
				 $site_title=$this->getdataSingleValue(22,'front_setting','title_english','st');
                 $message="Your password has been successfully reset. Please click here to login at <a href='".base_url('Welcome/login')."'>".$site_title."</a>";
	             $datas['messages']=array($name,$message);
		         $this->email($email,"Password Reset at ".$site_title,$datas); */
				 
		    $to =  $email;
    		$subject = 'Password Change';
		    $headers = "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=UTF-8\r\n";			
            $site_title="Seasonal Jobs";
			
	        $msg="Your password has been successfully reset. Please click here to login at <a href='".base_url('Welcome')."'>".$site_title."</a>";
	       
            //mail($to, $subject, $message, $headers);	
			$this->smtpemail($to,$subject,$msg);	 
				 
		   
				 $this->session->set_flashdata('result', 1);
		         $this->session->set_flashdata('class', 'success');
		         $this->session->set_flashdata('msg', "Password reset successfully");
                 redirect("Welcome");
		}
		else{
		   $this->session->set_flashdata('result', 1);
		   $this->session->set_flashdata('class', 'danger');
		   $this->session->set_flashdata('msg', "Error to reset");
           redirect("Forgot/resetpage/$id"); 
		}}
		else{
		   $this->session->set_flashdata('result', 1);
		   $this->session->set_flashdata('class', 'danger');
		   $this->session->set_flashdata('msg', "Invalid code please try again");
           redirect("Forgot/resetpage/$id"); 
		}
		}	  	
}


public function forgotpassword(){
	    $this->form_validation->set_rules('email', 'Email', 'required|valid_email|min_length[6]|max_length[300]');
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->index();
		}
		else
		{	
	      $email=$this->input->post('email');
		  $code=rand(100000,999999);
	      $data=$this->Welcome_model->forgotpassword($email,$code);
		  
	        if($data==1)
			{
				$emails=base64_encode($email);
				$subject="Reset Password link";
				
				$this->db->select("first_name");
				$this->db->where("email",$email);
				$res=$this->db->get("users")->result();
				$name=$res[0]->name;
				
				/* $msgs="<b>Your reset code is ".$code."</b><br>
							Please click on Reset Button to reset your password.<br>
							<a href='".base_url()."Forgot/resetpage/".$emails."'>Reset Password</a>";
				 $datas['messages']=array($name,$msgs);
                 $body = $this->load->view('Common',$datas,TRUE); */
				 
		    $to =  $email;
    		$subject = 'Reset Password link';
		    $headers = "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=UTF-8\r\n";			
            $site_title="Seasonal Jobs";
			
	        $msg="<b>Your reset code is ".$code."</b><br>
							Please click on Reset Button to reset your password.<br>
							<a href='".base_url()."Forgot/resetpage/".$emails."'>Reset Password</a>";
	       
            //mail($to, $subject, $message, $headers);	
			$this->smtpemail($to,$subject,$msg);		 
				 
                
                 //$this->email($email,$subject,$body);
 
				 $this->session->set_flashdata('result', 1);
		         $this->session->set_flashdata('class', 'success');
		         $this->session->set_flashdata('msg', "We've sent you an email with a link to reset your password.");
                 redirect("Welcome/");
			}
			if($data==2){
				
				 $this->session->set_flashdata('result', 1);
		         $this->session->set_flashdata('class', 'warning');
		         $this->session->set_flashdata('msg', "Account doesn't exist with this email id.");
                 redirect("Forgot"); 
			}
         
           if($data==3){ 
	
           $this->session->set_flashdata('result', 1);
		   $this->session->set_flashdata('class', 'danger');
		   $this->session->set_flashdata('msg', "Error to reset");
           redirect("Forgot"); 
	     }
		}		
}


}