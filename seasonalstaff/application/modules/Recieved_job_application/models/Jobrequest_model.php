<?php
class Jobrequest_model extends HT_Model 
{
	function __construct() {
		parent::__construct();		

		$this->jobs='jobs';
		$this->job_category='job_category';
		$this->users='users';
		$this->user_applied_jobs='user_applied_jobs';	

	}
   
   public function getRecievedJobRequest(){

   		$this->db->select($this->user_applied_jobs.'.*');
		$this->db->select($this->jobs.'.job_title');
		$this->db->select($this->job_category.'.category_name');
		$this->db->select($this->users.'.username,email,contact_number');
		$this->db->from($this->user_applied_jobs);
		$this->db->join($this->job_category,$this->job_category.'.id='.$this->user_applied_jobs.'.job_category_id','left');
		$this->db->join($this->jobs,$this->jobs.'.id='.$this->user_applied_jobs.'.job_id','left');
		$this->db->join($this->users,$this->users.'.id='.$this->user_applied_jobs.'.user_id','left');
		$this->db->where($this->user_applied_jobs.'.delete', 0);
		$this->db->order_by($this->user_applied_jobs.'.id','desc');
		$sql = $this->db->get();
		if($sql->num_rows()>0){
			return $sql->result_array();
		}else{
			return False;
		}

	}
}