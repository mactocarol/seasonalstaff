<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'Welcome';
$route['logout'] = 'Welcome/logout';
$route['user-registration'] = 'Welcome/user_registration';


$route['employee-profile'] = 'Employee_profile/Profile';
$route['update-profile/(:num)'] = 'Employee_profile/Profile/update_Profile/$1';

$route['manage-job'] = 'Employee_profile/Profile/manage_job';
$route['list-a-job'] = 'Employee_profile/Profile/list_a_job';
$route['reviews'] = 'Employee_profile/Profile/reviews';
$route['employee-staff-pricing'] = 'Employee_profile/Profile/pricing';
$route['messages'] = 'Employee_profile/Profile/messages';
$route['about_company'] = 'Employee_profile/Profile/about_company';
$route['work_detail/(:any)/(:num)'] = 'Employee_profile/Profile/work_detail/$1/$2';
$route['manage_applicant/(:num)'] = 'Employee_profile/Profile/manage_applicant/$1';
$route['edit-list-a-job/(:num)'] = 'Employee_profile/Profile/edit_list_a_job/$1';
$route['manage-applicants'] = 'Employee_profile/Profile/manage_applicants';
$route['manage-interesteduser'] = 'Employee_profile/Profile/manage_interesteduser';
/*******************Staff Profile Route**************************************/
$route['staff-profile'] = 'Staff_profile/Staffprofile';
$route['manage-work-profile'] = 'Staff_profile/Staffprofile/manage_work_profile';
$route['apply-jobs'] = 'Staff_profile/Staffprofile/apply_jobs';
$route['interested-jobs'] = 'Staff_profile/Staffprofile/interested_jobs';
$route['staff-message'] = 'Staff_profile/Staffprofile/staff_message';
$route['staffdetails/(:num)'] = 'Staff_profile/Staffprofile/staff_detail/$1';
$route['staff-membership'] = 'Staff_profile/Staffprofile/pricing';
/*******************front Route**************************************/
$route['find-staff'] = 'Welcome/find_staff';;
$route['staff-detail/(:num)'] = 'Welcome/staff_detail/$1';
$route['deals'] = 'Welcome/deals';
$route['deal_detail/(:num)'] = 'Welcome/deal_detail/$1';
/*******************Admin Route**************************************/

$route['admin'] = 'Admin';
$route['users-list'] = 'Users/User';
$route['add-user'] = 'Users/User/add';
$route['edit-user/(:num)'] = 'Users/User/edit/$1';

$route['staff-list'] = 'Users/User/staff_view';
$route['add-staff'] = 'Users/User/staff_add';
$route['edit-staff/(:num)'] = 'Users/User/staffedit/$1';

$route['role-list'] = 'Roles/Role';
$route['add-role'] = 'Roles/Role/add';
$route['edit-role/(:num)'] = 'Roles/Role/edit/$1';

$route['plan-list'] = 'Plans/Plan';
$route['add-plan'] = 'Plans/Plan/add';
$route['edit-plan/(:num)'] = 'Plans/Plan/edit/$1';

$route['coupon-list'] = 'Plans/Plan/coupon';
$route['add-coupon'] = 'Plans/Plan/addcoupon';
$route['edit-coupon/(:num)'] = 'Plans/Plan/editcoupon/$1';

$route['offer-list'] = 'Offers/Offer';
$route['add-offer'] = 'Offers/Offer/add';
$route['edit-offer/(:num)'] = 'Offers/Offer/edit/$1';

$route['job-Category'] = 'JobCategories/JobCategory';
$route['add-job-Category'] = 'JobCategories/JobCategory/add';
$route['edit-job-Category/(:num)'] = 'JobCategories/JobCategory/edit/$1';

$route['job-list'] = 'Jobs/Job';

$route['add-job'] = 'Jobs/Job/add';
$route['edit-job/(:num)'] = 'Jobs/Job/edit/$1'; 

$route['job-request-application'] = 'Recieved_job_application/Jobrequest';

$route['Blog-list'] = 'Blogs/Blog';
$route['add-Blog'] = 'Blogs/Blog/add';
$route['edit-Blog/(:num)'] = 'Blogs/Blog/edit/$1'; 

$route['Skill-list'] = 'Skills/Skill';
$route['add-Skill'] = 'Skills/Skill/add';
$route['edit-Skill/(:num)'] = 'Skills/Skill/edit/$1'; 


$route['Industry-list'] = 'Industries/Industry';
$route['add-Industry'] = 'Industries/Industry/add';
$route['edit-Industry/(:num)'] = 'Industries/Industry/edit/$1'; 

$route['Benefit-list'] = 'Benefits/Benefit';
$route['add-Benefit'] = 'Benefits/Benefit/add';
$route['edit-Benefit/(:num)'] = 'Benefits/Benefit/edit/$1'; 

$route['Package-list'] = 'Packeges/Package';
$route['add-Package'] = 'Packeges/Package/add';
$route['edit-Package/(:num)'] = 'Packeges/Package/edit/$1'; 

/*******************End Admin Route**************************************/
// $route['default_controller'] = 'welcome';
if($this->uri->segment(2)=="user"){
$route['404_override'] = 'welcome';
}
elseif($this->uri->segment(2)=="staffn"){
$route['404_override'] = 'welcome';
}
elseif($this->uri->segment(2)=="go"){
$route['404_override'] = 'Staff_profile/Staffprofile/manage_work_profile';
}
elseif($this->uri->segment(2)=="about"){
$route['404_override'] = 'Employee_profile/Profile/about_company';
}

else {
$route['404_override'] = 'Welcome/pagenotfound';	
}
$route['translate_uri_dashes'] = FALSE;
