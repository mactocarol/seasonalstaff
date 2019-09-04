<?php  
if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 *
 * Used for Meta Info
 *
 * @param none
 * @return array
 */
function template_head(){
	$CI =& get_instance();
	$CI->template->write('title', 'Course Directory');
	$data['metaKeywords'] = strip_tags('Meta Keywords goes here');
	$data['metaDescription'] = strip_tags('Meta Desc Goes here');
	return $data;
}

/**
 *
 * Include Header and Footer
 *
 * @param none
 * @return array
 */
function backend_includes_files(){
	$CI =& get_instance();
	$data['nav'] = 'admin';
	$data['header1'] = $CI->load->view('includes/backend/header',$data,TRUE);
	$data['footer1'] = $CI->load->view('includes/backend/footer','',TRUE);
	$data['front_style_script'] = $CI->load->view('includes/backend/admin_style_scripts','',TRUE);
	return $data;
}

// date-time //
function getago($ftime)
	{
					 $ftime=date("Y-m-d H:i:s",strtotime($ftime));
					 $cdt = date("Y-m-d H:i:s"); 
                     $cdt =  strtotime($cdt); 
					 $ftime = strtotime($ftime);
					 $datediff = ($cdt - $ftime); 
					
					$hrs= round($datediff / 3600);
                    $day= round($datediff / 86400);
                    $min= round($datediff / 60);
                    $month= round($datediff / 60 / 60 / 24 / 30);
					$ago=0;
					if($min==0)
					{
						$ago="Just Now";
					}
					else if($min<60)
					{
						$ago=$min.' Min ago';
					}
					else if($min>=60&&$min<1440)
					{
						$ago=$hrs.' Hours ago';
					}
					else if($min>=1440&&$min<43200)
					{
						$ago=$day.' Days ago';
					}
					else
					{
						$ago=$month.' Months ago';
					}
					return $ago;
	}		
// date-time //	

?>