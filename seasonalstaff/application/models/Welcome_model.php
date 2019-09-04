<?php
class Welcome_model extends HT_Model 
{
	function __construct() {
		parent::__construct();		

		$this->users = 'users';
       
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




	    public function checkUser($userData = array()){
		//print_r($userData); die;
        if(!empty($userData)){
        
            $this->db->select('id');
            $this->db->from($this->users);
            $this->db->where(array('facebook'=>$userData['facebook'], 'facebook_id'=>$userData['facebook_id']));
            $prevQuery = $this->db->get();
            $prevCheck = $prevQuery->num_rows();
            
            if($prevCheck > 0){
                $prevResult = $prevQuery->row_array();
                
                $userData['updated_date'] = date("Y-m-d H:i:s");
                $update = $this->db->update($this->users, $userData, array('id' => $prevResult['id']));
                
               
                $userID = $prevResult['id'];
            }else{
                $userData['created_date']  = date("Y-m-d H:i:s");
                $userData['updated_date'] = date("Y-m-d H:i:s");
				$userData['role'] = $this->session->userdata('utype');
                $insert = $this->db->insert($this->users, $userData);
               
			      
            $userID = $this->db->insert_id();
			$ids=base64_encode($userID);
			
			$to =  $userData['email'];
			$subject = 'Welcome, You have now registered with Seasonal staff';
		    $headers = "From: " . 'info@seasonalstaff.co.nz' . "\r\n";
			$headers .= "Content-Type: text/html; charset=UTF-8\r\n";			
            $site_title="Seasonal Staff";
			
	        $message="Welcome and thank you for registering with Seasonal Staff NZ.<br>
			So that we can get you started, please confirmation your email so that we know your details are correct. Verify Email. <br/> <a style='display: inline-block;background-color: #2396F3;color: #fff;text-transform: capitalize;padding: 0 25px;height: 40px;line-height: 40px;border-radius: 2em;font-size: 13px;cursor: pointer;font-weight: 500;text-decoration:none;margin: 15px 0;' href='".base_url()."Verify/account/".$ids."'>Verify Your Email</a><br/>
			We hope you enjoy using our website.<br/>
			Regards<br>
			Sharon and Wayne George.";
	       
            mail($to, $subject, $message, $headers);
        
            }
        }
        
        return $userID?$userID:FALSE;
    }

     public function google_checkUser($userData = array()){

     	if(!empty($userData)){
        
            $this->db->select('id');
            $this->db->from($this->users);
            $this->db->where(array('google'=>$userData['google'], 'google_id'=>$userData['google_id']));
            $prevQuery = $this->db->get();
            $prevCheck = $prevQuery->num_rows();
            
            if($prevCheck > 0){
                $prevResult = $prevQuery->row_array();
             
                $userData['updated_date'] = date("Y-m-d H:i:s");
                $update = $this->db->update($this->users, $userData, array('id' => $prevResult['id']));
               
                $userID = $prevResult['id'];
            }else{
               
                $userData['created_date']  = date("Y-m-d H:i:s");
                $userData['updated_date'] = date("Y-m-d H:i:s");
				$userData['role'] = $this->session->userdata('utype');
                $insert = $this->db->insert($this->users,$userData);
              
            $userID = $this->db->insert_id();
			 //echo $userID; die;
			$ids=base64_encode($userID);			 
			$to =  $userData['email'];
			$subject = 'Welcome, You have now registered with Seasonal staff';
		    $headers = "From: " . 'info@seasonalstaff.co.nz' . "\r\n";
			$headers .= "Content-Type: text/html; charset=UTF-8\r\n";			
            $site_title="Seasonal Staff";
			
	        $message="Welcome and thank you for registering with Seasonal Staff NZ.<br>
			So that we can get you started, please confirmation your email so that we know your details are correct.Verify Email. <br/> <a style='display: inline-block;background-color: #2396F3;color: #fff;text-transform: capitalize;padding: 0 25px;height: 40px;line-height: 40px;border-radius: 2em;font-size: 13px;cursor: pointer;font-weight: 500;text-decoration:none;margin: 15px 0;' href='".base_url()."Verify/account/".$ids."'>Verify Your Email</a><br/>
			We hope you enjoy using our website.<br/>
			Regards<br>
			Sharon and Wayne George.";
	       
            mail($to, $subject, $message, $headers);
            }
        }
        
        //return user ID
        return $userID?$userID:FALSE;
       
    }
	
	// find work //
	public function selectjobcount($location,$from_date,$to_date,$keyword,$oder,$benefit,$workduration){	
	$benefit = explode(",",$benefit); 
	$dayc = explode("-",$workduration);
	$dayc2 = explode("-",$workduration);	
	$dayc = $dayc[0];
    $dayc1 = $dayc2[1];
	
	$from_date1 = date('Y-m-d', strtotime($from_date));
    $to_date1 = date('Y-m-d', strtotime($to_date)); 	
	//$this->db->select('*'); 
	
   $this->db->select(" count(*) as allcount, jobs.*,users.delete,users.business_location,users.email_status");
   $this->db->join("users","jobs.modify_by=users.id","left");   
   
    if($location!=''){	
	$this->db->like('jobs.map_address',$location);
	}
	
	if($from_date!=''){
	$this->db->where('jobs.from_date >=',$from_date1);
	}
	
	if($to_date!=''){
	$this->db->where('jobs.to_date <=',$to_date1);
	}
	
	if($keyword!=''){
    $this->db->like('jobs.job_title', $keyword);
	}
	
	if($benefit!=''){
	foreach($benefit as $key){
		//echo $key; die;	
    $this->db->like('jobs.benifit_id', $key);
	}
	}
	
	if($dayc!='' and $dayc1=="" and $dayc=="181"){    	 	
    $this->db->where('jobs.daycount >', $dayc);
	}
	
	if($dayc!='' and $dayc1=="" and $dayc!="181"){    	 	
    $this->db->where('jobs.daycount <= ', $dayc);
	}
	
	if($dayc!='' and  $dayc1!=''){ 	
    $this->db->where('jobs.daycount >=', $dayc);
	$this->db->where('jobs.daycount <=', $dayc1);
	//}
	
	}
	$this->db->where('users.delete!=',1);
	$this->db->where('users.business_location!=',"");
	$this->db->where('jobs.latitude!=',"");
	$this->db->where('jobs.status',1);
	
	$this->db->where('users.email_status!=',0);	
	//$this->db->where('daycount <=', $dayc1);
	//$this->db->select('count(*) as allcount');
	if($oder!=''){
	$this->db->order_by("jobs.id", $oder);
	}
	else {
	$this->db->order_by("jobs.id", "desc");	
	}
	//$this->db->limit(10); 
    //$result = $this->db->get("jobs");
	
    $this->db->from('jobs');
	$query = $this->db->get();

	$result = $query->result_array();
	
      
    return $result[0]['allcount'];
	
	//echo $this->db->last_query(); die;
	//return $result;
	}
            
	
	
	// find work //
	public function selectjob($rowno,$rowperpage,$location,$from_date,$to_date,$keyword,$oder,$benefit,$workduration){	
	$benefit = explode(",",$benefit);
	$dayc = explode("-",$workduration);
	$dayc2 = explode("-",$workduration);	
	$dayc = $dayc[0];
    $dayc1 = $dayc2[1];
	
	$from_date1 = date('Y-m-d', strtotime($from_date));
    $to_date1 = date('Y-m-d', strtotime($to_date)); 

	$this->db->select("jobs.*,users.delete,users.business_location,users.email_status");
    $this->db->join("users","jobs.modify_by=users.id","left");   
	
	
    if($location!=''){	
	$this->db->like('jobs.map_address',$location);
	}
	if($from_date!=''){
	$this->db->where('jobs.from_date >=',$from_date1);
	}
	if($to_date!=''){
	$this->db->where('jobs.to_date <=',$to_date1);
	}
	if($keyword!=''){
    $this->db->like('jobs.job_title', $keyword);
	}
	
	if($benefit!=''){
	foreach($benefit as $key){
		//echo $key; die;	
    $this->db->like('jobs.benifit_id', $key);
	}
	}
	//echo $workduration; die;
	/* if($workduration!=''){
    $this->db->where("((from_date) = (to_date) - INTERVAL $workduration DAY)");
	} */
	
	if($dayc!='' and $dayc1=="" and $dayc=="181"){    	 	
    $this->db->where('jobs.daycount >', $dayc);
	}
	
	if($dayc!='' and $dayc1=="" and $dayc!="181"){    	 	
    $this->db->where('jobs.daycount <= ', $dayc);
	}
	
	if($dayc!='' and  $dayc1!=''){ 	
    $this->db->where('jobs.daycount >=', $dayc);
	$this->db->where('jobs.daycount <=', $dayc1);
	//}
	
	}
	$this->db->where('users.delete!=',1);
	$this->db->where('users.business_location!=',"");
	$this->db->where('jobs.latitude!=',"");
	$this->db->where('users.email_status!=',0);	
	$this->db->where('jobs.status',1);
	
	if($oder!=''){
	$this->db->order_by("jobs.id", $oder);
	}
	
	else {
	$this->db->order_by("jobs.id", "desc");
	}
	
	$this->db->limit($rowperpage, $rowno);  
    $result = $this->db->get("jobs")->result();

	//echo $this->db->last_query(); die;
	return $result;
	
	}
	
	public function selectjobcc($location,$from_date,$to_date,$keyword,$oder,$benefit,$workduration){	
	$benefit = explode(",",$benefit);
	$dayc = explode("-",$workduration);
	$dayc2 = explode("-",$workduration);	
	$dayc = $dayc[0];
    $dayc1 = $dayc2[1];
	
	$from_date1 = date('Y-m-d', strtotime($from_date));
    $to_date1 = date('Y-m-d', strtotime($to_date)); 

	//$this->db->select("count(jobs.id) as count, jobs.*,users.delete,users.business_location,users.email_status");
   // $this->db->join("users","jobs.modify_by=users.id","left");   
	
	$this->db->select("jobs.*,users.delete,users.business_location,users.email_status");
    $this->db->join("users","jobs.modify_by=users.id","left");   
	
	
    if($location!=''){	
	$this->db->like('jobs.map_address',$location);
	}
	if($from_date!=''){
	$this->db->where('jobs.from_date >=',$from_date1);
	}
	if($to_date!=''){
	$this->db->where('jobs.to_date <=',$to_date1);
	}
	if($keyword!=''){
    $this->db->like('jobs.job_title', $keyword);
	}
	
	if($benefit!=''){
	foreach($benefit as $key){
		//echo $key; die;	
    $this->db->like('jobs.benifit_id', $key);
	}
	}
	//echo $workduration; die;
	/* if($workduration!=''){
    $this->db->where("((from_date) = (to_date) - INTERVAL $workduration DAY)");
	} */
	
	if($dayc!='' and $dayc1=="" and $dayc=="181"){    	 	
    $this->db->where('jobs.daycount >', $dayc);
	}
	
	if($dayc!='' and $dayc1=="" and $dayc!="181"){    	 	
    $this->db->where('jobs.daycount <= ', $dayc);
	}
	
	if($dayc!='' and  $dayc1!=''){ 	
    $this->db->where('jobs.daycount >=', $dayc);
	$this->db->where('jobs.daycount <=', $dayc1);
	//}
	
	}
	$this->db->where('users.delete!=',1);
	$this->db->where('users.business_location!=',"");
	$this->db->where('jobs.latitude!=',"");
	$this->db->where('users.email_status!=',0);	
	$this->db->where('jobs.status',1);
	
	if($oder!=''){
	$this->db->order_by("jobs.id", $oder);
	}
	else {
	$this->db->order_by("jobs.id", "desc");
	}
	
	//$this->db->limit($rowperpage, $rowno);  
    $result = $this->db->get("jobs")->result();
	//echo '<pre>';
    //print_r($result); die;
	//echo $this->db->last_query(); die;
	return $result;
	
	}
	
	
    // find work // 
  
  public function getJob($id=''){
	$this->db->select("jobs.*,company_detail.approve_gap,company_detail.number_gap");
    $this->db->join("company_detail","jobs.modify_by=company_detail.uid","left");
    $this->db->where('jobs.id',$id);
    $result = $this->db->get("jobs")->result();
    //echo $this->db->last_query(); die;
	return $result;
	 }
            
    	// insert //       
public function insert($table,$data)
{
	$this->db->insert($table,$data);
	$id=$this->db->insert_id();
	return ($this->db->affected_rows()>0)? $id:FALSE;
} 
// insert //   
	 
    // cv staff // 
	 function cvstaffs($image_name, $image_path)
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
	 //// cv staff //  //

	 
//  find staff work count data //
public function selectstaffcount($location,$keyword,$from_date,$to_date,$oder,$industry,$industryskills,$workduration){
	
   $from_date1 = date('Y-m-d', strtotime($from_date));
   $to_date1 = date('Y-m-d', strtotime($to_date));

   $ff = explode(" ",$keyword);
   if($ff[1]==""){
   $keyword1 = $keyword;
   $keyword2 = $keyword;   
   }
   else {
	 $keyword1 = $ff[0];
     $keyword2 = $ff[1];	 
   }   
   
   $this->db->select(" count(*) as allcount, users.*,staff_basicinfo.eligibility_address,staff_basicinfo.	current_location,staff_basicinfo.cityLatc,staff_basicinfo.cityLngc,staff_basicinfo.available_date,staff_basicinfo.considered_location,staff_basicinfo.level_english,staff_basicinfo.level_fitness,staff_basicinfo.status,staff_sklills_arti.sklills_description,staff_sklills_arti.licence,staff_employment.jobtitle,staff_employment.em_industry");
   $this->db->join("staff_basicinfo","users.id=staff_basicinfo.staff_id","left");
   $this->db->join("staff_sklills_arti","users.id=staff_sklills_arti.staff_id","left");
   $this->db->join("staff_employment","users.id=staff_employment.staff_id","left");   
	
	
	if($location!=''){   
	$this->db->where("(staff_basicinfo.current_location LIKE '%$location%' OR staff_basicinfo.eligibility_address LIKE '%$location%')");
	//$this->db-> ->group_end()->or_like('staff_basicinfo.eligibility_address',$location);	
	}	
	if($keyword!=''){
    $this->db->where("(staff_employment.jobtitle LIKE '%$keyword%' OR staff_sklills_arti.sklills_description LIKE '%$keyword%'  or users.first_name LIKE '%$keyword1%'  or users.last_name LIKE '%$keyword2%' or users.	username LIKE '%$keyword%')");
	}
	
	if($from_date!=''){
	$this->db->where("staff_basicinfo.available_date >=",$from_date1);	
    //$this->db->where("(staff_basicinfo.available_date LIKE '%$from_date%')");
	} 
    
	if($to_date!=''){
	$this->db->where("users.created_date >=",$to_date1);	
    //$this->db->where("(staff_basicinfo.available_date LIKE '%$from_date%')");
	} 	
	
    if($industry!=''){
    //$this->db->where("(staff_employment.em_industry LIKE '%$industry%')");
     $ff = explode(",",$industry);
	foreach($ff as $keya){
		//echo $key; die;
	$this->db->where("(staff_employment.em_industry LIKE '%$keya%')");	
    //$this->db->like('staff_employment.em_industry', $keya);
	}	
	}
	
	if($industryskills!=''){
    //$this->db->where("(staff_employment.em_industry LIKE '%$industry%')");
     $ff = explode(",",$industryskills);
	foreach($ff as $keyaa){
		//echo $key; die;
	$this->db->where("(staff_sklills_arti.licence LIKE '%$keyaa%')");	
    //$this->db->like('staff_employment.em_industry', $keya);
	}	
	}
	
	$this->db->where("users.role",'staff');
    $this->db->where('users.delete!=',1);
	$this->db->where('users.staffbasicstatus',1);
	$this->db->where('staff_basicinfo.cityLatc!=',"");
	//$this->db->where('staff_sklills_arti.sklills_description!=',"");
	//$this->db->where('staff_employment.jobtitle!=',"");
    $this->db->where('users.email_status!=',0);	
	if($oder!=''){
	$this->db->order_by("users.id", $oder);
	}
	else {
	$this->db->order_by("users.id", "desc");	
	}
	
	
	$this->db->from('users');
	$query = $this->db->get();

	$result = $query->result_array();
	
	//echo $this->db->last_query(); die;
	
	return $result[0]['allcount'];
	
	}
	
	// find staff work count data //  	 
	 
	 
	 

	 
// find staff work //
public function selectstaff($rowno,$rowperpage,$location,$keyword,$from_date,$to_date,$oder,$industry,$industryskills,$workduration){

   $from_date1 = date('Y-m-d', strtotime($from_date));
   $to_date1 = date('Y-m-d', strtotime($to_date)); 
   
   $ff = explode(" ",$keyword);
   if($ff[1]==""){
   $keyword1 = $keyword;
   $keyword2 = $keyword;   
   }
   else {
	 $keyword1 = $ff[0];
     $keyword2 = $ff[1];	 
   }   
   
   $this->db->select("users.*,staff_basicinfo.eligibility_address,staff_basicinfo.	current_location,staff_basicinfo.cityLatc,staff_basicinfo.cityLngc,staff_basicinfo.available_date,staff_basicinfo.considered_location,staff_sklills_arti.licence,staff_basicinfo.level_english,staff_basicinfo.level_fitness,staff_basicinfo.status,staff_sklills_arti.sklills_description,staff_employment.jobtitle,staff_employment.em_industry");
   $this->db->join("staff_basicinfo","users.id=staff_basicinfo.staff_id","left");
   $this->db->join("staff_sklills_arti","users.id=staff_sklills_arti.staff_id","left");
   $this->db->join("staff_employment","users.id=staff_employment.staff_id","left");     
		

    if($location!=''){   
	$this->db->where("(staff_basicinfo.current_location LIKE '%$location%' OR staff_basicinfo.eligibility_address LIKE '%$location%')");	
	}	
	
	if($keyword!=''){
    $this->db->where("(staff_employment.jobtitle LIKE '%$keyword%' OR staff_sklills_arti.sklills_description LIKE '%$keyword%' or users.first_name LIKE '%$keyword1%'  or users.last_name LIKE '%$keyword2%' or users.	username LIKE '%$keyword%')");
	}
	
	if($from_date!=''){
	$this->db->where("staff_basicinfo.available_date <=",$from_date1);	
    //$this->db->where("(staff_basicinfo.available_date LIKE '%$from_date%')");
	} 
    
	if($to_date!=''){
	$this->db->where("users.created_date >=",$to_date1);	
    //$this->db->where("(staff_basicinfo.available_date LIKE '%$from_date%')");
	} 	
	
    if($workduration!=''){
	$date = date('d-m-Y');	
    $this->db->where("((staff_basicinfo.available_date) = ($date) - INTERVAL $workduration DAY)");
	}
	
	if($industry!=''){
    //$this->db->where("(staff_employment.em_industry LIKE '%$industry%')");
     $ff = explode(",",$industry);
	foreach($ff as $keya){
		//echo $key; die;
	$this->db->where("(staff_employment.em_industry LIKE '%$keya%')");	
    //$this->db->like('staff_employment.em_industry', $keya);
	}	
	}
	
	if($industryskills!=''){
    //$this->db->where("(staff_employment.em_industry LIKE '%$industry%')");
     $ff = explode(",",$industryskills);
	foreach($ff as $keyaa){
		//echo $key; die;
	$this->db->where("(staff_sklills_arti.licence LIKE '%$keyaa%')");	
    //$this->db->like('staff_employment.em_industry', $keya);
	}	
	}
	
		
	
	$this->db->where("users.role",'staff');
	$this->db->where('users.delete!=',1);
	$this->db->where('users.staffbasicstatus',1);
	$this->db->where('staff_basicinfo.cityLatc!=',"");
	//$this->db->where('staff_sklills_arti.sklills_description!=',"");
	//$this->db->where('staff_employment.jobtitle!=',"");
	$this->db->where('users.email_status!=',0);
	$this->db->group_by('users.id');  	
	if($oder!=''){
	$this->db->order_by("users.id", $oder);
	}
	else {
	$this->db->order_by("users.id", "desc");
	}
	
	$this->db->limit($rowperpage, $rowno);  
			
    $result = $this->db->get("users")->result();
	//echo $this->db->last_query(); die;
	return $result;
	}
	
public function selectstaffcc($location,$keyword,$from_date,$to_date,$oder,$industry,$industryskills,$workduration){

   $from_date1 = date('Y-m-d', strtotime($from_date));
   $to_date1 = date('Y-m-d', strtotime($to_date));

   $ff = explode(" ",$keyword);
   if($ff[1]==""){
   $keyword1 = $keyword;
   $keyword2 = $keyword;   
   }
   else {
	 $keyword1 = $ff[0];
     $keyword2 = $ff[1];	 
   }      
   
   $this->db->select("users.*,staff_basicinfo.eligibility_address,staff_basicinfo.	current_location,staff_basicinfo.cityLatc,staff_basicinfo.cityLngc,staff_basicinfo.available_date,staff_sklills_arti.licence,staff_basicinfo.considered_location,staff_basicinfo.level_english,staff_basicinfo.level_fitness,staff_basicinfo.status,staff_sklills_arti.sklills_description,staff_employment.jobtitle,staff_employment.em_industry");
   $this->db->join("staff_basicinfo","users.id=staff_basicinfo.staff_id","left");
   $this->db->join("staff_sklills_arti","users.id=staff_sklills_arti.staff_id","left");
   $this->db->join("staff_employment","users.id=staff_employment.staff_id","left");     
		

    if($location!=''){   
	$this->db->where("(staff_basicinfo.current_location LIKE '%$location%' OR staff_basicinfo.eligibility_address LIKE '%$location%')");	
	}	
	
	if($keyword!=''){
    $this->db->where("(staff_employment.jobtitle LIKE '%$keyword%' OR staff_sklills_arti.sklills_description LIKE '%$keyword%' or users.first_name LIKE '%$keyword1%'  or users.last_name LIKE '%$keyword2%' or users.	username LIKE '%$keyword%')");
	}
	
	if($from_date!=''){
	$this->db->where("staff_basicinfo.available_date >=",$from_date1);	
    //$this->db->where("(staff_basicinfo.available_date LIKE '%$from_date%')");
	} 
    
	if($to_date!=''){
	$this->db->where("users.created_date >=",$to_date1);	
    //$this->db->where("(staff_basicinfo.available_date LIKE '%$from_date%')");
	} 	
	
    if($workduration!=''){
	$date = date('d-m-Y');	
    $this->db->where("((staff_basicinfo.available_date) = ($date) - INTERVAL $workduration DAY)");
	}
	
	if($industry!=''){
    //$this->db->where("(staff_employment.em_industry LIKE '%$industry%')");
     $ff = explode(",",$industry);
	foreach($ff as $keya){
		//echo $key; die;
	$this->db->where("(staff_employment.em_industry LIKE '%$keya%')");	
    //$this->db->like('staff_employment.em_industry', $keya);
	}	
	}
	
	if($industryskills!=''){
    //$this->db->where("(staff_employment.em_industry LIKE '%$industry%')");
     $ff = explode(",",$industryskills);
	foreach($ff as $keyaa){
		//echo $key; die;
	$this->db->where("(staff_sklills_arti.licence LIKE '%$keyaa%')");	
    //$this->db->like('staff_employment.em_industry', $keya);
	}	
	}	
		
	
	$this->db->where("users.role",'staff');
	$this->db->where('users.delete!=',1);
	$this->db->where('users.staffbasicstatus',1);
	$this->db->where('staff_basicinfo.cityLatc!=',"");
	//$this->db->where('staff_sklills_arti.sklills_description!=',"");
	//$this->db->where('staff_employment.jobtitle!=',"");
	$this->db->where('users.email_status!=',0);
	$this->db->group_by('users.id');
	if($oder!=''){
	$this->db->order_by("users.id", $oder);
	}
	else {
	$this->db->order_by("users.id", "desc");
	}
	
	//$this->db->limit($rowperpage, $rowno);  
			
    $result = $this->db->get("users")->result();
	//echo $this->db->last_query(); die;
	return $result;
	}
	
	// find staff work //   
	
	// getstaffdetail //
public function getstaffdetail($id){
  
   $this->db->select("users.*,staff_basicinfo.eligibility_address,staff_basicinfo.current_location,
   staff_basicinfo.available_date,staff_basicinfo.considered_location,staff_basicinfo.level_english,
   staff_basicinfo.level_fitness,staff_basicinfo.languages,staff_basicinfo.contact,staff_basicinfo.member_since,
   staff_basicinfo.nationality,staff_basicinfo.basic_description,staff_basicinfo.extra_about,staff_sklills_arti.licence,staff_sklills_arti.sklills_description,
   staff_sklills_arti.cv_ele,staff_employment.jobtitle,staff_employment.employment_description,staff_employment.em_industry,staff_employment.fromdate,
   staff_employment.todate");
   $this->db->join("staff_basicinfo","users.id=staff_basicinfo.staff_id","left");
   $this->db->join("staff_sklills_arti","users.id=staff_sklills_arti.staff_id","left");
   $this->db->join("staff_employment","users.id=staff_employment.staff_id","left");
   $this->db->where("users.id",$id);
   $result = $this->db->get("users")->result();
   //echo $this->db->last_query(); die;
   return $result;
}
// getstaffdetail //

// email //
public function email($to,$subject,$msg)
{	
    $config = array(     
        'mailtype'  => 'html',
        'charset'   => 'utf-8'
    );	
$body = $this->load->view('Common',$msg,TRUE);
$this->load->library('email',$config);
$this->email->set_newline("\r\n");
$this->email->from('info@mactosys.com','Seasonal Jobs');
$this->email->to($to); 
$this->email->subject($subject);
$this->email->message($body);
$this->email->send(); 
}

// email //	

// work for map home page //
public function selectmap()
 { 
$this->db->select("jobs.*,users.first_name,users.last_name,users.delete,users.email_status");
$this->db->join("users","jobs.modify_by=users.id","left");
$this->db->where('jobs.latitude!=','');
$this->db->where('jobs.status',1);
$this->db->where('users.email_status',1);
$this->db->where('users.delete!=',1);
$this->db->order_by('jobs.id','desc');
$this->db->order_by('rand()');
//$this->db->limit(50);
$query = $this->db->get('jobs')->result();
//echo $this->db->last_query(); die;
return $query; 	 
 }

// work for map home page //

// work for map home page //
public function selectmapstaff()
 { 
$this->db->select("staff_basicinfo.*,users.first_name,users.last_name,users.username,users.delete,users.staffbasicstatus,users.email_status,staff_sklills_arti.sklills_description");
$this->db->join("users","staff_basicinfo.staff_id=users.id","left");
$this->db->join("staff_sklills_arti","staff_basicinfo.staff_id=staff_sklills_arti.staff_id","left");
$this->db->where('staff_basicinfo.cityLatc!=','');
$this->db->where('users.username!=','');
//$this->db->where('staff_sklills_arti.sklills_description!=','');
$this->db->where('users.email_status!=',0);
$this->db->where('users.delete!=',1);
$this->db->where('users.staffbasicstatus',1);
$this->db->order_by('staff_basicinfo.id','desc');
$this->db->group_by('users.id');
$this->db->order_by('rand()');
//$this->db->limit(50);
$query = $this->db->get('staff_basicinfo')->result();
//echo $this->db->last_query(); die;
return $query;
 }

// work for map home page //

public function selectmapwork()
 { 
$this->db->select("jobs.*,users.first_name,users.last_name,users.delete,users.email_status");
$this->db->join("users","jobs.modify_by=users.id","left");
$this->db->where('users.delete!=',1);
$this->db->where('jobs.status',1);
$this->db->where('jobs.longitude!=','');
$this->db->where('users.email_status!=',0);
//$this->db->where('mapaddstatus!=',0);
$this->db->order_by('jobs.id','desc');
$this->db->order_by('rand()');
//$this->db->limit(50);
$query = $this->db->get('jobs')->result();
//echo $this->db->last_query(); die;
return $query; 	 
 }
  
// work for blog //
public function selectblogcount($search,$category){
  if($category!='null'){
	$this->db->where("(category LIKE '%$category%')");			
	}
	else {
	if($search!=''){	
	$this->db->where("(title LIKE '%$search%' or category LIKE '%$category%')");	
	}
	}
	
$this->db->select('count(*) as allcount');	
	$this->db->order_by("id", "desc");		
	
    $this->db->from('blog');
	$query = $this->db->get();

	$result = $query->result_array();
	
      
    return $result[0]['allcount'];	
}

public function selectblog($rowno,$rowperpage,$search,$category){
    if($category!='null'){
	$this->db->where("(category LIKE '%$category%')");			
	}
	else {
	if($search!=''){	
	$this->db->where("(title LIKE '%$search%' or category LIKE '%$category%')");	
	}
	}	
	$this->db->order_by("id", "desc");   
	$this->db->limit($rowperpage, $rowno);  
    $result = $this->db->get("blog")->result();

	//echo $this->db->last_query(); die;
	return $result;
}

public function selectblogs()
{
    $this->db->order_by("id", "desc");   
	$this->db->limit(3, 0);  
    $result = $this->db->get("blog")->result();
    //echo $this->db->last_query(); die;	
	return $result;
}

// work for blog //	

// forgotpassword //

public function forgotpassword($email,$code)
{
        $this->db->where("email",$email);
		$query=$this->db->get("users");
		
		if($query->num_rows()>0)
		{
			
		$data=array('code'=>$code);
		$this->db->where('email',$email);
	    $this->db->update('users',$data);
        if($this->db->affected_rows()>0){
			return 1;
		}
		else{
			return 3;
		}}
		else{
			return 2;
		}
}
// forgotpassword //

// blog comment work //

public function blogcomment($id)
{
$this->db->select("blogcomment.*,users.first_name,users.last_name,users.image");
$this->db->join("users","blogcomment.uid=users.id","left");
$this->db->where('blogcomment.bid',$id);
$this->db->where('users.first_name!=',"");
$this->db->order_by('blogcomment.id','desc');
$query = $this->db->get('blogcomment')->result();
//echo $this->db->last_query(); die;
return $query; 	 	
}

// blog comment work //
    
}