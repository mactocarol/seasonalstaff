<?php
class User_model extends HT_Model 
{
	function __construct() {
		parent::__construct();		

        $this->users=' users';
        $this->address=' address';
        $this->plan=' plan';
        $this->role=' role';
        $this->offers=' offers';
		$this->staffpayment= 'staffpayment';
		$this->staff_basicinfo= 'staff_basicinfo';
		$this->staff_sklills_arti= 'staff_sklills_arti';
		$this->staff_employment= 'staff_employment';
	}
            
    
    function check_login($email,$pass)
    {
        $this->db->where('email', $email);
        $this->db->or_where('username', $email);
        $query = $this->db->get('hb_admin');
        if( $query->num_rows() > 0 ){ return True; } else { return False; }
    }
    
    function email_exists($email,$id='')
    {
        $this->db->where('email', $email);
        if(!empty($id)){
                $this->db->where('id !=', $id);
        }
        $query = $this->db->get('users');
        if( $query->num_rows() > 0 ){ return True; } else { return False; }
    }

    function username_exists($username,$id='')
    {
        $this->db->where('username', $username);
        if(!empty($id)){
                $this->db->where('id !=', $id);
        }
        $query = $this->db->get('users');
        if( $query->num_rows() > 0 ){ return True; } else { return False; }
    }

    public function getUsers($userid=''){
        $this->db->select($this->users.'.*');
       //$this->db->select($this->address.'.address,country,latitude,longitude,map_address');
        //$this->db->select($this->staffpayment.'.staff as plan_name,price as plan_amount');
	  // $this->db->select($this->plan.'.name as plan_name,amount as plan_amount');
        $this->db->select($this->role.'.role as role_name');
        $this->db->select($this->offers.'.offer_name,description as offer_description ,discount_amount as offer_discount_amount ,discount_percentage as offer_discount_percentage,from_date as plan_from_date,to_date as plan_to_date');
		$this->db->select($this->staff_basicinfo.'.current_location' ,$this->staff_basicinfo.'cityLatc');
		$this->db->select($this->staff_sklills_arti.'.sklills_description');
		$this->db->select($this->staff_employment.'.jobtitle');
		
        $this->db->from($this->users);
       // $this->db->join($this->plan,$this->plan.'.id='.$this->users.'.plan_id','left');
    	//$this->db->join($this->staffpayment,$this->staffpayment.'.uid='.$this->users.'.id','left');
        $this->db->join($this->role,$this->role.'.role='.$this->users.'.role','left');
        $this->db->join($this->offers,$this->offers.'.id='.$this->users.'.offer_id','left');
		$this->db->join($this->staff_basicinfo,$this->staff_basicinfo.'.staff_id='.$this->users.'.id','left');
		$this->db->join($this->staff_sklills_arti,$this->staff_sklills_arti.'.staff_id='.$this->users.'.id','left');
		$this->db->join($this->staff_employment,$this->staff_employment.'.staff_id='.$this->users.'.id','left');
    
	//   $this->db->join($this->address,$this->address.'.user_id='.$this->users.'.id','left');
     
        //$this->db->where($this->users.'.delete', 0);
        if(!empty($userid)){
             $this->db->where($this->users.'.id',$userid);
        }

        if(!empty($this->input->post('role'))){
            $this->db->where($this->users.'.role',$this->input->post('role'));
        }
		
		 if(!empty($this->input->post('staffprofile')) && $this->input->post('staffprofile')=="complete"){
            $this->db->where($this->users.'.role',"staff");
			$this->db->where($this->staff_basicinfo.'.cityLatc!= ','');
			//$this->db->where($this->staff_sklills_arti.'.sklills_description!=','');
			//$this->db->where($this->staff_employment.'.jobtitle!=','');
			$this->db->where($this->users.'.email_status!=',0);
			$this->db->where($this->users.'.delete!=',1);
        }
		
		if(!empty($this->input->post('staffprofile')) && $this->input->post('staffprofile')=="incomplete"){
            $this->db->where($this->users.'.role',"staff");
			//$this->db->where($this->staff_basicinfo.'.cityLatc'," ");
			//$this->db->where($this->staff_sklills_arti.'.sklills_description'," ");
			//$this->db->where($this->staff_employment.'.jobtitle'," ");
        }
		
		if(!empty($this->input->post('offercode'))){
            $this->db->where($this->users.'.offer_id',$this->input->post('offercode'));
        }
        if(!empty($this->input->post('country'))){

            $this->db->where($this->address.'.country',$this->input->post('country'));
        }

        if(!empty($this->input->post('offerdate'))){

         $this->db->where($this->users.'.created_date >=',date('Y-m-d',strtotime($this->input->post('offerdate'))));
        }
        if(!empty($this->input->post('offerTillDate'))){

               $this->db->where($this->users.'.created_date<=',date('Y-m-d',strtotime($this->input->post('offerTillDate'))));
        }
        // if(!empty($this->uri->segment(1))){
        //      $this->db->where($this->users.'.role',9);
        // }

        $this->db->group_by($this->users.'.id','desc');
        $this->db->order_by($this->users.'.id','desc');
        $query = $this->db->get();
	    //echo $this->db->last_query(); die;
        if($query->num_rows()>0){
            if(!empty($userid)){
                     return $query->row();
            }else{
                     return $query->result();
            }
         }
		
		 else{
            return False;
        }

    }

      public function getStaff($userid=''){

        $this->db->select($this->users.'.*');
        $this->db->select($this->address.'.address,country,latitude,longitude,map_address');
         $this->db->select($this->plan.'.name as plan_name,amount as plan_amount');
          $this->db->select($this->role.'.role as role_name');
           $this->db->select($this->offers.'.offer_name,description as offer_description ,discount_amount as offer_discount_amount ,discount_percentage as offer_discount_percentage,from_date as plan_from_date,to_date as plan_to_date');

        $this->db->from($this->users);
       $this->db->join($this->plan,$this->plan.'.id='.$this->users.'.plan_id','left');
        $this->db->join($this->role,$this->role.'.id='.$this->users.'.role','left');
        $this->db->join($this->offers,$this->offers.'.id='.$this->users.'.offer_id','left');
         $this->db->join($this->address,$this->address.'.user_id='.$this->users.'.id','right');
        
        $this->db->where($this->users.'.delete', 0);
        if(!empty($userid)){
             $this->db->where($this->users.'.id',$userid);
        }

        if(!empty($this->input->post('country'))){

            $this->db->where($this->address.'.country',$this->input->post('country'));
        }

        if(!empty($this->input->post('offerdate'))){
    
            $this->db->where($this->users.'.created_date >=',date('Y-m-d',strtotime($this->input->post('offerdate'). "-1 days")));
        }
        if(!empty($this->input->post('offerTillDate'))){

               $this->db->where($this->users.'.created_date<=',date('Y-m-d',strtotime($this->input->post('offerTillDate'). "+1 days")));
        }

         $this->db->where($this->users.'.role',9);


        $query = $this->db->get();
        if($query->num_rows()>0){
            if(!empty($userid)){
                     return $query->row();
            }else{
                     return $query->result();
            }
         }else{
            return False;
        }

    }

    public function getUserRow($userid){

        if(!empty($userid)){
            $this->db->select('*');
            $this->db->from($this->users);
            $this->db->where('id',$userid);
            $query = $this->db->get();
            if($query){
                return $query->row();
            }else{
                return False;
            }

        }else{
            return False;
        }

    }


}