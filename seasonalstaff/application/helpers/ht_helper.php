<?php	
if (!defined('BASEPATH')) exit('No direct script access allowed');

	
	
    function phpmailer($to,$sub,$msg){        
        require("./PHPMailer/class.phpmailer.php");

            $email = 'info@mactosys.com';
            $password = 'info@12345';
            $to_id = $to;
            $message = $msg;
            $subject = $sub;
            $mail = new PHPMailer;
            $mail->isSMTP();
            //$mail->SMTPDebug = 2;
            $mail->Host = "mail.mactosys.com";
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = "ssl";
            $mail->Port = 465;
            $mail->From = "info@mactosys.com";
            $mail->FromName = "Suxxis";            
            $mail->Username = $email;
            $mail->Password = $password;
            if(is_array($to)){
                foreach($to as $val){
                    $mail->addAddress($val);        
                }
            }else{
                $mail->addAddress($to_id);    
            }            
            $mail->Subject = $subject;
            $mail->msgHTML($message);
            //print_r($mail); die;
            $mail->send();
    }
    
    function mail_multiple($to,$sub,$msg){        
        require("./PHPMailer/class.phpmailer.php");

            $email = 'info@mactosys.com';
            $password = 'info@12345';
            $to_id = $to;
            $message = $msg;
            $subject = $sub;
            $mail = new PHPMailer;
            $mail->isSMTP();
            //$mail->SMTPDebug = 2;
            $mail->Host = "mail.mactosys.com";
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = "ssl";
            $mail->Port = 465;
            $mail->From = "info@mactosys.com";
            $mail->FromName = "Suxxis";            
            $mail->Username = $email;
            $mail->Password = $password;
            if(is_array($to)){
                foreach($to as $val){
                    $mail->addAddress($val);        
                }
            }else{
                $mail->addAddress($to_id);    
            }            
            $mail->Subject = $subject;
            $mail->msgHTML($message);
            //print_r($mail); die;
            $mail->send();
    }
        
    function get_upgrade_cost($userid){                   
            $CI =& get_instance();
            $CI->db->select('*');
            $CI->db->where(array('user_id'=>$userid));
            $query = $CI->db->get('mlm_matrix');            
            $reslt = $query->row();
            
            if(empty($reslt)){
                $CI->db->select('*');
                $CI->db->where(array('id'=>1));
                $query = $CI->db->get('upgrade_cost');            
                $amount = $query->row();                
            }else{
                $level = $reslt->level;
                $CI->db->select('*');
                $CI->db->where(array('id'=>$level+1));
                $query = $CI->db->get('upgrade_cost');            
                $amount = $query->row();                
            }                        
            return $amount;
    }
    
    
    function isPartner($userid){                   
            $CI =& get_instance();
            $CI->db->select('*');
            $CI->db->where(array('user_id'=>$userid));
            $query = $CI->db->get('partner');            
            $reslt = $query->row();
            
                                   
            return $reslt;
    }
    
    function get_subscription_validity($userid){
            $CI =& get_instance();
            $CI->db->select('*');
            $CI->db->where(array('user_id'=>$userid));
            $CI->db->where(array('status'=>1));
            $CI->db->where(array('is_lending_fee'=>NULL));
            $CI->db->order_by('id','desc');
            $query = $CI->db->get('user_payment');            
            $reslt = $query->row();
            //print_r($reslt); die;
            return $reslt;
    }
    
    function get_user($userid){
        
            $CI =& get_instance();
            $CI->db->select('*');
            $CI->db->where(array('id'=>$userid));
            $query = $CI->db->get('users');            
            $reslt = $query->row();
            //print_r($userid); die;
            return $reslt;
    }
    
    function get_current_upline_parent($userid, $level){            
            $res = get_parent($userid,$level);
            if($level >= 1){ $res = get_parent($res,$level);}
            if($level >= 2){ $res = get_parent($res,$level);}
            if($level >= 3){ $res = get_parent($res,$level);}
            if($level >= 4){ $res = get_parent($res,$level);}
            if($level >= 5){ $res = get_parent($res,$level);}
            if($level >= 6){ $res = get_parent($res,$level);}
            //print_r($level); die;
            $id = is_user_eligible($res,$level);
            return $id;
            
    }
    
    function get_parent($userid, $level){
            $CI =& get_instance();
            $CI->db->select('*');
            $CI->db->where(array('child_id'=>$userid));
            $query = $CI->db->get('downline');            
            $reslt = $query->row();
            if(!empty($reslt)){
                return $reslt->user_id;                
            }else{
                return 1;
            }            
    }
    
    function is_user_eligible($userid,$level){                   
            $CI =& get_instance();
            $CI->db->select('*');
            $CI->db->where(array('user_id'=>$userid));
            $query = $CI->db->get('matrix');            
            $reslt = $query->row();
            if($userid == 1) { return $userid;}
                if($reslt->level > $level)                                
                 {
                    return $userid;                    
                 }else{
                    $p_id = get_parent($userid, $level);
                    return is_user_eligible($p_id,$level);                    
                 }
    }
    
    
    
    function get_current_cost($userid){                   
            $CI =& get_instance();
            $CI->db->select('*');
            $CI->db->where(array('user_id'=>$userid));
            $query = $CI->db->get('mlm_matrix');            
            $reslt = $query->row();
            
            if(empty($reslt)){
                $CI->db->select('*');
                $CI->db->where(array('id'=>1));
                $query = $CI->db->get('upgrade_cost');            
                $amount = $query->row();                
            }else{
                $level = $reslt->level;
                $CI->db->select('*');
                $CI->db->where(array('id'=>$level));
                $query = $CI->db->get('upgrade_cost');            
                $amount = $query->row();                
            }                        
            return $amount;
    }
    
    function get_latest_payments(){
            $CI =& get_instance();
            $CI->db->select('up.*,u.username,u.image');
            $CI->db->from('user_payment as up');
            $CI->db->join('users as u','up.user_id = u.id','left');
            $CI->db->where('status','1');
            $CI->db->order_by('id','desc');
            $CI->db->limit(10);
            $query = $CI->db->get();            
            $reslt = $query->result();
            return $reslt;          
    }
    
    function get_loan_cost($userid){                   
            $CI =& get_instance();
            $CI->db->select('*');
            $CI->db->where(array('user_id'=>$userid));
            $query = $CI->db->get('mlm_matrix');            
            $reslt = $query->row();
            //print_r($reslt); die;
            if(($reslt->level == 7 || $reslt->level == 7.1)){ 
                $CI->db->select('*');
                $CI->db->where(array('id'=>2));
                $query = $CI->db->get('loan_cost');            
                $amount = $query->row();                
            }else if($reslt->level == 7.2){
                
                $CI->db->select('*');
                $CI->db->where(array('id'=>3));
                $query = $CI->db->get('loan_cost');            
                $amount = $query->row();                
            }else{
                $amount = 0;
            }
            return $amount;
    }
    
    function get_current_loan_stage($userid){                   
            $CI =& get_instance();
            $CI->db->select('lc.*');
            $CI->db->from('matrix as m');
            $CI->db->join('loan_cost as lc','m.level = lc.name','left');
            $CI->db->where(array('m.user_id'=>$userid));
            $query = $CI->db->get('');            
            $reslt = $query->row();
            
                                   
            return $reslt;
    }
    
    function get_time_ago( $time )
    {
        $time_difference = time() - $time;
    
        if( $time_difference < 1 ) { return 'less than 1 second ago'; }
        $condition = array( 12 * 30 * 24 * 60 * 60 =>  'year',
                    30 * 24 * 60 * 60       =>  'month',
                    24 * 60 * 60            =>  'day',
                    60 * 60                 =>  'hour',
                    60                      =>  'minute',
                    1                       =>  'second'
        );
    
        foreach( $condition as $secs => $str )
        {
            $d = $time_difference / $secs;
    
            if( $d >= 1 )
            {
                $t = round( $d );
                return 'about ' . $t . ' ' . $str . ( $t > 1 ? 's' : '' ) . ' ago';
            }
        }
    }
    
    function get_wallet_user($wallet){                   
            $CI =& get_instance();
            $CI->db->select('u.*');
            $CI->db->from('wallet as w');
            $CI->db->join('users as u','w.user_id = u.id','left');
            $CI->db->where(array('w.address'=>$wallet));
            $query = $CI->db->get();            
            $reslt = $query->row();
            
                                   
            return $reslt;
    }
    
    function get_upline_members($userid,$reslt=array()){            
            $res = get_parent($userid,0);            
            if($res == 1){
                $reslt[] = $res;
                return $reslt;
            }else{
                $reslt[] = $res;
                return get_upline_members($res,$reslt);
            }
            
    }
    
    function get_notifications($userid){                   
            $CI =& get_instance();
            $CI->db->select('*');
            $CI->db->where(array('user_id'=>$userid));
            $CI->db->where(array('status'=>0));
            $query = $CI->db->get('notifications');            
            $reslt = $query->result();
            
                                   
            return $reslt;
    }
	
	function get_lincens($id){ 
            if($id){ 
			$idd = explode(",",$id);
			
            $CI =& get_instance();
			$name = [];
			foreach($idd  as $row) {
            $CI->db->select('skills');
            $CI->db->where('id',$row);
            //$CI->db->where(array('status'=>0));
            $query = $CI->db->get('skill');            
            $reslt = $query->row();
			$name[] = $reslt->skills;
			}
			             
            return implode(',',$name);
			}else{
				return 'NA';
			}
    }
	
	function get_industry($id){ 
            if($id){ 
			$idd = explode(",",$id);
			
            $CI =& get_instance();
			$name = [];
			foreach($idd  as $row) {
            $CI->db->select('name');
            $CI->db->where('id',$row);
            //$CI->db->where(array('status'=>0));
            $query = $CI->db->get('industry');            
            $reslt = $query->row();
			$name[] = $reslt->name;
			}
			             
            return implode(',',$name);
			}else{
				return 'NA';
			}
    }
	
	
	function money_format1($format, $number) 
     { 
    $regex  = '/%((?:[\^!\-]|\+|\(|\=.)*)([0-9]+)?'. 
              '(?:#([0-9]+))?(?:\.([0-9]+))?([in%])/'; 
    if (setlocale(LC_MONETARY, 0) == 'C') { 
        setlocale(LC_MONETARY, ''); 
    } 
    $locale = localeconv(); 
    preg_match_all($regex, $format, $matches, PREG_SET_ORDER); 
    foreach ($matches as $fmatch) { 
        $value = floatval($number); 
        $flags = array( 
            'fillchar'  => preg_match('/\=(.)/', $fmatch[1], $match) ? 
                           $match[1] : ' ', 
            'nogroup'   => preg_match('/\^/', $fmatch[1]) > 0, 
            'usesignal' => preg_match('/\+|\(/', $fmatch[1], $match) ? 
                           $match[0] : '+', 
            'nosimbol'  => preg_match('/\!/', $fmatch[1]) > 0, 
            'isleft'    => preg_match('/\-/', $fmatch[1]) > 0 
        ); 
        $width      = trim($fmatch[2]) ? (int)$fmatch[2] : 0; 
        $left       = trim($fmatch[3]) ? (int)$fmatch[3] : 0; 
        $right      = trim($fmatch[4]) ? (int)$fmatch[4] : $locale['int_frac_digits']; 
        $conversion = $fmatch[5]; 

        $positive = true; 
        if ($value < 0) { 
            $positive = false; 
            $value  *= -1; 
        } 
        $letter = $positive ? 'p' : 'n'; 

        $prefix = $suffix = $cprefix = $csuffix = $signal = ''; 

        $signal = $positive ? $locale['positive_sign'] : $locale['negative_sign']; 
        switch (true) { 
            case $locale["{$letter}_sign_posn"] == 1 && $flags['usesignal'] == '+': 
                $prefix = $signal; 
                break; 
            case $locale["{$letter}_sign_posn"] == 2 && $flags['usesignal'] == '+': 
                $suffix = $signal; 
                break; 
            case $locale["{$letter}_sign_posn"] == 3 && $flags['usesignal'] == '+': 
                $cprefix = $signal; 
                break; 
            case $locale["{$letter}_sign_posn"] == 4 && $flags['usesignal'] == '+': 
                $csuffix = $signal; 
                break; 
            case $flags['usesignal'] == '(': 
            case $locale["{$letter}_sign_posn"] == 0: 
                $prefix = '('; 
                $suffix = ')'; 
                break; 
        } 
        if (!$flags['nosimbol']) { 
            $currency = $cprefix . 
                        ($conversion == 'i' ? $locale['int_curr_symbol'] : $locale['currency_symbol']) . 
                        $csuffix; 
        } else { 
            $currency = ''; 
        } 
        $space  = $locale["{$letter}_sep_by_space"] ? ' ' : ''; 

        $value = number_format($value, $right, $locale['mon_decimal_point'], 
                 $flags['nogroup'] ? '' : $locale['mon_thousands_sep']); 
        $value = @explode($locale['mon_decimal_point'], $value); 

        $n = strlen($prefix) + strlen($currency) + strlen($value[0]); 
        if ($left > 0 && $left > $n) { 
            $value[0] = str_repeat($flags['fillchar'], $left - $n) . $value[0]; 
        } 
        $value = implode($locale['mon_decimal_point'], $value); 
        if ($locale["{$letter}_cs_precedes"]) { 
            $value = $prefix . $currency . $space . $value . $suffix; 
        } else { 
            $value = $prefix . $value . $space . $currency . $suffix; 
        } 
        if ($width > 0) { 
            $value = str_pad($value, $width, $flags['fillchar'], $flags['isleft'] ? 
                     STR_PAD_RIGHT : STR_PAD_LEFT); 
        } 

        $format = str_replace($fmatch[0], $value, $format); 
    } 
    return $format; 
} 
	
?>