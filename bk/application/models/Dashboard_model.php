<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
Class Dashboard_model extends CI_Model
{
  /*CHECK EXIST QUERY OR GET SINGLE RECORD*/
 public function select_single_record($where=NULL,$output=NULL)
 {
  	$this->db->select('id,first_name,last_name,user_name,email,phone,detail,role_id,status');
  	$this->db->from('ep_admin');
  	if($where!=NULL){
  	 	$this->db->where($where);
  	}
  $query = $this->db->get();
	if ($query->num_rows() > 0)
	{
		if($output=='exist'){
			return true;
		}else{
			return  $query->row(); 
		}
	}else{
		return false;
	}
 }
}
?>