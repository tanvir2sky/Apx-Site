<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//For App permission
if(!function_exists('access_control_apx'))
{
    function access_control_apx($control=NULL,$action=NULL)
    {
    	/*
    	@ FULL is used for menu and complete controller.
    	@ In Specific functions or links use Read
    	*/
    	$CI =& get_instance();
    	$type=$CI->session->userdata('admin_users')['user_type'];
    	$permission = array(
			//super admin
			1=>array(
			'ship_manage'=>array('Full','Read','Add','Edit','Trash','Delete','Excel','Pdf','Status'),
			'customers_manage'=>array('Full','Read','Add','Edit','Trash','Delete','Excel','Pdf','Status'),
			'accounts_manage'=>array('Full','Read','Add','Edit','Trash','Delete','Excel','Pdf','Status'),
			'oprations_manage'=>array('Full','Read','Add','Edit','Trash','Delete','Excel','Pdf','Status'),
			'users_manage'=>array('Full','Read','Add','Edit','Trash','Delete','Excel','Pdf','Status'),
			'reports_manage'=>array('Full','Read','Add','Edit','Trash','Delete','Excel','Pdf','Status'),
			'general_setting'=>array('Full','Read','Add','Edit','Trash','Delete','Excel','Pdf','Status')
			),
			//admin
			2=>array(
			'ship_manage'=>array('Full','Read','Add','Edit','Trash','Delete','Excel','Pdf','Status'),
			'customers_manage'=>array('Full','Read','Add','Edit','Trash','Delete','Excel','Pdf','Status'),
			'accounts_manage'=>array('Full','Read','Add','Edit','Trash','Delete','Excel','Pdf','Status'),
			'oprations_manage'=>array('Full','Read','Add','Edit','Trash','Delete','Excel','Pdf','Status'),
			'users_manage'=>array('Full','Read'),
			'reports_manage'=>array('Full','Read','Add','Edit','Trash','Delete','Excel','Pdf','Status'),
			'general_setting'=>array()
			),
			//accounts
			3=>array(
			'ship_manage'=>array('Read','Add','Edit','Trash','Delete','Excel','Pdf','Status'),
			'customers_manage'=>array(),
			'accounts_manage'=>array('Full','Read','Add','Edit','Trash','Delete','Excel','Pdf','Status'),
			'oprations_manage'=>array(),
			'users_manage'=>array(),
			'reports_manage'=>array(),
			'general_setting'=>array()
			),
			//opration
			4=>array(
			'ship_manage'=>array('Full','Read','Add','Edit','Trash','Delete','Excel','Pdf','Status'),
			'customers_manage'=>array(),
			'accounts_manage'=>array(),
			'oprations_manage'=>array('Full','Read','Add','Edit','Trash','Delete','Excel','Pdf','Status'),
			'users_manage'=>array(),
			'reports_manage'=>array(),
			'general_setting'=>array()
			),
			//customer service
			5=>array(
			'ship_manage'=>array('Full','Read','Add','Edit','Trash','Delete','Excel','Pdf','Status'),
			'customers_manage'=>array('Full','Read','Add','Edit','Trash','Delete','Excel','Pdf','Status'),
			'accounts_manage'=>array(),
			'oprations_manage'=>array(),
			'users_manage'=>array(),
			'reports_manage'=>array(),
			'general_setting'=>array()
			),
		);
    	if(array_key_exists($type,$permission)){
			if(array_key_exists($control,$permission[$type])){
				if(in_array($action,$permission[$type][$control])){
					return TRUE;
				}else{
					return FALSE;
				}
			}else{
				return FALSE;
			}
		}else{
			return FALSE;
		}
	 	 
    }   
}
if(!function_exists('convert_val'))
{
	function convert_val($perms=NULL,$val=NULL){
		if($perms=='country' && $val!=""){
			$CI =& get_instance();
			$CI->db->select('countryName');
	  		$CI->db->from('apx_countries');
	  		$CI->db->where(array('countryCode'=>$val));
	  		$query = $CI->db->get();
			if ($query->num_rows() > 0)
			{
				return  $query->row()->countryName;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}
}