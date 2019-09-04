<?php
class Profile_model extends HT_Model 
{
	function __construct() {
		parent::__construct();	

		$this->users=' users';
        $this->address=' address';
        $this->plan=' plan';
        $this->role=' role';
        $this->offers=' offers';	
        $this->industry ='industry';

        $this->jobs ='jobs';
        $this->skill ='skill';
        $this->benefit ='benefit';
        $this->package ='package';
    }
	
    // getJob //	
    public function getJob($id=''){
        $this->db->select($this->jobs.'.*');
        $this->db->select($this->package.'.name as package_name,price as package_price');
        $this->db->select($this->industry.'.name as industry_name');
        $this->db->from($this->jobs);
        $this->db->join($this->package,$this->package.'.id='.$this->jobs.'.package_id','left');
    $this->db->join($this->industry,$this->industry.'.id='.$this->jobs.'.industry_id','left');
    $this->db->where($this->jobs.'.delete',0);
    $this->db->order_by($this->jobs.'.id','desc');
    if(!empty($id)){
        $this->db->where($this->jobs.'.id',$id);
    }
    $sql = $this->db->get();
    if($sql->num_rows()>0){
        if(!empty($id)){
            return $sql->row();
        }else{
            return $sql->result_array();
        }

    }else{
        return False;
    }

    }
	 // getJob //	
	 
	 	  // getJob //	
 public function getJobp($id=''){		
  $this->db->select("jobspreview.*,package.name as package_name,package.price as package_price,industry.name as industry_name");
  $this->db->join("package","jobspreview.package_id=package.id","left");  
   $this->db->join("industry","jobspreview.industry_id=industry.id","left");  
  $this->db->where("jobspreview.id",$id); 
  $result =  $this->db->get('jobspreview')->result();
  //echo $this->db->last_query(); die(); 
  return $result;		
}
	 // getJob //	
	

 // getUsers //	
	public function getUsers($userid=''){
        $this->db->select($this->users.'.*');
        $this->db->select($this->address.'.address,country,latitude,longitude,map_address');
         $this->db->select($this->plan.'.name as plan_name,amount as plan_amount');
          $this->db->select($this->role.'.role as role_name');
           $this->db->select($this->offers.'.offer_name,description as offer_description ,discount_amount as offer_discount_amount ,discount_percentage as offer_discount_percentage,from_date as plan_from_date,to_date as plan_to_date');
           $this->db->select($this->industry.'.id as indusctryId');
            $this->db->select($this->industry.'.name as indusctryName');

        $this->db->from($this->users);
       $this->db->join($this->plan,$this->plan.'.id='.$this->users.'.plan_id','left');
        $this->db->join($this->role,$this->role.'.id='.$this->users.'.role','left');
        $this->db->join($this->offers,$this->offers.'.id='.$this->users.'.offer_id','left');
        $this->db->join($this->industry,$this->industry.'.id='.$this->users.'.industry_id','left');
         $this->db->join($this->address,$this->address.'.user_id='.$this->users.'.id','right');
         
        
        $this->db->where($this->users.'.delete', 0);
        if(!empty($userid)){
             $this->db->where($this->users.'.id',$userid);
        }


        $query = $this->db->get();
        // echo $this->db->last_query(); die;

        if($query->num_rows()>0){
            if(!empty($userid)){
                     return $query->row();
            }else{
                      return $query->result_array();
            }
         }else{
            return False;
        }

    }
	 // getUsers //	
	
	
     // check_login //	
    function check_login($email,$pass)
    {
        $this->db->where('email', $email);
        $this->db->or_where('username', $email);
        $query = $this->db->get('users');
        if( $query->num_rows() > 0 ){ return True; } else { return False; }
    }
   // check_login //	
	
	
     // email_exists //	
    function email_exists($email,$id='')
    {
        $this->db->where('email', $email);
        if(!empty($id)){
                $this->db->where('id !=', $id);
        }
        $query = $this->db->get('users');
        if( $query->num_rows() > 0 ){ return True; } else { return False; }
    }
	  // email_exists //	
	
