<?php
class Job_model extends HT_Model 
{
	function __construct() {
		parent::__construct();	

		$this->jobs='jobs';
		$this->job_category='job_category';
		$this->users='users';	

	}

	public function getJobs($getUserId=''){
		$this->db->select($this->jobs.'.*');
		$this->db->select($this->job_category.'.category_name');
		$this->db->from($this->jobs);
		$this->db->join($this->job_category,$this->job_category.'.id='.$this->jobs.'.job_category_id','left');
		//$this->db->where($this->jobs.'.delete', 0);
		if(!empty($getUserId)){
			$this->db->where($this->jobs.'.employerId', $getUserId);
		}

		if(!empty($this->input->post('employee'))){
			$this->db->where($this->jobs.'.employerId', $this->input->post('employee'));
		}
		if(!empty($this->input->post('job_cat_id'))){
			$this->db->where($this->jobs.'.job_category_id', $this->input->post('job_cat_id'));
		}

		if(!empty($this->input->post('offerdate'))){
    
            $this->db->where($this->jobs.'.created_date >=',date('Y-m-d',strtotime($this->input->post('offerdate'). "-1 days")));
        }
        if(!empty($this->input->post('offerTillDate'))){

               $this->db->where($this->jobs.'.created_date<=',date('Y-m-d',strtotime($this->input->post('offerTillDate'). "+1 days")));
        }




		$this->db->order_by($this->jobs.'.id','desc');
		$sql = $this->db->get();
		if($sql->num_rows()>0){
			return $sql->result_array();
		}else{
			return False;
		}

	}

 function jobId_exists($jobId,$id='')
    {
        $this->db->where('jobId', $jobId);
        if(!empty($id)){
                $this->db->where('id !=', $id);
        }
        $query = $this->db->get('jobs');
        if( $query->num_rows() > 0 ){ return True; } else { return False; }
    }
   
}