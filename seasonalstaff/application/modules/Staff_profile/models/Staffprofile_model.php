<?php
class Staffprofile_model extends HT_Model 
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
	 	 
 function savecv_ele($image_name, $image_path)
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

// apply_jobs //
public function getapplyjob($uid)
{
   $this->db->select("user_applied_jobs.*,jobs.job_title,jobs.map_address,jobs.contract_type,jobs.industry_id,jobs.modify_by,users.first_name");
   $this->db->join("jobs","user_applied_jobs.job_id=jobs.id","left");
   $this->db->join("users","user_applied_jobs.job_userid=users.id","left");  
   $this->db->where("user_applied_jobs.user_id",$uid);
   $this->db->where("users.first_name!=","");
   $this->db->where("jobs.job_title!=","");
   $this->db->order_by("user_applied_jobs.id","desc");	
   $this->db->limit(5,0); 
   $result =  $this->db->get('user_applied_jobs')->result();
  //echo $this->db->last_query(); die(); 
  return $result;		
}
// apply_jobs //

// apply_jobs //
public function getinterestedjob($uid)
{
   $this->db->select(" user_applied_jobs.*,jobs.job_title,jobs.map_address,jobs.contract_type,jobs.industry_id,jobs.modify_by");
   $this->db->join("jobs"," user_applied_jobs.job_id=jobs.id","left");  
   $this->db->where(" user_applied_jobs.user_id",$uid);
   $this->db->where("jobs.job_title!=",""); 
   $this->db->order_by("user_applied_jobs.id","asc");	

   $resultdd =  $this->db->get('user_applied_jobs')->result();
  
   $this->db->select("job_like_staff.*,jobs.job_title,jobs.map_address,jobs.contract_type,jobs.industry_id,
   jobs.modify_by,job_like_staff.job_id");
   $this->db->join("jobs","job_like_staff.job_id=jobs.id","left"); 
   $this->db->join("user_applied_jobs","job_like_staff.user_id=user_applied_jobs.user_id","left");   
   $this->db->where("job_like_staff.user_id",$uid);
   foreach ($resultdd as $list) {	
   $this->db->where("job_like_staff.job_id!=",$list->job_id);
   }
   $this->db->where("jobs.job_title!=","");
   $this->db->group_by("job_like_staff.id","desc");	
   $this->db->order_by("job_like_staff.id","desc");	
   $this->db->limit(5,0); 
   $result =  $this->db->get('job_like_staff')->result(); 
   return $result;	
}
// apply_jobs //

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
  $this->db->select("userschating.*,b.first_name as sname,a.first_name as rname, b.last_name as slname, b.image as image,");
  $this->db->join("users a","userschating.rid=a.id","left"); 
  $this->db->join("users b","userschating.sid=b.id","left"); 
  $this->db->where("sid=$sid and rid=$rid OR sid=$rid and rid=$sid");
  $result=$this->db->get("userschating")->result();  
  return $result;
  
}
// get msg // 


	// getstaffdetail //
public function getstaffdetail($id){
   $this->db->select("users.*,staff_basicinfo_preview.eligibility_address,staff_basicinfo_preview.current_location,
   staff_basicinfo_preview.available_date,staff_basicinfo_preview.considered_location,staff_basicinfo_preview.level_english,
   staff_basicinfo_preview.level_fitness,staff_basicinfo_preview.languages,staff_basicinfo_preview.contact,
   staff_basicinfo_preview.member_since,staff_basicinfo_preview.nationality,staff_basicinfo_preview.basic_description,
   staff_basicinfo_preview.extra_about,staff_sklills_arti_preview.sklills_description,staff_sklills_arti_preview.licence,staff_employment_preview.jobtitle,
   staff_employment_preview.employment_description,staff_employment_preview.em_industry,staff_employment_preview.fromdate,
   staff_employment_preview.todate");
   $this->db->join("staff_basicinfo_preview","users.id=staff_basicinfo_preview.staff_id","left");
   $this->db->join("staff_sklills_arti_preview","users.id=staff_sklills_arti_preview.staff_id","left");
   $this->db->join("staff_employment_preview","users.id=staff_employment_preview.staff_id","left");
   $this->db->where("users.id",$id);
   $result = $this->db->get("users")->result();
   //echo $this->db->last_query(); die;
   return $result;
}
// getstaffdetail //

public function getdataoffercode($code){
  
 
  $this->db->where("offer_name",$code);
  $this->db->where("user_type","staff");
  $this->db->where("CURDATE() between `from_date` and `to_date`");  
  $result=$this->db->get("offers ")->result();
  return $result;
  
}

// documentup work //
function savedocumentup($image_name, $image_path)
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


function unsetImage1($uid,$table,$data,$path) {
	
	    $this->db->select($data);
        $this->db->from($table);
		$this->db->where('id',$uid);
        $query=$this->db->get();		
		if($query->num_rows()>0)
		{
		   $query=$query->result();
		   $img=$query[0]->$data;
           @unlink($path.$img);
		}	
        return true;		
	}
// documentup work //	

}