<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
Class Admins_model extends CI_Model
{
  /*CHECK EXIST QUERY OR GET SINGLE RECORD*/
 public function select_single_record($where=NULL,$output=NULL)
 {
    $this->db->select('id,first_name,last_name,user_name,email,phone,detail,role_id,picture,created_date,modified_date,status,(select r_name from apx_role where r_id=adm.role_id) as role,(select user_name from apx_admin where id=adm.created_by) as created_name,(select user_name from apx_admin where id=adm.modified_by) as modify_name');
    $this->db->from('apx_admin adm');
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
/*
* GET ALL RECORD QUERY 
*/
public function getUserAllData($where=NULL,$order=NULL,$type=NULL,$start=NULL,$end=NULL) {
    $this->db->select('adm.id,adm.first_name,adm.last_name,adm.user_name,adm.email,adm.phone,adm.detail,rol.r_name as role,adm.status');
    $this->db->from('apx_admin adm');
    if($start >=0 && $end > 0){
       $this->db->limit($end, $start);
    }
    if($where!=NULL){
        $query = $this->db->where($where);
    }
    if($order!=NULL){
        if($type!=NULL){$type=$type;}else{$type='DESC';}
        $this->db->order_by($order,$type);
    }
    $this->db->join('apx_role rol', 'adm.role_id = rol.r_id');
    $query = $this->db->get();
    return $query->result_array();
}
/*INSERT QUERY */
public function insert_record($fields,$lastid=NULL){
$result = $this->db->insert('apx_admin', $fields); 
if($result==true){
  if($lastid=='last_id'){
  return $this->db->insert_id();
  }else{
	  return true;
  }
}else{
	return false;
}
}
/*UPDATE QUERY */
public function update_record($fields,$where){
  $this->db->where($where);
  $result = $this->db->update('apx_admin', $fields); 
  if($result==true){
      return true;
  }else{
    return false;
  }
}
/*DELETE QUERY*/
public function deleteRecord($where=NULL)
{
   $query=$this->db->delete('apx_admin',$where); 
   if($query)
   {
     return true;
	}
   else
   {
     return false;
   }
 }
}
?>