 // username_exist //	
    function username_exists($username,$id='')
    {
        $this->db->where('username', $username);
        if(!empty($id)){
                $this->db->where('id !=', $id);
        }
        $query = $this->db->get('users');
        if( $query->num_rows() > 0 ){ return True; } else { return False; }
    }
// username_exist //


// company logo //	
 function savecompanylogo($image_name, $image_path)
	 {
		$f_name = $_FILES[$image_name]['name'];
	    $f_tmp = $_FILES[$image_name]['tmp_name']; 
	    $f_extension = explode('.',$f_name); //To breaks the string into array
	    $f_extension = strtolower(end($f_extension)); //end() is used to retrun a last element to the array
	    $f_newfile="";
	    if($f_name){
	    $f_newfile = uniqid().'.'.$f_extension; // It`s use to stop overriding if the image will be same then uniqid() will generate the unique name 
	    $store = "$image_path" . $f_newfile;
	    $file1 =  move_uploaded_file($f_tmp,$store);
		}
		return $f_newfile;
	 }
	 
	 
// company logo //	 	
// insert //       
public function insert($table,$data)
{
	$this->db->insert($table,$data);
	$id=$this->db->insert_id();
	return ($this->db->affected_rows()>0)? $id:FALSE;
} 
// insert //  

// getdata //
public function getdata($table,$where,$sort)
{
	if($where!="")
	$this->db->where($where);
    if($sort!="")
	$this->db->order_by($sort);
	return $this->db->get($table)->result();   
}
// getdata //

// unsetImage //
function unsetImage($uid,$table,$data,$path) {
	
	    $this->db->select($data);
        $this->db->from($table);
		$this->db->where('uid',$uid);
        $query=$this->db->get();		
		if($query->num_rows()>0)
		{
		   $query=$query->result();
		   $img=$query[0]->$data;
           @unlink($path.$img);
		}	
        return true;		
	}
// unsetImage //

// update //
public function update($table,$data,$where)
{
	$this->db->where($where);
	$this->db->update($table,$data);
	return ($this->db->affected_rows()>0)? TRUE:FALSE;
}
// update //



// delete //
public function deletedata($table,$where)
{
	$this->db->where($where);
	$this->db->delete($table);
	if($this->db->affected_rows()>0){
		echo 1;
	}
	else{
		return false;
	}
}
// delete //	

// apply_jobs //
public function getapplyjob($id)
{

  $this->db->select("user_applied_jobs.*,jobs.job_title,jobs.map_address,users.first_name,users.last_name,users.image,staff_basicinfo.current_location");
   $this->db->join("jobs","user_applied_jobs.job_id=jobs.id","left");
   $this->db->join("users","user_applied_jobs.user_id=users.id","left");
   $this->db->join("staff_basicinfo","user_applied_jobs.user_id= staff_basicinfo.staff_id","left");     
   $this->db->where("user_applied_jobs.job_id",$id);
   $this->db->where("users.first_name!=",''); 
   $this->db->where("jobs.job_title!=",'');       
   $this->db->order_by("user_applied_jobs.id","desc");	
   //$this->db->limit(5,0); 
   $result =  $this->db->get('user_applied_jobs')->result();
  //echo $this->db->last_query(); die(); 
  return $result;		
}
// apply_jobs //

// apply_jobs current user //
public function getapplyjobcu($uid)
{

  $this->db->select("user_applied_jobs.*,jobs.job_title,jobs.map_address,users.first_name,users.last_name,users.image,staff_basicinfo.current_location");
   $this->db->join("jobs","user_applied_jobs.job_id=jobs.id","left");
   $this->db->join("users","user_applied_jobs.user_id=users.id","left");
   $this->db->join("staff_basicinfo","user_applied_jobs.user_id= staff_basicinfo.staff_id","left");     
   $this->db->where("user_applied_jobs.job_userid",$uid);
   $this->db->where("users.first_name!=",''); 
   $this->db->where("jobs.job_title!=",'');       
   $this->db->order_by("user_applied_jobs.id","desc");  
   $result =  $this->db->get('user_applied_jobs')->result();
   //echo $this->db->last_query(); die();
  return $result;		
}
// apply_jobs current user //


// manage_interesteduser  current user //
public function getinteresteduser($uid)
{
   $this->db->select("job_like_staff.*,jobs.job_title,jobs.map_address,users.first_name,users.last_name,users.image,staff_basicinfo.current_location");
   $this->db->join("jobs","job_like_staff.job_id=jobs.id","left");
   $this->db->join("users","job_like_staff.user_id=users.id","left");
   $this->db->join("staff_basicinfo","job_like_staff.user_id= staff_basicinfo.staff_id","left");     
   $this->db->where("job_like_staff.job_userid",$uid); 
   $this->db->group_by("job_like_staff.id","desc");  
   $this->db->order_by("job_like_staff.id","desc");  
   $result =  $this->db->get('job_like_staff')->result();   
   return $result;			
}	
// manage_interesteduser  current user //

// getmessage user list //
public function getuser($rid='',$surid='')
{
 if($rid!=''){
   $this -> db -> order_by('FIELD (users.id,'.$rid.')', 'desc', FALSE);	 
  }
 else if($surid!=''){
   $this -> db ->like('users.first_name',$surid);	 
  } 
 else{
	 $this->db->order_by("users.id","desc");
	}	
	
 $uid = $this->session->userdata('user_id');	
 $this->db->select("DISTINCT(users.username),users.*");
 $this->db->join("userschating a","users.id=a.rid","left");
 $this->db->join("userschating b","users.id=b.sid","left");
 //$this->db->where('user.id !=',$uid); 
 $this->db->where("users.id !=$uid AND (a.rid=$uid OR b.sid=$uid OR b.rid=$uid OR a.sid=$uid)");
 $this->db->order_by('users.id','desc');
 
 $result=$this->db->get("users")->result(); 
 //echo $this->db->last_query(); die;
	foreach($result as $key=>$row)
	{
	$id =$row->id;	
	$this->db->select("count(status) as no");
	$this->db->where("status" ,0);
	$this->db->where("sid",$id);
	$this->db->where("rid",$uid);	
    $da =  $this->db->get("userschating")->result();
    $no = $da[0]->no;
    $result[$key]->no = $no;	
	}
	return $result;
	
}
// getmessage  user list //

// get message  //
public function getmsg($sid)
{
  
  $rid = $this->session->userdata('user_id');
  $this->db->where("sid",$sid);
  $this->db->where("rid",$rid);
  $data =array("status"=>1);
  $this->db->update("userschating",$data);  
  $this->db->select("userschating.*,b.first_name as sname,a.first_name as rname, a.last_name as rlname,b.image as image,");
  $this->db->join("users a","userschating.rid=a.id","left"); 
  $this->db->join("users b","userschating.sid=b.id","left"); 
  $this->db->where("sid=$sid and rid=$rid OR sid=$rid and rid=$sid");
  $result=$this->db->get("userschating")->result();  
  return $result;
  
}
// get msg // 


public function getdataoffercode($code){
   
  $this->db->where("offer_name",$code);
  $this->db->where("user_type","employer");
  $this->db->where("CURDATE() between `from_date` and `to_date`");  
  $result=$this->db->get("offers ")->result();
  return $result;
  
}
	

}