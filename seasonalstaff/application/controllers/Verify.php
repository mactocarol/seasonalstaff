<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ob_start();
class Verify extends HT_Controller{
	function __construct() {
        parent::__construct();        			 
    }
	
public function account()
{	
   
    if($this->uri->segment(3))
	{
    $id=base64_decode($this->uri->segment(3));
	$email_status=$this->getSingleValue($id,'users','email_status');
	if($email_status==1)
	{
		 $this->session->set_flashdata('result', 1);
	     $this->session->set_flashdata('class', 'danger');
	     $this->session->set_flashdata('msg', "Your email id has been already verified");
		 redirect("Welcome/");	
	}
	else{	
    $data=array("email_status"=>1); 
	$this->db->where("id",$id);
	
    //echo $this->db->last_query(); 
	if($this->db->update("users",$data))
	{
		$name=$this->getSingleValue($id,'users','first_name');
		//echo $this->db->last_query(); die;
		$email=$this->getSingleValue($id,'users','email');
		$type=$this->getSingleValue($id,'users','role'); 
		
		    $to = $email;
    		$subject = 'Your account has been verified';
		    $headers = "From: " . 'info@seasonalstaff.co.nz' . "\r\n";
			$headers .= "Content-Type: text/html; charset=UTF-8\r\n";			
            $site_title="Seasonal Staff";
		
		$msg="Congratulations, you account for seasonal staff has now be approved.<br> Please log in to Seasonal staff (<a href='".base_url()."'>".$site_title."</a>) to complete your profile and start using the Seasonal staff website.<br>Kind regards<br>The Seasonal Staff Team.";
	
		 $this->smtpemail($to,$subject,$msg);
		// mail($to, $subject, $message, $headers);
		 
		 $this->session->set_flashdata('result', 1);
	     $this->session->set_flashdata('class', 'success');
	     $this->session->set_flashdata('msg', "Your account has been verified successfully");
		 redirect("Welcome/");
	}
	else{
		 $this->session->set_flashdata('result', 1);
	     $this->session->set_flashdata('class', 'danger');
	     $this->session->set_flashdata('msg', "Error to verify");
		 redirect("Welcome/");
	}
	}
	}
	else{
		 $this->session->set_flashdata('result', 1);
	     $this->session->set_flashdata('class', 'danger');
	     $this->session->set_flashdata('msg', "Error to verify");
		 redirect("Welcome/");
	}
	
}


}