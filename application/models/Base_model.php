<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
Class Base_model extends CI_Model
{
 /*Load metronic theme layout*/
 public function load_metronic_theme($page=NULL,$data=NULL){
 	$this->load->view('common_pages/header');
 	if($page!=""){
 		$this->load->view($page,$data);
    }else{
    	$this->load->view('view_dashboard',$data);
    }
 	$this->load->view('common_pages/footer');

 }
 /*Method count*/
 public function count_record($table=NULL,$where=NULL)
 {
   $this->db->from($table);
   if($where!=NULL){
   $this->db->where($where);
   }
   return $this->db->count_all_results();
 }
 /*QUERY FOR GET SINGLE RECORD WITH JOIN*/
 public function select_single_record_with_join($table,$joinarray,$fields,$where=NULL,$output=NULL)
 {
  $this->db->select($fields);
  $this->db->from($table);
  if(isset($where['where']) &&  $where['where']!=NULL){
		$this->db->where($where['where']);
	}
	if(isset($where['or_where']) && $where['or_where']!=NULL){
		$this->db->or_where($where['or_where']);
	}
	if(isset($where['or_like']) && $where['or_like']!=NULL){
		$this->db->or_like($where['or_like']);
   }
  foreach($joinarray as $joined){	
		$this->db->join(''.$joined['joined_name'].'',''.$joined['joined_id'].' = '.$joined['tabel_id'].'',''.$joined['type'].'');
	}

  $query = $this->db->get();
	if ($query->num_rows() > 0)
	{
		if($output=='array'){
    	    	return  $query->row_array();
    	    }else{
    	    	return  $query->row();
    	} 
	}else{
		return false;
	}
 }
  /*CHECK EXIST QUERY OR GET SINGLE RECORD*/
 public function select_single_record($table=NULL,$fields=NULL,$where=NULL,$output=NULL)
 {
  $this->db->select($fields);
  $this->db->from($table);
  $this->db->where($where);
  $query = $this->db->get();

	if ($query->num_rows() > 0)
	{
		if($output=='exist'){
			return true;
		}else if($output == 'abc'){
			return  $query->row_array();
		}
		else{
            return  $query->row();
        }
	}else{
		return false;
	}
 }
 /*All records by a single query*/
  public function allrecords($tabel,$select,$where=NULL,$output=NULL,$order=NULL,$type=NULL)
  {
    if($where!=NULL){
		$this->db->where($where);
	}
	$this->db->select($select);
	 if($order!=NULL){
            if($type!=NULL){$type=$type;}else{$type='DESC';}
            $this->db->order_by($order,$type);
        }
	$query = $this->db->get($tabel);
    if ($query->num_rows() > 0){
    	    if($output=='array'){
    	    	return $query->result_array();
    	    }else{
    	    	return $query->result();
    	    }
		}else{
			return false;
		}
 }
 /*All records by joined query*/
 public function join_allrecords($tabel,$joinarray,$select,$where=NULL,$type=NULL){
	if(isset($where['where']) &&  $where['where']!=NULL){
		$this->db->where($where['where']);
	}
	if(isset($where['or_where']) && $where['or_where']!=NULL){
		$this->db->or_where($where['or_where']);
	}
	if(isset($where['or_like']) && $where['or_like']!=NULL){
		$this->db->or_like($where['or_like']);
	}
	$this->db->select($select);
	$this->db->from($tabel);
	//LOOP ALL JOINED TABELS
	foreach($joinarray as $joined){	
		$this->db->join(''.$joined['joined_name'].'',''.$joined['joined_id'].' = '.$joined['tabel_id'].'',''.$joined['type'].'');
	}
	$query = $this->db->get();
    if ($query->num_rows() > 0){
		    if($type=="row"){
			return $query->row();
			}else{
			return $query->result();
			}
		}else{
			return false;
		}
	 
	 
 }
 /*@ INSERT QUERY */
 public function insert_record($table=NULL,$fields=NULL,$output=NULL){
	$result = $this->db->insert($table, $fields); 
	if($result==true){
	  if($output=='last_id'){
	  return $this->db->insert_id();
	  }else{
		  return true;
	  }
	}else{
		return false;
	}
 }
  /*@ INSERT QUERY */
 public function update_record($table=NULL,$fields=NULL,$where=NULL){
	$result = $this->db->update($table, $fields,$where); 
	if($result==true){
		return true;
	}else{
		return false;
	}
 }
  /*DELETE QUERY*/
 public function deleteRecord($table=NULL,$where=NULL)
 {
   $query=$this->db->delete($table,$where); 
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