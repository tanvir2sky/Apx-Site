<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
Class Branches_model extends CI_Model
{
/*
* GET ALL RECORD QUERY 
*/
public function getBranchesAllData($where=NULL,$order=NULL,$type=NULL,$start=NULL,$end=NULL) {
    $this->db->select('brc.*,ctr.countryName as country');
    $this->db->from('apx_branches brc');
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
    $this->db->join('apx_countries ctr', 'brc.countryCode = ctr.countryCode');
    $query = $this->db->get();
    return $query->result_array();
}}
?>