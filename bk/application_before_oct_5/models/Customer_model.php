<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
Class Customer_model extends CI_Model
{
/*
* GET ALL RECORD QUERY 
*/
public function getCustomersAllData($where=NULL,$order=NULL,$type=NULL,$start=NULL,$end=NULL) {
    $this->db->select('cst.*,brc.name as branch_name');
    $this->db->from('apx_customer cst');
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
    $this->db->join('apx_branches brc', 'cst.branch_id = brc.branch_id');
    $query = $this->db->get();
    return $query->result_array();
}}
?>